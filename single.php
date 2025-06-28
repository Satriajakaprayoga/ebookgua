<?php get_header(); ?>
<?php global $post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="max-w-6xl mx-auto px-4 pt-10 mb-10">
        <?php if (function_exists('rank_math_the_breadcrumbs')): ?>
        <nav class="mb-4 text-sm text-blue-500 hover:text-blue-700 capitalize">
            <?php rank_math_the_breadcrumbs(); ?>
        </nav>
        <?php endif; ?>
        <div class="flex flex-col md:flex-row gap-10">
            <!-- Gambar Buku -->
            <div class="w-full max-w-96 md:w-1/2 md:pr-6">
                <?php if (has_post_thumbnail()): ?>
                    <div class="mb-6">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg shadow-lg']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Detail Buku -->
            <div class="w-full md:w-1/2 md:pl-6">
                <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
                
                <div class="mb-6">
                    <!-- <p class="font-semibold mb-2">Opsi Baca Ebook</p> -->
                    <div class="flex flex-wrap gap-4">
                        <?php  $pdf_url = get_post_meta(get_the_ID(), '_pdf', true); ?>
                        <?php if ($pdf_url): ?>
                            <a href="<?php echo esc_url($pdf_url); ?>"
                                class="rounded-md px-4 py-2 font-bold text-white transition-shadow shadow-md hover:shadow-lg bg-blue-500 hover:bg-blue-600"
                                download
                                target="_blank"
                                rel="noopener noreferrer">
                                Download E-book
                            </a>
                            <?php else  :?>
                            <!-- <button class="rounded-md px-4 py-2 font-bold text-white transition-shadow shadow-md hover:shadow-lg bg-blue-500 hover:bg-blue-600">
                                Download 
                            </button> -->
                        <?php endif; ?>
                        <button class="border rounded-md px-4 py-2 font-bold shadow-md hover:shadow-lg">
                            <div>Yuk Donasi
                            </div>
                        </button>
                    </div>
                </div>

                <p class="mb-2"><strong>Informasi Buku:</strong></p>
                <div class="flex flex-row justify-between gap-4">
                    <!-- Informasi Buku -->
                    <div>
                        <div class="mb-4 text-sm text-gray-700">
                            <p><strong>Penulis:</strong> <?php echo get_post_meta(get_the_ID(), '_penulis', true); ?></p>
                            <p><strong>Rating:</strong> <?php echo get_post_meta(get_the_ID(), '_rating', true); ?></p>
                            <p><strong>Status:</strong> <?php echo get_post_meta(get_the_ID(), '_status', true); ?></p>
                            <?php
                            $cat_id = get_post_meta(get_the_ID(), '_kategori', true);
                            $cat_obj = get_category($cat_id);
                            if ($cat_obj):
                            ?>
                                <p><strong>Kategori:</strong> <?php echo esc_html($cat_obj->name); ?></p>
                            <?php endif; ?>
                            <p><strong>Bahasa:</strong> <?php echo get_post_meta(get_the_ID(), '_bahasa' , true); ?></p>
                        </div>
                    </div>
        
                    <!-- Tanggal & Format -->
                    <div>
                        <div class="text-sm text-gray-600">
                            <p><strong>Penerbit:</strong> <?php echo get_post_meta(get_the_ID(), '_penerbit' , true); ?></p>
                            <p><strong>Tanggal Rilis:</strong> <?php echo get_post_meta(get_the_ID(), '_tanggal_rilis' , true); ?></p>
                            <p><strong>Halaman:</strong> <?php echo get_post_meta(get_the_ID(), '_halaman' , true); ?> Halaman</p>
                            <p><strong>Format:</strong> PDF</p>
                        </div>
                    </div>
                    
                </div>
                <div>
                    
                <p><?php echo get_post_meta(get_the_ID(), '_deskripsi' , true);  ?></p>
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
                if ($tags): ?>
                <div class="flex flex-wrap gap-2 mt-4">
                    <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                        class="text-sm font-semibold bg-blue-400 text-white bg-gray-100 px-3 py-1 rounded hover:bg-blue-500 transition">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                    <p>Tidak ada tag</p>
        <?php endif; ?> 
    </div>
    <?php
        // Pastikan komentar diizinkan atau sudah ada komentar
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    ?>

</div>


<?php get_footer(); ?>
