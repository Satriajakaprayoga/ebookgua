<?php get_header(); ?>

<?php if( is_search()) : ?>

<h1>Hello from search</h1>
<?php else : ?>
<h1>Hello from index.php</h1>

<?php endif; ?>

<?php get_footer(); ?>
