<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$thumbnail_image_src = tp_philosophy_get_thumbnail_source();

		if ( ! empty( $thumbnail_image_src ) ){
			echo '<a href="'. esc_url( get_permalink() ) .'"><img src="'. esc_url( $thumbnail_image_src ) .'"></a>';
		}
		
		the_content( sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tp-philosophy' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tp-philosophy' ),
			'after'  => '</div>',
		) );

		/**
		 * tp_philosophy_entry_footer Hook 
		 *  
		 * @hooked tp_philosophy_entry_footer 
		 */
		do_action( 'tp_philosophy_entry_footer' );
	?>
</article><!-- #post-## -->
