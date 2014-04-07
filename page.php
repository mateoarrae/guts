<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>

<div id="content" class="l-site-content" role="main">

<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="row">
			<div class="small-12 columns">
				
				<header class="entry-header">
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php endif; ?>

					<h1 class="entry-title"><?php the_title(); ?></h1>
					<hr />
				</header><!-- .entry-header -->
	
			</div>
		</div>
		<div class="row">
			<div class="large-8 columns">
	
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'guts' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry-content -->
	
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'guts' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->	
				
				<?php comments_template(); ?>
						
			</div>
			<div class="large-3 offset-1 columns" role="complementary">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</article>
	
<?php endwhile; ?>
</div>


<?php get_footer(); ?>