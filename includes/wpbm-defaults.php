<?php

function wpbm_defaults(): void
{
    $options = get_option('wpbm_plugin_options');

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
