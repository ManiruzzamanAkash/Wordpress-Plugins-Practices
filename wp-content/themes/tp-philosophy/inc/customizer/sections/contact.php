<?php
/**
 * Contact Customizer options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since TP Philosophy 0.1
 */

// Add contact enable section
$wp_customize->add_section( 'tp_philosophy_contact_section', array(
	'title'             => esc_html__( 'Contact','tp-philosophy' ),
	'description'       => esc_html__( 'Contact section options.', 'tp-philosophy' ),
	'panel'             => 'tp_philosophy_homepage_sections_panel'
) );

// Add contact enable setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_enable]', array(
	'default'           => $options['contact_enable'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_enable]', array(
	'label'             => esc_html__( 'Enable on', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_contact_section',
	'type'              => 'select',
	'choices'           => tp_philosophy_enable_disable_options()
) );

// Add contact content type setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_content_type]', array(
	'default'           => $options['contact_content_type'],
	'sanitize_callback' => 'tp_philosophy_sanitize_select'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_contact_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
	'choices'         	=> array(
		'custom' 		=> esc_html__( 'Custom Content', 'tp-philosophy' )
	)
) );

// Add contact section custom title
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_custom_title]',array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default' 			=> $options['contact_custom_title'],
	'transport' 		=> 'postMessage',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'tp_philosophy_theme_options[contact_custom_title]', array(
		'selector'            => '#contact h2.entry-title',
		'render_callback'     => 'tp_philosophy_contact_custom_title_refresh',
		'container_inclusive' =>  false,
		'fallback_refresh'    =>  true,
	) );
}

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_custom_title]',array(
	'label'      		=> esc_html__( 'Title', 'tp-philosophy' ),
	'description'		=> esc_html__( 'Enter Title.', 'tp-philosophy' ),
	'section'    		=> 'tp_philosophy_contact_section',
    'active_callback'	=> 'tp_philosophy_is_contact_active',
) );
/**
 * Contact options
 */

// Add contact control options heading setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_options_heading]', array(
	'sanitize_callback' => 'esc_textarea'
) );

$wp_customize->add_control( new TP_Philosophy_Note_Control( $wp_customize, 'tp_philosophy_theme_options[contact_options_heading]', array(
	'label'           	=> esc_html__( 'Contact Options', 'tp-philosophy' ),
	'description' 		=> esc_html__( 'Input contact options', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_contact_section',
	'type'				=> 'description',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) ) );

// Add contact fax icon setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_address_label]', array(
	'default'           => $options['contact_address_label'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'tp_philosophy_theme_options[contact_address_label]', array(
	'label'             => esc_html__( 'Address Label', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) );

// Add contact address setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_address]', array(
	'default'           => $options['contact_address'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_address]', array(
	'label'             => esc_html__( 'Address', 'tp-philosophy' ),
	'description'       => esc_html__( 'Enter address', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) );

// Add contact phone icon setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_phone_label]', array(
	'default'           => $options['contact_phone_label'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_phone_label]', array(
	'label'             => esc_html__( 'Phone Label', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) );

// Add contact phone number setting and control
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_phone_number]', array(
	'default'			=> $options['contact_phone_number'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_phone_number]', array(
	'label'           	=> esc_html__( 'Phone Number', 'tp-philosophy' ),
	'description'		=> esc_html__( 'Enter phone number', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) );

// Add contact fax icon setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_email_label]', array(
	'default'           => $options['contact_email_label'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_email_label]', array(
	'label'             => esc_html__( 'Email Label', 'tp-philosophy' ),
	'section'           => 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) );

// Add Email setting and control
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_email]', array(
	'default'			=> $options['contact_email'],
	'sanitize_callback' => 'sanitize_email',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_email]', array(
	'label'           	=> esc_html__( 'Contact Email', 'tp-philosophy' ),
	'description'		=> esc_html__( 'Enter email', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
	'type'				=> 'email'
) );

/**
 * Custom background option
 */

// Add contact background image setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_background_image]', array(
	'default'           => $options['contact_background_image'],
	'sanitize_callback' => 'tp_philosophy_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tp_philosophy_theme_options[contact_background_image]',
    array(
		'label'           => esc_html__( 'Upload a background image', 'tp-philosophy' ),
		'description'     => esc_html__( 'Recommended background image size is 1920x420 px', 'tp-philosophy' ),
		'section'         => 'tp_philosophy_contact_section',
		'active_callback' => 'tp_philosophy_is_contact_active',
   	)
) );


// Add contact form options heading setting and control.
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_form_heading]', array(
	'sanitize_callback' => 'esc_textarea'
) );

$wp_customize->add_control( new TP_Philosophy_Note_Control( $wp_customize, 'tp_philosophy_theme_options[contact_form_heading]', array(
	'label'           	=> esc_html__( 'Contact Form Options', 'tp-philosophy' ),
	'section'         	=> 'tp_philosophy_contact_section',
	'type'				=> 'description',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
) ) );


/**
 * Check if Contact Form 7 plugin is active.
 */

if ( ! class_exists( 'WPCF7' ) ) {
	$contact_form_description = sprintf( '<a href="https://wordpress.org/plugins/contact-form-7/">%1$s</a> %2$s', esc_html__( 'Contact Form 7', 'tp-philosophy' ), esc_html__( 'plugin is recommended for contact forms. After installing CF7 Plugin Input shortcode here.', 'tp-philosophy' ) );
} else {
	$contact_form_description = esc_html__( 'Input contact form 7 shortcode.', 'tp-philosophy' );
}


// Show contact form shortcode setting and control
$wp_customize->add_setting( 'tp_philosophy_theme_options[contact_form_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'tp_philosophy_theme_options[contact_form_shortcode]', array(
	'label'           	=> esc_html__( 'Contact Form Shortcode', 'tp-philosophy' ),
	'description'     	=> $contact_form_description,
	'section'         	=> 'tp_philosophy_contact_section',
	'active_callback' 	=> 'tp_philosophy_is_contact_active',
	'type'            	=> 'textarea',
) );