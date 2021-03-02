<?php
/**
 * Theme_Palace options
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if( !function_exists( 'tp_philosophy_enable_disable_options' ) ) :
    /**
     * Section enable/disable options
     * @return array enable/disable options
     */
    function tp_philosophy_enable_disable_options() {
        $tp_philosophy_enable_disable_options = array(
            'static-frontpage'  => esc_html__( 'Static Frontpage', 'tp-philosophy' ),
            'disabled'          => esc_html__( 'Disabled', 'tp-philosophy' ),
        );

        $output = apply_filters( 'tp_philosophy_enable_disable_options', $tp_philosophy_enable_disable_options );
      
        if ( ! empty( $output ) ) {
            ksort( $output );
        }

        return $output;
    }
endif;

if ( ! function_exists( 'tp_philosophy_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function tp_philosophy_site_layout() {
        $tp_philosophy_site_layout = array(
            'wide'  => esc_html__( 'Wide', 'tp-philosophy' ),
            'boxed' => esc_html__( 'Boxed', 'tp-philosophy' ),
        );

        $output = apply_filters( 'tp_philosophy_site_layout', $tp_philosophy_site_layout );

        return $output;
    }
endif;


if ( ! function_exists( 'tp_philosophy_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function tp_philosophy_sidebar_position() {
        $tp_philosophy_sidebar_position = array(
            'right-sidebar' => esc_html__( 'Right', 'tp-philosophy' ),
            'no-sidebar'    => esc_html__( 'No Sidebar', 'tp-philosophy' ),
        );

        $output = apply_filters( 'tp_philosophy_sidebar_position', $tp_philosophy_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'tp_philosophy_selected_sidebar' ) ) :
    /**
     * Selected sidebar
     * @return array available Sidbar
     */
    function tp_philosophy_selected_sidebar() {
        $tp_philosophy_selected_sidebar = array(
            'sidebar-1'     => esc_html__( 'Default ( Primary Sidebar )', 'tp-philosophy' ),
            'opt-sidebar-1' => esc_html__( 'Optional Sidebar 1', 'tp-philosophy' ),
            'opt-sidebar-2' => esc_html__( 'Optional Sidebar 2', 'tp-philosophy' ),
        );

        $output = apply_filters( 'tp_philosophy_selected_sidebar', $tp_philosophy_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'tp_philosophy_header_image' ) ) :
    /**
     * Header image options
     * @return array Header image options
     */
    function tp_philosophy_header_image() {
        $tp_philosophy_header_image = array(
            '' => esc_html__( 'Enable( Featured Image )', 'tp-philosophy' ),
            'default' => esc_html__( 'Default ( Customizer Header Image )', 'tp-philosophy' ),
        );

        $output = apply_filters( 'tp_philosophy_header_image', $tp_philosophy_header_image );

        return $output;
    }
endif;

if( ! function_exists('tp_philosophy_slider_effect') ) :
    /**
     * Slider effects
     * @return array Slider effects
     */
    function tp_philosophy_slider_effect() {
        $tp_philosophy_slider_effect = array(
            'cubic-bezier(0.250, 0.250, 0.750, 0.750)'            => esc_html__( 'Linear', 'tp-philosophy' ),
            'fade'                                        => esc_html__( 'Fade', 'tp-philosophy' ),
        );

        $output =  apply_filters( 'tp_philosophy_slider_effect', $tp_philosophy_slider_effect );

        // Sort array in ascending order, according to the key:
        if ( ! empty( $output ) ) {
            ksort( $output );
        }

        return $output;
    }
endif;