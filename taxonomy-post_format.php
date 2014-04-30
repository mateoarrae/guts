<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @todo http://core.trac.wordpress.org/ticket/23257: Add plural versions of Post Format strings
 * and remove plurals below.
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
						if ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'guts' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audio', 'guts' );
							
						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chat', 'guts' );
							
						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'guts' );
							
						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'guts' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'guts' );
							
						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'guts' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Status Updates', 'guts' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'guts' );

						else :
							_e( 'Archives', 'guts' );

						endif;
					?>
				</h1>
				<hr />
			</header><!-- .archive-header -->
		</div>
	</div>

	<div class="row">
		<div class="large-8 columns">
	
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