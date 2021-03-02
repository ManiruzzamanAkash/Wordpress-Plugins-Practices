<?php 

/**
 * Customizer Partial Functions
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_blogs_title_refresh' ) ) :
	/**
	 * Render blog section title partial refresh.
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	function tp_philosophy_blogs_title_refresh() {
		$options = tp_philosophy_get_theme_options();
		return esc_html( $options['blogs_title'] );
	}
endif;

if ( ! function_exists( 'tp_philosophy_contact_custom_title_refresh' ) ) :
	/**
	 * Render contact section custom title partial refresh.
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	function tp_philosophy_contact_custom_title_refresh() {
		$options = tp_philosophy_get_theme_options();
		return esc_html( $options['contact_custom_title'] );
	}
endif;

if ( ! function_exists( 'tp_philosophy_hero_content_title_refresh' ) ) :
	/**
	 * Render hero content title partial refresh.
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	function tp_philosophy_hero_content_title_refresh() {
		$options = tp_philosophy_get_theme_options();
		return esc_html( $options['hero_content_title'] );
	}
endif;

if ( ! function_exists( 'tp_philosophy_copyright_text_refresh' ) ) :
	/**
	 * Render copyright text partial refresh.
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	function tp_philosophy_copyright_text_refresh() {
		$options = tp_philosophy_get_theme_options();
		return esc_html( $options['copyright_text'] );
	}
endif;