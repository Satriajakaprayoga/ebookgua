<?php
get_header();
?>
<?php
global $post;

?>
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
    <!-- <p class="text-sm text-gray-500">Penulis: </p> -->

    <?php if (has_post_thumbnail()): ?>
        <div class="mb-6">
            <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg shadow-md']); ?>
        </div>
    <?php endif; ?>


    <p>Penulis from code: <?php echo get_post_meta(get_the_ID(), '_penulis', true); ?></p>
    <p>Rating: <?php echo get_post_meta(get_the_ID(), '_rating', true); ?></p>
    <p>Status: <?php echo get_post_meta(get_the_ID(), '_status', true); ?></p>

    <?php
    $cat_id = get_post_meta(get_the_ID(), '_kategori', true);
    $cat_obj = get_category($cat_id);
    if ($cat_obj):
    ?>
        <p>Kategori: <?php echo esc_html($cat_obj->name); ?></p>
    <?php endif; ?>

    <div class="prose">
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>