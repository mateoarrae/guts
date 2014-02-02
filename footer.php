<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>


<hr />

  <footer class="l-site-footer" role="contentinfo">

      <div class="row">
        <div class="large-8 columns">
          <?php get_sidebar( 'Footer' ); ?>
        </div>
        <div class="large-3 offset-1 columns" role="navigation">
        	<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="large-12 columns">
        	<?php //do_action( 'guts_credits' ); ?>
        	<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'guts' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'guts' ); ?>"><?php printf( __( 'Proudly powered by %s', 'guts' ), 'WordPress' ); ?></a>
        </div>
      </div>

  </footer>

<?php wp_footer(); ?>
	
</body>
</html>