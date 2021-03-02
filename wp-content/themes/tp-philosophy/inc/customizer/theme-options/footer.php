<?php
/**
 * Footer options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/* Footer Section */
$wp_customize->add_section( 'tp_philosophy_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'tp-philosophy' ),
		'priority'   			=> 900,
		'panel'      			=> 'tp_philosophy_theme_options_panel',
	)
);

// Footer hero content
$wp_customize->add_setting( 'tp_philosophy_theme_options[enable_hero_content]',
	array(
		'default'       		=> $options['enable_hero_content'],
		'sanitize_callback'		=> 'tp_philosophy_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'tp_philosophy_theme_options[enable_hero_content]',
    array(
		'label'      			=> esc_html__( 'Enable Footer Hero Content', 'tp-philosophy' ),
		'section'    			=> 'tp_philosophy_section_footer',
		'type'		 			=> 'checkbox',
    )
);

// Add hero content title
$wp_customize->add_setting( 'tp_philosophy_theme_options[hero_content_title]', 
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> $options['hero_content_title'],
		'transport' 		=> 'postMessage',
		) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'tp_philosophy_theme_options[hero_content_title]', array(
		'selector'            => '#colophon .widget_promotion h1',
		'render_callback'     => 'tp_philosophy_hero_content_title_refresh',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

$wp_customize->add_control( 'tp_philosophy_theme_options[hero_content_title]',
	array(
		'label'           => esc_html__( 'Hero Title', 'tp-philosophy' ),
		'section'         => 'tp_philosophy_section_footer',
		'active_callback' => 'tp_philosophy_is_footer_hero_content_enabled',
	)
);

// Add background image setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[hero_content_background_image]', 
	array(
		'default'           => $options['hero_content_background_image'],
		'sanitize_callback' => 'tp_philosophy_sanitize_image',
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tp_philosophy_theme_options[hero_content_background_image]',
    array(
		'label'           => esc_html__( 'Upload a background image', 'tp-philosophy' ),
		'description'     => esc_html__( 'Recommended background image size is 1920x315 px', 'tp-philosophy' ),
		'section'         => 'tp_philosophy_section_footer',
		'active_callback' => 'tp_philosophy_is_footer_hero_content_enabled',
   	)
) );

// footer text
$wp_customize->add_setting( 'tp_philosophy_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'tp_philosophy_santize_allow_tag',
		'transport' 		=> 'postMessage',
	)
);
$wp_customize->add_control( 'tp_philosophy_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Footer Text', 'tp-philosophy' ),
		'section'    			=> 'tp_philosophy_section_footer',
		'type'		 			=> 'textarea',
    )
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'tp_philosophy_theme_options[copyright_text]', array(
		'selector'            => '#colophon .pull-left',
		'render_callback'     => 'tp_philosophy_copyright_text_refresh',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// scroll top visible
$wp_customize->add_setting( 'tp_philosophy_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'tp_philosophy_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'tp_philosophy_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'tp-philosophy' ),
		'section'    			=> 'tp_philosophy_section_footer',
		'type'		 			=> 'checkbox',
    )
);