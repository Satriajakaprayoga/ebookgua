<?php
/**
 * Custom Post Types: buku & blog
 */

if (!function_exists('ebookgua_register_post_type')) {
    function ebookgua_register_post_type() {
        register_post_type('buku', [
            'labels' => [
                'name' => 'Buku',
                'singular_name' => 'Buku',
                'add_new_item' => 'Tambah Buku Baru',
                'edit_item' => 'Edit Buku',
                'new_item' => 'Buku Baru',
                'view_item' => 'Lihat Buku',
                'search_items' => 'Cari Buku',
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'buku'],
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields', 'author'],
            'taxonomies' => ['category', 'post_tag'],
            'show_in_rest' => true,
        ]);

        register_post_type('blog', [
            'labels' => [
                'name' => 'Blog',
                'singular_name' => 'Blog',
                'add_new_item' => 'Tambah Blog Baru',
                'edit_item' => 'Edit Blog',
                'new_item' => 'Blog Baru',
                'view_item' => 'Lihat Blog',
                'search_items' => 'Cari Blog',
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'blog'],
            'menu_icon' => 'dashicons-admin-post',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields', 'author'],
            'taxonomies' => ['category', 'post_tag'],
            'show_in_rest' => true,
        ]);
    }
    add_action('init', 'ebookgua_register_post_type');
}
