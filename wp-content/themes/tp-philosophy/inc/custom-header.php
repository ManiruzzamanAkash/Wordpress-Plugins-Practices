<?php
/**
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses tp_philosophy_header_style()
 */
function tp_philosophy_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'tp_philosophy_custom_header_args', array(
		'default-image'          => get_template_directory_uri() .'/assets/uploads/banner-1.jpg',
		'default-text-color'     => '58c9e9',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'tp_philosophy_custom_header_setup' );

if( ! function_exists( 'tp_philosophy_render_banner_section' ) ) :
	/**
	 * Hook to display banner section
	 *
	 * @since TP Philosophy 0.1
	 */
	function tp_philosophy_render_banner_section() {
		global $wp_query, $post;
		
		$options = tp_philosophy_get_theme_options(); // get theme options 	

		// Get front page ID
		$page_on_front	  = get_option('page_on_front');
		$page_for_posts   = get_option('page_for_posts');
		// Get Page ID outside Loop
		$page_id          = $wp_query->get_queried_object_id( $post );
		
		if( ( is_home() && $page_on_front == $page_id ) ) {
			return;
		} else {

			/**
			 * Filter the default twentysixteen custom header sizes attribute.
			 *
			 * @since TP Philosophy 0.1
			 *
			 */
			$header_image_meta = tp_philosophy_header_image_meta_option(); // get header image
			$header_background_css = '';
			
			if( !empty( $header_image_meta ) ) {
				$header_background_css = 'style="background-image: url('. esc_url( $header_image_meta ) .');"';
			}
		?>
		<section id="banner-image" <?php echo $header_background_css; ?>>
        	<div class="black-overlay"></div>
	        <div class="wrapper">
	        	<?php
	        		$template_title = tp_philosophy_title_as_per_template();
	        		
	        		if ( ! empty( $template_title ) ) {
	        			echo 	'<div class="banner-title">
	        						<h2 class="page-title">'. esc_html( $template_title ) .'</h2>
	        					</div><!--.banner-title-->';
	        		}

	        		/**
	        		 * tp_philosophy_add_breadcrumb hook
					 *
					 * @hooked tp_philosophy_add_breadcrumb -  10
					 *
	        		 */

	          		do_action( 'tp_philosophy_add_breadcrumb' ); // add breadcrumbs
	          	?>
	        </div><!-- .wrapper-->
      </section><!-- #banner-image-->

		<?php
		}
	}
endif;
add_action( 'tp_philosophy_banner_image_action', 'tp_philosophy_render_banner_section', 10 );

// Add custom css
function tp_philosophy_inline_css() {
	$header_text_color = get_header_textcolor(); // get header text color
	$background_color = get_background_color();
	$custom_css = '';

	$custom_css .= '
		#content { 
			background-color: #'. esc_attr( $background_color ) . 
		'}';

	if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ) {
		if ( ! display_header_text() ) :
		$header_color = ".site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}";
		// If the user has set a custom color for the text use that.
		else :
			$header_color = '
			#site-header p.site-title a,
			.site-description {
				color: #'. esc_attr( $header_text_color ) .
			'}';
		endif; 
		$custom_css .= $header_color;
	}

	wp_add_inline_style( 'tp-philosophy-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'tp_philosophy_inline_css', 10 );


