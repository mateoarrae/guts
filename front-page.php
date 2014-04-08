<?php
/**
 * The template for displaying a static front page.
 *
 * This template is only used when you select a static page as your home page in settings > reading.
 * If this template is removed, page.php will be used instead.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>

<div class="row">
	<div class="large-8 large-offset-2 columns">
		<div id="content" class="l-site-content" role="main">
	
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
	
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<div class="entry-thumbnail">
								<?php the_post_thumbnail(); ?>
							</div>
							<?php endif; ?>
	
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->
	
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'guts' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div><!-- .entry-content -->
	
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'guts' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</article><!-- #post -->
	
					<?php comments_template(); ?>
				<?php endwhile; ?>
	
		</div><!-- #content -->
	</div>
</div>
<?php get_footer(); ?>