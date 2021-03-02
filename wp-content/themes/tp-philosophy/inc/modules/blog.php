<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

if ( ! function_exists( 'tp_philosophy_add_blog_section' ) ) :
  /**
   * Add blog section
   *
   * @since 0.1
   */
  function tp_philosophy_add_blog_section() {

    // Check if blog section is enabled on frontpage
    $blog_section_enable = apply_filters( 'tp_philosophy_section_status', true, 'blogs_enable' );
    if ( true !== $blog_section_enable ) {
      return false;
    }

    // Get blog section details
    $section_details = array();
    $section_details = apply_filters( 'tp_philosophy_filter_blog_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render blog section now.
    tp_philosophy_render_blog_section( $section_details );
  }
endif;
add_action( 'tp_philosophy_homepage_section', 'tp_philosophy_add_blog_section', 90 );

if ( ! function_exists( 'tp_philosophy_get_blogs_section_details' ) ) :
  /**
   * Blogs section details.
   *
   * @since 0.1
   * @param array $input Blogs section details.
   */
    function tp_philosophy_get_blogs_section_details( $input ) {
        $options = tp_philosophy_get_theme_options();

        // blog section type
        $content_type = $options['blogs_content_type'];

        $content = array();
        switch ( $content_type ) {
            case 'category':
                $cat_ids = ! empty( $options['blogs_content_category'] ) ? $options['blogs_content_category'] : array(); // get blog categories

                // Bail if no valid categories are selected.
                if ( empty( $cat_ids ) ) {
                    return $input;
                }

                $args = array(
                    'category__in'        => $cat_ids,
                    'posts_per_page'      => 4,
                    'orderby'             => 'DESC',
                    'ignore_sticky_posts' => true
                );

                $category_posts = get_posts( $args );

                if( !empty( $category_posts ) ){
                    $i = 1;
                    foreach( $category_posts as $category_post ) :
                        $post_id   = $category_post->ID;
                        $author_id = $category_post->post_author;
                        $img_array = array();

                        if ( has_post_thumbnail( $post_id ) ) {
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'tp-philosophy-square-thumbnail' );
                        } else {
                            $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x300.jpg';
                        }   

                        $content[$i]['img_array'] = $img_array;
                        $content[$i]['url']       = get_permalink( $post_id );
                        $content[$i]['title']     = get_the_title( $post_id );
                        $content[$i]['excerpt']   = tp_philosophy_trim_content( 20, $category_post );
                        $content[$i]['post_date'] = get_the_date( '', $post_id );
                        $content[$i]['author']    = get_the_author_meta( 'display_name', $author_id );

                        $i++;
                    endforeach;
                }
            break;

            default:
            break;
        }

        if ( ! empty( $content ) ) {
          $input = $content;
        }
        return $input;
    }
endif;
// Blogs section content details.
add_filter( 'tp_philosophy_filter_blog_details', 'tp_philosophy_get_blogs_section_details' );


if ( ! function_exists( 'tp_philosophy_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog section content
   * @since 0.1
   *
   */
   function tp_philosophy_render_blog_section( $content_details ) {
        $options = tp_philosophy_get_theme_options(); // Get theme options

        $section_title    = ! empty( $options['blogs_title'] ) ? $options['blogs_title'] : ''; // Get blog section title
    ?>
        <section id="blog" class="page-section blog-text">
            <div class="wrapper">

                <?php if( ! empty( $section_title ) ) : ?>
                    <header class="entry-header text-center add-gray-border border-center">
                        <?php 
                            if( !empty( $section_title ) ){
                                echo '<h2 class="entry-title">'. esc_html( $section_title ) .'</h2>';
                            }
                        ?>
                    </header><!--.entry-header-->
                <?php endif; ?>

                <div class="entry-content col-4">
                    <div class="row blog-text">
                    <?php foreach( $content_details as $content ) : ?>
                        <div class="column-wrapper">
                            <?php
                                if( !empty( $content['img_array'] ) ){
                                    $blog_background_css = "style='background-image: url(". esc_url( $content['img_array'][0] ) .");'";
                                } else{
                                    $blog_background_css = '';
                                }
                            ?>
                            <div class="featured-image" <?php echo $blog_background_css; ?>>
                                <div class="blue-overlay"></div>
                                <div class="hover-content">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="view-more"><span data-hover="Read More"><?php esc_html_e( 'Read More', 'tp-philosophy' ); ?></span></a>
                                    <span class="link-more"></span>
                                </div><!--.hover-content-->
                            </div><!--.featured-image-->

                            <div class="blog-wrapper">
                                <div class="blog-content">
                                    <?php if( !empty( $content['title'] ) ){ ?>
                                        <h4><a href="<?php echo esc_url( $content['url'] );?>"><?php echo esc_html( $content['title'] ); ?></a></h4>
                                    <?php } ?>
                                    <div class="seperator"></div>
                                    <?php 
                                        if( !empty( $content['excerpt'] ) ) {
                                            echo '<p>'. esc_html( $content['excerpt'] ) .'</p>';
                                        }
                                    ?>
                                </div><!--.blog-content-->

                                <div class="article-entry-meta">
                                    <time><?php echo date_i18n( esc_html__( 'M d, Y', 'tp-philosophy' ), strtotime( $content['post_date'] ) );?></time>
                                      /
                                    <span><?php echo esc_html( $content['author'] ); ?></span>
                                </div><!--article / entry-meta-->
                            </div><!--.blog-wrapper-->
                        </div><!--.column-wrapper-->
                    <?php endforeach; ?>

                    </div><!--.row-->
                </div><!--.entry-content-->
            </div><!--.wrapper-->
        </section><!-- #blog -->
    <?php 
    }
endif;