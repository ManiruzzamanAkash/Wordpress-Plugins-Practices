<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

get_header(); 
if ( true === apply_filters( 'tp_philosophy_filter_frontpage_content_enable', true ) ) : 

	if ( is_front_page() && ! is_home() ) { 
			$section_class = has_post_thumbnail() ? 'col-2' : 'col-1';
		?>
		<section id="front-page" class="<?php echo esc_attr( $section_class ); ?> page-section">
	        <div class="wrapper">
	          	<?php 
	          		while ( have_posts() ) : the_post();
	          			get_template_part( 'template-parts/content', 'front-page' );
	          		endwhile;
	          	?>
	        </div><!--.wrapper-->
    	</section><!--#front-page-->
	<?php } else { ?>

	    <div class="wrapper page-section">
	        <div id="primary" class="content-area">
	          	<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// Check if page is not homepage
						if( !( is_front_page() && !is_home() ) ){
							// If comments are open or we have at least one comment, load up the comment template.

							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						}

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php
				if ( tp_philosophy_is_sidebar_enable() ) {
					get_sidebar();
				}
			?>
		</div><!-- .wrapper -->
<?php
	}
endif;
get_footer();
