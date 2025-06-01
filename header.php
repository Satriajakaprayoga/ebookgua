<?php
/**
 * The template for displaying the header.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<header class="bg-white shadow top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <!-- KIRI: Logo -->
      <div class="flex-shrink-0">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-bold text-blue-700">
          ebookgua
        </a>
      </div>

      <!-- TENGAH: Navbar (desktop) -->
      <nav class="hidden md:flex flex-1 justify-center items-center space-x-6 relative group">
        <!-- <a href="#benefits" class="text-gray-700 hover:text-blue-600 font-medium">Manfaat</a>
        <a href="#download" class="text-gray-700 hover:text-blue-600 font-medium">Download</a> -->
        <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'flex items-center space-x-6',
          'fallback_cb' => false,
          'walker' => new class extends Walker_Nav_Menu {
            function start_lvl(&$output, $depth = 0, $args = null) {
              $output .= '<ul class="absolute mt-2 bg-white shadow-lg rounded-lg py-2 w-40 hidden group-hover:block z-50">';
            }
            function end_lvl(&$output, $depth = 0, $args = null) {
              $output .= '</ul>';
            }
            function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
              $classes = 'text-gray-700 hover:text-blue-600 font-medium transition-colors';
              if ($depth > 0) {
                $classes = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100';
              }
              $output .= sprintf(
                '<li><a href="%s" class="%s">%s</a>',
                esc_url($item->url),
                $classes,
                esc_html($item->title)
              );
            }
            function end_el(&$output, $item, $depth = 0, $args = null) {
              $output .= '</li>';
            }
          }
        ]);
        ?>
      </nav>

      <!-- KANAN: Account -->
    <div class="relative flex items-center space-x-4">
        <?php if (is_user_logged_in()): 
          $current_user = wp_get_current_user(); ?>
            <!-- Theme Toggle Button -->
            <button id="theme-toggle" class="w-8 h-8 flex items-center justify-center rounded-full transition">
            <!-- Icon: Sun (Yellow) -->
            <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-2 text-yellow-400 hover:text-blue-600 block transition-colors" viewBox="0 0 20 20" fill="currentColor">
                <path fill="currentColor" d="M12 18a6 6 0 1 1 0-12a6 6 0 0 1 0 12m0-2a4 4 0 1 0 0-8a4 4 0 0 0 0 8M11 1h2v3h-2zm0 19h2v3h-2zM3.515 4.929l1.414-1.414L7.05 5.636L5.636 7.05zM16.95 18.364l1.414-1.414l2.121 2.121l-1.414 1.414zm2.121-14.85l1.414 1.415l-2.121 2.121l-1.414-1.414zM5.636 16.95l1.414 1.414l-2.121 2.121l-1.414-1.414zM23 11v2h-3v-2zM4 11v2H1v-2z"/>
            </svg>

            <!-- Icon: Moon (Black) -->
            <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 m-2 text-black hover:text-blue-600 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                <path fill="currentColor" d="M12 1.992a10 10 0 1 0 9.236 13.838c.341-.82-.476-1.644-1.298-1.31a6.5 6.5 0 0 1-6.864-10.787l.077-.08c.551-.63.113-1.653-.758-1.653h-.266l-.068-.006z"/>
            </svg>
            </button>
          <button id="user-avatar" class="focus:outline-none relative">
            <?php echo get_avatar($current_user->ID, 32, '', '', ['class' => 'rounded-full w-8 h-8']); ?>
          </button>
          <!-- Dropdown -->
          <div id="user-dropdown" class="hidden absolute right-0 top-12 mt-2 w-48 bg-white shadow-lg rounded-lg py-2 z-50">
            <div class="px-4 py-2 text-sm text-gray-700">
              👤 <?php echo esc_html($current_user->display_name); ?>
            </div>
            <a href="<?php echo esc_url(get_edit_user_link()); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
          </div>
        <?php else: ?>
          <a href="<?php echo esc_url(wp_login_url()); ?>" class="text-blue-600 hover:underline text-sm">Login</a>
        <?php endif; ?>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2">
    <!-- <a href="#benefits" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Manfaat</a>
    <a href="#download" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Download</a> -->
    <?php
    wp_nav_menu([
      'theme_location' => 'primary',
      'container' => false,
      'menu_class' => '',
      'fallback_cb' => false,
      'walker' => new class extends Walker_Nav_Menu {
        function start_lvl(&$output, $depth = 0, $args = null) {
          $output .= '<ul class="pl-4">';
        }
        function end_lvl(&$output, $depth = 0, $args = null) {
          $output .= '</ul>';
        }
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
          $classes = 'block py-2 text-gray-700 hover:text-blue-600';
          if ($depth > 0) {
            $classes = 'block py-1 pl-4 text-sm text-gray-600 hover:text-blue-500';
          }
          $output .= sprintf(
            '<li><a href="%s" class="%s">%s</a>',
            esc_url($item->url),
            $classes,
            esc_html($item->title)
          );
        }
        function end_el(&$output, $item, $depth = 0, $args = null) {
          $output .= '</li>';
        }
      }
    ]);
    ?>
  </div>
</header>


<script>
  // Mobile menu toggle
  document.getElementById('mobile-menu-toggle')?.addEventListener('click', () => {
    document.getElementById('mobile-menu')?.classList.toggle('hidden');
  });

  // Avatar dropdown toggle
  const avatarBtn = document.getElementById('user-avatar');
  const dropdown = document.getElementById('user-dropdown');

  if (avatarBtn && dropdown) {
    avatarBtn.addEventListener('click', () => {
      dropdown.classList.toggle('hidden');
    });

    // Optional: click outside to close
    document.addEventListener('click', (e) => {
      if (!avatarBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });
  }

    // Theme toggle icon
  const toggleBtn = document.getElementById('theme-toggle');
  const sunIcon = document.getElementById('icon-sun');
  const moonIcon = document.getElementById('icon-moon');

  toggleBtn?.addEventListener('click', () => {
    sunIcon.classList.toggle('hidden');
    moonIcon.classList.toggle('hidden');
  });
</script>
