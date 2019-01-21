# Dashboard Cleanup

Cleans up the WP Admin backend by disabling various bloat features including nag notices, Automattic spam, and other outdated and pointless items.

* [Plugin Homepage](https://www.littlebizzy.com/plugins/dashboard-cleanup)
* [**Become A LittleBizzy.com Member Today!**](https://www.littlebizzy.com/members)

### Defined Constants

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

### Compatibility

This plugin has been designed for use on [SlickStack](https://slickstack.io) web servers with PHP 7.2 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and usability reasons, we strongly recommend avoiding WordPress Multisite for the vast majority of your projects.

Any of our WordPress plugins may also be loaded as "Must-Use" plugins (meaning that they load first, and cannot be deactivated) by using our free [Autoloader](https://github.com/littlebizzy/autoloader) script in the `mu-plugins` directory.

### Support Issues

*Please do not submit Pull Requests. Instead, kindly create a new Issue with relevant information if you are an experienced developer, otherwise post your comments in our free Facebook group.*

***No emails, please! Thank you.***
