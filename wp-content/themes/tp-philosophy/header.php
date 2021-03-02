<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme_Palace
	 */

	/**
	 * tp_philosophy_doctype hook
	 *
	 * @hooked tp_philosophy_doctype -  10
	 *
	 */
	do_action( 'tp_philosophy_doctype' );
?>
<head>
<?php
	/**
	 * tp_philosophy_before_wp_head hook
	 *
	 * @hooked tp_philosophy_head -  10
	 *
	 */
	do_action( 'tp_philosophy_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * tp_philosophy_page_start_action hook
	 *
	 * @hooked tp_philosophy_page_start -  10
	 *
	 */
	do_action( 'tp_philosophy_page_start_action' );

	/**
	 * tp_philosophy_header_action hook
	 *
	 * @hooked tp_philosophy_header_start -  10
	 * @hooked tp_philosophy_site_branding -  20
	 * @hooked tp_philosophy_site_navigation -  30
	 * @hooked tp_philosophy_header_end -  50
	 *
	 */
	do_action( 'tp_philosophy_header_action' );

	/**
	 * tp_philosophy_content_start_action hook
	 *
	 * @hooked tp_philosophy_content_start -  10
	 *
	 */
	do_action( 'tp_philosophy_content_start_action' );

	if( is_home() || !is_front_page() ) { 
		/**
		 * tp_philosophy_banner_image_action hook
		 *
		 * @hooked tp_philosophy_render_banner_section -  10
		 */
		do_action( 'tp_philosophy_banner_image_action' );
	}
	/**
	 * tp_philosophy_homepage_section hook
	 *
	 * @hooked tp_philosophy_add_slider_section -  10
	 * @hooked tp_philosophy_add_about_section -  20
	 * @hooked tp_philosophy_add_blog_section -  90
	 *
	 */
	do_action( 'tp_philosophy_homepage_section' );
	

	
