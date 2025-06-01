<?php get_header(); ?>
<?php 

$badgeStyle = 'bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent ';
// get tags from database
$listTags = get_tags(array(
    'orderby' => 'id', // urutkan berdasarkan ID
    'order'   => 'DESC', // ID terbesar (terbaru) di atas
    'number'  => 10, // ambil 10 tag saja
));

$listCategories = get_categories(array(
    'orderby' => 'id', // urutkan berdasarkan ID
    'order'   => 'DESC', // ID terbesar (terbaru) di atas
    'number'  => 3, // ambil 10 tag saja
));

$listPost = have_posts(array(
  'orderby' => 'id',
  'order' => 'DESC',
  'number' => 2
));


function getCardBook() {
  echo '<div class="group cursor-pointer shadow-md hover:shadow-lg transition-shadow bg-white rounded-md">
              <!-- card content -->
              <div class="p-4">
                <!-- {/* Book Cover */} -->
                <div class="relative mb-4">
                  <div class="aspect-[3/4] bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                    <div class="w-16 h-20 bg-white rounded shadow-sm"></div>
                  </div>
                  <!-- {book.badge && ( -->
                    <div class="<?php getBadge() ?> absolute top-2 left-2 text-white text-xs px-2 py-1 bg-green-500">
                      <p>BAGONG</p>
                    </div>
                  <!-- )} -->
                  <!-- <div class="absolute top-2 right-2 bg-white/80 hover:bg-white">
                    <Bookmark class="h-4 w-4" />
                  </div> -->
                </div>

                <!-- {/* Book Info */} -->
                <div class="space-y-2">
                  <h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                    {book.title}
                  </h3>
                  <p class="text-sm text-gray-600">{book.author}</p>

                  <!-- {/* Rating */} -->
                  <div class="flex items-center space-x-1">
                    bintang
                    <span class="text-sm text-gray-600 ml-1">{book.rating}</span>
                  </div>

                  <!-- {/* Category */} -->
                  <div class=" inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-white text-xs">{book.category}</div>
                </div>
              </div>
            </div>';
}

function getCardNewBook() {
  echo '      <div class="bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-shadow p-4 relative">
        <div class="flex gap-4">
          <!-- Gambar -->
          <div class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center">
            <div class="w-10 h-14 bg-white rounded shadow-sm"></div>
          </div>

          <!-- Konten -->
          <div class="flex-1 space-y-1">
            <div class="flex justify-between items-start">
              <h3 class="font-semibold text-gray-900 text-sm line-clamp-2 hover:text-blue-600 transition-colors">
                {book.title}
              </h3>
              <span class="bg-yellow-100 text-xs text-gray-700 px-2 py-0.5 rounded">Baru</span>
            </div>
            <p class="text-xs text-gray-500">{book.author}</p>
            <div class="flex items-center text-yellow-400 text-sm">
              ★★★★☆ <span class="text-gray-600 ml-1">{book.rating}</span>
            </div>
            <p class="text-sm text-gray-600 line-clamp-2">{book.description}</p>
            <div class="flex items-center justify-between mt-2">
              <span class="bg-blue-100 text-blue-600 text-xs px-2 py-0.5 rounded">{book.category}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5H5z" />
              </svg>
            </div>
          </div>
        </div>
      </div>
';
}

// var_dump(get_posts(array(
//       'orderby' => 'id', // urutkan berdasarkan ID
//     'order'   => 'DESC', // ID terbesar (terbaru) di atas
//     'number'  => 1, // ambil 10 tag saja
// )));

?>



<!-- Hero Section -->
<section class="min-h-96 flex items-center justify-center bg-gradient-to-br from-blue-50 to-white px-4">
  <div class="max-w-3xl text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight text-gray-900">
      Temukan Dunia Literasi Digital
    </h1>
    <p class="text-gray-600 mb-8 text-lg md:text-xl">
      Akses ribuan eBook berkualitas dari berbagai genre dan penulis terkemuka
    </p>
      <div class="max-w-2xl mx-auto mb-8">
        <!-- search form -->
    <?php get_search_form(); ?>
  </div>
  <div class="flex flex-wrap justify-center gap-3 mb-8">
    <?php 
    $noTagsMessage = 'Tidak ada tags';
    // check is there tags
      if ($listTags) : ?> 
          <?php 
          foreach ($listTags as $tag) { 
              $tag_link = get_tag_link($tag->term_id);
              echo '<div class="' . esc_attr($badgeStyle) . '">' . '<a href="' . esc_url($tag_link) . '">#' . esc_html($tag->name) . '</a></div> ';
          }
          ?>
    <?php else : ?>
        <?php echo '<div class="' . esc_attr($badgeStyle) . '">' . $noTagsMessage . '</div> '; ?>
    <?php endif; 
    ?> 
  </div>
  </div>
</section>

<!-- BUKU PILIHAN -->
<section class="max-w-7xl mx-auto bg-white my-2">
<div class="max-w-6xl mx-10">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-gray-900">Buku Pilihan</h2>
      <a href="#" class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
        Lihat Semua
       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="h-4 w-4 ml-1"  >
          <path fill="none" stroke="currentColor" stroke-dasharray="12" stroke-dashoffset="12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12l-7 -7M16 12l-7 7">
            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="12;0"/>
          </path>
        </svg>
      </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
      <!-- card -->
            <?php getCardBook() ?>
            <?php getCardBook() ?>
            <?php getCardBook() ?>
            <?php getCardBook() ?>
            <?php getCardBook() ?>
      </div>
</div>
</section>

<!-- CATEGORY -->
<section class=" mx-auto bg-gray-100 px-4 py-10  my-20">
  <div class="max-w-6xl mx-auto">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Kategori Populer</h2>
        <a href="#" class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
          Lihat Semua
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="h-4 w-4 ml-1"  >
            <path fill="none" stroke="currentColor" stroke-dasharray="12" stroke-dashoffset="12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12l-7 -7M16 12l-7 7">
              <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="12;0"/>
            </path>
          </svg>
        </a>
      </div>
      <!-- Check categori -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- card BOOK -->
        <?php
        if($listCategories) : ?>
            <?php
            foreach ($listCategories as $categories) {

              $categorieName = $categories->name;
              $categorieCount = $categories->category_count;
              $iconComponent = '<div class="justify-center flex mb-2">
                      <div class="justify-center items-center flex p-1 bg-blue-300 text-blue-700 rounded-full w-8 h-8 " >
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" class="h-5 w-5">
                            <path fill="currentColor" d="M7 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18H7zm2 22a2 2 0 0 1-2-2h18.25A1.75 1.75 0 0 0 27 24.25V6a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v20a4 4 0 0 0 4 4h17a1 1 0 1 0 0-2zm1.75-22A1.75 1.75 0 0 0 9 7.75v2.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0 0 23 10.25v-2.5A1.75 1.75 0 0 0 21.25 6zm.25 4V8h10v2z"/>
                          </svg>
                      </div>
                    </div>';
              $nameComponent = '<span class="text-md text-black font-bold">' . $categorieName . '</span>';
              $totalBookComponent = '<p class="text-sm text-gray-600">' . $categorieCount . ' buku</p>';

              echo '<div class="group cursor-pointer shadow-md hover:shadow-lg transition-shadow bg-white rounded-xl">
                      <div class="p-4 justify-center flex text-center items-center">
                          <div class="relative ">
                              <div class="space-y-1">' . $iconComponent . $nameComponent . $totalBookComponent . '</div>
                          </div>
                      </div>
                  </div>';
            }
            ?>
                <?php else : ?>
            <?php echo 'tidak ada kategori'; ?>
        <?php endif; ?>
        <!-- </div> -->
  </div>
</section>
<section>
  <?php if ( have_posts() ) {
while ( have_posts(array(
        'orderby' => 'id', // urutkan berdasarkan ID
    'order'   => 'DESC', // ID terbesar (terbaru) di atas
    'number'  => 2, // ambil 10 tag saja
)) ) {

the_post(); ?>

<h2><?php the_title(); ?></h2> <br />

<?php the_content(); ?>

<?php }
} ?>
</section>

<!-- BUKU TERBARU -->
<section class="max-w-7xl mx-auto bg-white my-10 px-4">
  <div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-gray-900">Buku Terbaru</h2>
      <a href="#" class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
        Lihat Semua
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Kartu Buku -->
      <?php getCardNewBook() ?>
      <?php getCardNewBook() ?>
      <?php getCardNewBook() ?>

    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-6 accent-primary bg-blue-500 text-white text-center">
  <div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-4">Dapatkan Update Terbaru</h2>
    <p class="mb-6 text-lg">Berlangganan newsletter kami untuk mendapatkan informasi tentang buku-buku terbaru dan promo spesial</p>
    <div class="flex flex-wrap justify-center gap-3">
        <input
          type="text"
          placeholder="Masukan alamat email"
          class="min-w-fit pl-4 pr-10 py-3 text-lg rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-md"
        />
      <button class=" bg-white text-blue-500 font-semibold px-8 py-4 rounded-md hover:bg-gray-100 transition" >
        berlangganan
      </button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
