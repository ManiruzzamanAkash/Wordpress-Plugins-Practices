<?php
/**
* Breadcrumb options
*
* @package Theme_Palace
* @subpackage TP Philosophy
* @since 0.1
*/

$wp_customize->add_section( 'tp_philosophy_breadcrumb', array(
	'title'             => esc_html__('Breadcrumb','tp-philosophy'),
	'description'       => esc_html__( 'Breadcrumb section options.', 'tp-philosophy' ),
	'panel'             => 'tp_philosophy_theme_options_panel'
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'tp_philosophy_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'tp-philosophy' ),
	'section'          	=> 'tp_philosophy_breadcrumb',
	'type'             	=> 'checkbox',
) );
