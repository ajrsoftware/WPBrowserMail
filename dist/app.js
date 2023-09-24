document.addEventListener('DOMContentLoaded', () => {
    const autoOption = document.getElementById('wpbm_plugin_options_usage_auto');
    const shortcodeOption = document.getElementById('wpbm_plugin_options_usage_shortcode');
    const autoOptionTip = document.getElementById('wpbm_plugin_options_usage_auto_tip');
    const shortcodeTip = document.getElementById('wpbm_plugin_options_usage_shortcode_tip');

    if (autoOption.checked) {
        autoOptionTip.style.display = 'block';
    }

    if (shortcodeOption.checked) {
        shortcodeTip.style.display = 'block';
    }
});
