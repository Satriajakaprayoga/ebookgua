<?php get_header(); ?>

<div class="max-w-6xl mx-auto px-4 py-10">
  <h1 class="text-3xl font-bold mb-6">Blog</h1>

  <?php if (have_posts()) { ?>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while (have_posts()) {
          the_post(); ?>
        <article class="bg-white rounded-xl shadow p-4 hover:shadow-lg transition">
          <?php if (has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover rounded-lg mb-3']); ?>
            </a>
          <?php } ?>
          <h2 class="text-xl font-semibold mb-2">
            <a href="<?php the_permalink(); ?>" class="hover:text-blue-600"><?php the_title(); ?></a>
          </h2>
          <p class="text-gray-600 text-sm mb-3"><?php echo get_the_date('j F Y'); ?></p>
          <p class="text-gray-700"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        </article>
      <?php } ?>
    </div>

 <!-- 🔹 Pagination di sini -->
<div class="mt-8 flex justify-center">
  <?php
  the_posts_pagination([
      'mid_size' => 2,
      'prev_text' => '<span class="px-3 py-2 rounded-full bg-gray-200 hover:bg-blue-500 hover:text-white transition">«</span>',
      'next_text' => '<span class="px-3 py-2 rounded-full bg-gray-200 hover:bg-blue-500 hover:text-white transition">»</span>',
      'before_page_number' => '<span class="px-3 py-2 rounded-full bg-gray-200 hover:bg-blue-500 hover:text-white transition">',
      'after_page_number' => '</span>',
  ]);
      ?>
</div>

  <?php } else { ?>
    <p>No blog posts found.</p>
  <?php } ?>
</div>

<?php get_footer(); ?>

