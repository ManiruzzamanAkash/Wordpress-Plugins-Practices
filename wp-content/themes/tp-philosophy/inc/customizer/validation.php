<?php
/**
* Customizer validation functions
*
* @package Theme_Palace
* @subpackage TP Philosophy
* @since 0.1
*/

if ( ! function_exists( 'tp_philosophy_validate_long_excerpt' ) ) :
  function tp_philosophy_validate_long_excerpt( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'tp-philosophy' ) );
     } elseif ( $value < 5 ) {
         $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'tp-philosophy' ) );
     } elseif ( $value > 100 ) {
         $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'tp-philosophy' ) );
     }
     return $validity;
  }
endif;
