<?php

/**
 * Sets default options and values for the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function ensures that essential options and key-value pairs are initialized if they are empty.
 */
function wpbm_defaults(): void
{
    $options = get_option('wpbm_plugin_options');
    $key_values = get_option('wpbm_plugin_key_values');

    if (empty($key_values)) {
        update_option('wpbm_plugin_key_values', []);
    }

    if (empty($options['message'])) {
        $options['message'] = 'Something wrong with the email?';
        update_option('wpbm_plugin_options', $options);
    }

    if (empty($options['label'])) {
        $options['label'] = 'View it in your browser.';
        update_option('wpbm_plugin_options', $options);
    }

    if (empty($options['usage'])) {
        $options['usage'] = 'auto';
        update_option('wpbm_plugin_options', $options);
    }
}
