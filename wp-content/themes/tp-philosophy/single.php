<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

do_action('tp_philosophy_action_before_post_article', get_the_title());

get_header(); ?>

    <div class="wrapper page-section">
        <div id="primary" class="content-area">
          	<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

					/**
					* Hook tp_philosophy_action_post_pagination
					*  
					* @hooked tp_philosophy_post_pagination 
					*/
					do_action( 'tp_philosophy_action_post_pagination' );
					
					/**
					* Hook tp_philosophy_author_profile
					*  
					* @hooked tp_philosophy_get_author_profile 
					*/
					do_action( 'tp_philosophy_author_profile' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

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
get_footer();
