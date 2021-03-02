<?php
/**
 * Excerpt options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// Add excerpt section
$wp_customize->add_section( 'tp_philosophy_excerpt_section', array(
	'title'             => esc_html__('Excerpt','tp-philosophy'),
	'description'       => esc_html__( 'Excerpt section options.', 'tp-philosophy' ),
	'panel'             => 'tp_philosophy_theme_options_panel'
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[excerpt_length]', array(
	'sanitize_callback' => 'tp_philosophy_sanitize_number_range',
	'validate_callback' => 'tp_philosophy_validate_long_excerpt',
	'default'			=> $options['excerpt_length']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[excerpt_length]', array(
	'label'       => esc_html__( 'Blog Page Excerpt Length', 'tp-philosophy' ),
	'description' => esc_html__( 'Total words to be displayed in archive page/search page/blog page.', 'tp-philosophy' ),
	'section'     => 'tp_philosophy_excerpt_section',
	'type'        => 'number',
	'input_attrs' => array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );

// Read more text.
$wp_customize->add_setting( 'tp_philosophy_theme_options[read_more_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['read_more_text']
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[read_more_text]', array(
	'label'       => esc_html__( 'Read More Text', 'tp-philosophy' ),
	'section'     => 'tp_philosophy_excerpt_section',
	'type'        => 'text',
) );