<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </div>
  <div class="container">
  <?php
if ( current_user_can( 'administrator' ) ) {
global $wpdb;
echo "<pre>";
print_r( $wpdb->queries );
echo "</pre>";
}
?>
  </div>
</footer>

<?php wp_footer(); ?>
