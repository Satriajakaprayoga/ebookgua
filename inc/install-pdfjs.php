<?php

// install pdfjs
function ebookgua_install_pdfjs()
{
    $plugin_slug = 'pdfjs-viewer-shortcode/pdfjs-viewer.php';
    $plugin_dir = WP_PLUGIN_DIR.'/pdfjs-viewer-shortcode';
    $plugin_zip = get_template_directory().'/required-plugins/pdfjs-viewer.zip';

    // cek apakah file file sudah ada
    if (file_exists($plugin_dir)) {
        // aktifkan jika plugin pdf viewer tidak aktif
        if (! is_plugin_active($plugin_slug)) {
            echo '<div class="notice notice-success is-dismissible" style="padding:5px; max-height:100px;">
                <p><strong>Plugin PDF.js Viewer sudah diaktifkan.</strong></p>
              </div>';
            activate_plugin($plugin_slug);

            return;
        }

        echo '<div class="notice notice-success is-dismissible" style="padding:5px; max-height:100px;">
                <p><strong>Plugin PDF.js Viewer sudah terpasang.</strong></p>
              </div>';

        return;
    }

    // install plugin pdfjs-viewer jika file plugin tidak ada
    if (file_exists($plugin_zip)) {

        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/misc.php';
        require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
        require_once ABSPATH.'wp-admin/includes/plugin.php';

        ob_start();
        $upgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin);
        $upgrader->install($plugin_zip);
        ob_end_clean();

        update_option('ebookgua_installing_pdfjs', true);
        update_option('ebookgua_pdfjs_slug', $plugin_slug);
    }
}
add_action('after_switch_theme', 'ebookgua_install_pdfjs');

// activate pluggin pdfjs-viewer
function ebookgua_activate_pdfjs_on_load()
{
    $should_activate = get_option('ebookgua_installing_pdfjs');
    $plugin_slug = get_option('ebookgua_pdfjs_slug');

    if ($should_activate && $plugin_slug) {
        activate_plugin($plugin_slug);

        echo '<div class="notice notice-success is-dismissible" style="padding:5px; max-height:100px;">
                <p><strong>Plugin PDF.js Viewer telah diinstall dan diaktifkan.</strong></p>
              </div>';

        delete_option('ebookgua_installing_pdfjs');
        delete_option('ebookgua_pdfjs_slug');
    }
}
add_action('admin_init', 'ebookgua_activate_pdfjs_on_load');
