<?php
/**
 * About section
 *
 * This is the template for the content of About section
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_add_about_section' ) ) :
    /**
     * Add About section
     *
     * @since 0.1
     */
    function tp_philosophy_add_about_section() {
        // Check if about section is enabled on frontpage

        $about_section_enable = apply_filters( 'tp_philosophy_section_status', true, 'about_enable' );

        if ( true !== $about_section_enable ) {
            return false;
        }

        // Get About section details
        $section_details = array();
        $section_details = apply_filters( 'tp_philosophy_filter_about_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render About section now.
        tp_philosophy_render_about_section( $section_details );
    }
endif;
add_action( 'tp_philosophy_homepage_section', 'tp_philosophy_add_about_section', 20 );

if ( ! function_exists( 'tp_philosophy_get_about_section_details' ) ) :
  /**
   * About section details.
   *
   * @since 0.1
   *
   * @param array $input about section details.
   */
   function tp_philosophy_get_about_section_details( $input ) {
        global $post;
        $options = tp_philosophy_get_theme_options();

        // About section options
        $about_content_type = $options['about_content_type'];

        $content = array();
        switch ( $about_content_type ){

            case 'pages':
                $page_id      = !empty ( $options['about_page_id'] ) ? absint( $options['about_page_id'] ) : '';

                if ( empty( $page_id  ) ) return; // Return if page id is empty

                $about_page = get_post( $page_id ); // Get post object by page id

                $content['title']           = get_the_title( $about_page->ID );
                $content['read_more_link']  = get_permalink( $about_page->ID );
                
                $content['thumbnail_image'] = array();
                
                if ( has_post_thumbnail( $about_page->ID ) ){
                    $content['thumbnail_image'] = wp_get_attachment_image_src( get_post_thumbnail_id( $about_page->ID ), 'tp-philosophy-about-thumbnail' );
                }

                $excerpt_length             = empty( $content['thumbnail_image'] ) ? 150 : 100 ;

                $content['description']     = tp_philosophy_trim_content( absint( $excerpt_length ), $about_page );
            break;

            default:
            break;
        }
                                                                                                                   
        if ( !empty( $content ) ) {
            $input = $content;
        }
        return $input;
  }
endif;
add_filter( 'tp_philosophy_filter_about_details', 'tp_philosophy_get_about_section_details' );

if ( ! function_exists( 'tp_philosophy_render_about_section' ) ) :
    /**
     * Start About section
     *
     * @return string about section content
     * @since 0.1
     *
     */
    function tp_philosophy_render_about_section( $content ) {
        $options = tp_philosophy_get_theme_options(); // get theme options

        $section_class      = ! empty( $content['thumbnail_image'] ) ? 'col-2' : 'col-1';
        
        $header_class       = ( 'col-2' == $section_class ) ? 'entry-header add-gray-border' : 'entry-header text-center add-gray-border border-center' ;

        $button_css         = ( 'col-2' == $section_class ) ? '' : 'center-align' ;
    ?>
        <section id="about" class="<?php echo esc_attr( $section_class ); ?> page-section">
            <div class="wrapper">
                <div class="row">
                    <div class="column-wrapper">
                    <?php if ( ! empty( $content['title'] ) ) : ?>
                        <header class="<?php echo esc_attr( $header_class ); ?>">
                        <?php 
                            if ( ! empty( $content['title'] ) ){
                                echo '<h2 class="entry-title">'. esc_html( $content['title'] ) .'</h2>';
                            } 
                        ?>
                        </header><!--.entry-header-->
                    <?php endif; ?>

                        <div class="entry-content">
                        <?php 
                            if ( ! empty( $content['description'] ) ){
                                echo '<p>'. esc_html( $content['description'] ) .'</p>';
                            }

                            echo '<a href="'. esc_url( $content['read_more_link'] ).'" class="view-more '. esc_attr( $button_css ) .'"><span data-hover="'. esc_attr__( 'View More', 'tp-philosophy' ) .'">'. esc_html__( 'View More', 'tp-philosophy' ) .'</span></a>';
                        ?>
                           
                            <div class="background-text">
                                <h1><?php echo esc_html( $content['title'] ); ?></h1>
                            </div><!-- .background-text -->
                        </div><!--.entry-content-->
                    </div><!--.column-wrapper-->

                    <?php if ( ! empty( $content['thumbnail_image'] ) ) : ?>
                        <div class="column-wrapper">
                            <div class="featured-image">
                                <a href="<?php echo esc_url( $content['read_more_link'] ); ?>"><img src="<?php echo esc_url( $content['thumbnail_image'][0] ); ?>" alt="<?php echo esc_html( $content['title'] ); ?>"></a>
                            </div><!--.featured-image-->
                        </div><!--.column-wrapper-->
                    <?php endif; ?>

                </div><!-- .row -->
            </div><!--.wrapper-->
        </section><!--#about-->

    <?php 
    }
endif;