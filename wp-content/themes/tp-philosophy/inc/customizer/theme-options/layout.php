<?php
/**
* Layout options
*
* @package Theme_Palace
* @subpackage TP Philosophy
* @since 0.1
*/

// Add sidebar section
$wp_customize->add_section( 'tp_philosophy_layout', array(
	'title'               => esc_html__('Layout','tp-philosophy'),
	'description'         => esc_html__( 'Layout section options.', 'tp-philosophy' ),
	'panel'               => 'tp_philosophy_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'tp_philosophy_sanitize_select',
	'default'             => $options['sidebar_position']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'tp-philosophy' ),
	'section'             => 'tp_philosophy_layout',
	'type'                => 'select',
	'choices'			  => tp_philosophy_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[site_layout]', array(
	'sanitize_callback'   => 'tp_philosophy_sanitize_select',
	'default'             => $options['site_layout']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'tp-philosophy' ),
	'section'             => 'tp_philosophy_layout',
	'type'                => 'select',
	'choices'			  => tp_philosophy_site_layout(),
) );