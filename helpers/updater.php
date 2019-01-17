<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Helpers;

/**
 * Updater class
 *
 * @package WordPress Plugin
 * @subpackage Helpers
 */
class Updater {



	/**
	 * The common option to store plugin update data
	 */
	const UPDATE_OPTION_NAME = 'lbpbp_update_plugins';



	/**
	 * Plugin file
	 */
	private $file;



	/**
	 * Plugin repo
	 */
	private $repo;



	/**
	 * Current version
	 */
	private $version;



	/**
	 * Constructor
	 */
	public function __construct($file, $repo, $version) {

		// Set plugin data
		$this->file = $file;
		$this->repo = $repo;
		$this->version = $version;

		// HTTP Request Args short-circuit
		add_filter('http_request_args', [$this, 'httpRequestArgs'], PHP_INT_MAX, 2);

		// Check repo
		if (!empty($this->repo)) {

			// Hook the default plugin rows action
			add_action('load-plugins.php', [$this, 'pluginRow'], 21);

			$this->checkUpdates();
			/* if (!wp_next_scheduled('pbp_update_plugins_'.$this->repo)) {
				wp_schedule_event(time(), 'hourly', 'checkUpdates');
			} */
		}
	}



	/**
	 * Remove default plugin row action
	 */
	public function pluginRow() {

		// Check plugin file based key
		if (false === ($key = $this->fileKey())) {
			return;
		}

		// Check user permissions
		if (!current_user_can('update_plugins')) {
			return;
		}

		// Remove possible default WP action
		remove_action('after_plugin_row_'.$key, 'wp_plugin_update_row', 10);

		// Add a new custom action
		add_action('after_plugin_row_'.$key, [$this, 'pluginRowUpdate'], 10, 2);
	}



	/**
	 * Show custom update info
	 */
	public function pluginRowUpdate($file, $plugin_data) {
	}



	/**
	 * Handles HTTP requests looking for plugin updates
	 * and removes any reference of the current plugin
	 */
	public function httpRequestArgs($args, $url) {

		// Check args
		if (empty($args) || !is_array($args)) {
			return $args;
		}

		// Check endpoint
		if (false === strpos($url, '://api.wordpress.org/plugins/update-check/')) {
			return $args;
		}

		// Check method
		if (empty($args['method']) || 'POST' != $args['method']) {
			return $args;
		}

		// Check plugin file based key
		if (false === ($key = $this->fileKey())) {
			return $args;
		}

		// Check plugins argument
		if (empty($args['body']) || !is_array($args['body']) || empty($args['body']['plugins'])) {
			return $args;
		}

		// Check plugins list
		$data = @json_decode($args['body']['plugins'], true);
		if (empty($data) || !is_array($data)) {
			return $args;
		}

		// Plugins list
		if (!empty($data['plugins']) && is_array($data['plugins']) && isset($data['plugins'][$key])) {
			$modified = true;
			unset($data['plugins'][$key]);
		}

		// Check active plugins
		if (!empty($data['active']) && is_array($data['active']) && in_array($key, $data['active'])) {
			$modified = true;
			$data['active'] = array_diff($data['active'], [$key]);
		}

		// Modifications
		if ($modified) {
			$args['body']['plugins'] = wp_json_encode($data);
		}

		// Done
		return $args;
	}



	/**
	 * Check for private repo plugin updates
	 */
	private function checkUpdates() {

		// Check plugin file based key
		if (false === ($key = $this->fileKey())) {
			return;
		}

		// Compose URL
		$url = str_replace('%repo%', $this->repo, 'https://raw.githubusercontent.com/littlebizzy/%repo%/master/releases.json');

		// Request attempt
		$request = wp_remote_get($url.'?'.rand(0, 99999));
		if (empty($request) || !is_array($request) || empty($request['body'])) {
			return;
		}

		// Check response
		if (empty($request['response']) || !is_array($request['response']) ||
			empty($request['response']['code']) || '200' != $request['response']['code']) {
			return;
		}

		// Check json
		$versions = @json_decode($request['body'], true);
		if (empty($versions) || !is_array($versions)) {
			return;
		}

		// Enum json version
		foreach ($versions as $version => $info) {

			// Compare with current version
			if (!empty($info) && version_compare($version, $this->version, '>')) {

				// Add as a new version, or compare with registered new version (avoid order issues)
				if (empty($greater) || version_compare($version, $greater[0], '>')) {
					$greater = [$version, $info];
				}
			}
		}

		// Save in a common space (no needed to uninstall option data)
		$plugins = $this->plugins();

		// Check update
		if (!empty($greater)) {

			// Check plugin data
			if (is_array($greater[1])) {
				$package = $greater[1][0];
				$readme  = $greater[1][1];

			// No readme
			} else {
				$package = $greater[1];
				$readme  = '';
			}

			if (!isset($plugins[$key])) {
				$plugins[$key] = ['timestamp' => 0];
			}

			// Prepare data
			$plugins[$key]['update'] = [
				'readme' => $readme,
				'package' => $package,
			];

			// Save data
			$this->plugins($plugins);

		// No plugin update but registered before
		} elseif (isset($plugins[$key])) {

			// Unset update info
			$plugins[$key]['update'] = null;

			// Save data
			$this->plugins($plugins);
		}
	}



	/**
	 * Compose plugin key based on main plugin file
	 */
	private function fileKey() {

		// This plugin main file
		if (empty($this->file)) {
			return false;
		}

		// Split in slugs
		$parts = explode('/', $this->file);
		if (count($parts) < 2) {
			return false;
		}

		// Check dir and file
		$dir  = $parts[count($parts) - 2];
		$file = $parts[count($parts) - 1];
		if ('' === $dir || '' === $file) {
			return false;
		}

		// Compose key
		$key = $dir.'/'.$file;

		// Done
		return $key;
	}



	/**
	 * Read or save plugins data
	 */
	private function plugins($plugins = null) {

		// Retrieve plugins
		if (!isset($plugins)) {

			// Retrieve plugins list
			$plugins = @json_decode(get_option(self::UPDATE_OPTION_NAME), true);
			if (empty($plugins) || !is_array($plugins)) {
				$plugins = [];
			}

			// Done
			return $plugins;

		// Update
		} else {

			// Save plugins data
			update_option(self::UPDATE_OPTION_NAME, @json_encode($plugins), false);
		}
	}



}