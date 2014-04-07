<?php
/**
 * The Default Header for Guts
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php guts_browse_happy(); ?>
<div class="l-header-container">
  <header id="site-header">
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1 class="site-title"><a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        </li>          
        <li class="toggle-topbar menu-icon"><a href="#"><span><?php _e( 'Menu' , 'guts' ); ?></span></a></li>
      </ul>
      <section class="top-bar-section">
        <?php wp_nav_menu(array('container' => false, 'menu_class' => 'left', 'theme_location' => 'primary-left', 'fallback_cb' => false, 'walker' => new guts_top_bar_walker() )); ?>

        <?php wp_nav_menu(array('container' => false, 'menu_class' => 'right', 'theme_location' => 'primary', 'walker' => new guts_top_bar_walker() )); ?>
      </section>
    </nav>
    <?php if ( is_front_page() ) : ?>
    <div class="row">
	  <div class="large-8 columns">   
	    <h1 class="site-title"><a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> <small><?php bloginfo( 'description' ); ?></small></h1>
	  </div>
	  <div class="large-3 offset-1 columns">
	    <?php get_search_form(); ?>
	  </div>
    </div>
    <hr />
    <?php endif; ?>
  </header>
</div>
