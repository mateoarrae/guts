<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>


<div id="content" class="l-site-content" role="main">

	<div class="row">
		<div class="small-12 columns">
		
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Not Found', 'guts' ); ?></h1>
					<hr />
				</header>
				
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'guts' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'guts' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
		</div>
	</div>

</div>
<?php get_footer(); ?>