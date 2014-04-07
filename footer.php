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
          <?php get_sidebar( 'footer' ); ?>
        </div>
        <div class="large-3 offset-1 columns" role="navigation">
        	<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => false, 'menu_class' => 'side-nav' ) ); ?>
        </div>
      </div>
      <hr />
      <div class="row">
        <!-- Feel free to remove these lines for your project !-->
        <div class="large-8 columns">
        	<p><?php _e( 'Proudly powered by', 'guts' ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'guts' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'guts' ); ?>">WordPress</a></p>
        </div>
        <div class="large-3 offset-1 column">
        	<p><?php _e( 'Created by', 'guts' ); ?> <a href="<?php echo esc_url( __( 'http://www.rosemckeon.co.uk', 'guts' ) ); ?>" title="<?php esc_attr_e( 'Freelance Web Designer &amp; Developer', 'guts' ); ?>">Rose Mckeon</a></p>
        </div>
      </div>

  </footer>

<?php wp_footer(); ?>
	
</body>
</html>