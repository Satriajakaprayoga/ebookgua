# Tata Cara Install Theme ebookgua
untuk installasi theme ebookgua ada 2 cara yaitu dengan download format zip atau langsung clone repo pada wordpress

## install di wordpres
1. donwload repo dengan cara klik tombol code diatas -> Download ZIP 
2. masuk ke admin panel wordpress
3. setelah itu upload ZIPnya langsung -> pilih Appearence -> themes -> Add Theme -> Upload Theme -> chose file or drag file ZIP
4. klik install dan done

## install dengan cara terminal
1. masuk ke server wordpress menggunakan ssh
2. masuk masuk ke directory wordpress -> wp-content-> themes
3. clone repositori 
~~~
git clone https://github.com/Satriajakaprayoga/ebookgua.git
~~~
4. done


# 📘 Dokumentasi Instalasi dan Pembuatan Custom Theme WordPress dengan Tailwind CSS

Dokumentasi ini ditulis untuk membantu siapapun dalam membuat tema WordPress kustom menggunakan Tailwind CSS tanpa plugin tambahan, dengan konfigurasi modern dan optimal untuk performa.

## 📦 Prasyarat

Sebelum memulai, pastikan:

* ✅ Node.js dan npm sudah terinstal
* ✅ WordPress sudah aktif di lokal (misalnya via XAMPP atau Laragon)
* ✅ Kamu sudah memiliki folder theme aktif di `/wp-content/themes/nama-theme-kamu`

---

## ⚙️ Langkah 1: Setup Awal Project

### 1.1 Inisialisasi npm

```bash
cd wp-content/themes/nama-theme-kamu
npm init -y
```

### 1.2 Install Tailwind CSS dan plugin tambahan

```bash
npm install -D tailwindcss postcss autoprefixer @tailwindcss/forms @tailwindcss/typography
npx tailwindcss init
```

### 1.3 Buat struktur folder CSS

```bash
mkdir -p assets/css
```

### 1.4 Buat file input `main.css`

**`assets/css/main.css`**

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### 1.5 Buat file output `output.css`

> Akan dibuat otomatis oleh Tailwind saat build

### 1.6 Konfigurasi `tailwind.config.js`

```js
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js'
  ],
  theme: {
    container: {
      center: true,
      padding: '1rem'
    },
    extend: {
      colors: {
        primary: '#1d4ed8',
        secondary: '#9333ea',
        gray: '#6b7280'
      },
      fontSize: {
        sm: ['14px', '1.5'],
        base: ['16px', '1.75'],
        lg: ['20px', '1.75'],
        xl: ['24px', '1.75']
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans]
      }
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')
  ]
}
```

### 1.7 Konfigurasi `postcss.config.js`

```js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {}
  }
}
```

### 1.8 Tambahkan Script Build di `package.json`

```json
"scripts": {
  "build": "npx tailwindcss -i ./assets/css/main.css -o ./assets/css/output.css --minify",
  "watch": "npx tailwindcss -i ./assets/css/main.css -o ./assets/css/output.css --watch"
}
```

### 1.9 Build pertama

```bash
npm run build
```

---

## 🧩 Langkah 2: Hubungkan Tailwind ke Theme

### 2.1 Enqueue CSS di `functions.php`

```php
function mytheme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/output.css', [], '1.0');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');
```

---

## 🧱 Langkah 3: Konfigurasi Gutenberg dengan `theme.json`

Buat file `theme.json` di root theme:

```json
{
  "version": 2,
  "settings": {
    "color": {
      "custom": false,
      "palette": [
        { "name": "Primary", "slug": "primary", "color": "#1d4ed8" },
        { "name": "Secondary", "slug": "secondary", "color": "#9333ea" },
        { "name": "Gray", "slug": "gray", "color": "#6b7280" }
      ]
    },
    "typography": {
      "customFontSize": false,
      "fontSizes": [
        { "slug": "sm", "size": "14px", "name": "Small" },
        { "slug": "base", "size": "16px", "name": "Base" },
        { "slug": "lg", "size": "20px", "name": "Large" },
        { "slug": "xl", "size": "24px", "name": "Extra Large" }
      ]
    },
    "layout": {
      "contentSize": "768px",
      "wideSize": "1024px"
    },
    "spacing": {
      "units": ["px", "em", "rem", "%"]
    }
  }
}
```

Hasil: Gutenberg hanya akan menampilkan opsi styling yang kamu definisikan.

---

## 🛠️ Langkah 4: Fungsi WordPress Umum yang Sering Dibutuhkan

Tambahkan di `functions.php`:

```php
// Aktifkan featured image
add_theme_support('post-thumbnails');

// Daftarkan menu
add_action('after_setup_theme', function() {
    register_nav_menus([
        'primary' => 'Primary Menu'
    ]);
});

// Tambahkan title tag
add_theme_support('title-tag');

// Aktifkan HTML5 markup
add_theme_support('html5', [
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
]);
```

---

## 💡 Tips Tambahan

### 🎨 Styling Konten Post dengan Typography Plugin

Tambahkan di `main.css`:

```css
.prose {
  @apply prose lg:prose-xl max-w-none;
}
```

Dan di template post:

```php
<div class="prose">
  <?php the_content(); ?>
</div>
```

### 🚀 Optimasi Performa

* Jalankan `npm run build` sebelum deployment
* Gunakan plugin caching untuk minify dan compress HTML
* Gunakan `loading="lazy"` untuk gambar
* Aktifkan gzip compression di server

### 🔎 SEO Tips

* Gunakan semantic HTML (`<article>`, `<header>`, `<nav>`, dll)
* Gunakan plugin SEO jika diperlukan (misal: Yoast SEO, Rank Math)
* Gunakan struktur heading yang rapi di dalam konten post

---

## ✅ Penutup

Dengan pendekatan ini, kamu punya:

* Custom theme yang ringan dan fleksibel
* Tanpa plugin tambahan
* Konsisten antara editor Gutenberg dan frontend
* Siap pakai untuk produksi dan dikembangkan lebih lanjut

Selamat membangun theme profesionalmu dengan Tailwind CSS dan WordPress! 🎉
