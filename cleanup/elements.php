<?php

// Subpackage namespace
namespace LittleBizzy\DashboardCleanup\Cleanup;

// Aliased namespaces
use \LittleBizzy\DashboardCleanup\Helpers;

/**
 * Elements class
 *
 * @package Dashboard Cleanup
 * @subpackage Cleanup
 */
final class Elements extends Helpers\Singleton {



	/**
	 * Removes the thank you footer text
	 */
	public function footerText($text) {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP') ||
			!$this->plugin->enabled('DASHBOARD_CLEANUP_THANKS_FOOTER')) {
			return $text;
		}

		//  OnlyRemoves the thank you message
		if (false !== ($pos = strpos($text, '<span id="footer-thankyou">')) && false !== ($pos2 = strpos($text, '</span>', $pos)) ) {
			$text = substr($text, 0, $pos).substr($text, $pos2 + 7);
		}

		// Done
		return $text;
	}



	/**
	 * Removes the WP.org logo and shortcut links (top left of the screen)
	 */
	public function WPORGShortcutLinks() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP') ||
			!$this->plugin->enabled('DASHBOARD_CLEANUP_WP_ORG_SHORTCUT_LINKS')) {
			return;
		}

		// Done
		remove_action('admin_bar_menu', 'wp_admin_bar_wp_menu');
	}



	/**
	 * Removes the Link Manager menu item, enabled it or disabled
	 * This behaviour is controlled in wp_options table record link_manager_enabled (values 0 or 1)
	 */
	public function linkManagerMenu() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP') ||
			!$this->plugin->enabled('DASHBOARD_CLEANUP_LINK_MANAGER_MENU')) {
			return;
		}

		// Globals
		global $submenu;

		// Check first the submenu (fast method)
		if (empty($submenu) || !is_array($submenu) || !isset($submenu['link-manager.php'])) {
			return;
		}

		// Remove submenus
		unset($submenu['link-manager.php']);

		// Check menu
		global $menu;
		if (empty($menu) || !is_array($menu)) {
			return;
		}

		// Find the Links item in main menu
		foreach ($menu as $index => $data) {

			// Check data
			if (empty($data) || !is_array($data)) {
				continue;
			}

			// Check links handler
			if (!empty($data[1]) && 'manage_links' == $data[1]) {
				unset($menu[$index]);
				return;
			}
		}
	}



	/**
	 * Removes Add new plugin Featured and Favorites tab, and set Popular as the default tab
	 */
	public function addPluginTabs($tabs) {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP') ||
			!$this->plugin->enabled('DASHBOARD_CLEANUP_ADD_PLUGIN_TABS')) {
			return $tabs;
		}

		// Check tabs value
		if (!empty($tabs) && is_array($tabs)) {
			unset($tabs['featured']);
			unset($tabs['favorites']);
		}

		// Set Popular as default
		if (empty($_GET['tab'])) {
			global $tab;
			$tab = 'popular';
		}

		// Done
		return $tabs;
	}



	/**
	 * Remove top admin bar search icon/field
	 */
	public function removeAdminTopSearch() {

		// Last minute check
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP') ||
			!$this->plugin->enabled('DASHBOARD_CLEANUP_DISABLE_SEARCH')) {
			return;
		}

		// Remove WP hook handler
		remove_action('admin_bar_menu', 'wp_admin_bar_search_menu', 4);
	}



}