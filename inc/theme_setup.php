<?php
/**
 * Theme supports and menu registration
 */

if (!function_exists('ebookgua_theme_setup')) {
    function ebookgua_theme_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', [
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
        ]);
    }
    add_action('after_setup_theme', 'ebookgua_theme_setup');
}

if (!function_exists('ebookgua_register_menus')) {
    function ebookgua_register_menus() {
        register_nav_menus([
            'primary' => __('Primary Menu', 'ebookgua'),
        ]);
    }
    add_action('init', 'ebookgua_register_menus');
}
