<?php
/**
 * Customizer active callbacks
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/**
 * Homepage Sections 
 */

// Slider active callback functions 

if ( ! function_exists( 'tp_philosophy_is_slider_enable' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_slider_enable( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'tp_philosophy_theme_options[slider_enable]' )->value() );
	}
endif;

// About section active callback section
if ( ! function_exists( 'tp_philosophy_is_about_enable' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_about_enable( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'tp_philosophy_theme_options[about_enable]' )->value() );
	}
endif;

// Active callback function for blogs section
if ( ! function_exists( 'tp_philosophy_is_blogs_active' ) ) :
	/**
	 * Check if blogs section is enabled on home page.
	 *
	 * @since 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_blogs_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'tp_philosophy_theme_options[blogs_enable]' )->value() );
	}
endif;

// Active callback for teams section
if ( ! function_exists( 'tp_philosophy_is_teams_enable' ) ) :
	/**
	 * Check if teams section is enabled on home page.
	 *
	 * @since 1.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_teams_enable( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'tp_philosophy_theme_options[teams_enable]' )->value() );
	}
endif;

if ( ! function_exists( 'tp_philosophy_is_teams_content_post_active' ) ) :
	/**
	 * Check if content post is active in teams section.
	 *
	 * @since 1.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_teams_content_post_active( $control ) {
		return ( tp_philosophy_is_teams_enable( $control ) && 'posts' == $control->manager->get_setting( 'tp_philosophy_theme_options[teams_content_type]' )->value() );
	}
endif;

if ( ! function_exists( 'tp_philosophy_is_cpt_teams_content_post_active' ) ) :
	/**
	 * Check if tp philosophy teams is active in teams section.
	 *
	 * @since 1.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_cpt_teams_content_post_active( $control ) {
		return ( tp_philosophy_is_teams_enable( $control ) && 'tp-philosophy-teams' == $control->manager->get_setting( 'tp_philosophy_theme_options[teams_content_type]' )->value() );
	}
endif;

// Active callback for contact section
if ( ! function_exists( 'tp_philosophy_is_contact_active' ) ) :
	/**
	 * Check if client section is enabled on home page.
	 *
	 * @since 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_contact_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'tp_philosophy_theme_options[contact_enable]' )->value() );
	}
endif;

/**
 * Active callback for footer section
*/

// Check if footer hero content is enabled
if ( ! function_exists( 'tp_philosophy_is_footer_hero_content_enabled' ) ) :
	/**
	 * Check if footer hero content is enabled.
	 *
	 * @since 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function tp_philosophy_is_footer_hero_content_enabled( $control ) {
		return ( $control->manager->get_setting( 'tp_philosophy_theme_options[enable_hero_content]' )->value() );
	}
endif;
