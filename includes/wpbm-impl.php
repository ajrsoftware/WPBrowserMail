<?php

/**
 * Generates HTML content for a WordPress Browser Mail (wpbrowsermail) email.
 *
 * @param string $message The main message content of the email.
 * @param string $label   The label for the link to view the email in the browser.
 * @param string $url     The URL for viewing the email in the browser.
 *
 * @return string The HTML content of the email.
 */
function wpbm_generate(string $message, string $label, string $url = null): string
{
    $content = '<div class="wpbm-output" style="display:block;font-family:sans-serif;text-align:center;">';
    $content .= '<p>';
    $content .= $message;
    $content .= ' ';
    $content .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" style="text-decoration:underline;">';
    $content .= $label;
    $content .= '</a>';
    $content .= '</p>';
    $content .= '</div>';
    return $content;
}
