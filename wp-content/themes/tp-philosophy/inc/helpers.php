<?php
/**
 * Theme_Palace custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion Pro
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since 0.1
	 */
  	function tp_philosophy_check_enable_status( $input, $content_enable ){
		$options = tp_philosophy_get_theme_options();

		// Content status.
		$content_status = $options[ $content_enable ];

		// Get Page ID outside Loop.
		$query_obj = get_queried_object();
		$page_id   = null;

	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );

		if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) ) {
			$input = true;
		} else {
			$input = false;
		}

		return ( $input );
  	}
endif;
add_filter( 'tp_philosophy_section_status', 'tp_philosophy_check_enable_status', 10, 2 );

if ( ! function_exists( 'tp_philosophy_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since TP Philosophy 0.1
	 *
	 * @return string Header image meta option
	 */
	function tp_philosophy_header_image_meta_option() {
		
		global $post;
		if ( is_object( $post ) ) {
			$post_id = $post->ID;
			$header_image_meta = get_post_meta( $post_id, 'tp-philosophy-header-image', true );

			if ( '' == $header_image_meta ) {
				if( has_post_thumbnail( $post_id ) ){
					$img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
					return $img_arr[0];
				} else{
					return get_template_directory_uri() .'/assets/uploads/no-featured-image-1350x495.jpg';
				}

			} elseif ( 'default' == $header_image_meta && get_header_image() ) {
				return  get_header_image();
			}
		} else {
			return esc_url( get_header_image() );
		}
	}
endif;

if ( ! function_exists( 'tp_philosophy_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since 0.1
	 */
	function tp_philosophy_is_sidebar_enable() {
		$options               = tp_philosophy_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( ! empty( $post_id ) )
				$post_sidebar_position = get_post_meta( $post_id, 'tp-philosophy-sidebar-position', true );
			else
				$post_sidebar_position = '';
		} elseif ( is_archive() || is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'tp-philosophy-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'tp_philosophy_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function tp_philosophy_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = tp_philosophy_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}
endif;
add_filter( 'tp_philosophy_filter_frontpage_content_enable', 'tp_philosophy_is_frontpage_content_enable' );


add_action( 'tp_philosophy_simple_breadcrumb', 'tp_philosophy_simple_breadcrumb' , 10 );
if ( ! function_exists( 'tp_philosophy_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function tp_philosophy_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 *
		 */
		$options = tp_philosophy_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


if ( ! function_exists( 'tp_philosophy_title_as_per_template' ) ) :
	/**
	 * Return title as per template rendered
	 *
	 * @since TP Philosophy 0.1
	 *
	 * @return string Template title
	 */
	function tp_philosophy_title_as_per_template() {
		$template_title = '';
		if ( is_singular() ) {
			$template_title = get_the_title();
		} elseif( is_404() ) {
			$template_title = esc_html__( '404', 'tp-philosophy' );
		} elseif( is_search() ){
			$template_title = sprintf( esc_html__( 'Search Result for: %s', 'tp-philosophy' ), get_search_query() );
		} elseif ( is_archive() ) {
			$template_title = get_the_archive_title();
		} elseif ( is_home() ) {
			$template_title = esc_html__( 'Blogs', 'tp-philosophy' );
		}
		return $template_title;
	}
endif;

add_action( 'tp_philosophy_action_pagination', 'tp_philosophy_pagination', 10 );
if ( ! function_exists( 'tp_philosophy_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_pagination() {
		$options = tp_philosophy_get_theme_options();

		if ( true == $options['pagination_enable'] ) {
			the_posts_navigation();
		}
	}

endif;

add_action( 'tp_philosophy_action_post_pagination', 'tp_philosophy_post_pagination', 10 );
if ( ! function_exists( 'tp_philosophy_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_post_pagination() {
		the_post_navigation(
			array(
	            'prev_text'                  => esc_html__( 'previous', 'tp-philosophy' ),
	            'next_text'                  => esc_html__( 'next', 'tp-philosophy' ),
	            'in_same_term'               => true,
	        )
        );
	}
endif;


if ( ! function_exists( 'tp_philosophy_excerpt_length' ) ) :
	/**
	 * long excerpt
	 * 
	 * @since 0.1
	 * @return long excerpt value
	 */
	function tp_philosophy_excerpt_length( $length ){
		if ( is_admin() ) {
			return $length;
		}

		$options = tp_philosophy_get_theme_options();
		$length = $options['excerpt_length'];
		return $length;
	}
endif;
add_filter( 'excerpt_length', 'tp_philosophy_excerpt_length' );

if ( ! function_exists( 'tp_philosophy_excerpt_more' ) ) :
	// read more
	function tp_philosophy_excerpt_more( $more ){
		return '...';
	}
endif;
add_filter( 'excerpt_more', 'tp_philosophy_excerpt_more' );


if ( ! function_exists( 'tp_philosophy_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since 0.1
	 * @return  no of words to display
	 */
	function tp_philosophy_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'tp_philosophy_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'tp_philosophy_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 0.1
	 */
	function tp_philosophy_custom_content_width() {

		global $content_width;
		$sidebar_position = tp_philosophy_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'left-sidebar':
		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'tp_philosophy_custom_content_width' );


if ( ! function_exists( 'tp_philosophy_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since 0.1
	 *
	 * @return string Theme Palace layout value
	 */
	function tp_philosophy_layout() {
		$options = tp_philosophy_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'tp_philosophy_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'tp-philosophy-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'tp-philosophy-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;

if( ! function_exists( 'tp_philosophy_get_thumbnail_source' ) ) :
	/**
	 * Add thumbnail image source
	 *
	 * @since 0.1
	 *
	 * @return Thumbnail image source
	 */
	function tp_philosophy_get_thumbnail_source() {
		global $post;
		$post_id = $post->ID;
		$thumbnail_image_src = '';

		if ( post_password_required() || is_attachment() ) {
			return;
		}
		elseif ( is_singular() ) {
			$header_image_meta = get_post_meta( $post_id, 'tp-philosophy-header-image', true );

			if( '' == $header_image_meta ) return; // retun if thumbnail image is used as a header image.
			$thumbnail_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$thumbnail_image_src = $thumbnail_image_src[0];

		} else {

			if( has_post_thumbnail( $post_id ) ){
				$thumbnail_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'tp-philosophy-square-thumbnail' );
				$thumbnail_image_src = $thumbnail_image_src[0];
			} else {
				$thumbnail_image_src = get_template_directory_uri() .'/assets/uploads/no-featured-image-300x300.jpg';
			}
		}

		return $thumbnail_image_src;
	}
endif;

if ( ! function_exists( 'tp_philosophy_get_author_profile' ) ) :
	/*
	 * Function to get author profile
	 */           
	function tp_philosophy_get_author_profile(){
		$author_id          = get_the_author_meta( 'ID' );
		$author_description = get_the_author_meta( 'description');
		$author_url         = get_the_author_meta( 'user_url' );
		$author_url         = !empty( $author_url ) ? $author_url : '#' ;
	    ?>
	    <div id="about-author">
            <div class="entry-content">
                <div class="author-image">
                  	<?php echo get_avatar( $author_id, 80 );  ?>
                </div><!-- .author-image -->
                <div class="author-content">
                  	<div class="author-name clear">
                    	<span class="author"><?php esc_html__( 'Author:', 'tp-philosophy' ); ?></span>
                    	<h6><a href="<?php echo esc_url( $author_url ); ?>"><?php the_author_meta('display_name'); ?></a></h6>
                  	</div><!--.author-name-->

                  	<?php 
                  		if ( ! empty( $author_description ) ) : 
							echo '<p>'. esc_html( $author_description ) .'</p>';
					 	endif;
					?>

                </div><!-- .author-content -->
            </div><!-- .entry-content -->
        </div><!--#about-author-->
	    <?php
	}
endif;
add_action( 'tp_philosophy_author_profile', 'tp_philosophy_get_author_profile' );

if ( ! function_exists( 'tp_philosophy_primary_menu_fallback' ) ) :

	/**
	 * Fallback for Primary menu.
	 *
	 * @since TP Philosophy 0.1
	 */
	function tp_philosophy_primary_menu_fallback( $args ){

		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'tp-philosophy' ) . '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 8,
		) );
		echo '</ul>';

	}
endif;
