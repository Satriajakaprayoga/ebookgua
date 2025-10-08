<?php

/**
 * Theme bootstrap: load modular files from /inc (snake_case).
 * Text domain: ebookgua
 */

// Keamanan: pastikan file tidak diakses langsung
if (! defined('ABSPATH')) {
    exit;
}

// Keep your existing install-pdfjs.php loader if you already have it.
// If you prefer to keep it in functions.php, uncomment the next line.
// require get_template_directory() . '/inc/install-pdfjs.php';

require get_template_directory().'/inc/enqueue_scripts.php';
require get_template_directory().'/inc/theme_setup.php';
require get_template_directory().'/inc/post_types.php';
require get_template_directory().'/inc/meta_boxes.php';
require get_template_directory().'/inc/taxonomies.php';
require get_template_directory().'/inc/manual_buku_form.php';
require get_template_directory().'/inc/customizer_footer.php';
require get_template_directory().'/inc/customizer_social.php';
require get_template_directory().'/inc/update_checker.php';
require get_template_directory().'/inc/admin_notices.php';
// require get_template_directory().'/inc/comment_template.php';
