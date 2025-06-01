<footer class="p-4 bg-gray-200 text-center">
<p>&copy; <?php echo date('Y'); ?> ebookgua</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
<script>
  document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });
</script>