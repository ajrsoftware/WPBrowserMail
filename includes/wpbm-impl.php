<?php

function wpbm_generate(string $message, string $label, string $url): string
{
    $content = '<div>';
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
