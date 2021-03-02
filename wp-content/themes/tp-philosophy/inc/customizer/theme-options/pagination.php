<?php
/**
* pagination options
*
* @package Theme_Palace
* @subpackage TP Philosophy
* @since 0.1
*/

// Add sidebar section
$wp_customize->add_section( 'tp_philosophy_pagination', array(
	'title'               => esc_html__('Pagination','tp-philosophy'),
	'description'         => esc_html__( 'Pagination section options.', 'tp-philosophy' ),
	'panel'               => 'tp_philosophy_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'tp_philosophy_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'tp-philosophy' ),
	'section'             => 'tp_philosophy_pagination',
	'type'                => 'checkbox',
) );
