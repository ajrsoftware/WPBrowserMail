<?php

function wpbm_generate(string $message, string $label, string $url): string
{
    $content = '<div class="wpbm-output" style="font-family:sans-serif;text-align:center;">';
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
