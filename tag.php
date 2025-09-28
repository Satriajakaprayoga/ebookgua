<?php
/**
 * Tag Archive Template (manual query)
 */
get_header();

// get current tag object
$term = get_queried_object();

// custom query
$args = [
    'post_type' => ['buku', 'blog', 'post'],
    'posts_per_page' => 10,
    'paged' => get_query_var('paged') ?: 1,
    'tag' => $term->slug,
];
$query = new WP_Query($args);
?>

<section class="max-w-7xl mx-auto bg-white my-2 mb-20 mt-10"> 
  <div class="max-w-6xl mx-10">
    
    <h2 class="text-2xl font-bold text-gray-900 mb-2">
      Tag: <?php echo esc_html($term->name); ?>
    </h2>
    
    <?php if (tag_description()) { ?>
      <p class="text-gray-600 mb-5"><?php echo tag_description(); ?></p>
    <?php } ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
      <?php if ($query->have_posts()) { ?>
        <?php while ($query->have_posts()) {
            $query->the_post(); ?>
          <div class="group shadow-md hover:shadow-lg transition-shadow bg-white rounded-md">
            <div class="p-4">
              <?php ebookgua_postbox_default(); ?>
            </div>
          </div>
        <?php } ?>

        <div class="col-span-full mt-6">
          <?php
              echo paginate_links([
                  'total' => $query->max_num_pages,
                  'current' => max(1, get_query_var('paged')),
              ]);
          ?>
        </div>

      <?php } else { ?>
        <p><?php _e('No posts found for this tag.', 'ebookgua'); ?></p>
      <?php } ?>
    </div>         
  </div>   
</section>

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

<?php
wp_reset_postdata();
get_footer();
?>
