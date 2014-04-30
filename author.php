<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>


<div id="content" class="l-site-content" role="main">

	<?php if ( have_posts() ) : ?>

	<div class="row">
		<div class="small-12 columns">
		
			<header class="archive-header">
				<h1 class="archive-title">
					<?php
						/*
						 * Queue the first post, that way we know what author
						 * we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop properly
						 * with a call to rewind_posts().
						 */
						the_post();

						printf( __( 'All posts by %s', 'guts' ), get_the_author() );
					?>
				</h1>
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
				<?php endif; ?>
				<hr />
			</header><!-- .archive-header -->
		</div>
	</div>

	<div class="row">
		<div class="large-8 columns">
			
				<?php
				/*
				 * Since we called the_post() above, we need to rewind
				 * the loop back to the beginning that way we can run
				 * the loop properly, in full.
				 */
				rewind_posts(); ?>
	
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
				  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'content', get_post_format() ); ?>
				  </article>
				<?php endwhile; ?>
	
				<?php guts_paging_nav(); ?>
	
		</div>
		<div class="large-3 offset-1 columns" role="complementary">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>