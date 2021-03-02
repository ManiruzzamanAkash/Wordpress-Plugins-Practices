<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tp_philosophy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'tp-philosophy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tp-philosophy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'tp-philosophy-about-thumbnail', 450, 515, true );
		add_image_size( 'tp-philosophy-square-thumbnail', 500, 500, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'tp-philosophy' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tp_philosophy_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'width'       => 91,
			'height'      => 84,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/unminified/editor-style.css', tp_philosophy_fonts_url() ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'tp-philosophy' ),
				'slug' => 'blue',
				'color' => '#58c9e9',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'tp-philosophy' ),
	           	'slug' => 'green',
	           	'color' => '#ffbb44',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'tp-philosophy' ),
	           	'slug' => 'black',
	           	'color' => '#000',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'tp-philosophy' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'tp-philosophy' ),
		       	'shortName' => esc_html__( 'S', 'tp-philosophy' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'tp-philosophy' ),
		       	'shortName' => esc_html__( 'M', 'tp-philosophy' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'tp-philosophy' ),
		       	'shortName' => esc_html__( 'L', 'tp-philosophy' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'tp-philosophy' ),
		       	'shortName' => esc_html__( 'XL', 'tp-philosophy' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'tp_philosophy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tp_philosophy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tp_philosophy_content_width', 640 );
}
add_action( 'after_setup_theme', 'tp_philosophy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tp_philosophy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tp-philosophy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tp-philosophy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar 1', 'tp-philosophy' ),
		'id'            => 'opt-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tp-philosophy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar 2', 'tp-philosophy' ),
		'id'            => 'opt-sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'tp-philosophy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tp_philosophy_widgets_init' );


if ( ! function_exists( 'tp_philosophy_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function tp_philosophy_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Oxygen, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oxygen font: on or off', 'tp-philosophy' ) ) {
		$fonts[] = 'Oxygen:100,200,300,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'tp-philosophy' ) ) {
		$fonts[] = 'Raleway:100,200,300,400,600,700,800,900';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function tp_philosophy_scripts() {

	$options = tp_philosophy_get_theme_options();  // get theme options 

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'tp-philosophy-fonts', tp_philosophy_fonts_url(), array(), null );

	// Load font awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/plugins/css/font-awesome.min.css', array(), '4.7.0' );

	// Load slick theme css
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() .'/assets/plugins/css/slick-theme.min.css', array(), '' );

	// Load slick css
	wp_enqueue_style( 'slick', get_template_directory_uri() .'/assets/plugins/css/slick.min.css', array(), '' );

	// blocks
	wp_enqueue_style( 'tp-philosophy-blocks', get_template_directory_uri() . '/assets/css/blocks.min.css' );

	// Load theme style css
	wp_enqueue_style( 'tp-philosophy-style', get_stylesheet_uri() );

	// Load theme color
	wp_enqueue_style( 'tp-philosophy-theme-color', get_template_directory_uri() .'/assets/css/blue.min.css', array(), '' );

	// Load the html5 shiv.
	wp_enqueue_script( 'tp-philosophy-html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'tp-philosophy-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'tp-philosophy-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20160412', true );

	wp_enqueue_script( 'tp-philosophy-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'tp-philosophy-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	// Load slick js 
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/js/slick.min.js', array( 'jquery' ), '1.6.0', true );

	// Load parallax js 
	wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/assets/plugins/js/jquery.parallax.min.js', array( 'jquery' ), '0.6.2', true );

	// Load custom js
	wp_enqueue_script( 'tp-philosophy-custom-js', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tp_philosophy_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Tp Phiosophy 1.0.0
 */
function tp_philosophy_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'tp-philosophy-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.min.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'tp-philosophy-fonts', tp_philosophy_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'tp_philosophy_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';


function tp_philosophy_increase_count($post_title){
	if($post_title == "Hello Programming"){
		$visit_count = get_option('hello_programming_view');
		$visit_count = $visit_count ? $visit_count : 0;
		$visit_count++;
		update_option('hello_programming_view', $visit_count);
	}
}
add_action('tp_philosophy_action_before_post_article', 'tp_philosophy_increase_count');

function tp_philosophy_action_before_pagination(){
	echo "<span class='text-info'>Thank you for viewing this post ..</span>";
}
add_action('tp_philosophy_action_before_pagination', 'tp_philosophy_action_before_pagination');

remove_action("tp_philosophy_action_before_pagination", "tp_philosophy_action_before_pagination");



function tp_philosophy_pqrc_countries($countries)
{
	array_push($countries, "Spain");
	$countries = array_diff($countries, array("Pakistan"));
	return $countries;
}

add_filter('pqrc_countries', 'tp_philosophy_pqrc_countries');
