<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Core;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;
use \LittleBizzy\DashboardCleanup\Cleanup;

/**
 * Object Factory class
 *
 * @package Dashboard Cleanup
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * Cleanup Elements object
	 */
	protected function createElements() {
		return Cleanup\Elements::instance($this->plugin);
	}



	/**
	 * Cleanup Dashboard object
	 */
	protected function createDashboard() {
		return Cleanup\Dashboard::instance($this->plugin);
	}



	/**
	 * Cleanup Woocommerce object
	 */
	protected function createWoocommerce() {
		return Cleanup\Woocommerce::instance($this->plugin);
	}



}