<?php get_header(); ?>

<div class="max-w-6xl mx-auto px-4 py-10">

  <?php if (is_search()) : ?>
    <h1 class="text-2xl font-bold mb-2">Hasil Pencarian</h1>
    <p class="text-gray-700 mb-6">Anda mencari: <strong><?php echo get_search_query(); ?></strong></p>

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('template-part/content', get_post_type()); ?>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <p class="text-gray-600">Maaf, tidak ada hasil ditemukan.</p>
    <?php endif; ?>

  <?php elseif (is_tag()) : ?>
    <?php get_template_part('template-part/coming-soon'); ?>

  <?php elseif (is_page()) : ?>
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    endif;
    ?>

  <?php else : ?>
    <?php
    if (have_posts()) :
      echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';
      while (have_posts()) : the_post();
        get_template_part('template-part/content', get_post_type());
      endwhile;
      echo '</div>';
    else :
      get_template_part('template-part/coming-soon');
    endif;
    ?>
  <?php endif; ?>

</div>

<?php get_footer(); ?>
