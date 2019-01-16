<?php
/*
Plugin Name: Dashboard Cleanup
Plugin URI: https://www.littlebizzy.com/plugins/dashboard-cleanup
Description: Cleans up the WP Admin backend by disabling various bloat features including nag notices, Automattic spam, and other outdated and pointless items.
Version: 1.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
PBP Version: 1.2.0
WC requires at least: 3.3
WC tested up to: 3.5
Prefix: DSHCLN
*/

// Plugin namespace
namespace LittleBizzy\DashboardCleanup;

// Plugin constants
const FILE = __FILE__;
const PREFIX = '[dshcln]';
const VERSION = '1.0.0';
const REPO = 'dashboard-cleanup';

// Boot
require_once dirname(FILE).'/helpers/boot.php';
Helpers\Boot::instance(FILE);