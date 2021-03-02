<?php
/**
 * Team section
 *
 * This is the template for the content of team section
 *
 * @package Theme_Palace
 * @subpackage TP_Philosophy
 * @since 1.0
 */

if ( ! function_exists( 'tp_philosophy_add_team_section' ) ) :
    /**
     * Add team section
     *
     * @since 1.0
     */

    function tp_philosophy_add_team_section() {
        // Check if team section is enabled on frontpage
        $team_section_enable = apply_filters( 'tp_philosophy_section_status', true, 'teams_enable' );

        if ( true !== $team_section_enable ) {
            return false;
        }

        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'tp_philosophy_filter_teams_details', $section_details );


        if ( empty( $section_details ) ) {
          return;
        }

        // Render team section now.
        tp_philosophy_render_team_section( $section_details );
    }
endif;

add_action( 'tp_philosophy_homepage_section', 'tp_philosophy_add_team_section', 60 );

if ( ! function_exists( 'tp_philosophy_get_teams_section_details' ) ) :
    /**
     * Teams section details.
     *
     * @since TP Philosophy Pro 1.0
     * @param array $input Team section details.
     */

    function tp_philosophy_get_teams_section_details( $input ) {
        $options = tp_philosophy_get_theme_options();

        // Teams section type
        $teams_content_type = $options['teams_content_type'];
        $no_of_slides = 3;

        $content = array();

        switch ( $teams_content_type ) {
            case 'posts':

                $team_post_ids = ! empty( $options['teams_post_ids'] ) ? array_slice( $options['teams_post_ids'], 0, 5 ) :array(); // Get posts id
                // Bail if no posts id is entered
                if ( empty( $team_post_ids ) ) {
                    return;
                }

                $args = array(
                    'post_type'      => 'post',
                    'post__in'       => $team_post_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => absint( $no_of_slides ),
                );

                $team_posts = get_posts( $args );

                $i = 1;
                foreach ( $team_posts as $team_post ) {
                    $img_array = null;

                    if ( has_post_thumbnail( $team_post->ID ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $team_post->ID ), 'tp-philosophy-square-thumbnail' );
                    } else {
                        $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x300.jpg';
                    }

                    $content[$i]['img_array'] = $img_array;
                    $content[$i]['ID']        = $team_post->ID;
                    $content[$i]['url']       = get_permalink( $team_post->ID );
                    $content[$i]['member_name']     = get_the_title( $team_post->ID );
                    $content[$i]['position']  = '';

                    $i++;
                }
            break;

            case 'tp-philosophy-teams':

                $cpt_team_post_ids = ! empty( $options['cpt_teams_post_ids'] ) ? $options['cpt_teams_post_ids'] :array(); // Get posts id

                 // Bail if no posts id is entered
                if ( empty( $cpt_team_post_ids ) ) {
                    return;
                }

                $args = array(
                    'post_type'      => $teams_content_type,
                    'post__in'       => $cpt_team_post_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => absint( $no_of_slides ),
                );

                $cpt_team_posts = get_posts( $args );

                $i = 1;
                foreach ( $cpt_team_posts as $cpt_team_post ) {
                    $img_array = null;

                    if ( has_post_thumbnail( $cpt_team_post->ID ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $cpt_team_post->ID ), 'tp-philosophy-square-thumbnail' );
                    } else {
                        $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x300.jpg';
                    }
                    $team_post = get_post_meta( $cpt_team_post->ID, 'tp_philosophy_team_designation_value', true );

                    $content[$i]['img_array'] = $img_array;
                    $content[$i]['ID']        = $cpt_team_post->ID;
                    $content[$i]['url']       = get_permalink( $cpt_team_post->ID );
                    $content[$i]['member_name']     = get_the_title( $cpt_team_post->ID );
                    $content[$i]['position']  = !empty( $team_post ) ? $team_post : '';

                    $i++;
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
// teams course section content details.
add_filter( 'tp_philosophy_filter_teams_details', 'tp_philosophy_get_teams_section_details' );

if ( ! function_exists( 'tp_philosophy_render_team_section' ) ) :
    /**
     * Start team section
     *
     * @return string team section content
     * @since 1.0
     *
     */

    function tp_philosophy_render_team_section( $content_details ) { 
        $options = tp_philosophy_get_theme_options(); // Get theme options
        $team_title = !empty( $options['teams_custom_title'] ) ? $options['teams_custom_title'] : '';
        ?>
        <section id="team" class="page-section">
            <div class="wrapper">
                <?php if( !empty( $team_title ) ) : ?>
                    <header class="entry-header text-center">
                        <?php 
                            if( !empty( $team_title ) ){
                                echo '<h2 class="entry-title color-white">'. esc_html( $team_title ) .'</h2>';
                            }
                        ?>
                    </header><!-- entry-header -->
                <?php endif; ?>

                <div class="entry-content">
                    <div class="regular" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": false, "speed": 600, "dots": true, "arrows":false, "autoplay": true, "fade": false, "draggable":true }'>

                        <?php foreach ( $content_details as $content ): ?>
                            <div class="team-member">
                                <div class="team-slider">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['member_name'] ); ?>"></a>
                                    <div class="team-content">
                                        <?php if( !empty( $content['position'] ) ) { echo '<span>'. esc_html( $content['position'] ) .'</span>'; } ?>
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="team-name"><?php echo esc_html( $content['member_name'] ); ?></a>
                                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="more-link"><i class="fa fa-plus"></i></a>
                                    </div><!--.team-content-->
                              </div><!--.team-slider-->
                            </div><!-- .team-member -->
                        <?php endforeach; ?>

                    </div><!-- .regular -->
                </div><!--.entry-content-->
            </div><!--. wrapper -->
        </section><!-- #team -->
    <?php 
    }
endif;