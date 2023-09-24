<?php

function wpbm_render_plugin_settings_page()
{
?>
    <h1 style="margin-bottom: 40px;">WPBrowserMail</h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('wpbm_plugin_options');
        do_settings_sections('wpbm_plugin');
        ?>
        <input name="submit" style="margin-top: 20px;" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
<?php
}

function wpbm_register_settings()
{
    register_setting('wpbm_plugin_options', 'wpbm_plugin_options', ['wpbm_plugin_options_validate']);

    add_settings_section('wpbm_settings', 'Options', 'wpbm_plugin_section_text', 'wpbm_plugin');
    add_settings_field('wpbm_plugin_setting_message', 'Message', 'wpbm_plugin_setting_message', 'wpbm_plugin', 'wpbm_settings');
    add_settings_field('wpbm_plugin_setting_label', 'Link label', 'wpbm_plugin_setting_label', 'wpbm_plugin', 'wpbm_settings');

    add_settings_section('wpbm_preview', 'Preview', 'wpbm_plugin_section_preview', 'wpbm_plugin');
}
add_action('admin_init', 'wpbm_register_settings');


function wpbm_plugin_options_validate($input)
{
    $newinput['message'] = trim($input['message']);
    if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['message'])) {
        $newinput['message'] = '';
    }

    return $newinput;
}

function wpbm_plugin_section_text()
{
?>
    <p>Set the text for the footer message and link label below</p>
<?php
}

function wpbm_plugin_section_preview()
{
    $options = get_option('wpbm_plugin_options');
?>
    <p><?php echo $options['message']; ?> <span style="text-decoration: underline;"><?php echo $options['label']; ?></span></p>
<?php
}

function wpbm_plugin_setting_message()
{
    $options = get_option('wpbm_plugin_options');
?>
    <input id='wpbm_plugin_setting_message' class='regular-text' name='wpbm_plugin_options[message]' type='text' value='<?php echo esc_attr($options['message']); ?>' />
<?php
}

function wpbm_plugin_setting_label()
{
    $options = get_option('wpbm_plugin_options');
?>
    <input id='wpbm_plugin_setting_label' class='regular-text' name='wpbm_plugin_options[label]' type='text' value='<?php echo esc_attr($options['label']); ?>' />
<?php
}
