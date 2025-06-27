<?php get_header(); ?>
<?php global $post; ?>

<div class="max-w-6xl mx-auto px-4 pt-10 mb-10">
    <div class="flex flex-col md:flex-row gap-10">
        <!-- Gambar Buku -->
        <div class="w-full md:w-1/2 md:pr-6">
            <?php if (has_post_thumbnail()): ?>
                <div class="mb-6">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg shadow-lg']); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Detail Buku -->
        <div class="w-full md:w-1/2 md:pl-6">
            <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
            <!-- Opsi Pembelian -->
            <!-- <div class="mb-6">
                <p class="font-semibold mb-2">Opsi Pembelian</p>
                <div class="flex flex-wrap gap-2">
                    <div class="border rounded-md px-4 py-2 font-semibold bg-gray-200">Satuan<br><span class="text-lg font-bold">Rp 109.000</span></div>
                    <div class="border rounded-md px-4 py-2 font-semibold">Premium Package<br><span class="text-lg font-bold">Rp 99.000</span></div>
                    <div class="border rounded-md px-4 py-2 font-semibold">Fiction Package<br><span class="text-lg font-bold">Rp 49.000</span></div>
                </div>
            </div> -->

            <!-- Info Aplikasi -->
            <!-- <div class="bg-gray-100 rounded-md p-4 mb-6 text-sm">
                <p class="font-semibold">Konten ini dapat dibaca melalui aplikasi Gramedia Digital</p>
                <p class="text-gray-600">Download aplikasi Gramedia Digital yang tersedia di seluruh perangkat iOS dan Android</p>
                <div class="flex gap-2 mt-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-10" alt="Google Play">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" class="h-10" alt="App Store">
                </div>
            </div> -->

            <div class="mb-6">
                <!-- <p class="font-semibold mb-2">Opsi Baca Ebook</p> -->
                <div class="flex flex-wrap gap-4">
                    <button class="rounded-md px-4 py-2 font-bold text-white transition-shadow shadow-md hover:shadow-lg bg-blue-500 hover:bg-blue-600">
                        <div class="">
                            Download E-book
                        </div>
                    </button>
                    <button class="border rounded-md px-4 py-2 font-bold shadow-md hover:shadow-lg ">
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
                             <p><strong>Kategori:</strong> <?php echo esc_html($cat_obj->name); ?> tahu goreng di goreng dadakan enak jaja jaja </p>
                         <?php endif; ?>
                         <p><strong>Bahasa:</strong> Indonesia asdklf asdf asdf asdf asdf</p>
                     </div>
                 </div>
    
                <!-- Tanggal & Format -->
                 <div>
                     <div class="text-sm text-gray-600">
                         <p><strong>Penerbit:</strong> Gramedia Pustaka Utama</p>
                         <p><strong>Tanggal Rilis:</strong> 07 Mei 2018</p>
                         <p><strong>Halaman:</strong> 520 Halaman</p>
                         <p><strong>Format:</strong> PDF</p>
                     </div>
                 </div>
                
            </div>
            <div>
                <article class="article-post">
                <div class="prose max-w-none">
                    <?php echo apply_filters('the_content', get_the_content()); ?>
                </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
