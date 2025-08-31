<footer class="p-4 bg-blue-500 text-center text-white">
  <div>
    <?php echo wp_kses_post(get_theme_mod('footer_text')); ?>
  </div>
</footer>
<?php wp_footer(); ?>
<div class="ebookgua-social-fixed">
    <?php

      $socials = [
          'facebook' => [
              'icon' => 'fab fa-facebook-f',
              'color' => '#1877F2',
          ],
          'twitter' => [
              'icon' => 'fab fa-twitter',
              'color' => '#1DA1F2',
          ],
          'instagram' => [
              'icon' => 'fab fa-instagram',
              'color' => '#E4405F',
          ],
          'linkedin' => [
              'icon' => 'fab fa-linkedin-in',
              'color' => '#0A66C2',
          ],
          'youtube' => [
              'icon' => 'fab fa-youtube',
              'color' => '#FF0000',
          ],
      ];

    foreach ($socials as $key => $data) {
        $url = get_theme_mod("ebookgua_social_{$key}");
        $color = get_theme_mod("ebookgua_social_{$key}_color", $data['color']);

        if ($url) {
            echo '<a href="'.esc_url($url).'" target="_blank" rel="noopener" 
                style="color:'.esc_attr($color).'; margin-right:10px; font-size:20px;">';
            echo '<i class="'.esc_attr($data['icon']).'"></i>';
            echo '</a>';
        }
    }
    ?>
</div>
</body>
</html>
<script>
  document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });
</script>
