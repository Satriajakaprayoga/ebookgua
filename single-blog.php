<?php get_header(); ?>
<?php global $post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="max-w-4xl mx-auto px-4 pt-10 mb-10">
        <?php if (function_exists('rank_math_the_breadcrumbs')) { ?>
        <nav class="mb-4 text-sm text-blue-500 hover:text-blue-700 capitalize">
            <?php rank_math_the_breadcrumbs(); ?>
        </nav>
        <?php } ?>
        <div class="gap-10">
            <!-- Gambar Buku -->
            <div class="w-full">
              <div class="mb-8">
                <h1 class="text-3xl font-bold mb-1"><?php the_title(); ?></h1>
          <p>by <?php the_author(); ?> - <?php echo get_the_date('j F Y'); ?></p>
              </div>
              <?php if (has_post_thumbnail()) { ?>
                <div class="mb-6">
                      <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg shadow-lg']); ?>
                </div>
                <?php } else { ?>
                   <div class="mb-6 aspect-[3/4] bg-slate-200 rounded flex items-center justify-center ">
                      <div class="w-20 h-20 bg-white rounded shadow-sm"></div>
                   </div>
               <?php } ?>
            </div>

            <!-- Detail Blog -->
            <div class="w-full">
                <p><?php echo get_post_meta(get_the_ID(), '_deskripsi', true); ?></p>
                    <div class="prose max-w-none">
                        <?php echo apply_filters('the_content', get_the_content()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<div class="max-w-6xl mx-auto px-4 pt-10 mb-10">
    <div class="mb-7">
        <p>Tags:</p>
            <?php
                $tags = get_the_tags();
if ($tags) { ?>
                <div class="flex flex-wrap gap-2 mt-4">
                    <?php foreach ($tags as $tag) { ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                        class="text-sm font-semibold bg-blue-400 text-white bg-gray-100 px-3 py-1 rounded hover:bg-blue-500 transition">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                    <?php } ?>
                </div>
                <?php } else { ?>
                    <p>Tidak ada tag</p>
        <?php } ?> 
    </div>
    <?php
        // Pastikan komentar diizinkan atau sudah ada komentar
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
?>
  <!-- Related Posts -->
<div class="mt-10">
    <h2 class="text-2xl font-bold mb-4">Artikel Terkait</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
      $categories = wp_get_post_categories(get_the_ID());

$related = new WP_Query([
    'post_type' => 'blog', // custom post type kamu
    'posts_per_page' => 3,      // jumlah artikel yang mau ditampilkan
    'post__not_in' => [get_the_ID()], // jangan tampilkan artikel yang sedang dibuka
    'orderby' => 'rand', // acak (atau bisa pakai 'date' untuk terbaru)
    'category__in' => $categories,
]);

if ($related->have_posts()) {
    while ($related->have_posts()) {
        $related->the_post(); ?>
                <div class="border rounded-lg shadow-sm p-4 hover:shadow-md transition">
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover rounded']); ?>
                        </a>
                    <?php } ?>
                    <h3 class="text-lg font-semibold mt-3 capitalize">
                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-500">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <p class="text-sm font-thin capitalize">categori</p>
                    <p class="text-xs text-gray-500"><?php echo get_the_date('j F Y'); ?></p>
                </div>
            <?php }
    wp_reset_postdata();
} else { ?>
            <p>Tidak ada artikel terkait.</p>
        <?php } ?>
    </div>
</div>

</div>


<?php get_footer(); ?>

