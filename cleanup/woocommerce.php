<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Cleanup;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;

/**
 * WooCommerce class
 *
 * @package Dashboard Cleanup
 * @subpackage Cleanup
 */
final class Woocommerce extends Helpers\Singleton {



	/**
	 * Removes the 'Connect your store' WC admin notice
	 */
	public function connectStore() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_WOOCOMMERCE_CONNECT_STORE')) {
			return;
		}

		// Done
		add_filter( 'woocommerce_helper_suppress_connect_notice', '__return_true' );
	}



	/**
	 * Removes the 'Products Block' WC admin notice
	 */
	public function productsBlock() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_WOOCOMMERCE_PRODUCTS_BLOCK')) {
			return;
		}
	}



}