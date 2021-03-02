<?php
/**
 * TP Philosophy team customizer options
 *
 * @package Theme_Palace
 * @subpackage TP_Philosophy
 * @since 1.0
 */

// Add teams section
$wp_customize->add_section( 'tp_philosophy_teams_section', array(
	'title'             => esc_html__( 'Teams','tp-philosophy' ),
	'description'       => esc_html__( 'Teams section options.', 'tp-philosophy' ),
	'panel'             => 'tp_philosophy_homepage_sections_panel'
) );

// Add teams section enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[teams_enable]', array(
	'default'           => $options['teams_enable'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[teams_enable]', array(
	'label'             => esc_html__( 'Enable on', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_teams_section',
	'type'              => 'select',
	'choices'           => tp_philosophy_enable_disable_options()
) );

if ( ! class_exists( 'TP_Philosophy_Tools' ) ) {
    $content_type_description = esc_html__( 'Using ', 'tp-philosophy' ) . sprintf( '<a target="_blank" href="%1$s"> %2$s </a>%3$s', esc_url( 'https://wordpress.org/plugins/tp-philosophy-tools/' ), esc_html__( 'TP Philosophy Tools Plugin', 'tp-philosophy' ), esc_html__( 'provides extra content types.', 'tp-philosophy' ) );

	$choices = array(
		'posts'               => esc_html__( 'Posts', 'tp-philosophy' ),
	);
} else{
    $content_type_description = '';
    $choices = array(
		'posts'               => esc_html__( 'Posts', 'tp-philosophy' ),
		'tp-philosophy-teams' => esc_html__( 'Teams', 'tp-philosophy' ),
	); 
}

// Add teams section content type setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[teams_content_type]', array(
	'default'           => $options['teams_content_type'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[teams_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'tp-philosophy' ),
	'description' 		=> $content_type_description,
	'section'         	=> 'tp_philosophy_teams_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'tp_philosophy_is_teams_enable',
	'choices'         	=> $choices,
) );

// Add teams custom title setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[teams_custom_title]', array(
	'default'           => $options['teams_custom_title'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[teams_custom_title]', array(
	'label'           	=> esc_html__( 'Title', 'tp-philosophy' ),
	'description'		=> esc_html__( 'Input title', 'tp-philosophy' ),
	'active_callback' 	=> 'tp_philosophy_is_teams_enable',
	'section'         	=> 'tp_philosophy_teams_section',
) );

// Add setting and controls to input post id
$wp_customize->add_setting( 'tp_philosophy_theme_options[teams_post_ids]', array(
	'sanitize_callback' => 'tp_philosophy_sanitize_post_ids',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[teams_post_ids]', array(
	'label'           => esc_html__( 'Team member', 'tp-philosophy' ),
	'description' 	  => esc_html__( 'Max: 3. Enter post ID seperated with comma. Example 88,91,93', 'tp-philosophy' ),
	'section'         => 'tp_philosophy_teams_section',
	'active_callback' => 'tp_philosophy_is_teams_content_post_active',
) );

// Add setting and controls to input post id
$wp_customize->add_setting( 'tp_philosophy_theme_options[cpt_teams_post_ids]', array(
	'sanitize_callback' => 'tp_philosophy_sanitize_post_ids',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[cpt_teams_post_ids]', array(
	'label'           => esc_html__( 'Cpt Team member', 'tp-philosophy' ),
	'description' 	  => esc_html__( 'Enter post ID seperated with comma. Example 88,91,93', 'tp-philosophy' ),
	'section'         => 'tp_philosophy_teams_section',
	'active_callback' => 'tp_philosophy_is_cpt_teams_content_post_active',
) );