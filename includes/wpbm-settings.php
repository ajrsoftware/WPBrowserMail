<?php

/**
 * Registers the settings page for the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function adds an options page to the WordPress admin menu, allowing users to access plugin settings.
 * It also initializes default options if necessary.
 */
function wpbm_settings_page(): void
{
    add_options_page('WPBrowserMail', 'WPBrowserMail', 'manage_options', 'wp-browser-mail', 'wpbm_render_plugin_settings_page');
    wpbm_defaults();
}

/**
 * Renders the settings page content for the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function generates the HTML content for the plugin's settings page in the WordPress admin area.
 * It includes a form for submitting options, along with information and guidelines related to email communication security.
 */
function wpbm_render_plugin_settings_page()
{
?>
    <h1 style="margin-bottom: 40px;">WPBrowserMail</h1>
    <form action="options.php" method="post" class="wpbm_plugin_options">
        <?php
        settings_fields('wpbm_plugin_options');
        do_settings_sections('wpbm_plugin');
        ?>
        <input name="submit" style="margin-top: 20px;" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
    <br />
    <p><strong>Security notice:</strong></p>
    <ul>
        <li>
            <p>By choosing to utilize the <strong>WPBrowserMail</strong> plugin, users affirmatively acknowledge and accept full responsibility for all aspects of their email communication.</p>
            <p> This encompasses obtaining explicit consent for sending emails, safeguarding sensitive information, and abiding by applicable data protection and privacy regulations.</p>
            <p> Additionally, users are encouraged to routinely review and update their email content and recipient lists to ensure relevancy and compliance.</p>
            <p>The user's diligence in these matters plays a crucial role in maintaining a high standard of email communication and upholding ethical email practices.</p>
        </li>
        <li>Mail accessed via the <i>view in browser</i> link can only be viewed once.</li>
        <li><a href="https://www.wpbrowsermail.com/security" target="_blank" rel="noopener noreferrer">Read more</a></li>
    </ul>
<?php
}

/**
 * Registers settings and sections for the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function sets up the plugin's settings fields, sections, and validation callbacks.
 * It establishes the structure for storing and managing plugin options.
 */
function wpbm_register_settings()
{
    register_setting('wpbm_plugin_options', 'wpbm_plugin_options', ['wpbm_plugin_options_validate']);

    add_settings_section('wpbm_settings', 'Options', 'wpbm_plugin_section_text', 'wpbm_plugin');
    add_settings_section('wpbm_preview', 'Preview', 'wpbm_plugin_section_preview', 'wpbm_plugin');
    add_settings_section('wpbm_usage', 'Usage', 'wpbm_plugin_section_useage', 'wpbm_plugin');

    add_settings_field('wpbm_plugin_setting_message', 'Message', 'wpbm_plugin_setting_message', 'wpbm_plugin', 'wpbm_settings');
    add_settings_field('wpbm_plugin_setting_label', 'Link label', 'wpbm_plugin_setting_label', 'wpbm_plugin', 'wpbm_settings');
}

/**
 * Validates and sanitizes the input for the WordPress Browser Mail (wpbrowsermail) plugin options.
 *
 * This function ensures that the input values meet the required criteria before saving them as options.
 *
 * @param array $input The input values submitted for the plugin options.
 *
 * @return array The validated and sanitized input values.
 */
function wpbm_plugin_options_validate($input): array
{
    $newinput['message'] = trim($input['message']);
    if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['message'])) {
        $newinput['message'] = '';
    }

    return $newinput;
}

/**
 * Renders the text content for the settings section of the WordPress Browser Mail (wpbrowsermail) plugin.
 *
 * This function generates the HTML content that provides instructions and information for the settings section.
 */
function wpbm_plugin_section_text()
{
?>
    <p>Set the text for the message and link label below</p>
<?php
}

/**
 * Renders a preview of the email content for the WordPress Browser Mail (wpbrowsermail) plugin settings section.
 *
 * This function generates HTML content that displays a preview of how the email message and link label will appear.
 */
function wpbm_plugin_section_preview()
{
    $options = get_option('wpbm_plugin_options');
?>
    <p class="wpbm_plugin_options_preview"><?php echo $options['message']; ?> <span style="text-decoration: underline;"><?php echo $options['label']; ?></span></p>
<?php
}

/**
 * Renders the usage options section for the WordPress Browser Mail (wpbrowsermail) plugin settings.
 *
 * This function generates HTML content that allows users to select how they want to include the email link.
 */
function wpbm_plugin_section_useage()
{
    $options = get_option('wpbm_plugin_options');
?>
    <fieldset>
        <label for="wpbm_plugin_options_usage_auto">
            <input type="radio" name="wpbm_plugin_options[usage]" id="wpbm_plugin_options_usage_auto" class="wpbm_plugin_options_usage_auto" value="auto" <?php echo esc_attr($options['usage']) === 'auto' ? 'checked' : '' ?>>
            <span>Include as email footer <a href="https://www.wpbrowsermail.com/auto-include" target="_blank" rel="noopener noreferrer">(learn more)</a></span>
        </label>
        <br />
        <label for="wpbm_plugin_options_usage_shortcode">
            <input type="radio" name="wpbm_plugin_options[usage]" id="wpbm_plugin_options_usage_shortcode" class="wpbm_plugin_options_usage_shortcode" value="shortcode" <?php echo esc_attr($options['usage']) === 'shortcode' ? 'checked' : '' ?>>
            <span>Use shortcode <a href="https://www.wpbrowsermail.com/shortcode" target="_blank" rel="noopener noreferrer">(learn more)</a></span>
        </label>
    </fieldset>
    <br />
    <p id="wpbm_plugin_options_usage_auto_tip">Your email browser link will automatically be added to the footer of your mail.</p>
    <pre id="wpbm_plugin_options_usage_shortcode_tip"><code>[wpbrowsermail]</code></pre>
<?php
}

/**
 * Renders the input field for setting the email message in the WordPress Browser Mail (wpbrowsermail) plugin settings.
 *
 * This function generates HTML content that allows users to input the email message text.
 */
function wpbm_plugin_setting_message()
{
    $options = get_option('wpbm_plugin_options');
?>
    <input id='wpbm_plugin_setting_message' class='regular-text' name='wpbm_plugin_options[message]' type='text' value='<?php echo esc_attr($options['message']); ?>' />
<?php
}

/**
 * Renders the input field for setting the link label in the WordPress Browser Mail (wpbrowsermail) plugin settings.
 *
 * This function generates HTML content that allows users to input the label text for the email link.
 */
function wpbm_plugin_setting_label()
{
    $options = get_option('wpbm_plugin_options');
?>
    <input id='wpbm_plugin_setting_label' class='regular-text' name='wpbm_plugin_options[label]' type='text' value='<?php echo esc_attr($options['label']); ?>' />
<?php
}
