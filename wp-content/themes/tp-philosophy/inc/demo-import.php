<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage TP Philosophy
 * @since TP Philosophy 1.0.0
 */

function tp_philosophy_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for TP Philosophy Theme.', 'tp-philosophy' ),
    esc_url( 'https://themepalace.com/instructions/themes/tp-philosophy' ), esc_html__( 'Click here for Demo File download', 'tp-philosophy' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'tp_philosophy_intro_text' );