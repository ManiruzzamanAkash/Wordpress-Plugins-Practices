<?php
/**
 * Theme Palace Theme Customizer.
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// load upgrade to pro option
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tp_philosophy_customize_register( $wp_customize ) {
	$options = tp_philosophy_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * 	Add customizer homepage sections
	 */

	// Add panel for home page sections options
	$wp_customize->add_panel( 'tp_philosophy_homepage_sections_panel' , array(
	    'title'      => esc_html__( 'Homepage Sections','tp-philosophy' ),
	    'description'=> esc_html__( 'Home page section options.', 'tp-philosophy' ),
	    'priority'   => 150,
	) );

	// Slider section
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// About section
	require get_template_directory() . '/inc/customizer/sections/about.php';

	// Add Teams section
	require get_template_directory() . '/inc/customizer/sections/teams.php';

	// Blogs section
	require get_template_directory() . '/inc/customizer/sections/blogs.php';

	// Contact section
	require get_template_directory() . '/inc/customizer/sections/contact.php';

	// Add panel for common theme options
	$wp_customize->add_panel( 'tp_philosophy_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','tp-philosophy' ),
	    'description'=> esc_html__( 'Theme Palace Theme Options.', 'tp-philosophy' ),
	    'priority'   => 150,
	) );

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';
}
add_action( 'customize_register', 'tp_philosophy_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/*
 * Load partial refresh functions.
 */
require get_template_directory() . '/inc/customizer/partial.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tp_philosophy_customize_preview_js() {
	wp_enqueue_script( 'tp_philosophy_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'tp_philosophy_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function tp_philosophy_customize_control_js() {
	wp_enqueue_script( 'tp-philosophy-customize-controls', get_template_directory_uri() . '/assets/js/customize-control.js', array(), '1.0', true );
	$tp_philosophy_cusomizer_control_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'tp-philosophy' ),
	);
	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'tp-philosophy-customize-controls', 'tp_philosophy_cusomizer_control_data', $tp_philosophy_cusomizer_control_data );
}
add_action( 'customize_controls_enqueue_scripts', 'tp_philosophy_customize_control_js' );

if ( !function_exists( 'tp_philosophy_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function tp_philosophy_reset_options() {
		$options = tp_philosophy_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'tp_philosophy_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
			remove_theme_mod( 'header_textcolor' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'tp_philosophy_reset_options' );