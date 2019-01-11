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

		// Elements
		add_filter('admin_footer_text', [$factory->elements(), 'footerText']);

		// Dashboard
		add_action('admin_init', [$factory->dashboard(), 'quickDraft']);
		add_action('admin_init', [$factory->dashboard(), 'welcomePanel']);
		add_action('admin_init', [$factory->dashboard(), 'eventsAndNews']);

		// WooCommerce
		add_action('admin_init', [$factory->woocommerce(), 'connectStore']);
		add_filter('woocommerce_show_admin_notice', [$factory->woocommerce(), 'productsBlock'], 10, 2);
	}



}