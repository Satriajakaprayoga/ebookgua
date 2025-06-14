<?php get_header(); ?>
<!-- show from search -->
<?php if( is_search()) :?>
<h1>Hello from search</h1>
<?php echo 'data ' . get_search_link() ?>
<br />
<?php echo  'Hasil pencarian: <span>' . get_query_var('s') . '</span>' ?>
<br />
<?php if(have_posts()) : ?>
    <p>terdapat post</p>
    <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediumish' ); ?></p>
<?php endif; wp_reset_query(); ?>
<?php endif; wp_reset_query(); ?>

<!-- show if from tag -->
<?php if( is_tag()) :?>
    <h1>Hello from tag</h1>
<?php endif; ?>

<!-- show if from page -->
<?php if( is_page()) :?>
    <h1>Hello from page</h1>
<?php endif; ?>
    
<?php get_footer(); ?>
