<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, tag.php for Tag archives, 
 * category.php for Category archives and author.php for Author archives.
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
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'guts' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'guts' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'guts' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'guts' ), get_the_date( _x( 'Y', 'yearly archives date format', 'guts' ) ) );
					else :
						_e( 'Archives', 'guts' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part( 'content', get_post_format() ); ?>
			  </article>
			<?php endwhile; ?>

			<?php guts_post_nav(); ?>

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