<?php
/**
 * TP Philosophy Blogs Customizer options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// Add Blogs section enable option
$wp_customize->add_section( 'tp_philosophy_blogs_section', array(
	'title'             => esc_html__( 'Blogs Section', 'tp-philosophy' ),
	'description'       => esc_html__( 'Blogs section options.', 'tp-philosophy' ),
	'panel'             => 'tp_philosophy_homepage_sections_panel'
) );

// Add category blog enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[blogs_enable]', array(
	'default'           => $options['blogs_enable'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[blogs_enable]', array(
	'label'             => esc_html__( 'Enable on', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_blogs_section',
	'type'              => 'select',
	'choices'           => tp_philosophy_enable_disable_options()
) );

// Add category blog content type setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[blogs_content_type]', array(
	'default'           => $options['blogs_content_type'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[blogs_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_blogs_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'tp_philosophy_is_blogs_active',
	'choices'         	=> array(
        'category' 		=> esc_html__( 'Category', 'tp-philosophy' ),
    ),
) );

// Add blogs section title
$wp_customize->add_setting( 'tp_philosophy_theme_options[blogs_title]',array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'           => $options['blogs_title'],
	'transport' 		=> 'postMessage',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'tp_philosophy_theme_options[blogs_title]', array(
		'selector'            => '#blog h2.entry-title',
		'render_callback'     => 'tp_philosophy_blogs_title_refresh',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

$wp_customize->add_control( 'tp_philosophy_theme_options[blogs_title]',array(
	'label'           	=> esc_html__( 'Title', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_blogs_section',
	'active_callback' 	=> 'tp_philosophy_is_blogs_active',
) );

// Add Category Content Type
$wp_customize->add_setting(  'tp_philosophy_theme_options[blogs_content_category]', array(
  	'sanitize_callback' => 'tp_philosophy_sanitize_muti_select_categories_list',
) ) ;

$wp_customize->add_control( new TP_Philosophy_Multi_Select_Categories_Control ( $wp_customize,'tp_philosophy_theme_options[blogs_content_category]', array(
	'label'             => esc_html__( 'Select Categories', 'tp-philosophy' ),
	'description' 		=> esc_html__( 'Select categories for blog section', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_blogs_section',
	'active_callback'   => 'tp_philosophy_is_blogs_active'
) ) );