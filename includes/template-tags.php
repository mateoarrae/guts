<?php
/**
 * Custom template tags for Guts
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */
 
if ( !function_exists( 'guts_browse_happy' ) ) :
/**
 * Outputs Boilerplate browsehappy and chromeframe links for users on legacy browsers
 * 
 * @since Guts 0.0.1
 */
function guts_browse_happy() { ?>
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<?php }
endif;

if ( ! function_exists( 'guts_paging_nav' ) ) :
/**
 * Display Foundation pagination navigation to next/previous set of posts when applicable.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$wp_links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&laquo;', 'guts' ),
		'next_text' => __( '&raquo;', 'guts' ),
	) );

	if ( $wp_links ) :
	
		// Split the link string at the line breaks and build array
		$links = preg_split("/\n/", $wp_links);
	
	?>
	<hr>
	<div class="navigation paging-navigation pagination-centered" role="navigation">
		<ul class="pagination loop-pagination">
			<?php 
			foreach ( $links as $link ) :
				// Foreach link in the array check for current page span, next and previous links - then output list items appropriately
				if ( preg_match( "/<span class='page-numbers current(.*?)<\/span>/", $link ) ) :
					echo '<li class="current">'.preg_replace("/span/", "a", $link)."</li>\n\t\t\t";
				elseif( preg_match( "/next|prev/", $link ) ) :
					echo '<li class="arrow">'.$link."</li>\n\t\t\t";
				else:
					echo "<li>$link</li>\n\t\t\t";
				endif;
			endforeach; 
			?>
		</ul>
	</div>
	<?php
	endif;
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
	<hr>
	<h4 class="screen-reader-text"><?php _e( 'Other Posts', 'guts' ); ?></h4>
	<ul class="button-group radius post-navigation" role="navigation">
	  <li><?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'guts' ) ); ?></li>
	  <li><?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'guts' ) ); ?></li>
	</ul>
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

if ( ! function_exists( 'guts_post_format_link' ) ) :
/**
 * Conditionally Print HTML link with dashicon for post format which can be used outside of content-post-format templates.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_post_format_link() {

	if ( is_single() && has_post_format() ) : // Only use label class and dashicons when used in single.php
	
		$post_format = get_post_format();
	
		echo '<dd class="post-format"><a class="entry-format label secondary radius" href="'.esc_url( get_post_format_link( $post_format ) ).'">';
	
		switch ( $post_format ) {
			
			case 'link' : // Link post format needs 's' adding to class for dashicon
				echo '<i class="dashicons dashicons-format-'. get_post_format() .'s"></i> ';
				break;
				
			default : 
				echo '<i class="dashicons dashicons-format-'. get_post_format() .'"></i> ';
		}
		
		echo get_post_format_string( get_post_format() ).'</a></dd>'; 
		
	elseif ( ! is_single() && has_post_format() ) :

		echo '<dd class="post-format"><a class="entry-format" href="'.esc_url( get_post_format_link( get_post_format() ) ).'">';
		echo get_post_format_string( get_post_format() ).'</a></dd>'; 
		
	endif;

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
		echo '<dd class="featured-post"><span class="label">' . __( 'Sticky', 'guts' ) . '</span></dd>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() && ! is_sticky() )
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
		printf( '<dd class="author vcard">by <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></dd>',
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

