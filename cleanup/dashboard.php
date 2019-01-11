<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Cleanup;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;

/**
 * Dashboard class
 *
 * @package Dashboard Cleanup
 * @subpackage Cleanup
 */
final class Dashboard extends Helpers\Singleton {



	/**
	 * Removes the WP welcome panel
	 */
	public function welcomePanel() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_WELCOME_TO_WORDPRESS')) {
			return;
		}

		// Done
		remove_action('welcome_panel', 'wp_welcome_panel');
	}



	/**
	 * Removes the 'Quick Draft' widget
	 */
	public function quickDraft() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_QUICK_DRAFT')) {
			return;
		}

		// Done
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	}



	/**
	 * Removes the 'Events and News' widget
	 */
	public function eventsAndNews() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_EVENTS_AND_NEWS')) {
			return;
		}

		// Done
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	}



}