<?php
/**
 * Philosophy about section customizer options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// Add about section
$wp_customize->add_section( 'tp_philosophy_about_section', 
	array(
		'title'             => esc_html__( 'About','tp-philosophy' ),
		'description'       => esc_html__( 'about section options.', 'tp-philosophy' ),
		'panel'             => 'tp_philosophy_homepage_sections_panel',
	)
);

// Add about section enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[about_enable]', 
	array(
		'default'           => $options['about_enable'],
		'sanitize_callback' => 'tp_philosophy_sanitize_select',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[about_enable]', 
	array(
		'label'             => esc_html__( 'Enable on', 'tp-philosophy' ),
		'section'           => 'tp_philosophy_about_section',
		'type'              => 'select',
		'choices'           => tp_philosophy_enable_disable_options(),
	)
);

// Add about section content type setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[about_content_type]', array(
		'default'           => $options['about_content_type'],
		'sanitize_callback' => 'tp_philosophy_sanitize_select',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[about_content_type]', array(
		'label'           	=> esc_html__( 'Content Type', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_about_section',
		'type'            	=> 'select',
		'active_callback' 	=> 'tp_philosophy_is_about_enable',
		'choices'         	=> array(
			'pages'    		=> esc_html__( 'Pages', 'tp-philosophy' ),
	    ),
	)
);

// Add setting and controls to input page id
$wp_customize->add_setting( 'tp_philosophy_theme_options[about_page_id]', 
	array(
		'sanitize_callback' => 'tp_philosophy_sanitize_page',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[about_page_id]', 
	array(
		'label'             => esc_html__( 'Select Page' , 'tp-philosophy' ),
		'section'           => 'tp_philosophy_about_section',
		'active_callback'	=> 'tp_philosophy_is_about_enable',
		'type'              => 'dropdown-pages',
	)
);