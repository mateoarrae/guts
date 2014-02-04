<?php
/**
 * The Default Header for Guts
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
      
      <header id="site-header">
		<nav class="top-bar" role="navigation">
            <ul class="title-area">
                <li class="name">
                    <h1 class="site-title">
				      	<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			      	</h1>
                </li>          
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>
            <section class="top-bar-section">
	            <?php wp_nav_menu(array( 
			        'container' => false,                           // remove nav container
			        'container_class' => '',           			    // class of container
			        'menu' => '',                      	        	// menu name
			        'menu_class' => 'top-bar-menu left',         	// adding custom nav class
			        'theme_location' => 'primary-left',             // where it's located in the theme
			        'before' => '',                                 // before each link <a> 
			        'after' => '',                                  // after each link </a>
			        'link_before' => '',                            // before each link text
			        'link_after' => '',                             // after each link text
			        'depth' => 5,                                   // limit the depth of the nav
			    	'fallback_cb' => false,                         // fallback function (see below)
			        'walker' => new guts_top_bar_walker()
				)); ?>

                <?php wp_nav_menu(array( 
			        'container' => false,                           // remove nav container
			        'container_class' => '',           				// class of container
			        'menu' => '',                      	        	// menu name
			        'menu_class' => 'top-bar-menu right',         	// adding custom nav class
			        'theme_location' => 'primary',                  // where it's located in the theme
			        'before' => '',                                 // before each link <a> 
			        'after' => '',                                  // after each link </a>
			        'link_before' => '',                            // before each link text
			        'link_after' => '',                             // after each link text
			        'depth' => 5,                                   // limit the depth of the nav
			    	'fallback_cb' => false,                         // fallback function (see below)
			        'walker' => new guts_top_bar_walker()
				)); ?>
            </section>
        </nav>
		<div class="row">
			<div class="large-12 columns">   
				<h1 class="site-title">
			      	<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			      		<?php bloginfo( 'name' ); ?>
			      	</a>
			      	<small><?php bloginfo( 'description' ); ?></small>
		      	</h1>
	    </div>
	  </div>
	  </header>

<hr />