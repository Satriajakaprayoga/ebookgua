<?php
get_header();
global $post;
?>

<div class="max-w-3xl mx-auto p-6 space-y-4">
    <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>

    <?php if (has_post_thumbnail()): ?>
        <div class="mb-6">
            <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg shadow-md']); ?>
        </div>
    <?php endif; ?>

    <ul class="space-y-1 text-gray-800">
        <li><strong>Penulis:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_penulis', true)); ?></li>
        <li><strong>Rating:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_rating', true)); ?></li>
        <li><strong>Status:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_status', true)); ?></li>

        <?php
        $cat_id = get_post_meta(get_the_ID(), '_kategori', true);
        $cat_obj = get_category($cat_id);
        if ($cat_obj):
        ?>
            <li><strong>Kategori:</strong> <?php echo esc_html($cat_obj->name); ?></li>
        <?php endif; ?>

        <?php
        $bahasa = get_post_meta(get_the_ID(), '_bahasa', true);
        if ($bahasa):
        ?>
            <li><strong>Bahasa:</strong> <?php echo esc_html($bahasa); ?></li>
        <?php endif; ?>

        <?php
        $halaman = get_post_meta(get_the_ID(), '_halaman', true);
        if ($halaman):
        ?>
            <li><strong>Jumlah Halaman:</strong> <?php echo esc_html($halaman); ?></li>
        <?php endif; ?>

        <?php
        $pdf_url = get_post_meta(get_the_ID(), '_file_pdf', true);
        if ($pdf_url && pathinfo($pdf_url, PATHINFO_EXTENSION) === 'pdf'):
        ?>
            <li><strong>File PDF:</strong> <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="text-blue-600 underline">Lihat / Unduh PDF</a></li>
        <?php endif; ?>
    </ul>

    <?php if (trim(get_the_content())): ?>
        <div class="prose max-w-none mt-6">
            <?php the_content(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
