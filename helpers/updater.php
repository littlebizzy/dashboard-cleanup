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
			$this->checkUpdates();
			/* if (!wp_next_scheduled('pbp_update_plugins_'.$this->repo)) {
				wp_schedule_event(time(), 'hourly', 'checkUpdates');
			} */
		}
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

		// This plugin main file
		if (empty($this->file)) {
			return $args;
		}

		// Split in slugs
		$parts = explode('/', $this->file);
		if (count($parts) < 2) {
			return $args;
		}

		// Check plugins list
		$data = @json_decode($args['body']['plugins'], true);
		if (empty($data) || !is_array($data)) {
			return $args;
		}

		// Check plugin key
		$key = $parts[count($parts) - 2].'/'.$parts[count($parts) - 1];

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

		// Compose URL
		$url = str_replace('%repo%', $this->repo, 'https://raw.githubusercontent.com/littlebizzy/%repo%/master/releases.json');

		// Request attempt
		$response = wp_remote_get($url);
		if (empty($response) || !is_array($response)) {
			return;
		}

		//print_r($response);die;
	}



}