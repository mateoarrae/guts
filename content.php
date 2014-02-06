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
 <header class="entry-header">
    <?php if ( is_single() ) : ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php else : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	<?php endif; // is_single() ?>
	
    <dl class="sub-nav entry-meta">
    	<?php guts_entry_meta(); ?>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<dd class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'guts' ), __( '1 Comment', 'guts' ), __( '% Comments', 'guts' ) ); ?></dd>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
	</dl>
 </header>
 
	 <?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
		  <?php the_excerpt(); ?>
		  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		  	<div class="entry-thumbnail">
			  	<?php the_post_thumbnail(); ?>
			</div>
		  <?php endif; ?>
	    </div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'guts' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'guts' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
