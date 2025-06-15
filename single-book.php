<?php
get_header();
?>
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
    <?php if (has_post_thumbnail()): ?>
        <div class="w-full h-48 bg-gray-200 overflow-hidden">
            <?php the_post_thumbnail('medium', ['class' => 'object-cover w-full h-full']); ?>
        </div>
    <?php endif; ?>
    <p class="text-sm text-gray-500">Penulis: </p>

    <div class="prose">
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>