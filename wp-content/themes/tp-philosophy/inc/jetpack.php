<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_jetpack_setup' ) ) :

	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.com/support/responsive-videos/
	 */

	function tp_philosophy_jetpack_setup() {
		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}
endif;
add_action( 'after_setup_theme', 'tp_philosophy_jetpack_setup' );