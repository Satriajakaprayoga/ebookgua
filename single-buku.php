<?php
get_header();
?>
<?php
global $post;
echo 'Current Post ID: ' . $post->ID . '<br>';
var_dump(get_post_meta($post->ID, '_edit_lock')[0]); // Lihat semua metadata
?>
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
    <!-- <p class="text-sm text-gray-500">Penulis: </p> -->


    <p>Penulis from code: <?php echo get_post_meta(get_the_ID(), '_penulis', true); ?></p>
    <p>edit lock: <?php echo get_post_meta(get_the_ID(), '_edit_lock', true); ?></p>
    <p>Rating: <?php echo get_post_meta(get_the_ID(), '_rating', true); ?></p>
    <p>Status: <?php echo get_post_meta(get_the_ID(), '_status', true); ?></p>

    <?php
    $cat_id = get_post_meta(get_the_ID(), '_kategori', true);

    if ($cat_id) {
        $cat_obj = get_category($cat_id);

        if (!is_wp_error($cat_obj)) {
            echo '<p>Kategori from code: ' . esc_html($cat_obj->name) . '</p>';
        } else {
            echo '<p><i>Kategori tidak ditemukan</i></p>';
        }
    } else {
        echo '<p><i>Tidak ada kategori dipilih</i></p>';
    }
    ?>

    <div class="prose">
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>