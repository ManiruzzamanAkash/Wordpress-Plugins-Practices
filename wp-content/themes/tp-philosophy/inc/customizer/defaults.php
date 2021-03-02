<?php
/**
 * Customizer default options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 * @return array An array of default values
 */

function tp_philosophy_get_default_theme_options() {
	$tp_philosophy_default_options = array(

		/**
		 * Homepage section options 
		 */

		// Slider Options
		'slider_enable'					=> 'disabled',
		'slider_content_type'			=> 'pages',
		'slider_content_effect'         => 'cubic-bezier(0.250, 0.250, 0.750, 0.750)',
		'enable_slider_pager' 			=> true,
		'slider_btn_label' 				=> esc_html__( 'Get Started', 'tp-philosophy' ),

		// About Options
		'about_enable' 					=> 'disabled',
		'about_content_type' 			=> 'pages',

		// Blog Options
		'blogs_enable' 					=> 'disabled',
		'blogs_content_type' 			=> 'category',
		'blogs_title' 					=> esc_html__( 'Blog', 'tp-philosophy' ),
		
		// Teams options 
		'teams_enable' 					=> 'static-frontpage',
		'teams_content_type' 			=> 'posts',
		'teams_custom_title' 			=> esc_html__( 'Team','tp-philosophy' ),

		// Contact Options 
		'contact_enable' 				=> 'disabled',
		'contact_content_type' 			=> 'custom',
		'contact_custom_title' 			=> sprintf( 'Contact', 'tp-philosophy' ),

		'contact_address_label' 		=> esc_html__( 'Address:', 'tp-philosophy' ),
		'contact_address' 			 	=> esc_html__( 'Jawlakhel, Kathmandu, Nepal', 'tp-philosophy' ),
		'contact_phone_label' 			=> esc_html__( 'Phone No:', 'tp-philosophy' ),
		'contact_phone_number' 			=> esc_html__( '+977-123456789', 'tp-philosophy' ),
		'contact_email_label' 			=> esc_html__( 'Email:', 'tp-philosophy' ),
		'contact_email' 				=> esc_html__( 'info@themepalace.com', 'tp-philosophy' ),
		'contact_background_image' 		=> get_template_directory_uri().'/assets/uploads/contact-bg.jpg',

		// Theme Options
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'excerpt_length'           		=> 15,
		'read_more_text'				=> esc_html__( 'Read More', 'tp-philosophy' ),
		'breadcrumb_enable'         	=> true,
		'pagination_enable'         	=> true,
		'enable_hero_content' 			=> true,
		'hero_content_title' 			=> esc_html( 'We are good at what we do!', 'tp-philosophy' ),
		'hero_content_background_image' => get_template_directory_uri() .'/assets/uploads/footer-bg.jpg',
		'copyright_text'                => sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'tp-philosophy' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> true,
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,
		'join_team_custom_blogquote' 	=> sprintf( '%1$s <a href="mailto:#">%2$s</a> %3$s', esc_html__( 'There are currently no open positions. But you&rsquo;re welcome to', 'tp-philosophy'), esc_html__( 'Email Us', 'tp-philosophy' ), esc_html__( 'and introduce yourself!', 'tp-philosophy' ) ),
		'join_team_custom_image' 		=> get_template_directory_uri() .'/assets/uploads/join.jpg',
		'join_team_custom_link' 		=> '#',

	);

	$output = apply_filters( 'tp_philosophy_default_theme_options', $tp_philosophy_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}