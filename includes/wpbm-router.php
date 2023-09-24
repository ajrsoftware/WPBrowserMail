<?php

function wpbm_route_init()
{
    add_rewrite_rule('^wpbrowsermail/?', 'index.php', 'top');
}
add_action('init', 'wpbm_route_init');

function wpbm_query_vars($query_vars)
{
    $query_vars[] = 'wpbm_key';
    return $query_vars;
}
add_filter('query_vars', 'wpbm_query_vars');

function wpbm_handle_route()
{
    $wpbm_key = get_query_var('wpbm_key');

    if (empty($wpbm_key)) {
        status_header(404);
        include get_404_template();
        exit;
    }

    $value = get_option('wpbm_plugin_key_values')[$wpbm_key];

    if (empty($value)) {
        status_header(404);
        include get_404_template();
        exit;
    }

    echo $value;
    exit;
}
add_action('template_redirect', 'wpbm_handle_route');
