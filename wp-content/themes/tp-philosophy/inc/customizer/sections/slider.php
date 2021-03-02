<?php
/**
 * TP Philosophy slider customizer options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// Add slider section
$wp_customize->add_section( 'tp_philosophy_slider_section', 
	array(
		'title'             => esc_html__( 'Slider','tp-philosophy' ),
		'description'       => esc_html__( 'Slider section options.', 'tp-philosophy' ),
		'panel'             => 'tp_philosophy_homepage_sections_panel',
	)
);

// Add slider section enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_enable]', 
	array(
		'default'           => $options['slider_enable'],
		'sanitize_callback' => 'tp_philosophy_sanitize_select',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[slider_enable]', 
	array(
		'label'             => esc_html__( 'Enable on', 'tp-philosophy' ),
		'section'           => 'tp_philosophy_slider_section',
		'type'              => 'select',
		'choices'           => tp_philosophy_enable_disable_options(),
	)
);

/**
 * Slider Control options  
 */

// Add slider control options heading setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_control_options_heading]', 
	array(
		'sanitize_callback' => 'esc_textarea',
	)
);

$wp_customize->add_control( new TP_Philosophy_Note_Control( $wp_customize, 'tp_philosophy_theme_options[slider_control_options_heading]', 
	array(
		'label'           	=> esc_html__( 'Slider Control Options', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_slider_section',
		'type'				=> 'description',
		'active_callback' 	=> 'tp_philosophy_is_slider_enable',
	)
 ) );

// Add slider effects setting and controls
$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_content_effect]', array(
		'default'           => $options['slider_content_effect'],
		'sanitize_callback' => 'tp_philosophy_sanitize_select',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[slider_content_effect]', array(
		'label'           	=> esc_html__( 'Transition Effects', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_slider_section',
		'type'            	=> 'select',
		'active_callback' 	=> 'tp_philosophy_is_slider_enable',
		'choices'         	=> tp_philosophy_slider_effect(),
	)
);


// Add enable slider pager option setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[enable_slider_pager]', array(
		'default'           => $options['enable_slider_pager'],
		'sanitize_callback' => 'tp_philosophy_sanitize_checkbox',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[enable_slider_pager]', array(
		'label'           	=> esc_html__( 'Enable Pager', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_slider_section',
		'type'            	=> 'checkbox',
		'active_callback' 	=> 'tp_philosophy_is_slider_enable',
	)
);

// Add enable slider button label option setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_btn_label]', array(
		'default'           => $options['slider_btn_label'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'tp_philosophy_theme_options[slider_btn_label]', array(
		'label'           	=> esc_html__( 'Button Label', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_slider_section',
		'type'            	=> 'text',
		'active_callback' 	=> 'tp_philosophy_is_slider_enable',
	)
);

/**
 * Slider content Option
 */

// Add slider section content type setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_content_type]', array(
		'default'           => $options['slider_content_type'],
		'sanitize_callback' => 'tp_philosophy_sanitize_select',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[slider_content_type]', array(
		'label'           	=> esc_html__( 'Content Type', 'tp-philosophy' ),
		'section'         	=> 'tp_philosophy_slider_section',
		'type'            	=> 'select',
		'active_callback' 	=> 'tp_philosophy_is_slider_enable',
		'choices'         	=> array(
			'pages'    		=> esc_html__( 'Pages', 'tp-philosophy' ),
		),
	)
);

for( $i=1; $i<=3; $i++ ){

	// Add setting and controls to input page id
	$wp_customize->add_setting( 'tp_philosophy_theme_options[slider_page_id_' . $i . ']', 
		array(
			'sanitize_callback' => 'tp_philosophy_sanitize_page',
		)
	);

	$wp_customize->add_control( 'tp_philosophy_theme_options[slider_page_id_' . $i . ']', 
		array(
			'label'             => __( 'Select Page # ' , 'tp-philosophy' ) . $i,
			'section'           => 'tp_philosophy_slider_section',
			'active_callback'	=> 'tp_philosophy_is_slider_enable',
			'type'              => 'dropdown-pages',
		)
	);
}