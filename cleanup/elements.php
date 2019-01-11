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
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_THANKS_FOOTER')) {
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
		if (!$this->plugin->enabled('DASHBOARD_CLEANUP_WP_ORG_SHORTCUT_LINKS')) {
			return;
		}

		// Done
		remove_action('admin_bar_menu', 'wp_admin_bar_wp_menu');
	}



}