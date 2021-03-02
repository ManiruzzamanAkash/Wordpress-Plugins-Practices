<?php
/**
 * Slider section
 *
 * This is the template for the content of Slider section
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */
if ( ! function_exists( 'tp_philosophy_add_slider_section' ) ) :
    /**
     * Add Slider section
     *
     * @since 0.1
     */
    function tp_philosophy_add_slider_section() {
        // Check if Slider is enabled on frontpage
        $slider_enable = apply_filters( 'tp_philosophy_section_status', true, 'slider_enable' );

        if ( true !== $slider_enable ) {
          return false;
        }

        // Get Slider section details
        $section_details = array();
        $section_details = apply_filters( 'tp_philosophy_filter_slider_details', $section_details );

        if ( empty( $section_details ) ) {
          return;
        }

        // Render Slider section now.
        tp_philosophy_render_slider_section( $section_details );
    }
endif;
add_action( 'tp_philosophy_homepage_section', 'tp_philosophy_add_slider_section', 10 );


if ( ! function_exists( 'tp_philosophy_get_slider_section_details' ) ) :
    /**
     * Slider section details.
     *
     * @since 0.1
     * @param array $input Slider section details.
     */
    function tp_philosophy_get_slider_section_details( $input ) {
        $options = tp_philosophy_get_theme_options();

        // Slider type
        $slider_content_type = $options['slider_content_type'];

        $content = array();
        switch ( $slider_content_type ) {

            case 'pages':
                $page_ids      = array(); // set empty array of pages id

                for( $i = 1; $i <= 3; $i++ ){
                    if( !empty( $options['slider_page_id_'. $i ] ) ){
                        $post_id    = ! empty ( $options['slider_page_id_' . $i] ) ? absint( $options['slider_page_id_' . $i] ) : '';
                        $page_ids  = array_merge( $page_ids, array( $post_id ) );
                    }
                }

                // Bail if no valid pages are selected.
                if ( empty( $page_ids ) ) {
                    return $input;
                }

                $args = array(
                    'post_type'      => 'page',
                    'post__in'       => $page_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => 3,
                );

                $pages = get_posts( $args ); // get pages 

                $i = 1;
                foreach ( $pages as $page ) {

                    $page_id   = $page->ID;
                    $img_array = null;

                    if ( has_post_thumbnail( $page_id ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
                    } else {
                        $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-1920x1080.jpg';
                    }

                    if ( isset( $img_array ) ) {
                        $content[$i]['img_array'] = $img_array;
                    }

                    $content[$i]['url']        = get_permalink( $page_id );
                    $content[$i]['title']      = get_the_title( $page_id );

                $i++;
                }
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
// Slider section content details.
add_filter( 'tp_philosophy_filter_slider_details', 'tp_philosophy_get_slider_section_details' );


if ( ! function_exists( 'tp_philosophy_render_slider_section' ) ) :
    /**
     * Start Slider section
     *
     * @return string Slider content
     * @since 0.1
     *
     */
    function tp_philosophy_render_slider_section( $content_details ) {

        if ( empty( $content_details ) ) {
            return;
        }

        $options         = tp_philosophy_get_theme_options(); // get theme options
        
        $content_type    = $options['slider_content_type'];
        $slider_effect   = ! empty( $options['slider_content_effect'] ) ? $options['slider_content_effect'] : 'cubic-bezier(0.250, 0.100, 0.250, 1.000)';
        $enable_pager    = ( $options['enable_slider_pager'] == true ) ? 'true' : 'false';

        $data_slick_value = '{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": '. esc_attr( $enable_pager ) .', "autoplay": true, "pauseOnHover": true, "arrows": true, "draggable": true, "fade": false }';
        $btn_label = ! empty( $options['slider_btn_label'] ) ? $options['slider_btn_label'] : 'Get Started';
    ?>
        <section id="main-slider" class="align-center main-featured-slider" data-effect="<?php echo esc_attr( $slider_effect ); ?>" data-slick=<?php echo "'" . $data_slick_value . "'"; ?>>
        <?php foreach ( $content_details as $content ) : ?>
            <div class="slider-item" style="background-image: url('<?php echo esc_url( $content['img_array'][0] ); ?>');">
                <div class="black-overlay"></div>
                <div class="main-slider-contents add-border wrapper">
                    <?php 
                        $content_title = $content['title'];
                        
                        if ( ! empty( $content_title ) ){
                            echo '<h1>'. esc_html( $content_title ) .'</h1>';
                        }

                        echo '<a href="'. esc_url( $content['url'] ) .'" class="btn btn-fill">'. esc_html( $btn_label ) .'</a>';
                    ?>
                </div><!--.main-slider-->
            </div><!-- .slider-item -->
        <?php endforeach; ?>
        </section><!-- #main-slider -->
    <?php 
    }
endif;