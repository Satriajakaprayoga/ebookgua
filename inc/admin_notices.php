<?php

/**
 * Admin notices for required/recommended plugins
 * This file for notice admin page pluggins required
 */
if (! function_exists('ebookgua_notice_plugin_required')) {
    function ebookgua_notice_plugin_required()
    {
        if (! function_exists('is_plugin_active')) {
            require_once ABSPATH.'wp-admin/includes/plugin.php';
        }

        if (! is_plugin_active('seo-by-rank-math/seo-by-rank-math.php')) {
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>Plugin Rank Math SEO belum terpasang atau belum aktif.</strong><br>
                Theme ebookgua merekomendasikan untuk menggunakan <a href="https://wordpress.org/plugins/seo-by-rank-math/" target="_blank">Rank Math</a> agar SEO bekerja dengan optimal.</p>
            </div>';
        }

        if (! is_plugin_active('pdfjs-viewer-shortcode/pdfjs-viewer.php')) {
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>Plugin pdfjs-viewer belum terpasang atau belum aktif.</strong><br>
                Theme ebookgua menggunakan plugin PDFjs Viewer untuk fitur baca ebook. Silahkan install / aktifkan plugin atau non aktifkan theme dan aktifkan ulang untuk install plugin secara otomatis</p>
            </div>';
        }
    }
    add_action('admin_notices', 'ebookgua_notice_plugin_required');
}
