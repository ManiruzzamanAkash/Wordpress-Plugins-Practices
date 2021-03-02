<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tp_philosophy_body_classes( $classes ) {
	$options = tp_philosophy_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = tp_philosophy_layout();

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	// Add footer-sticky-disabled class when footer hero content is disabled
	if ( ! $options['enable_hero_content'] ){
		$classes[] = 'footer-sticky-disabled';
	}

	return $classes;
}
add_filter( 'body_class', 'tp_philosophy_body_classes' );


if( !function_exists( 'tp_philosophy_blog_article_class' ) ) :
	/**
	 * Adds custom classes to the array of post classes.
	 *
	 * @param array $classes Classes for the post element.
	 * @return array
	 */
	function tp_philosophy_blog_article_class( $classes ) {
	    global $post;

	    if ( is_search() || is_home() || is_archive() ) {   
	    	$classes[] = 'column-wrapper';
	    } else{
	    	$classes[] = '';
	    }
	 
	    return $classes;
	}
endif;
add_filter( 'post_class', 'tp_philosophy_blog_article_class' );

if ( ! function_exists( 'tp_philosophy_add_search_box_to_menu' ) ) :
    /**
     * Add search box to menu
     * @param  $items,$args
   * * @return html,$items
     */

    function tp_philosophy_add_search_box_to_menu( $items, $args ) {
        
        $options = tp_philosophy_get_theme_options();
        if( $args->theme_location == 'primary' ) {        
            $search = '<div id="search">' . get_search_form(false) . '</div>';
            $html = $items .'<li><a id="search-btn" href="#"><i class="fa fa-search"></i></a>'. $search .'</li>';

            return $html;      
        }
        return $items;
    }
endif;
add_filter('wp_nav_menu_items','tp_philosophy_add_search_box_to_menu', 10, 2);