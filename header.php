<?php
/**
 * The Defaults Header for Guts uses Foundations Blog Template
 * http://foundation.zurb.com/page-templates4/blog.html
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?><!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- Nav Bar -->

  <div id="page" class="row">
    <div class="large-12 columns">
      <div class="l-primary-nav nav-bar right" role="navigation">
       <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'guts' ); ?>"><?php _e( 'Skip to content', 'guts' ); ?></a>
       <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
      </div>
      
      	<h1 class="site-title">
	      	<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	      		<?php bloginfo( 'name' ); ?>
	      	</a>
	      	<small><?php bloginfo( 'description' ); ?></small>
      	</h1>
      
      <hr />
    </div>
  </div>

  <!-- End Nav -->