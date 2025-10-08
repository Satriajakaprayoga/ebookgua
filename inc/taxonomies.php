<?php
/**
 * Taxonomies & upload mimes
 */

if (!function_exists('ebookgua_register_taxonomies_for_buku')) {
    function ebookgua_register_taxonomies_for_buku() {
        register_taxonomy_for_object_type('category', 'buku');
        register_taxonomy_for_object_type('post_tag', 'buku');
    }
    add_action('init', 'ebookgua_register_taxonomies_for_buku');
}

if (!function_exists('ebookgua_allow_pdf_upload')) {
    function ebookgua_allow_pdf_upload($mimes) {
        $mimes['pdf'] = 'application/pdf';
        return $mimes;
    }
    add_filter('upload_mimes', 'ebookgua_allow_pdf_upload');
}
