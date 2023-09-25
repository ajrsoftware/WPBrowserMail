<?php

/**
 * Enqueues assets (styles and scripts) for the WordPress Browser Mail (wpbrowsermail) plugin in the admin area.
 *
 * This function registers and enqueues the necessary styles and scripts used by the plugin.
 * It ensures that the assets are loaded with the correct version and dependencies.
 */
function wpbm_assets(): void
{
    wp_register_style('wpbm-admin-styles', constant('WPBM_DIR') . '/dist/wpbm.css', [], constant('WPBM_VERSION'));
    wp_enqueue_style('wpbm-admin-styles');
    wp_register_script('wpbm-admin-scripts', constant('WPBM_DIR') . '/dist/wpbm.js', [], constant('WPBM_VERSION'), true);
    wp_enqueue_script('wpbm-admin-scripts');
}
