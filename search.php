<?php
/**
 * The template for displaying Search Results pages
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

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'guts' ), get_search_query() ); ?></h1>
			</header>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part( 'content', get_post_format() ); ?>
			  </article>
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