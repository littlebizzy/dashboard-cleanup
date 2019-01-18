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
	 * The common option across PBP plugins to check last plugin timestamp
	 */
	const TIMESTAMP_OPTION_NAME = 'lbpbp_update_plugins_ts';



	/**
	 * Interval between update checks
	 */
	const INTERVAL_UPDATE_CHECK = 6 * 3600; // 6 hours



	/**
	 * Random time added to the update interval
	 */
	const INTERVAL_UPDATE_CHECK_RAND  = 3600; // 1 hour



	/**
	 * Plugin constants
	 */
	private $file;
	private $prefix;
	private $version;
	private $repo;



	/**
	 * Plugin directory/file key
	 */
	private $key;



	/**
	 * Constructor
	 */
	public function __construct($file, $prefix, $version, $repo) {

		// Set plugin data
		$this->file 	= $file;
		$this->prefix 	= $prefix;
		$this->version 	= $version;
		$this->repo 	= $repo;

		// Check plugin file based key
		if (false === ($this->key = $this->fileKey())) {
			return;
		}

		// HTTP Request Args short-circuit
		add_filter('http_request_args', [$this, 'httpRequestArgs'], PHP_INT_MAX, 2);

		// Check repo
		if (!empty($this->repo)) {

			// Scheduling checks
			$this->scheduling();

			// Hook the default plugin rows action
			add_action('load-plugins.php', [$this, 'pluginRow'], 21);
		}
	}



	/**
	 * Remove default plugin row action
	 */
	public function pluginRow() {

		// Check user permissions
		if (!current_user_can('update_plugins')) {
			return;
		}

		// Remove possible default WP action
		remove_action('after_plugin_row_'.$this->key, 'wp_plugin_update_row', 10);

		// Add a new custom action
		add_action('after_plugin_row_'.$this->key, [$this, 'pluginRowUpdate'], 10, 2);
	}



	/**
	 * Show custom update info
	 */
	public function pluginRowUpdate($file, $data) {
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
		if (!empty($data['plugins']) && is_array($data['plugins']) && isset($data['plugins'][$this->key])) {
			$modified = true;
			unset($data['plugins'][$this->key]);
		}

		// Check active plugins
		if (!empty($data['active']) && is_array($data['active']) && in_array($this->key, $data['active'])) {
			$modified = true;
			$data['active'] = array_diff($data['active'], [$this->key]);
		}

		// Modifications
		if ($modified) {
			$args['body']['plugins'] = wp_json_encode($data);
		}

		// Done
		return $args;
	}



	/**
	 * Schedule update checks
	 */
	private function scheduling() {

		// Global timestamp option
		global $lbpbp_update_plugins_ts;
		if (!isset($lbpbp_update_plugins_ts)) {

			// Retrieve global plugin timestamps data
			$lbpbp_update_plugins_ts = @json_decode(get_option(self::TIMESTAMP_OPTION_NAME), true);
			if (empty($lbpbp_update_plugins_ts) || !is_array($lbpbp_update_plugins_ts)) {
				$lbpbp_update_plugins_ts = [];
			}

			// Timestamps saving
			add_action('init', [$this, 'timestamps']);
		}

		// Check last update check
		$timestamp = empty($lbpbp_update_plugins_ts[$this->key])? 0 : (int) $lbpbp_update_plugins_ts[$this->key];
		if (!empty($timestamp) && time() < $timestamp + self::INTERVAL_UPDATE_CHECK + self::INTERVAL_UPDATE_CHECK_RAND) {
			return;
		}

		// Update check
		$lbpbp_update_plugins_ts[$this->key] = time() + rand(0, self::INTERVAL_UPDATE_CHECK_RAND);

		// Set scheduling
		// ..

		// Debug point
		$this->checkUpdates();
		/* if (!wp_next_scheduled('pbp_update_plugins_'.$this->repo)) {
			wp_schedule_event(time(), 'hourly', 'checkUpdates');
		} */
	}



	/**
	 * Save common timestamps option
	 */
	public function timestamps() {

		// Globals
		global $lbpbp_update_plugins_ts;

		// Current timestamp
		$time = time();

		// Clean outdated
		foreach ($lbpbp_update_plugins_ts as $key => $timestamp) {
			if ($key != $this->key && $time >= $timestamp + self::INTERVAL_UPDATE_CHECK + self::INTERVAL_UPDATE_CHECK_RAND) {
				unset($lbpbp_update_plugins_ts[$key]);
			}
		}

		// Update once for al PBP plugins
		update_option(self::TIMESTAMP_OPTION_NAME, @json_encode($lbpbp_update_plugins_ts), true);
	}



	/**
	 * Check for private repo plugin updates
	 */
	private function checkUpdates() {

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

			// Plugin data
			$data = [
				'readme' => $readme,
				'package' => $package,
			];

			// Save data
			$this->store($data);

		// No plugin info
		} else {

			// Remove update if not empty
			$data = $this->store();
			if (!empty($data)) {
				$this->store([]);
			}
		}
	}



	/**
	 * Read or save plugins data
	 */
	private function store($data = null) {

		// Option name
		$option = $this->prefix.'_update_plugins';

		// Update
		if (isset($data)) {

			// Save plugins data
			update_option($option, @json_encode($data), false);

		// Retrieve
		} else {

			// Retrieve plugins list
			$data = @json_decode(get_option($option), true);
			if (empty($data) || !is_array($data)) {
				$data = [];
			}

			// Done
			return $data;
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



}