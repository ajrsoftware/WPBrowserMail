<?php

/**
 * Generates a random key of specified length for use in WordPress Browser Mail (wpbrowsermail).
 *
 * @param int $length The length of the random key.
 *
 * @return string The generated random key.
 */
function wpbm_generate_random_key(int $length): string
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

/**
 * Generates the footer content for a WordPress Browser Mail (wpbrowsermail) email.
 *
 * @param string $key The unique key associated with the email.
 *
 * @return string The HTML content of the email footer.
 */
function wpbm_email_footer(string $key): string
{
    $options = get_option('wpbm_plugin_options');
    $message = $options['message'];
    $label = $options['label'];
    $url = trailingslashit(site_url()) . '/wpbrowsermail?wpbm_key=' . $key . '';
    $content = wpbm_generate($message, $label, $url);
    return $content;
}

/**
 * Customizes and processes email content before sending using WordPress' wp_mail function.
 *
 * @param array $atts An array of email attributes including 'message'.
 *
 * @return array Modified array of email attributes.
 */
function wpbm_wp_mail(array $atts): array
{
    $key = wpbm_generate_random_key(12);
    $options = get_option('wpbm_plugin_options');
    $original = $atts['message'];

    if ($options['usage'] === 'auto') {
        $atts['message'] .= wpbm_email_footer($key);
    }

    if ($options['usage'] === 'shortcode') {
        $atts['message'] = wpbm_shortcode_replace($atts['message'], $key);
    }

    $key_values = get_option('wpbm_plugin_key_values');
    $key_values[$key] = $original;
    update_option('wpbm_plugin_key_values', $key_values);

    return $atts;
}
