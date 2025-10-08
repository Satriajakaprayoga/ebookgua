<?php
/**
 * Admin submenu: Tambah Buku Manual + handler
 */

if (!function_exists('ebookgua_add_custom_submenu')) {
    function ebookgua_add_custom_submenu() {
        add_submenu_page(
            'edit.php?post_type=buku',
            'Tambah Buku Manual',
            'Tambah Buku Manual',
            'manage_options',
            'tambah-buku-manual',
            'ebookgua_render_form_page'
        );
    }
    add_action('admin_menu', 'ebookgua_add_custom_submenu');
}

if (!function_exists('ebookgua_add_custom_submenu_blog')) {
    function ebookgua_add_custom_submenu_blog() {
        add_submenu_page(
            'edit.php?post_type=blog',
            'Tambah blog',
            'Tambah blog',
            'manage_options',
            'tambah-buku-manual',
            'ebookgua_render_form_page'
        );
    }
    add_action('admin_menu', 'ebookgua_add_custom_submenu_blog');
}

if (!function_exists('ebookgua_render_form_page')) {
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
                        <option value="Populer">Populer</option>
                        <option value="Terbaru">Terbaru</option>
                        <option value="Terlaris">Terlaris</option>
                    </select>
                </p>

                <p>
                    <label for="kategori">Kategori:</label><br>
                    <select name="kategori" id="kategori" class="regular-text">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($categories as $cat) { ?>
                            <option value="<?php echo esc_attr($cat->term_id); ?>">
                                <?php echo esc_html($cat->name); ?>
                            </option>
                        <?php } ?>
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
}

if (!function_exists('ebookgua_handle_manual_buku_submit')) {
    function ebookgua_handle_manual_buku_submit() {
        if (isset($_POST['ebookgua_submit_buku']) && check_admin_referer('ebookgua_save_manual_buku', 'ebookgua_nonce')) {
            $judul = sanitize_text_field($_POST['judul']);
            $penulis = sanitize_text_field($_POST['penulis']);
            $rating = floatval($_POST['rating']);
            $deskripsi = sanitize_textarea_field($_POST['deskripsi']);
            $bahasa = sanitize_text_field($_POST['bahasa']);
            $halaman = intval($_POST['halaman']);
            $status = sanitize_text_field($_POST['status']);

            $post_id = wp_insert_post([
                'post_type' => 'buku',
                'post_title' => $judul,
                'post_content' => $deskripsi,
                'post_status' => 'publish',
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

                // Upload Thumbnail
                if (!empty($_FILES['thumbnail']['tmp_name'])) {
                    $thumbnail_id = media_handle_upload('thumbnail', $post_id);
                    if (!is_wp_error($thumbnail_id)) {
                        set_post_thumbnail($post_id, $thumbnail_id);
                    }
                }

                // Upload PDF
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
    add_action('admin_init', 'ebookgua_handle_manual_buku_submit');
}
