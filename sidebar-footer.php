<?php
/**
 * The sidebar containing the footer widget area
 *
 * Displays always in the footer.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<div class="l-sidebar-container" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
<?php endif; ?>