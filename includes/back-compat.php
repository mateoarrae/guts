<?php
/**
 * Guts back compat functionality - Taken from Twenty Thirteen.
 *
 * Prevents Guts from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Guts
 * @since Guts 0.0.1
 */

/**
 * Prevent switching to Guts on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'guts_upgrade_notice' );
}
add_action( 'after_switch_theme', 'guts_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Guts on WordPress versions prior to 3.6.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_upgrade_notice() {
	$message = sprintf( __( 'Guts requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'guts' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_customise() {
	wp_die( sprintf( __( 'Guts requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'guts' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'guts_customise' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Guts 0.0.1
 *
 * @return void
 */
function guts_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Guts requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'guts' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'guts_preview' );
