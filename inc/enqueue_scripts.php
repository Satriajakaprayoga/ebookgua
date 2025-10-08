<?php
/**
 * Enqueue styles & icons
 */

if (!function_exists('ebookgua_enqueue_scripts')) {
    function ebookgua_enqueue_scripts() {
        $css_path = get_template_directory() . '/assets/css/output.css';
        $ver = file_exists($css_path) ? filemtime($css_path) : null;
        wp_enqueue_style(
            'tailwind',
            get_template_directory_uri() . '/assets/css/output.css',
            [],
            $ver
        );
    }
    add_action('wp_enqueue_scripts', 'ebookgua_enqueue_scripts');
}

// Optional legacy function from your original file. We keep it defined but NOT hooked
// to avoid double-enqueue of the same CSS file.
if (!function_exists('mytheme_enqueue_styles')) {
    function mytheme_enqueue_styles() {
        wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/output.css', [], '1.0');
    }
    // Intentionally not hooking this to prevent duplicate enqueues.
}

if (!function_exists('ebookgua_enqueue_icons')) {
    function ebookgua_enqueue_icons() {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    }
    add_action('wp_enqueue_scripts', 'ebookgua_enqueue_icons');
}

if (!function_exists('ebookgua_load_dashicons_frontend')) {
    function ebookgua_load_dashicons_frontend() {
        wp_enqueue_style('dashicons');
    }
    add_action('wp_enqueue_scripts', 'ebookgua_load_dashicons_frontend');
}
