<?php 
/**
 * Template part for displaying front page content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

 $options            = tp_philosophy_get_theme_options(); // get theme options
?>
    <div class="row">
        <div class="column-wrapper">
            <header class="entry-header text-center add-gray-border border-center">
                <?php 
                    the_title( '<h2 class="entry-title">', '</h2>' );
                ?>
            </header><!--.entry-header-->

            <div class="entry-content">
                <?php 
                    the_content( sprintf(
                        /* translators: %s: Name of current post. */
                        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tp-philosophy' ), array( 'span' => array( 'class' => array() ) ) ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ) );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tp-philosophy' ),
                        'after'  => '</div>',
                    ) );
                ?>

                <div class="background-text">
                    <?php the_title( '<h1>', '</h1>' ); ?>
                </div><!-- .background-text -->
            </div><!--.entry-content-->
        </div><!--.column-wrapper-->

        <div class="column-wrapper">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'tp-philosophy-about-thumbnail' ); ?></a>
            </div><!--.featured-image-->
            <?php endif; ?>
        </div><!--.column-wrapper-->
    </div><!-- .row -->