<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>


<div class="row">
	<div class="large-8 columns">
		<div id="content" class="l-site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php guts_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div>
	<div class="large-3 offset-1 columns">
	    <?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>