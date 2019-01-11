<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Core;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;

/**
 * Object Factory class
 *
 * @package Dashboard Cleanup
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * A core object
	 */
	protected function createCoreObject() {
		return new MyCoreObject;
	}



	/**
	 * A singleton object instance
	 */
	protected function createOtherObject() {
		return Subdirectory\TheClassName::instance($this->plugin);
	}



	/**
	 * Create new object
	 */
	protected function createNewObject($args) {
		return new Subdirectory\TheClassName($args);
	}



}