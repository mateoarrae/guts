<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>
<div class="row">
	<div class="small-12 columns">
	
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Nothing Found', 'guts' ); ?></h1>
			<hr />
		</header>
		
		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'guts' ), admin_url( 'post-new.php' ) ); ?></p>
		
			<?php elseif ( is_search() ) : ?>
		
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'guts' ); ?></p>
			<?php get_search_form(); ?>
		
			<?php else : ?>
		
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'guts' ); ?></p>
			<?php get_search_form(); ?>
		
			<?php endif; ?>
		</div><!-- .page-content -->

	</div>
</div>