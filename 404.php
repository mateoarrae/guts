<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>

<div class="row">
	<div class="large-8 columns">
		<div id="content" class="l-site-content" role="main">
	
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'guts' ); ?></h1>
			</header>
	
			<div class="page-content">
				<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'guts' ); ?></h2>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'guts' ); ?></p>
			</div><!-- .page-content -->
	
		</div><!-- #content -->
	</div>
	<div class="large-3 offset-1 columns">
		<?php get_search_form(); ?>
	</div>
</div>
<?php get_footer(); ?>