<?php

/**
 * Generates a WordPress Browser Mail (wpbrowsermail) shortcode.
 *
 * @return string The generated shortcode HTML.
 */
function wpbm_shortcode(): string
{
    $options = get_option('wpbm_plugin_options');
    $message = $options['message'];
    $label = $options['label'];

    $content = wpbm_generate($message, $label);

    return $content;
}

/**
 * Replaces a WordPress Browser Mail (wpbrowsermail) shortcode with provided content in an email body.
 *
 * @param string $body The email body content.
 * @param string $key  The key for identifying the email.
 *
 * @return string The modified email body with the shortcode replaced.
 */
function wpbm_shortcode_replace(string $body, string $key): string
{
    $content = wpbm_email_footer($key);
    $replaced = wpbm_replace_element_by_id($body, $content);
    return $replaced;
}

/**
 * Replaces a specific element in the HTML with new content based on a provided shortcode.
 *
 * @param string $html The original HTML containing the element to be replaced.
 * @param string $new_html The new HTML content to replace the element with.
 * @return string The modified HTML with the element replaced.
 */
function wpbm_replace_element_by_id(string $html, string $new_html): string
{
    $node_to_find = wpbm_shortcode();
    $count = 1;
    $new = str_replace($node_to_find, $new_html, $html, $count);

    return $new;
}
