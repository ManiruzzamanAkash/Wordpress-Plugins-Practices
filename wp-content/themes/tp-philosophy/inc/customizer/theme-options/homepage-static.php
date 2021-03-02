<?php
/**
* Homepage (Static ) options
*
* @package Theme_Palace
* @subpackage TP Philosophy
* @since 0.1
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'tp_philosophy_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[enable_frontpage_content]', array(
	'label'       => esc_html__( 'Enable Content', 'tp-philosophy' ),
	'description' => esc_html__( 'Check to enable content on static front page only.', 'tp-philosophy' ),
	'section'     => 'static_front_page',
	'type'        => 'checkbox'
) );