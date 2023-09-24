<?php

/**
 * Handles the request for viewing an email in the browser through the WordPress Browser Mail plugin.
 *
 * This function checks if the current request corresponds to viewing an email and displays it if valid.
 * It also removes the entry to prevent further access by sharing links.
 *
 * @return void|false Returns false if the request is not for viewing an email, otherwise displays the email content.
 */
function wpbm_route_request()
{
    global $wp;
    $current_slug = add_query_arg([], $wp->request);
    if ($current_slug !== 'wpbrowsermail') {
        return false;
    }

    $key = $_GET['wpbm_key'];

    $key_values = get_option('wpbm_plugin_key_values');
    $value = $key_values[$key];

    if (empty($key)) {
        return false;
    }

    echo $value;

    // Remove the entry so the email cannot be access again by sharing links etc.
    unset($key_values[$key]);

    update_option('wpbm_plugin_key_values', $key_values);
}
