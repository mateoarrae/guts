<?php
/**
 * Guts functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

/**
 * Guts only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/includes/back-compat.php';

/**
 * Guts setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Guts supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_setup() {
	/*
	 * Makes Guts available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Guts, use a find and
	 * replace to change 'guts' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'guts', get_template_directory() . '/languages' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'guts' ) );
	register_nav_menu( 'primary-left', __( 'Left Navigation Menu', 'guts' ) );
	register_nav_menu( 'secondary', __( 'Footer Navigation Menu', 'guts' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'guts_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Contrail One, Ubuntu and Ununtu Mono by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Guts 0.0.1
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function guts_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Contrail One, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$contrail_one = _x( 'off', 'Contrail One font: on or off', 'guts' );

	/* Translators: If there are characters in your language that are not
	 * supported by Ubuntu, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$ubuntu = _x( 'on', 'Ubuntu font: on or off', 'guts' );

	/* Translators: If there are characters in your language that are not
	 * supported by Ubuntu Mono, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$ubuntu_mono = _x( 'off', 'Ubuntu Mono font: on or off', 'guts' );

	if ( 'off' !== $contrail_one || 'off' !== $ubuntu || 'off' !== $ubuntu_mono ) {
		$font_families = array();

		if ( 'off' !== $contrail_one )
			$font_families[] = 'Contrail+One';
			
		if ( 'off' !== $ubuntu )
			$font_families[] = 'Ubuntu:300,500,300italic,500italic';

		if ( 'off' !== $ubuntu_mono )
			$font_families[] = 'Ubuntu+Mono';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_scripts_styles() {
	
	// Modernizr acts as a shim for HTML5 elements for older browsers as well as detection for mobile devices.
	// It is also used by Foundation and should be included in the head. Find out more at http://modernizr.com/
	wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/bower_components/foundation/js/vendor/modernizr.js', false, '2014-02-01', false );
	
	// Include Foundation Core and all JavaScript plugins or load them individually below.
	// Find out more at http://foundation.zurb.com/docs/javascript.html
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-abide', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.abide.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-alerts', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.alerts.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-clearing', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.clearing.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-cookie', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.cookie.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-dropdown', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.dropdown.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-forms', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.forms.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-interchange', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.interchange.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-joyride', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.joyride.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-magellan', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.magellan.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-orbit', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.orbit.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-placeholder', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.placeholder.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-reveal', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.reveal.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-section', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.section.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-tooltips', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.tooltips.js', array( 'jquery' ), '2014-02-01', true );
	wp_enqueue_script( 'foundation-topbar', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.topbar.js', array( 'jquery' ), '2014-02-01', true );

	// Loads JavaScript file ready for Customisation.
	// wp_enqueue_script( 'guts-script', get_template_directory_uri() . '/js/guts.js', array( 'jquery' ), '2013-11-05', true );

	// Add Contrail One, Ubuntu and Ubuntu Mono fonts, used in app.css.
	wp_enqueue_style( 'guts-fonts', guts_fonts_url(), array(), null );

	// Add Genericons font.
	// wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'guts-style', get_template_directory_uri() . '/css/app.css', array(), '2013-11-05' );

	// Loads an Internet Explorer specific stylesheet.
	//wp_enqueue_style( 'guts-ie', get_template_directory_uri() . '/css/ie.css', array( 'guts-style' ), '2013-11-05' );
	//wp_style_add_data( 'guts-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'guts_scripts_styles' );

/**
 * Initialise Foundation.
 * @since Guts 0.0.1
 */
function guts_initialise_foundation(){ ?>
	<script>jQuery(document).foundation();</script>
<?php }
add_action( 'wp_footer', 'guts_initialise_foundation', 200 );

/**
 * Cleanup the Head
 * @since Guts 0.0.1
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Guts 0.0.1
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function guts_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'guts_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Guts 1.0
 *
 * @return void
 */
function guts_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'guts' ),
		'id'            => 'footer-1',
		'description'   => __( 'Appears in the footer section of the site.', 'guts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'guts' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'guts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'guts_widgets_init' );

if ( ! function_exists( 'guts_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'guts' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'guts' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'guts' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'guts_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Guts 0.0.1
*
* @return void
*/
function guts_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h4 class="screen-reader-text"><?php _e( 'Other Posts', 'guts' ); ?></h4>
		<div class="nav-links">
			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'guts' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'guts' ) ); ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'guts_yoast_breadcrumbs' ) ) :
/**
 * Customise Yoast Breadcrumb Output
 *
 * Removes all the extra prefixes and separators to make output cleaner 
 * and more complient with Foundation. Keeps rich snippet info intact.
 *
 * @since Guts 0.0.1
 */
function guts_yoast_breadcrumbs() {
	// Check Yoast Plugin is available
	if ( function_exists('yoast_breadcrumb') ) {
		$yoast_breadcrumbs = yoast_breadcrumb("","",false);
		//Look for the links inside the Spans.
		$pattern = "/<span typeof=\"v:Breadcrumb\">(.*?)<\/span>/";
		preg_match_all( $pattern, $yoast_breadcrumbs, $breadcrumbs, PREG_PATTERN_ORDER);
		//Open custom container
		$guts_breadcrumbs = "";
		$guts_breadcrumbs .= '<ul class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		//For each link found output a new list item
		foreach($breadcrumbs[1] as $crumb){
			$guts_breadcrumbs .= '<li typeof="v:Breadcrumb">'.$crumb.'</li>';
		}
		//Close container
		$guts_breadcrumbs .= '</ul>';
		//Output Customised Breadcrumbs
		echo $guts_breadcrumbs;
	}
}
endif;

if ( ! function_exists( 'guts_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_entry_meta() {
		
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<dd class="featured-post">' . __( 'Sticky', 'guts' ) . '</dd>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		guts_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'guts' ) );
	if ( $categories_list ) {
		echo '<dd class="categories-links">' . $categories_list . '</dd>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'guts' ) );
	if ( $tag_list ) {
		echo '<dd class="tags-links">' . $tag_list . '</dd>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<dd class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></dd>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'guts' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'guts_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * @since Guts 0.0.1
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function guts_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'guts' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<dd class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></dd>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'guts' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'guts_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Guts 0.0.1
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'guts_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Guts 0.0.1
 *
 * @return string The Link format URL.
 */
function guts_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body class to denote: Active widgets in the sidebar to change the layout and spacing.
 * You can add more custom body classes in this way to control layut and sytyles in your theme.
 *
 * @since Guts 0.0.1
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function guts_body_class( $classes ) {

	if ( is_active_sidebar( 'sidebar-1' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	return $classes;
}
add_filter( 'body_class', 'guts_body_class' );


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Guts 0.0.1
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function guts_customise_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'guts_customise_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_customize_preview_js() {
	wp_enqueue_script( 'guts-customizer', get_template_directory_uri() . '/js/wordpress/theme-customizer.js', array( 'customize-preview' ), '20131105', true );
}
add_action( 'customize_preview_init', 'guts_customize_preview_js' );

/**
 * Foundation Top Bar Walker 
 * Compatible with Foundation 4 and 5
 *
 * @since Guts 0.0.1
 */
class guts_top_bar_walker extends Walker_Nav_Menu {

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el(&$output, $item, $depth, $args) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        $output .= ($depth == 0) ? '<li class="divider"></li>' : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if(in_array('section', $classes)) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
        }

        $output .= $item_html;
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }

}


/**
 * Comments Walker
 * Customises comments markup output by wp_list_comments()
 * Nests comments as sub articles of the main article.
 * http://html5doctor.com/lets-talk-about-semantics/
 *
 * @since Guts 0.0.1
 */
class guts_walker_comment extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
      
    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment; 
        $parent_class = ( empty( $args['panel has_children'] ) ? 'panel' : 'panel parent' ); ?>
         
        <article <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
          <div class="row">
            <div class="small-2 column">
	          <header class="comment-meta comment-meta-data">
	            <div class="comment-author vcard author">
		          <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
	            </div>
	          </header>
            </div>
            <div class="small-10 column">
            
	          <section id="comment-content-<?php comment_ID(); ?>" class="comment-content">
	            <?php if( !$comment->comment_approved ) : ?>
	              <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
	            <?php else: comment_text(); ?>
	            <?php endif; ?>
	          </section>
	 
	          <footer class="comment-meta comment-meta-data">
	            <dl class="sub-nav">
	              <dd class="comment-author author vcard"><cite class="fn n author-name" rel="author">- <?php echo get_comment_author_link(); ?></cite></dd>
	              <dd class="date"><a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a></dd>
	              <?php edit_comment_link(__( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
	            </dl>
	          </footer>
	          
            </div>
          </div>
    <?php }
 
    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
        </article>
    <?php }
    
}
