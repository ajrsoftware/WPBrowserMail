document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('wpbm_plugin_options_usage_auto')?.checked) {
        document.getElementById('wpbm_plugin_options_usage_auto_tip').style.display = 'block';
    }

    if (document.getElementById('wpbm_plugin_options_usage_shortcode')?.checked) {
        document.getElementById('wpbm_plugin_options_usage_shortcode_tip').style.display = 'block';
    }
});
