=== Dashboard Cleanup ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: dashboard, cleanup, wp admin, backend, optimize
Requires at least: 4.4
Tested up to: 5.0
Requires PHP: 7.2
Multisite support: No
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: DSHCLN

Cleans up the WP Admin backend by disabling various bloat features including nag notices, Automattic spam, and other outdated and pointless items.

== Description ==

Cleans up the WP Admin backend by disabling various bloat features including nag notices, Automattic spam, and other outdated and pointless items.

* [**Join our FREE Facebook group for support**](https://www.facebook.com/groups/littlebizzy/)
* [Plugin Homepage](https://www.littlebizzy.com/plugins/dashboard-cleanup)
* [Plugin GitHub](https://github.com/littlebizzy/dashboard-cleanup)

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

#### Compatibility ####

This plugin has been designed for use on [SlickStack](https://slickstack.io) web servers with PHP 7.2 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and usability reasons, we highly recommend avoiding WordPress Multisite for the vast majority of projects.

Any of our WordPress plugins may also be loaded as "Must-Use" plugins by using our free [Autoloader](https://github.com/littlebizzy/autoloader) script in the `mu-plugins` directory.

#### Defined Constants ####

    /* Plugin Meta */
    define('DISABLE_NAG_NOTICES', true);
    
    /* Dashboard Cleanup Functions */
    define('DASHBOARD_CLEANUP_ADD_PLUGIN_TABS', true);
    define('DASHBOARD_CLEANUP_EVENTS_AND_NEWS', true);
    define('DASHBOARD_CLEANUP_LINK_MANAGER_MENU', true);
    define('DASHBOARD_CLEANUP_QUICK_DRAFT', true);
    define('DASHBOARD_CLEANUP_THANKS_FOOTER', true);
    define('DASHBOARD_CLEANUP_WELCOME_TO_WORDPRESS', true);
    define('DASHBOARD_CLEANUP_WOOCOMMERCE_CONNECT_STORE', true);
    define('DASHBOARD_CLEANUP_WOOCOMMERCE_PRODUCTS_BLOCK', true);
    define('DASHBOARD_CLEANUP_WP_ORG_SHORTCUT_LINKS', true); 

#### Technical Details ####

* Prefix: DSHCLN
* Parent Plugin: [**Speed Demon**](https://www.littlebizzy.com/plugins/speed-demon)
* Disable Nag Notices: [Yes](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices#Disable_Nag_Notices)
* Settings Page: No
* PHP Namespaces: Yes
* Object-Oriented Code: Yes
* Includes Media (images, icons, etc): No
* Includes CSS: No
* Database Storage: No
  * Transients: No
  * WP Options Table: No
  * Other Tables: No
  * Creates New Tables: No
  * Creates New WP Cron Jobs: No
* Database Queries: Backend Only (Options API)
* Must-Use Support: [Yes](https://github.com/littlebizzy/autoloader)
* Multisite Support: No
* Uninstalls Data: No (None)

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep these conditions in mind, and refrain from slandering, threatening, or harassing our team members in order to get a feature added, or to otherwise get "free" support. The only place you should be contacting us is in our free [**Facebook group**](https://www.facebook.com/groups/littlebizzy/) which has been setup for this purpose, or via GitHub if you are an experienced developer. Thank you!

#### Our Philosophy ####

> "Decisions, not options." -- WordPress.org

> "Everything should be made as simple as possible, but not simpler." -- Albert Einstein, et al

> "Write programs that do one thing and do it well... write programs to work together." -- Doug McIlroy

> "The innovation that this industry talks about so much is bullshit. Anybody can innovate... 99% of it is 'Get the work done.' The real work is in the details." -- Linus Torvalds

== Installation ==

1. Upload to `/wp-content/plugins/dashboard-cleanup-littlebizzy`
2. Activate via WP Admin > Plugins
3. Test plugin is working

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is no settings page, everything works automatically.

= I have a suggestion, how can I let you know? =

Join our free Facebook group.

== Changelog ==

= 1.0.0 =
* initial release
* PBP v1.1.1
* tested with PHP 7.0, 7.1, 7.2
* tested with PHP 5.6 (no fatal errors only)
* uses PHP namespaces
* object-oriented codebase
* disables/removes "Thank you for creating with WordPress" footer tag
* disables/removes Quick Draft dashboard widget
* disables/removes Welcome to WordPress admin notice
* disables/removes WordPress Events and News dashboard widget
* disables/removes WooCommerce admin notice "Connect your store to WooCommerce.com to receive extensions updates and support."
* disables/removes WooCommerce admin notice "We noticed you have the block editor available: Try the WooCommerce Products Block for a powerful new way to feature products in posts.
* disables/removes the shortcut links (drop down menu icon) to WordPress.org in the top left of WP Admin toolbar
* disables/removes Links menu in WP Admin, even if links exist in database (wp_links)
* disable/remove "Featured plugins" tab and "Favorites plugins" tab in the Add New Plugins area
