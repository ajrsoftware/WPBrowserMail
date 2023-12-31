<?php

/**
 * Plugin Name:         WPBrowserMail
 * Plugin URI:          https://www.wpbrowsermail.com
 * Description:         WordPress Plugin to allow emails to be viewed in the browser
 * Version:             0.0.1
 * Author:              AJR Software 
 * Author URI:          https://www.ajrsoftware.com
 * License              GPL v3 or later
 * Text Domain:         wpbm
 * Domain Path:         /languages
 * Requires at least:   5.8
 * Requires PHP:        7.4
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined('ABSPATH') || exit;

define('WPBM_VERSION', '0.0.1');
define('WPBM_DIR', plugins_url('', __FILE__));

require_once 'includes/wpbm-helpers.php';
require_once 'includes/wpbm-scripts.php';
require_once 'includes/wpbm-defaults.php';
require_once 'includes/wpbm-settings.php';
require_once 'includes/wpbm-impl.php';
require_once 'includes/wpbm-auto.php';
require_once 'includes/wpbm-shortcode.php';
require_once 'includes/wpbm-router.php';

add_action('plugins_loaded', 'wpbm_start');

/**
 * Initializes and sets up the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function attaches necessary actions, filters, and shortcodes to integrate the plugin into the WordPress environment.
 */
function wpbm_start(): void
{
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wpbm_settings_link');
    register_deactivation_hook(__FILE__, 'wpbm_deactivation');
    add_action('admin_enqueue_scripts', 'wpbm_assets');
    add_action('admin_menu', 'wpbm_settings_page');
    add_action('admin_init', 'wpbm_register_settings');
    add_action('template_redirect', 'wpbm_route_request', 0);
    add_shortcode('wpbrowsermail', 'wpbm_shortcode');
    add_filter('wp_mail', 'wpbm_wp_mail');
}
