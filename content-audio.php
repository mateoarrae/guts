<?php
/**
 * The template for displaying posts using the Audio post format
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?>

<?php if ( !is_single() ) : // Not displayed on post pages using single.php ?>
 <header class="entry-header">
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="dashicons dashicons-format-audio"></i> <?php the_title(); ?></a>
	</h2>
	
    <dl class="sub-nav entry-meta">
    	<dd class="post-format"><a class="entry-format" href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>"><?php echo get_post_format_string( get_post_format() ); ?></a></dd>
    	<?php guts_entry_meta(); ?>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<dd class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'guts' ), __( '1 Comment', 'guts' ), __( '% Comments', 'guts' ) ); ?></dd>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
	</dl>
 </header>
<?php endif; ?> 

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
	
 <footer class="entry-meta">
    <dl class="sub-nav entry-meta">
    <?php if ( is_single() ) : ?>
		<?php the_tags( '<dt><i class="fi-pricetag-multiple"></i> Tagged as: </dt><dd class="tag-links">', '', '</dd>' ); ?>
		<?php edit_post_link( __( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
	<?php endif; ?>
	</dl>
 </footer>