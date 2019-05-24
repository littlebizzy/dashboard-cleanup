=== Dashboard Cleanup ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: dashboard, cleanup, wp admin, backend, optimize
Requires at least: 4.4
Tested up to: 5.2
Requires PHP: 7.2
Multisite support: No
Stable tag: 1.1.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: DSHCLN

Cleans up the WP Admin backend by disabling various core WP and WC bloat features including Automattic spam, nag notices, tracking, and other items.

#### Current Features ####

* disables/removes "Thank you for creating with WordPress" footer tag
* disables/removes Quick Draft dashboard widget
* disables/removes Welcome to WordPress admin notice
* disables/removes WordPress Events and News dashboard widget
* disables/removes WooCommerce admin notice "Connect your store to WooCommerce.com to receive extensions updates and support."
* disables/removes WooCommerce admin notice "We noticed you have the block editor available: Try the WooCommerce Products Block for a powerful new way to feature products in posts.
* disables/removes the shortcut links (drop down menu icon) to WordPress.org in the top left of WP Admin toolbar
* disables/removes Links menu in WP Admin, even if links exist in database (wp_links)
* disable/remove "Featured plugins" tab and "Favorites plugins" tab in the Add New Plugins area
* and several more tweaks...

== Changelog ==

= 1.1.2 =
* DASHBOARD_CLEANUP_ADD_THEME_TABS
* DASHBOARD_CLEANUP_CSS_ADMIN_NOTICE
* DASHBOARD_CLEANUP_DISABLE_SEARCH
* DASHBOARD_CLEANUP_IMPORT_EXPORT_MENU
* DASHBOARD_CLEANUP_WOOCOMMERCE_MARKETPLACE_SUGGESTIONS
* DASHBOARD_CLEANUP_WOOCOMMERCE_TRACKER

= 1.1.1 =
* DASHBOARD_CLEANUP
* DASHBOARD_CLEANUP_WOOCOMMERCE_FOOTER_TEXT
* fix: removed WP.org shortcut links dropdown from frontend (previously only working on backend)

= 1.1.0 =
* PBP v1.2.0

= 1.0.0 =
* initial release
* PBP v1.1.1
* DASHBOARD_CLEANUP_ADD_PLUGIN_TABS
* DASHBOARD_CLEANUP_EVENTS_AND_NEWS
* DASHBOARD_CLEANUP_LINK_MANAGER_MENU
* DASHBOARD_CLEANUP_QUICK_DRAFT
* DASHBOARD_CLEANUP_THANKS_FOOTER
* DASHBOARD_CLEANUP_WELCOME_TO_WORDPRESS
* DASHBOARD_CLEANUP_WOOCOMMERCE_CONNECT_STORE
* DASHBOARD_CLEANUP_WOOCOMMERCE_FOOTER_TEXT
* DASHBOARD_CLEANUP_WOOCOMMERCE_PRODUCTS_BLOCK
* DASHBOARD_CLEANUP_WP_ORG_SHORTCUT_LINKS
