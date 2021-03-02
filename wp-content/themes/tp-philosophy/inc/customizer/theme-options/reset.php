<?php
/**
 * Reset options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'tp_philosophy_reset_section', array(
	'title'             => esc_html__('Reset all settings','tp-philosophy'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'tp-philosophy' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'tp_philosophy_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_reset_section',
	'type'              => 'checkbox',
) );