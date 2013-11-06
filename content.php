<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php if ( is_single() ) : ?>
		<h3 class="entry-title"><?php the_title(); ?></h3>
		<?php else : ?>
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
		<?php endif; // is_single() ?>
		
        <div class="entry-meta">
        	<?php //guts_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'guts' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
 
 
	 <?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary row">
	      <div class="<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>large-6<?php else: ?>large-12<?php endif; ?> columns">
		        <?php the_excerpt(); ?>
	      </div>
		  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		  	<div class="entry-thumbnail large-6 columns">
			  	<?php the_post_thumbnail(); ?>
			</div>
		  <?php endif; ?>
	      </div>
	    </div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'guts' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'guts' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	
	
	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'guts' ) . '</span>', __( 'One comment so far', 'guts' ), __( 'View all % comments', 'guts' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
