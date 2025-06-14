<?php

// require_once get_template_directory() . '/inc/tailwind-navwalker.php';

// echo '<div>' . get_template_directory() . '</div>';

function ebookgua_enqueue_scripts()
{
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/output.css', [], filemtime(get_template_directory() . '/assets/css/output.css'));
}

add_action('wp_enqueue_scripts', 'ebookgua_enqueue_scripts');

register_nav_menus([
  'primary' => __('Primary Menu', 'ebookgua')
]);

function ebookgua_postbox_default()
{
  global $post;

  $categori = get_category(1);


?>
  <div class="relative mb-4">
    <div class="aspect-[3/4] bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
      <div class="w-16 h-20 bg-white rounded shadow-sm"></div>
    </div>
    <div class="absolute top-2 right-2 text-white text-xs px-2 py-1 bg-green-500 rounded-md uppercase">

    <?php
    echo  '<b>populer</b>
      </div>
    </div>
      <div class="space-y-2">
        <h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
            ' . substr(get_the_title(), 0, 20) . '
        </h3>
      <p class="text-sm text-gray-600">' . substr(get_the_author_meta('display_name'), 0, 200) . '</p>
    <div class="flex items-center space-x-1 text-yellow-400">
        ★★★★☆
        <span class="text-sm text-gray-600 ml-1">' . substr(get_the_author_meta('display_name'), 0, 200) . '</span>
    </div>
    <div class=" inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-gray-800 capitalize text-sm">
      ' . substr($categori->name, 0, 20) . '
    </div>
  </div>';
  }

    ?>