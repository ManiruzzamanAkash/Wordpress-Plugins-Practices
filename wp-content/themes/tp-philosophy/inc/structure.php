<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

$options = tp_philosophy_get_theme_options();


if ( ! function_exists( 'tp_philosophy_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'tp_philosophy_doctype', 'tp_philosophy_doctype', 10 );


if ( ! function_exists( 'tp_philosophy_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'tp_philosophy_before_wp_head', 'tp_philosophy_head', 10 );

if ( ! function_exists( 'tp_philosophy_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tp-philosophy' ); ?></a>

		<?php
	}
endif;

add_action( 'tp_philosophy_page_start_action', 'tp_philosophy_page_start', 10 );

if ( ! function_exists( 'tp_philosophy_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'tp_philosophy_page_end_action', 'tp_philosophy_page_end', 10 );

if ( ! function_exists( 'tp_philosophy_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_header_start() {
		?>
		<header id="masthead" class="site-header sticky" role="banner">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'tp_philosophy_header_action', 'tp_philosophy_header_start', 10 );

if ( ! function_exists( 'tp_philosophy_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_site_branding() {
		?>
		<div class="site-branding pull-left site-logo-title">
			<?php if( has_custom_logo() ) : ?>
			<div class="site-logo">
            	<?php echo get_custom_logo(); ?>
          	</div><!-- end .site-logo -->
          	<?php endif;

          	if( display_header_text() ): ?>
          	<div id="site-header">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : 
					echo '<p class="site-description">'. esc_html( $description ) .'</p>';
				endif; ?>
			</div><!-- #site-header -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'tp_philosophy_header_action', 'tp_philosophy_site_branding', 20 );

if ( ! function_exists( 'tp_philosophy_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_site_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle">
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'fallback_cb' => 'tp_philosophy_primary_menu_fallback' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'tp_philosophy_header_action', 'tp_philosophy_site_navigation', 30 );


if ( ! function_exists( 'tp_philosophy_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'tp_philosophy_header_action', 'tp_philosophy_header_end', 50 );

if ( ! function_exists( 'tp_philosophy_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'tp_philosophy_content_start_action', 'tp_philosophy_content_start', 10 );

if ( ! function_exists( 'tp_philosophy_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'tp_philosophy_content_end_action', 'tp_philosophy_content_end', 10 );

if ( ! function_exists( 'tp_philosophy_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_add_breadcrumb() {
		$options = tp_philosophy_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() && is_home() ) {
			return;
		}

		/**
		 * tp_philosophy_simple_breadcrumb hook
		 *
		 * @hooked tp_philosophy_simple_breadcrumb -  10
		 *
		 */
		do_action( 'tp_philosophy_simple_breadcrumb' );
		return;
	}

endif;
add_action( 'tp_philosophy_add_breadcrumb', 'tp_philosophy_add_breadcrumb' , 20 );

if ( ! function_exists( 'tp_philosophy_get_footer_content' ) ) :

	/**
	 * Add Footer content.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_get_footer_content() { 
		$options = tp_philosophy_get_theme_options(); // get theme options
	?>
		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php 
				if ( $options['enable_hero_content'] ) :
					$hero_title            = ! empty( $options['hero_content_title'] ) ? $options['hero_content_title'] : '';
					
					$hero_background_style = '';
					if ( ! empty( $options['hero_content_background_image'] ) ){
						$hero_background_style = 'style="background-image: url('. esc_url( $options['hero_content_background_image'] ).')"';
					}
			 ?>
				<div class="footer-bg page-section col-1" <?php echo $hero_background_style; ?>>
			        <div class="blue-overlay"></div>
			        <div class="wrapper">
						<div class="column-wrapper">
							<section id="post" class="widget widget_promotion">
								<div class="widget_wrap">
									<?php 
										if ( ! empty( $hero_title ) ){
											echo '<h1>'. esc_html( $hero_title ) .'</h1>';
										}
									?>
								</div><!-- .bg-content -->
							</section>
						</div><!-- .column-wrapper -->
			        </div><!-- .wrapper -->
		      	</div><!-- .footer-bg -->
		    <?php endif; ?>
	        
	        <div class="site-info clear">
	        	<div class="wrapper">
	        		<?php 
	        			if( !empty( $options['copyright_text'] ) ) :
	        				// site info
							$search = array( '[the-year]', '[site-link]' );

        					$replace = array( date_i18n( __( 'Y','tp-philosophy' ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        					$options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
	        		?>
	          			<div class="pull-left">
		        			<?php echo '<p>'. wp_kses_data( $options['copyright_text'] ); if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( '<span> | </span>' );
							} '</p>'; ?>
		        		</div><!--.pull-left-->
		        	<?php endif; ?>
				
					<div class="pull-right">
	            		<?php printf( '<p> %1$s <a href="%2$s">%3$s</a></p>', esc_html( 'TP Philosophy  Theme by ', 'tp-philosophy' ), esc_url( 'http://www.themepalace.com' ), esc_html__( 'Theme Palace', 'tp-philosophy' ) ); ?>
	          		</div><!--.pull-right-->
        		</div><!-- .wrapper -->
			</div><!-- .site-info -->
	</footer><!-- #colophon -->
        	
	<?php } 
endif;
add_action( 'tp_philosophy_footer_content', 'tp_philosophy_get_footer_content' );

if ( ! function_exists( 'tp_philosophy_back_to_top' ) ) :
	/**
	 * Footer ends
	 *
	 * @since 0.1
	 *
	 */
	function tp_philosophy_back_to_top() { 
		$options = tp_philosophy_get_theme_options();
		if ( $options['scroll_top_visible'] === true ) : ?>
			<div class="backtotop"><i class="fa fa-angle-up"></i></div>
		<?php
		endif;
	}
endif;
add_action( 'tp_philosophy_back_to_top', 'tp_philosophy_back_to_top', 10 );
