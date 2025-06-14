<?php 
/**
 * Search Results
 */
get_header()
?>

<?php 
$listCategories = get_categories(array(
    'orderby' => 'id', // urutkan berdasarkan ID
    'order'   => 'DESC', // ID terbesar (terbaru) di atas
    'number'  => 5, // ambil 10 tag saja
));

$getSearch = get_posts(array(
    'orderby' => 'id', // urutkan berdasarkan ID
    'order'   => 'DESC', // ID terbesar (terbaru) di atas
    'number'  => 5, // ambil 10 tag saja
));



?>
  <section class="max-w-7xl mx-auto bg-white my-2 mb-20 mt-10"> 
    <div class="max-w-6xl mx-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-5">Hasil pencarian data: <?php echo get_query_var('s'); ?></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="group cursor-pointer shadow-md hover:shadow-lg transition-shadow bg-white rounded-md">
                    <div class="p-4">
                        <?php ebookgua_postbox_default() ?>
                    </div>
                </div>
                <?php endwhile; ?> 
                
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'ebookgua' ); ?></p>
                    <?php endif; ?> 
                </div>         
            </div>   
        </div>
    </section>
<?php get_footer(); ?>