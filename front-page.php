<?php get_header(); ?>
<?php 

function getBadge() {
    echo 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent';
}


function getCardBook() {
  echo '<div class="group cursor-pointer hover:shadow-lg transition-shadow bg-white rounded-md">
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

function getCardCategory() {
  echo '';
}

function getIconBook() {
  echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" class="h-5 w-5">
          <path fill="currentColor" d="M7 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18H7zm2 22a2 2 0 0 1-2-2h18.25A1.75 1.75 0 0 0 27 24.25V6a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v20a4 4 0 0 0 4 4h17a1 1 0 1 0 0-2zm1.75-22A1.75 1.75 0 0 0 9 7.75v2.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0 0 23 10.25v-2.5A1.75 1.75 0 0 0 21.25 6zm.25 4V8h10v2z"/>
        </svg>';
}

function getCardCategoryBook() {
  echo '       <div class="group cursor-pointer shadow-md hover:shadow-lg transition-shadow bg-white rounded-xl">
          <!-- card content -->
           <div class="p-4 justify-center flex text-center items-center">
              <div class="relative mb-4 ">
                <!-- info -->
                  <div class="space-y-1">
                    <!-- icon -->
                    <div class="justify-center flex mb-2">
                      <div class="justify-center items-center flex p-1 bg-blue-300 text-blue-700 rounded-full w-8 h-8 " >
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" class="h-5 w-5">
                            <path fill="currentColor" d="M7 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18H7zm2 22a2 2 0 0 1-2-2h18.25A1.75 1.75 0 0 0 27 24.25V6a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v20a4 4 0 0 0 4 4h17a1 1 0 1 0 0-2zm1.75-22A1.75 1.75 0 0 0 9 7.75v2.5c0 .966.784 1.75 1.75 1.75h10.5A1.75 1.75 0 0 0 23 10.25v-2.5A1.75 1.75 0 0 0 21.25 6zm.25 4V8h10v2z"/>
                          </svg>
                      </div>
                    </div>
                    <!-- name book -->
                    <span class="text-md text-black font-bold">
                      bintang
                    </span>
                    <!-- total book -->
                    <p class="text-sm text-gray-600">1230 buku</p>

                  </div>
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
    <div class="relative">
      <Input
        type="text"
        placeholder="Cari judul buku, penulis, atau genre..."
        class="w-full pl-4 pr-12 py-3 text-lg rounded-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-md"
      />
      <Button
        size="icon"
        class="absolute right-2 top-1/2 transform -translate-y-1/2 rounded-full"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 hover:text-blue-600"  width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" fill-rule="evenodd" d="M10.44 2.75a7.69 7.69 0 1 0 4.615 13.842c.058.17.154.329.29.464l3.84 3.84a1.21 1.21 0 0 0 1.71-1.712l-3.84-3.84a1.2 1.2 0 0 0-.463-.289A7.69 7.69 0 0 0 10.44 2.75m-5.75 7.69a5.75 5.75 0 1 1 11.5 0a5.75 5.75 0 0 1-11.5 0" clip-rule="evenodd"/>
        </svg>
      </Button>
    </div>
  </div>
  <div class="flex flex-wrap justify-center gap-3 mb-8">
  <div class= "<?php getBadge() ?> bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer">
      #Fiksi
  </div>
  <div class= "<?php getBadge() ?> bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer">
      #NonFiksi
  </div>
  <div class= "<?php getBadge() ?> bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer">
      #Pendidikan
  </div>
  <div class="<?php getBadge() ?> bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer">
      #Tenologi
  </div>
  <div class="<?php getBadge() ?> bg-blue-50 text-primary-foreground hover:bg-blue-100 hover:cursor-pointer">
      #Sastra
  </div>
  </div>

    <!-- <a href="https://wa.me/08xxxxxxx" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-4 rounded-full transition duration-300">
      Download Sekarang
    </a> -->
  </div>
</section>

<!-- BUKU PILIHAN -->
<section class="max-w-7xl mx-auto bg-white">
<div class="max-w-6xl mx-auto">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
      <!-- card BOOK -->
       <?php getCardCategoryBook() ?>
       <?php getCardCategoryBook() ?>
       <?php getCardCategoryBook() ?>
       <?php getCardCategoryBook() ?>
       <?php getCardCategoryBook() ?>
      </div>
</div>
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

      <!-- Duplikasikan kartu ini untuk buku lainnya -->
    </div>
  </div>
</section>


<!-- Benefit Section -->
<!-- <section class="py-16 px-6 bg-white">
  <div class="max-w-5xl mx-auto text-center">
    <h2 class="text-3xl font-bold mb-12 text-gray-800">Apa yang Akan Kamu Pelajari?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
      <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h3 class="text-xl font-semibold mb-2">Strategi Bisnis</h3>
        <p class="text-gray-600">Langkah-langkah membangun bisnis dari nol hingga menghasilkan.</p>
      </div>
      <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h3 class="text-xl font-semibold mb-2">Pemasaran Online</h3>
        <p class="text-gray-600">Teknik digital marketing yang bisa langsung diterapkan.</p>
      </div>
      <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h3 class="text-xl font-semibold mb-2">Studi Kasus</h3>
        <p class="text-gray-600">Kisah nyata pebisnis sukses yang bisa kamu tiru dan pelajari.</p>
      </div>
    </div>
  </div>
</section> -->

<!-- CTA Section -->
<section class="py-16 px-6 accent-primary bg-blue-500 text-white text-center">
  <div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-4">Dapatkan Update Terbaru</h2>
    <p class="mb-6 text-lg">Berlangganan newsletter kami untuk mendapatkan informasi tentang buku-buku terbaru dan promo spesial</p>
    <div class="flex flex-wrap justify-center gap-3">
      <!-- <div >
        </div> -->
        <Input
          type="text"
          placeholder="Masukan alamat email"
          class="min-w-fit pl-4 pr-10 py-3 text-lg rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-md"
        />
      <button class=" bg-white text-blue-500 font-semibold px-8 py-4 rounded-md hover:bg-gray-100 transition" >
        berlangganan
      </button>
      <!-- <a href="https://wa.me/08xxxxxxx" class=" bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-gray-100 transition">
        Berlangganan
      </a> -->
    </div>
  </div>
</section>

<?php get_footer(); ?>
