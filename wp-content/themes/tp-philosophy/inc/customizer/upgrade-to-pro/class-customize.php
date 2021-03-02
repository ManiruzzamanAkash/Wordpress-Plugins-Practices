<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

final class TP_Philosophy_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since 0.1
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since 0.1
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since 0.1
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since 0.1
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upgrade-to-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'TP_Philosophy_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new TP_Philosophy_Customize_Section_Pro(
				$manager,
				'tp-philosophy',
				array(
					'title'    => esc_html__( 'TP Philosophy Pro', 'tp-philosophy' ),
					'pro_text' => esc_html__( 'Go Pro',         'tp-philosophy' ),
					'pro_url'  => 'http://themepalace.com/downloads/tp-philosophy-pro/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since 0.1
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'tp-philosophy-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'tp-philosophy-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
TP_Philosophy_Customize::get_instance();
