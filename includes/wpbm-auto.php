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

function wpbm_email_footer(): string
{
    $options = get_option('wpbm_plugin_options');
    $content = wpbm_minify_html(wpbm_generate($options['message'], $options['label'], ''));
    return $content;
}

function wpbm_wp_mail($atts)
{
    $options = get_option('wpbm_plugin_options');
    if ($options['usage'] === 'auto') {
        $atts['message'] .= wpbm_email_footer();
        return $atts;
    }
}
