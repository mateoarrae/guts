<?php
/**
 * The template for displaying all single posts
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
				<h1 class="entry-title"><?php the_title(); ?></h1>
								
			    <dl class="sub-nav entry-meta">
			        <?php guts_post_format_link(); ?>
			    	<?php guts_entry_meta(); ?>
					<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<dd class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'guts' ), __( '1 Comment', 'guts' ), __( '% Comments', 'guts' ) ); ?></dd>
					<?php endif; ?>
					<?php edit_post_link( __( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
				</dl>
				<hr />
			 </header>
			 
    	</div>
    </div>
    
  
	<div class="row">
		<div class="large-8 columns">
			  <?php guts_yoast_breadcrumbs(); ?>
	
					<?php get_template_part( 'content', get_post_format() ); ?>
					
					<?php guts_post_nav(); ?>
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