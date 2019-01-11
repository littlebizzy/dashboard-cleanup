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

		// Factory object
		$this->plugin->factory = new Factory($this->plugin);

		// Attempt to run an object
		//$this->plugin->factory->myObject()
	}



}