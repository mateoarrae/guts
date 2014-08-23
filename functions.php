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

/*
 * Set up the required content width value based on the theme's design.
 * You can Adust this later for specific post types or page templates
 */
if ( ! isset( $content_width ) )
	$content_width = 637;

/**
 * Guts only works in WordPress 3.8 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.8-alpha', '<' ) )
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
	
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'css/editor-style.css' );
	
	/**
	 * Adds Required Support for RSS feed links to <head> for posts and comments.
	 * These can be optionally cleaned up later
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * Guts supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// Guts uses wp_nav_menu() in three locations.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'guts' ) );
	register_nav_menu( 'primary-left', __( 'Left Navigation Menu', 'guts' ) );
	register_nav_menu( 'secondary', __( 'Footer Navigation Menu', 'guts' ) );

	/*
	 * Guts uses custom image sizes for featured images, displayed on posts and pages.
	 * More info here: http://markjaquith.wordpress.com/2009/12/23/new-in-wordpress-2-9-post-thumbnail-images/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 637, 9999 ); // Standard size
	add_image_size( '12-columns', 970, 9999 ); // Single post and page size
	add_image_size( 'front-page', 1920, 300, true ); // Front page size
	

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'guts_setup' );


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_scripts_styles() {
	
	// Use the new WordPress threaded comments system @since WordPress 2.7
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
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
	wp_enqueue_script( 'foundation-reveal', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.reveal.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-section', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.section.js', array( 'jquery' ), '2014-02-01', true );
	// wp_enqueue_script( 'foundation-tooltips', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.tooltips.js', array( 'jquery' ), '2014-02-01', true );
	wp_enqueue_script( 'foundation-topbar', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.topbar.js', array( 'jquery' ), '2014-02-01', true );

	// Loads JavaScript file ready for Customisation.
	// wp_enqueue_script( 'guts-script', get_template_directory_uri() . '/js/guts.js', array( 'jquery' ), '2013-11-05', true );

	// Guts main stylesheet. 
	// Default Production Stylesheet - use this for production and if you're using SASS.
	wp_enqueue_style( 'guts-style', get_template_directory_uri() . '/css/minified/guts.css', array('dashicons'), '2014-04-17' );
	// Optional Development Stylesheet - use this during development or if you want to use plain CSS
	// Comment out the default stylesheet above and uncomment the stylesheet below.
	// wp_enqueue_style( 'guts-style', get_template_directory_uri() . '/css/guts.css', array('dashicons'), '2014-04-17' );

	// Loads an Internet Explorer specific stylesheet.
	// wp_enqueue_style( 'guts-ie', get_template_directory_uri() . '/css/ie.css', array( 'guts-style' ), '2013-11-05' );
	// wp_style_add_data( 'guts-ie', 'conditional', 'lt IE 9' );
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
 * Clean up the Head.
 *
 * Removes unecessary actions from wp_head
 * Comment out below as required
 *
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
 * Require the custom template tags for this theme.
 * @since Guts 0.0.1
 */
require get_template_directory() . '/includes/template-tags.php';


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


/**
 * Adds Foundation small button class to anchor markup where no previous classes exist
 * Output by previous_post_link(), next_post)link()
 *
 * @since Guts 0.0.1
 */
function guts_add_button_class($format){
  $format = str_replace('href=', 'class="small button" href=', $format);
  return $format;
}
add_filter('next_post_link', 'guts_add_button_class');
add_filter('previous_post_link', 'guts_add_button_class');
add_filter('comment_reply_link', 'guts_add_button_class');

/**
 * Adds Foundation Icon Font Pencil Icon before anchor text
 * Output by edit_post_link() and edit_comment_link()
 *
 * @since Guts 0.0.1
 */
function guts_add_edit_icon($format){
  $format = str_replace('">', '"><i class="icon fi-pencil"></i> ', $format);
  return $format;
}
add_filter('edit_post_link', 'guts_add_edit_icon');
add_filter('edit_comment_link', 'guts_add_edit_icon');

/**
 * Adds Foundation button classes and comment icons to Comment Reply links
 * Output by comment_reply_link()
 *
 * @since Guts 0.0.1
 */
function guts_comment_icon_button($format){
  $format = str_replace("class='comment-reply-link'", "class='comment-reply-link tiny button radius'", $format);
  $format = str_replace("'>", "'><i class=\"icon fi-comment\"></i> ", $format);
  return $format;
}
add_filter('comment_reply_link', 'guts_comment_icon_button');

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
 * You can add more custom body classes in this way to control layout and styles in your theme.
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

    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
    
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	
        $item_html = '';
        
        parent::start_el( $item_html, $item, $depth, $args, $id );

        $output .= ($depth == 0) ? '<li class="divider"></li>' : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if ( in_array( 'section', $classes ) ) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
        }

        $output .= $item_html;
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
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
class guts_comment_walker extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
      
    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
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
	              <p><span class="label alert comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'guts' ); ?></span></p>
	            <?php else: comment_text(); ?>
	            <?php endif; ?>
	          </section>
	 
	          <footer class="comment-meta comment-meta-data row">
	            <div class="large-8 medium-6 columns">
	              <dl class="sub-nav">
	                <dd class="comment-author author vcard">
	                  <cite class="fn n author-name" rel="author">- <?php echo get_comment_author_link(); ?></cite>
	                </dd>
	                <dd class="date">
	                  <a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>">
	                  <?php comment_date(); ?> <?php _e( 'at', 'guts' ); ?> <?php comment_time(); ?></a>
	                </dd>
	                <?php edit_comment_link(__( 'Edit', 'guts' ), '<dd class="edit-link">', '</dd>' ); ?>
	              </dl>
	            </div>
	            <div class="reply large-4 medium-6 columns">
					<?php $reply_args = array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ); ?>
					<?php comment_reply_link( array_merge( $args, $reply_args ) );  ?>
				</div>
	          </footer>
	          
            </div>
          </div>
    <?php }
 
    function end_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) { ?>
        </article>
    <?php }
    
}

/**
 * Adds Foundation thumbnail class to anchor markup output by wp_get_attachment_link()
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_add_th_class($format){
  $format = str_replace('<a', '<a class="th"', $format);
  return $format;
}
add_filter('wp_get_attachment_link', 'guts_add_th_class');

/**
 * Customises the default gallery markup to use Foundation block-grids
 * Gallery shortcode function taken from WordPress 3.8.1
 *
 * @since Guts 0.0.1
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */

remove_shortcode('gallery');
add_shortcode('gallery', 'guts_gallery_shortcode');

function guts_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	
	// Setup shortcode attributes and add additional Guts tags
	extract(shortcode_atts(array(
		'order'      		=> 'ASC',
		'orderby'    		=> 'menu_order ID',
		'id'         		=> $post ? $post->ID : 0,
		'itemtag'    		=> 'li',
		'imgcontainertag'   => 'fig',
		'icontag'    		=> 'div',
		'captiontag' 		=> 'figcaption',
		'labeltag' 			=> 'span',
		'columns'   		=> 3,
		'size'       		=> 'thumbnail',
		'include'    		=> '',
		'exclude'    		=> '',
		'link'       		=> ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	// Make sure the tags specified contain only valid characters
	$itemtag = tag_escape($itemtag);
	$imgcontainertag = tag_escape($imgcontainertag);
	$captiontag = tag_escape($captiontag);
	$labeltag = tag_escape($labeltag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	
	// Set default tags if none already given
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'li';
	if ( ! isset( $valid_tags[ $imgcontainertag ] ) )
		$imgcontainertag = 'fig';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'figcaption';
	if ( ! isset( $valid_tags[ $labeltag ] ) )
		$labeltag = 'span';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'div';

	// Get column number specified by user
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$selector = "gallery-{$instance}";
	
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<ul id='$selector' class='gallery galleryid-{$id} large-block-grid-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		if ( ! empty( $link ) && 'file' === $link )
			$image_output = wp_get_attachment_link( $id, $size, false, false );
		elseif ( ! empty( $link ) && 'none' === $link )
			$image_output = wp_get_attachment_image( $id, $size, false );
		else
			$image_output = wp_get_attachment_link( $id, $size, true, false );

		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) )
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		// Output markup
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "<{$imgcontainertag}>";
		$output .= "<{$icontag} class='gallery-icon {$orientation}'>$image_output</{$icontag}>";
		
		if ( $captiontag && trim($attachment->post_excerpt) ) :
			$output .= "<{$captiontag} class='wp-caption-text gallery-caption'><{$labeltag} class='label'>" . wptexturize($attachment->post_excerpt) . "</{$labeltag}></{$captiontag}>";
		endif;
		
		$output .= "</{$imgcontainertag}>";
		$output .= "</{$itemtag}>";
	}

	$output .= "
		</ul>\n";

	return $output;
}

/**
 * Customises the default caption shortcode markup
 * Applies html5 elements and Foundation Thumbnails
 *
 * @since Guts 0.0.1
 *
 * @param array $output to return, $attr Attributes to apply, $content of the original string
 * @return string HTML content to display caption
 */
function guts_caption( $output, $attr, $content ) {

	// Leave feed captions alone
	if ( is_feed() )
		return $output;

	// Setup default args
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	// Merge default args with user changes.
	$attr = shortcode_atts( $defaults, $attr );

	// Add Foundation Thumbnail classs to link
	$content = str_replace('<a', '<a class="th"', $content);
	
	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags.
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	// Set up the attributes for the caption container.
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	// Open container.
	$output = '<fig' . $attributes .'>';

	// Allow shortcodes for the content the caption was created for.
	$output .= do_shortcode( $content );

	// Append the caption text.
	$output .= '<figcaption class="wp-caption-text"><span class="label">' . $attr['caption'] . '</span></figcaption>';

	// Close the caption container.
	$output .= '</fig>';

	// Return customised caption.
	return $output;
}
add_filter( 'img_caption_shortcode', 'guts_caption', 10, 3 );
