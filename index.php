<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>



<div class="row">
	<div class="large-8 columns">
	    <div id="content" class="l-site-content" role="main">
		
			<?php if ( have_posts() ) : ?>
	
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', get_post_format() ); ?>
					<?php get_template_part( 'content' ); ?>
				<?php endwhile; ?>
	
				<?php guts_paging_nav(); ?>
	
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
	
	    </div><!-- #content -->
	</div>
	<div class="large-3 offset-1 columns">
	    <?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>