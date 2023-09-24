<?php

function wpbm_assets(): void
{
    wp_register_style('wpbm_admin_styles', constant('WPBM_DIR') . '/dist/styles.css', [], constant('WPBM_VERSION'));
    wp_enqueue_style('wpbm_admin_styles');
    wp_register_script('wpc2o_admin_scripts_app', constant('WPBM_DIR') . '/dist/app.js', [], constant('WPBM_VERSION'), true);
    wp_enqueue_script('wpc2o_admin_scripts_app');
}
