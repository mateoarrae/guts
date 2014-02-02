<?php
/**
 * The sidebar containing the primary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="l-sidebar-container" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
<?php endif; ?>