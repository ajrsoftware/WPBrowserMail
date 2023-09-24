<?php

/**
 * Dumps and displays a variable value for debugging purposes in the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function outputs the variable's value along with additional formatting for improved readability.
 *
 * @param mixed $value The variable to be dumped and displayed.
 */
function wpbm_dd(mixed $value): void
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
?>
        <pre style="padding: 50px 0 50px 200px;"><code><?php var_dump($value); ?></code></pre>
<?php
    }
}
