<?php

/**
 * Plugin Name:         WPBrowserMail
 * Plugin URI:          https://www.wpbrowsermail.com
 * Description:         WordPress Plugin to allow emails to be viewed in the browser
 * Version:             0.0.0
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

require_once 'includes/wpbm-constants.php';
require_once 'includes/wpbm-helpers.php';
require_once 'includes/wpbm-defaults.php';
require_once 'includes/wpbm-settings.php';

add_action('plugins_loaded', 'wpbm_start');

function wpbm_start(): void
{
    function wpbm_settings_page(): void
    {
        add_options_page('WPBrowserMail', 'WPBrowserMail', 'manage_options', 'wp-browser-mail', 'wpbm_render_plugin_settings_page');
        wpbm_defaults();
    }
    add_action('admin_menu', 'wpbm_settings_page');
}
