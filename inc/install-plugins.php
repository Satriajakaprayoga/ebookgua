<?php

function mytheme_install_required_plugins()
{
    $required_plugins = [
        [
            'name' => 'PDF.js Viewer',
            'slug' => 'pdfjs-viewer-shortcode/pdfjs-viewer.php',
            'zip_path' => get_template_directory().'/required-plugins/pdfjs-viewer.zip',
        ],
    ];

    require_once ABSPATH.'wp-admin/includes/file.php';
    require_once ABSPATH.'wp-admin/includes/misc.php';
    require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
    require_once ABSPATH.'wp-admin/includes/plugin.php';

    foreach ($required_plugins as $plugin) {
        if (! is_plugin_active($plugin['slug'])) {
            if (file_exists($plugin['zip_path'])) {
                $upgrader = new Plugin_Upgrader;
                $upgrader->install($plugin['zip_path']);
                update_option('mytheme_activate_'.md5($plugin['slug']), $plugin['slug']);
            }
        }
    }
}
add_action('after_switch_theme', 'mytheme_install_required_plugins');

function mytheme_activate_required_plugins_on_load()
{
    foreach (get_option('active_plugins') as $active) { /* just to loop */
    }

    foreach (wp_load_alloptions() as $key => $value) {
        if (strpos($key, 'mytheme_activate_') === 0) {
            activate_plugin($value);
            delete_option($key);
        }
    }
}
add_action('admin_init', 'mytheme_activate_required_plugins_on_load');
