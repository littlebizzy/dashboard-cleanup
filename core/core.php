<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Core;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;

/**
 * Core class
 *
 * @package Dashboard Cleanup
 * @subpackage Core
 */
final class Core extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		// Check admin area
		if (!$this->plugin->context()->admin()) {
			return;
		}

		// Factory object
		$factory = new Factory($this->plugin);

		// Cleanup filters
		add_filter('admin_footer_text', [$factory->elements(), 	'footerText']);
		add_action('admin_init', 		[$factory->dashboard(), 'quickDraft']);
	}



}