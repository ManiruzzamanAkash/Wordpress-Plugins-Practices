<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

get_header(); ?>

	<div class="wrapper page-section">
        <div id="primary" class="content-area col-3">
          	<main id="main" class="site-main blog-text" role="main">
            	<div class="row" id="infinite-scroll">

					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;

				echo '</div><!-- .row -->';

				/**
				* Hook - tp_philosophy_action_pagination.
				*
				* @hooked tp_philosophy_pagination 
				*/
				do_action( 'tp_philosophy_action_pagination' ); 
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
			if ( tp_philosophy_is_sidebar_enable() ) {
				get_sidebar();
			}
		?>
	</div><!-- .page-section -->

<?php
get_footer();
