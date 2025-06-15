<?php

// require_once get_template_directory() . '/inc/tailwind-navwalker.php';

// echo '<div>' . get_template_directory() . '</div>';

// function script

// get file css
function ebookgua_enqueue_scripts()
{
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/output.css', [], filemtime(get_template_directory() . '/assets/css/output.css'));
}

// registry nav menus
register_nav_menus([
  'primary' => __('Primary Menu', 'ebookgua')
]);

// custom post type
function ebookgua_register_post_type()
{
  register_post_type('buku', [
    'labels' => [
      'name' => 'Buku',
      'singular_name' => 'Buku',
      'add_new_item' => 'Tambah Buku Baru nih',
      'edit_item' => 'Edit Buku',
      'new_item' => 'Buku Baru',
      'view_item' => 'Lihat Buku',
      'search_items' => 'Cari Buku',
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'buku'],
    'menu_icon' => 'dashicons-book-alt',
    'supports' => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true // penting untuk Gutenberg & REST API
  ]);
}

function ebookgua_add_meta_boxes()
{
  add_meta_box(
    'ebookgua_buku_meta',
    'Detail Buku',
    'ebookgua_render_buku_meta_box',
    'buku',
    'normal',
    'high'
  );
}

function ebookgua_save_buku_meta($post_id)
{
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  echo '<script type="text/javascript">alert("' . $post_id . '")</script>';
  var_dump($_POST);

  // Batasi hanya untuk post type buku
  $post_type = get_post_type($post_id);
  if ($post_type !== 'buku') return;

  if (isset($_POST['penulis'])) {
    update_post_meta($post_id, '_penulis', sanitize_text_field($_POST['penulis']));
  }

  if (isset($_POST['rating'])) {
    update_post_meta($post_id, '_rating', floatval($_POST['rating']));
  }

  if (isset($_POST['status'])) {
    update_post_meta($post_id, '_status', sanitize_text_field($_POST['status']));
  }

  if (isset($_POST['kategori'])) {
    update_post_meta($post_id, '_kategori', intval($_POST['kategori']));
  }
}



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
    <div class=" inline-flex items-center rounded-full border font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-gray-800 capitalize text-sm">
      ' . substr($categori->name, 0, 20) . '
    </div>
  </div>';
  }


  function ebookgua_render_buku_meta_box($post)
  {
    $penulis = get_post_meta($post->ID, '_penulis', true);
    $rating = get_post_meta($post->ID, '_rating', true);
    $status = get_post_meta($post->ID, '_status', true);
    $kategori = get_post_meta($post->ID, '_kategori', true);
    $categories = get_categories(['hide_empty' => false]);

    ?>
      <p>
        <label for="penulis">Penulis:</label><br>
        <input type="text" name="penulis" value="<?php echo esc_attr($penulis); ?>" class="widefat" />
      </p>

      <p>
        <label for="rating">Rating:</label><br>
        <input type="number" name="rating" value="<?php echo esc_attr($rating); ?>" class="widefat" min="0" max="5" step="0.1" />
      </p>

      <p>
        <label for="status">Status:</label><br>
        <select name="status" class="widefat">
          <option value="tersedia" <?php selected($status, 'tersedia'); ?>>Tersedia</option>
          <option value="habis" <?php selected($status, 'habis'); ?>>Habis</option>
        </select>
      </p>

      <p>
        <label for="kategori">Kategori:</label><br>
        <select name="kategori" class="widefat">
          <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat->term_id; ?>" <?php selected($kategori, $cat->term_id); ?>>
              <?php echo esc_html($cat->name); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
    <?php
  }




  // action 
  add_action('wp_enqueue_scripts', 'ebookgua_enqueue_scripts');
  add_action('init', 'ebookgua_register_post_type');
  add_action('add_meta_boxes', 'ebookgua_add_meta_boxes');
  add_action('save_post', 'ebookgua_save_buku_meta');

    ?>