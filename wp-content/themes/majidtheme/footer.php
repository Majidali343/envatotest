<footer class="site-footer">
<div class="container">
<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
<?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'menu_class' => 'menu']); ?>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>