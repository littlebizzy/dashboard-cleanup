=== Plugin Name ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: five, keywords, separated, by, commas
Requires at least: 4.4
Tested up to: 5.0
Requires PHP: 7.2
Multisite support: No
Stable tag: 1.2.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: plugin-name-littlebizzy
Domain Path: /lang
Prefix: ABCXYZ

Description of the plugin goes here, limited to 150 characters or less and should be a single well-written sentence that includes some of your most important keywords.

== Description ==

Description of the plugin goes here, limited to 150 characters or less and should be a single well-written sentence that includes some of your most important keywords.

* [**Join our FREE Facebook group for support**](https://www.facebook.com/groups/littlebizzy/)
* [**Worth a 5-star review? Thank you!**](https://wordpress.org/support/plugin/example-littlebizzy/reviews/?rate=5#new-post)
* [Plugin Homepage](https://www.littlebizzy.com/plugins/disable-emojis)
* [Plugin GitHub](https://github.com/littlebizzy/disable-emojis)
* [SlickStack](https://slickstack.io)

#### The Long Version ####

Here you can place a longer description of the plugin and its features, separated into paragraphs.

    code snippet is indented with four spaces;

#### Compatibility ####

This plugin has been designed for use on LEMP (Nginx) web servers with PHP 7.0 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and security reasons, we highly recommend against using WordPress Multisite for the vast majority of projects.

Note: Any WordPress plugin may also be loaded as "Must-Use" by using the [Autoloader](https://github.com/littlebizzy/autoloader) script within the `mu-plugins` directory.

#### Defined Constants ####

The following defined constants are supported by this plugin:

* `define('DISABLE_NAG_NOTICES', true);`

Why no quotes? Adding quotes evaluates the 'false' or "false" values as a string, and the boolean evaluation of any string returns true (except for empty strings).

It is a little bit weird but PHP works this way because it does not require strong data typing. There are special operatos (the triple equality ===) to ensure the right data type, but adds complexity and it is used normally where you are not sure of the input variable data type.

It is true that there are constants that expects both boolean and string values, but the important thing here is that the false value does not contain quotes, e.g.:

define('DISABLE_CART_FRAGMENTS', true);
define('DISABLE_CART_FRAGMENTS', false);
define('DISABLE_CART_FRAGMENTS', '123,456,789');

#### Plugin Features ####

* Parent Plugin: [**SEO Genius**](https://www.littlebizzy.com/plugins/seo-genius)
* Disable Nag Notices: [[Yes](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices#Disable_Nag_Notices)]
* Settings Page: No
* PHP Namespaces: Yes
* Object-Oriented Code: Yes
* Includes Media (images, icons, etc): No
* Includes CSS: No
* Database Storage: Yes
  * Transients: No
  * WP Options Table: Yes
  * Other Tables: No
  * Creates New Tables: No
* Database Queries: Backend Only 
  * Query Types: Options API
* Multisite Support: No
* Uninstalls Data: Yes

#### Inspiration ####

* [Some Name](https://wordpress.org/plugins/plugin-name/)
* [Another Name](https://wordpress.org/plugins/plugin-name/)

#### Special Thanks ####

[Alex Georgiou](https://www.alexgeorgiou.gr), [Automattic](https://automattic.com), [Brad Touesnard](https://bradt.ca), [Daniel Auener](http://www.danielauener.com), [Delicious Brains](https://deliciousbrains.com), [Greg Rickaby](https://gregrickaby.com), [Matt Mullenweg](https://ma.tt), [Mika Epstein](https://halfelf.org), [Mike Garrett](https://mikengarrett.com), [Samuel Wood](http://ottopress.com), [Scott Reilly](http://coffee2code.com), [Jan Dembowski](https://profiles.wordpress.org/jdembowski), [Jeff Starr](https://perishablepress.com), [Jeff Chandler](https://jeffc.me), [Jeff Matson](https://jeffmatson.net), [Jeremy Wagner](https://jeremywagner.me), [John James Jacoby](https://jjj.blog), [Leland Fiegel](https://leland.me), [Luke Cavanagh](https://github.com/lukecav), [Mike Jolley](https://mikejolley.com), [Pau Iglesias](https://pauiglesias.com), [Paul Irish](https://www.paulirish.com), [Rahul Bansal](https://profiles.wordpress.org/rahul286), [Roots](https://roots.io), [rtCamp](https://rtcamp.com), [Ryan Hellyer](https://geek.hellyer.kiwi), [WP Chat](https://wpchat.com), [WP Tavern](https://wptavern.com)

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep the above-mentioned goals in mind... thanks!

#### Keywords ####

* Terms:

* Phrases:

* Plugins:

### Philosophy ####

Inspired by the likes of Unix and W. Edwards Deming, we believe in creating high quality software "components" that can stand on their own, or be integrated into other software. At a certain point, this approach has practical limits, which is why we are beginning to combine certain features into premium plugins. Still, we aim to reduce redundancy wherever possible, and present a unified UI in our premium plugins that in fact combines multiple small indepdent functions behind the scenes.
https://www.johndcook.com/blog/2010/06/30/where-the-unix-philosophy-breaks-down/

== Installation ==

1. Upload to `/wp-content/plugins/some-name-littlebizzy`
2. Activate via WP Admin > Plugins
3. Test plugin is working

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is a settings page where you can exclude certain types of query strings.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Changelog ==

= 1.1.0 =
* major changes/new features
* tested with PHP 7.1
* tested with PHP 7.2

= 1.0.1 =
* minor tweaks/patches

= 1.0.0 =
* initial release
* tested with PHP 7.0
* uses PHP namespaces
* object-oriented codebase
