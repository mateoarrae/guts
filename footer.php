<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>

  <!-- Footer -->

  <footer class="l-site-footer row" role="contentinfo">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <?php get_sidebar( 'Footer' ); ?>
          <hr />
          <?php //do_action( 'guts_credits' ); ?>
          <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'guts' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'guts' ); ?>"><?php printf( __( 'Proudly powered by %s', 'guts' ), 'WordPress' ); ?></a>
        </div>
        <div class="large-6 columns" role="navigation">
        	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- End Footer -->

	<?php wp_footer(); ?>
	<script>
		$(document).foundation();
  	</script>
	
</body>
</html>