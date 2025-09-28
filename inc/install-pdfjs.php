<?php

function ebookgua_notice_pdfjs_installed()
{
    $message = get_option('tahu');
    if ($message) {

        echo '<div class="notice notice-success is-dismissible">';
        echo '<h2>Plugin PDF.js sudah aktif</h2>';
        echo '<pre style="white-space:pre-wrap; margin-top:10px;">uang</pre>';
        echo '</div>';

        delete_option('tahu');
    }
}

add_action('admin_notices', 'ebookgua_notice_pdfjs_installed');

function mytheme_install_pdfjs()
{
    $plugin_slug = 'pdfjs-viewer-shortcode/pdfjs-viewer.php'; // SLUG BENAR

    if (is_plugin_active($plugin_slug)) {
        update_option('tahu', true);

        return;
    }

    $plugin_zip = get_template_directory().'/required-plugins/pdfjs-viewer.zip';

    if (file_exists($plugin_zip)) {

        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/misc.php';
        require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
        require_once ABSPATH.'wp-admin/includes/plugin.php';

        ob_start(); // Tangkap output asli dari upgrader

        $upgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin);
        $upgrader->install($plugin_zip);
        update_option('mytheme_installing_pdfjs', true);
        $install_output = ob_get_clean(); // Simpan outputnya

        // Simpan ke option agar nanti bisa ditampilkan di admin_notices
        update_option('mytheme_install_message', $install_output);
    }
}
add_action('after_switch_theme', 'mytheme_install_pdfjs');

function ebookgua_activate_pdfjs_on_load()
{
    $should_activate = get_option('ebookgua_activate_pdfjs');
    $plugin_slug = get_option('mytheme_pdfjs_slug');

    if ($should_activate && $plugin_slug) {
        activate_plugin($plugin_slug);
        delete_option('ebookgua_activate_pdfjs');
        delete_option('mytheme_pdfjs_slug');
    }
}
add_action('admin_init', 'ebookgua_activate_pdfjs_on_load');

function mytheme_show_install_message()
{
    $message = get_option('mytheme_install_message', null);
    if ($message !== null) {
        echo '<div class="notice notice-success is-dismissible" style="padding:15px; overflow:auto; max-height:200px;">';
        echo '<h2>Plugin PDF.js Berhasil Diinstall tahu goreng'.esc_html($message).'</h2>';
        echo '<pre style="white-space:pre-wrap; margin-top:10px;">'.esc_html($message).'</pre>';
        echo '</div>';
        delete_option('mytheme_install_message');
        delete_option('mytheme_installing_pdfjs');
    }
}
add_action('admin_notices', 'mytheme_show_install_message');
