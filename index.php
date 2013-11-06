<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

get_header(); ?>


<!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div id="content" class="l-site-content large-9 columns" role="main">
	
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php //get_template_part( 'content/content', get_post_format() ); ?>
				<?php get_template_part( 'content' ); ?>
			<?php endwhile; ?>

			<?php guts_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

    </div>
    <!-- End Main Content -->


    <?php get_sidebar(); ?>
  </div>

  <!-- End Main Content and Sidebar -->
  

<?php get_footer(); ?>