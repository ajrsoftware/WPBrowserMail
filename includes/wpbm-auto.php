<?php

function wpbm_minify_html(string $html): string
{
    $search = [
        '/(\n|^)(\x20+|\t)/',
        '/(\n|^)\/\/(.*?)(\n|$)/',
        '/\n/',
        '/\<\!--.*?-->/',
        '/(\x20+|\t)/',
        '/\>\s+\</',
        '/(\"|\')\s+\>/',
        '/=\s+(\"|\')/'
    ];

    $replace = ["\n", "\n", " ", "", " ", "><", "$1>", "=$1"];

    $html = preg_replace($search, $replace, $html);
    return $html;
}

function wpbm_generate_random_key(int $length)
{
    $current_datetime = new DateTime();
    $timestamp = $current_datetime->format('YmdHis');
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key_length = $length;
    $random_key = '';

    for ($i = 0; $i < $key_length; $i++) {
        $random_key .= $characters[rand(0, strlen($characters) - 1)];
    }

    return urlencode($timestamp . $random_key);
}

function wpbm_email_footer(string $key): string
{
    $options = get_option('wpbm_plugin_options');
    $message = $options['message'];
    $label = $options['label'];
    $url = trailingslashit(site_url()) . '/wpbrowsermail?wpbm_key=' . $key . '';
    $content = wpbm_minify_html(wpbm_generate($message, $label, $url));
    return $content;
}

function wpbm_wp_mail($atts)
{
    $key = wpbm_generate_random_key(12);
    $options = get_option('wpbm_plugin_options');
    $original = $atts['message'];

    if ($options['usage'] === 'auto') {
        $atts['message'] .= wpbm_email_footer($key);
    }

    $key_values = get_option('wpbm_plugin_key_values');
    $key_values[$key] = $original;
    update_option('wpbm_plugin_key_values', $key_values);

    return $atts;
}
