<?php
// function script

// get file css
function ebookgua_enqueue_scripts()
{
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/output.css', [], filemtime(get_template_directory() . '/assets/css/output.css'));
}

function ebookgua_theme_setup()
{
    // Tambah dukungan SEO WordPress (agar Rank Math bisa bekerja)
  add_theme_support('title-tag');          // Membiarkan Rank Math mengatur <title>
  add_theme_support('post-thumbnails');    // Untuk thumbnail image
  add_theme_support('html5', [             // Gunakan tag HTML5 untuk struktur yang lebih SEO-friendly
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
  ]);
}

// registry nav menus primary menu
function ebookgua_register_menus()
{
  register_nav_menus([
    'primary' => __('Primary Menu', 'ebookgua')
  ]);
}


// configuration tailwind 
function mytheme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/output.css', [], '1.0');
}


// ================ BUKU BLOCK  START ============================ 


// custom post type
function ebookgua_register_post_type()
{
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
    'show_in_rest' => true // penting untuk Gutenberg & REST API
  ]);
}

function ebookgua_add_custom_submenu() {
  add_submenu_page(
    'edit.php?post_type=buku',       // Parent slug (menu Buku)
    'Tambah Buku Manual',           // Page title
    'Tambah Buku Manual',           // Menu title
    'manage_options',               // Capability
    'tambah-buku-manual',           // Menu slug
    'ebookgua_render_form_page'     // Callback function
  );
}

function ebookgua_render_form_page() {

  $categories = get_categories(['hide_empty' => false]);

  ?>
  <div class="wrap">
    <h1>Tambah Buku Manual</h1>
  <form method="post" action="" enctype="multipart/form-data">
    <?php wp_nonce_field('ebookgua_save_manual_buku', 'ebookgua_nonce'); ?>

    <p>
      <label for="judul">Judul Buku:</label><br>
      <input type="text" name="judul" id="judul" class="regular-text" required>
    </p>

    <p>
      <label for="penulis">Penulis:</label><br>
      <input type="text" name="penulis" id="penulis" class="regular-text">
    </p>


    <p>
      <label for="rating">Rating:</label><br>
      <input type="number" placeholder="Ketik 0.0 sampai 5.0" name="rating" id="rating" step="0.1" min="0" max="5">
    </p>

    <p>
      <label for="deskripsi">Deskripsi:</label><br>
      <textarea name="deskripsi" id="deskripsi" rows="5" class="large-text"></textarea>
    </p>
    

    <p>
      <label for="bahasa">Bahasa:</label><br>
      <select name="bahasa" id="bahasa" class="regular-text">
        <option value="">-- Pilih Bahasa --</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Inggris">Inggris</option>
        <option value="Arab">Arab</option>
        <option value="Mandarin">Mandarin</option>
        <option value="Jepang">Jepang</option>
        <option value="Jerman">Jerman</option>
        <option value="Perancis">Perancis</option>
      </select>
    </p>

    <p>
      <label for="halaman">Jumlah Halaman:</label><br>
      <input type="number" name="halaman" id="halaman" min="1" class="small-text">
    </p>

      <p>
      <label for="status">Status :</label><br>
      <select name="status" class="widefat">
        <option value="Populer" >Populer</option>
        <option value="Terbaru" >Terbaru</option>
        <option value="Terlaris" >Terlaris</option>
      </select>
    </p>

  <p>
    <label for="kategori">Kategori:</label><br>
    <select name="kategori" id="kategori" class="regular-text">
      <option value="">-- Pilih Kategori --</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?php echo esc_attr($cat->term_id); ?>">
          <?php echo esc_html($cat->name); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </p>

    <p>
      <label for="thumbnail">Thumbnail (Gambar):</label><br>
      <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
    </p>

    <p>
      <label for="pdf">File PDF:</label><br>
      <input type="file" name="pdf" id="pdf" accept="application/pdf">
    </p>

    <p>
      <input type="submit" name="ebookgua_submit_buku" class="button button-primary" value="Simpan Buku">
    </p>
  </form>

  </div>
  <?php
}

function ebookgua_handle_manual_buku_submit() {
  if (isset($_POST['ebookgua_submit_buku']) && check_admin_referer('ebookgua_save_manual_buku', 'ebookgua_nonce')) {
    $judul = sanitize_text_field($_POST['judul']);
    $penulis = sanitize_text_field($_POST['penulis']);
    $rating = floatval($_POST['rating']);
    $deskripsi = sanitize_textarea_field($_POST['deskripsi']);
    $bahasa = sanitize_text_field($_POST['bahasa']);
    $halaman = intval($_POST['halaman']);
    $status = sanitize_text_field($_POST['status']);

    // Buat post
    $post_id = wp_insert_post([
      'post_type'    => 'buku',
      'post_title'   => $judul,
      'post_content' => $deskripsi,
      'post_status'  => 'publish'
    ]);

    if ($post_id) {
      update_post_meta($post_id, '_penulis', $penulis);
      update_post_meta($post_id, '_rating', $rating);
      update_post_meta($post_id, '_bahasa', $bahasa);
      update_post_meta($post_id, '_halaman', $halaman);
      update_post_meta($post_id, '_status', $status);

      if (!empty($_POST['kategori'])) {
        wp_set_post_categories($post_id, [(int) $_POST['kategori']]);
      }


      // === Upload Thumbnail ===
      if (!empty($_FILES['thumbnail']['tmp_name'])) {
        $thumbnail_id = media_handle_upload('thumbnail', $post_id);
        if (!is_wp_error($thumbnail_id)) {
          set_post_thumbnail($post_id, $thumbnail_id);
        }
      }

      // === Upload PDF ===
      if (!empty($_FILES['pdf']['tmp_name'])) {
        $pdf_file = $_FILES['pdf'];
        $file_type = wp_check_filetype($pdf_file['name']);

        if ($file_type['ext'] === 'pdf') {
          $pdf_id = media_handle_upload('pdf', $post_id);
          if (!is_wp_error($pdf_id)) {
            update_post_meta($post_id, '_pdf', wp_get_attachment_url($pdf_id));
          }
        } else {
          add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>File yang diunggah bukan PDF.</p></div>';
          });
        }
      }

      add_action('admin_notices', function () {
        echo '<div class="notice notice-success is-dismissible"><p>Buku berhasil ditambahkan.</p></div>';
      });
    }
  }
}

// register taxonomies
function ebookgua_register_taxonomies_for_buku()
{
  register_taxonomy_for_object_type('category', 'buku');
  register_taxonomy_for_object_type('post_tag', 'buku');
}

function ebookgua_allow_pdf_upload($mimes) {
  $mimes['pdf'] = 'application/pdf';
  return $mimes;
}
add_filter('upload_mimes', 'ebookgua_allow_pdf_upload');


// ================ BUKU BLOCK END ============================ 

function ebookgua_add_meta_boxes()
{
  add_meta_box(
    'ebookgua_buku_meta',
    'Detail Buku',
    'ebookgua_render_buku_meta_box',
    'buku',
    'side',
    'low'
  );

  add_meta_box(
    'ebookgua_post_meta',
    'Detail Post',
    'ebookgua_render_buku_meta_box',
    'post',
    'side',
    'low'
  );
}


// handle save post meta
function ebookgua_save_post_meta($post_id)
{
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

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
  if (isset($_POST['bahasa'])) {
    update_post_meta($post_id, '_bahasa', sanitize_text_field($_POST['bahasa']));
  }

  if (isset($_POST['penerbit'])) {
    update_post_meta($post_id, '_penerbit', sanitize_text_field($_POST['penerbit']));
  }

  if (isset($_POST['tanggal_rilis'])) {
    update_post_meta($post_id, '_tanggal_rilis', sanitize_text_field($_POST['tanggal_rilis']));
  }

  if (isset($_POST['halaman'])) {
    update_post_meta($post_id, '_halaman', intval($_POST['halaman']));
  }
  if (isset($_POST['deskripsi'])) {
    update_post_meta($post_id, '_deskripsi', sanitize_text_field($_POST['deskripsi']));
  }

  if (!empty($_FILES['pdf']['tmp_name'])) {
  require_once ABSPATH . 'wp-admin/includes/file.php';
    $pdf_id = media_handle_upload('pdf', $post_id);
    if (!is_wp_error($pdf_id)) {
      update_post_meta($post_id, '_pdf', wp_get_attachment_url($pdf_id));
    }
  }
}



function ebookgua_postbox_default()
{
  global $post;

  // Ambil custom field dari post meta
  $penulis = get_post_meta($post->ID, '_penulis', true);
  $rating = get_post_meta($post->ID, '_rating', true);
  $status = get_post_meta($post->ID, '_status', true);
  $kategori_id = get_post_meta($post->ID, '_kategori', true);
  $deskripsi = get_post_meta($post->ID,'_deskripsi', true);
  $kategori = get_category($kategori_id);
  $link = get_permalink($post->ID);
?>
  <a href="<?php echo esc_url($link); ?>" class="block group overflow-hidden">
    <div class="relative mb-4">
      <?php if (has_post_thumbnail($post->ID)): ?>
        <div class="aspect-square bg-slate-200 rounded-lg mb-3 overflow-hidden shadow-md">
          <?php echo get_the_post_thumbnail($post->ID, 'medium', ['class' => 'w-full h-full object-cover']); ?>
        </div>
      <?php else: ?>
        <div class="aspect-square bg-slate-200 rounded-lg mb-3 flex items-center justify-center">
          <div class="w-16 h-20 bg-white rounded shadow-sm"></div>
        </div>
      <?php endif; ?>
      <div class="absolute top-2 right-2 text-white text-xs px-2 py-1 bg-green-500 rounded-md uppercase">
        <?php echo esc_html($status ?: 'Populer'); ?>
      </div>
    </div>
    <div class="space-y-0">
      <h3 class="font-semibold text-gray-900 line-clamp-2  transition-colors">
          <a href="<?php the_permalink(); ?>" class="hover:underline cursor-pointer">
            <?php echo esc_html(wp_trim_words(get_the_title(), 10)); ?>
          </a>
      </h3>

      <!-- penulis -->
      <?php if ($penulis): ?>
        <p class="text-sm font-light text-gray-600"> <?php echo esc_html($penulis); ?></p>
      <?php endif; ?>

      <!-- rating -->
      <?php if ($rating): ?>
        <div class="flex items-center space-x-1 text-yellow-400">
          <?php
          $rating = max(0, min(5, floatval($rating)));
          $fullStars = floor($rating);
          echo str_repeat('★', $fullStars) . str_repeat('☆', 5 - $fullStars);
          ?>
          <span class="text-sm text-gray-600 ml-1"><?php echo esc_html(number_format($rating, 1)); ?></span>
        </div>
      <?php endif; ?>

      <!-- deskripsi -->
     <?php if ($deskripsi): ?>
          <p class="text-sm text-gray-600 line-clamp-2"><?php echo esc_html($deskripsi) ?> </p>
      <?php endif; ?>

      <?php if ($kategori && !is_wp_error($kategori)): ?>
        <div class="inline-flex items-center rounded px-2 py-1 font-semibold text-blue-600 text-xs bg-blue-100 mt-4">
          <?php echo esc_html($kategori->name); ?>
        </div>
      <?php endif; ?>
    </div>
  </a>
<?php
}

function ebookgua_render_buku_meta_box($post)
{
  $penulis = get_post_meta($post->ID, '_penulis', true);
  $rating = get_post_meta($post->ID, '_rating', true) ?: '5.0';
  $status = get_post_meta($post->ID, '_status', true);
  $kategori = get_post_meta($post->ID, '_kategori', true);
  $penerbit = get_post_meta($post->ID, '_penerbit', true);
  $rilis    = get_post_meta($post->ID, '_tanggal_rilis', true);
  $halaman  = get_post_meta($post->ID, '_halaman', true);
  $deskripsi  = get_post_meta($post->ID, '_deskripsi', true);
  $bahasa   = get_post_meta($post->ID, '_bahasa', true);

  $categories = get_categories(['hide_empty' => false]);
    // Dapatkan URL PDF jika sudah diupload sebelumnya
  $pdf_url = get_post_meta($post->ID, '_pdf', true);

?>
  <p>
    <label for="penulis">Penulis:</label><br>
    <input type="text" name="penulis" value="<?php echo esc_attr($penulis); ?>" class="widefat" />
  </p>
  <p>
    <label for="deskripsi">Deskripsi:</label><br>
    <input type="text" name="deskripsi" value="<?php echo esc_attr($deskripsi); ?>" class="widefat" />
  </p>

  <p>
    <label for="rating">Rating:</label><br>
    <input type="number" name="rating" value="<?php echo esc_attr($rating); ?>" class="widefat" min="0" max="5" step="0.1" />
  </p>

  <p>
    <label for="status">Status:</label><br>
    <select name="status" class="widefat">
      <option value="Populer" <?php selected($status, 'Populer'); ?>>Populer</option>
      <option value="Terbaru" <?php selected($status, 'Terbaru'); ?>>Terbaru</option>
      <option value="Terlaris" <?php selected($status, 'Terlaris'); ?>>Terlaris</option>
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
    <p>
    <label for="bahasa">Bahasa:</label><br>
    <select name="bahasa" class="widefat">
      <option value="">-- Pilih Bahasa --</option>
      <option value="Indonesia" <?php selected($bahasa, 'Indonesia'); ?>>Indonesia</option>
      <option value="Inggris" <?php selected($bahasa, 'Inggris'); ?>>Inggris</option>
      <option value="Arab" <?php selected($bahasa, 'Arab'); ?>>Arab</option>
      <option value="Mandarin" <?php selected($bahasa, 'Mandarin'); ?>>Mandarin</option>
      <option value="Jepang" <?php selected($bahasa, 'Jepang'); ?>>Jepang</option>
      <option value="Jerman" <?php selected($bahasa, 'Jerman'); ?>>Jerman</option>
      <option value="Perancis" <?php selected($bahasa, 'Perancis'); ?>>Perancis</option>
    </select>
  </p>
   <p>
    <label for="penerbit">Penerbit:</label><br>
    <input type="text" name="penerbit" value="<?php echo esc_attr($penerbit); ?>" class="widefat" />
  </p>

  <p>
    <label for="tanggal_rilis">Tanggal Rilis:</label><br>
    <input type="date" name="tanggal_rilis" value="<?php echo esc_attr($rilis); ?>" class="widefat" />
  </p>

  <p>
    <label for="halaman">Jumlah Halaman:</label><br>
    <input type="number" name="halaman" value="<?php echo esc_attr($halaman); ?>" class="widefat" min="1" />
  </p>
  <p>
    <label for="pdf">File PDF:</label><br>
    <input type="file" name="pdf" accept="application/pdf" />
    <?php if ($pdf_url): ?>
      <p><a href="<?php echo esc_url($pdf_url); ?>" target="_blank">Lihat PDF saat ini</a></p>
    <?php endif; ?>
  </p>
<?php
}


  

// action 
add_action('wp_enqueue_scripts', 'ebookgua_enqueue_scripts');
add_action('init', 'ebookgua_register_post_type');
add_action('add_meta_boxes', 'ebookgua_add_meta_boxes');
add_action('save_post', 'ebookgua_save_post_meta');
add_action('init', 'ebookgua_register_menus');
add_action('init', 'ebookgua_register_taxonomies_for_buku');
add_action('after_setup_theme', 'ebookgua_theme_setup');
add_action('admin_init', 'ebookgua_handle_manual_buku_submit');
add_action('admin_menu', 'ebookgua_add_custom_submenu');
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');


?>

<?php
function ebookgua_comment_template($comment, $args, $depth)
{
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('border border-gray-200 rounded-lg p-4'); ?>>

        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full']); ?>
            </div>
            <div class="flex-1">
                <div class="mb-1">
                    <strong class="text-sm text-gray-900"><?php comment_author(); ?></strong>
                    <span class="text-xs text-gray-500 ml-2"><?php comment_date(); ?></span>
                </div>
                <div class="text-sm text-gray-700">
                    <?php comment_text(); ?>
                </div>
                <div class="mt-2">
                    <?php
                    comment_reply_link(array_merge($args, [
                        'reply_text' => 'Balas',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'class' => 'text-xs text-blue-600 hover:underline',
                    ]));
                    ?>
                </div>
            </div>
        </div>

    </<?php echo $tag; ?>>
<?php
}
