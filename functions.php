<?php

// require_once get_template_directory() . '/inc/tailwind-navwalker.php';

// echo '<div>' . get_template_directory() . '</div>';

function ebookgua_enqueue_scripts() {
    wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/style.css', [], filemtime( get_template_directory() . '/style.css' ) );
}

add_action( 'wp_enqueue_scripts', 'ebookgua_enqueue_scripts' );

register_nav_menus([
  'primary' => __('Primary Menu', 'ebookgua')
]);

