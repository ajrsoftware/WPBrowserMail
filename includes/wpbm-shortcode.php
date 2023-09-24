<?php

/**
 * Generates a WordPress Browser Mail (wpbrowsermail) shortcode.
 *
 * @return string The generated shortcode HTML.
 */
function wpbm_shortcode(): string
{
    return '<span id="wpbm_shortcode_tag" style="display:none;"></span>';
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
    $id = 'wpbm_shortcode_tag';
    $content = wpbm_email_footer($key);
    return wpbm_replace_element_by_id($body, $id, $content);
}

/**
 * Replace an HTML element with a specified ID with new HTML content.
 *
 * @param string $html        The original HTML content.
 * @param string $target_id   The ID of the element to be replaced.
 * @param string $new_html    The new HTML content to replace the element with.
 *
 * @return string             The modified HTML content with the element replaced.
 */
function wpbm_replace_element_by_id(string $html, string $target_id, string $new_html): string
{
    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $target_element = $xpath->query("//*[@id='$target_id']")->item(0);

    if ($target_element) {
        $new_fragment = $dom->createDocumentFragment();
        $new_fragment->appendXML($new_html);

        $parent = $target_element->parentNode;
        $parent->replaceChild($new_fragment, $target_element);

        return $dom->saveHTML();
    } else {
        return $html;
    }
}
