<?php
/**
 * Meta boxes for Buku & Post + save handlers
 */

if (!function_exists('ebookgua_add_meta_boxes')) {
    function ebookgua_add_meta_boxes() {
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
    add_action('add_meta_boxes', 'ebookgua_add_meta_boxes');
}

if (!function_exists('ebookgua_render_buku_meta_box')) {
    function ebookgua_render_buku_meta_box($post) {
        $penulis   = get_post_meta($post->ID, '_penulis', true);
        $rating    = get_post_meta($post->ID, '_rating', true) ?: '5.0';
        $status    = get_post_meta($post->ID, '_status', true);
        $kategori  = get_post_meta($post->ID, '_kategori', true);
        $penerbit  = get_post_meta($post->ID, '_penerbit', true);
        $rilis     = get_post_meta($post->ID, '_tanggal_rilis', true);
        $halaman   = get_post_meta($post->ID, '_halaman', true);
        $deskripsi = get_post_meta($post->ID, '_deskripsi', true);
        $bahasa    = get_post_meta($post->ID, '_bahasa', true);

        $categories = get_categories(['hide_empty' => false]);
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
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat->term_id; ?>" <?php selected($kategori, $cat->term_id); ?>>
                        <?php echo esc_html($cat->name); ?>
                    </option>
                <?php } ?>
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
            <?php if ($pdf_url) { ?>
                <p><a href="<?php echo esc_url($pdf_url); ?>" target="_blank">Lihat PDF saat ini</a></p>
            <?php } ?>
        </p>
        <?php
    }
}

if (!function_exists('ebookgua_save_post_meta')) {
    function ebookgua_save_post_meta($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }

        $map = [
            'penulis'       => ['_penulis', 'text'],
            'rating'        => ['_rating', 'float'],
            'status'        => ['_status', 'text'],
            'kategori'      => ['_kategori', 'int'],
            'bahasa'        => ['_bahasa', 'text'],
            'penerbit'      => ['_penerbit', 'text'],
            'tanggal_rilis' => ['_tanggal_rilis', 'text'],
            'halaman'       => ['_halaman', 'int'],
            'deskripsi'     => ['_deskripsi', 'text'],
        ];

        foreach ($map as $field => [$meta_key, $type]) {
            if (isset($_POST[$field])) {
                $val = $_POST[$field];
                switch ($type) {
                    case 'float': $val = floatval($val); break;
                    case 'int':   $val = intval($val);   break;
                    default:      $val = sanitize_text_field($val);
                }
                update_post_meta($post_id, $meta_key, $val);
            }
        }

        if (!empty($_FILES['pdf']['tmp_name'])) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            $pdf_id = media_handle_upload('pdf', $post_id);
            if (!is_wp_error($pdf_id)) {
                update_post_meta($post_id, '_pdf', wp_get_attachment_url($pdf_id));
            }
        }
    }
    add_action('save_post', 'ebookgua_save_post_meta');
}

/**
 * Card renderer helper (kept as-is)
 */
if (!function_exists('ebookgua_postbox_default')) {
    function ebookgua_postbox_default() {
        global $post;
        $penulis = get_post_meta($post->ID, '_penulis', true);
        $rating = get_post_meta($post->ID, '_rating', true);
        $status = get_post_meta($post->ID, '_status', true);
        $kategori_id = get_post_meta($post->ID, '_kategori', true);
        $deskripsi = get_post_meta($post->ID, '_deskripsi', true);
        $kategori = get_category($kategori_id);
        $link = get_permalink($post->ID); ?>
        <a href="<?php echo esc_url($link); ?>" class="block group overflow-hidden">
            <div class="relative mb-4">
                <?php if (has_post_thumbnail($post->ID)) { ?>
                    <div class="aspect-square bg-slate-200 rounded-lg mb-3 overflow-hidden shadow-md">
                        <?php echo get_the_post_thumbnail($post->ID, 'medium', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php } else { ?>
                    <div class="aspect-square bg-slate-200 rounded-lg mb-3 flex items-center justify-center">
                        <div class="w-16 h-20 bg-white rounded shadow-sm"></div>
                    </div>
                <?php } ?>
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
                <?php if ($penulis) { ?>
                    <p class="text-sm font-light text-gray-600"><?php echo esc_html($penulis); ?></p>
                <?php } ?>
                <?php if ($rating) { ?>
                    <div class="flex items-center space-x-1 text-yellow-400">
                        <?php
                        $rating_val = max(0, min(5, floatval($rating)));
                        $fullStars = floor($rating_val);
                        echo str_repeat('★', $fullStars) . str_repeat('☆', 5 - $fullStars);
                        ?>
                        <span class="text-sm text-gray-600 ml-1"><?php echo esc_html(number_format($rating_val, 1)); ?></span>
                    </div>
                <?php } ?>
                <?php if ($deskripsi) { ?>
                    <p class="text-sm text-gray-600 line-clamp-2"><?php echo esc_html($deskripsi) ?></p>
                <?php } ?>
                <?php if ($kategori && !is_wp_error($kategori)) { ?>
                    <div class="inline-flex items-center rounded px-2 py-1 font-semibold text-blue-600 text-xs bg-blue-100 mt-4">
                        <?php echo esc_html($kategori->name); ?>
                    </div>
                <?php } ?>
            </div>
        </a>
        <?php
    }
}
