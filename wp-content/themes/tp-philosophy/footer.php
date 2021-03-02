<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

/**
 * tp_philosophy_homepage_section_footer hook
 *
 * @hooked tp_philosophy_add_contact_section -  10
 *
 */
do_action( 'tp_philosophy_homepage_section_footer' );

/**
 * tp_philosophy_content_end_action hook
 *
 * @hooked tp_philosophy_content_end -  10
 *
 */
do_action( 'tp_philosophy_content_end_action' );

/**
 * tp_philosophy_footer_content hook
 *
 * @hooked tp_philosophy_get_footer_content -  10
 *
 */
do_action( 'tp_philosophy_footer_content' );

/**
 * tp_philosophy_page_end_action hook
 *
 * @hooked tp_philosophy_page_end -  10
 *
 */
do_action( 'tp_philosophy_page_end_action' ); 

/**
 * tp_philosophy_back_to_top hook
 *
 * @hooked tp_philosophy_back_to_top -  10
 *
 */
do_action( 'tp_philosophy_back_to_top' ); 

wp_footer(); 
?>

</body>
</html>
