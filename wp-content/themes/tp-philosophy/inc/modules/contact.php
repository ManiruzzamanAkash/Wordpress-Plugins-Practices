<?php
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */
if ( ! function_exists( 'tp_philosophy_add_contact_section' ) ) :
    /**
     * Add contact section
     *
     * @since 0.1
     */

    function tp_philosophy_add_contact_section() {
        // Check if contact section is enabled on frontpage
        $contact_section_enable = apply_filters( 'tp_philosophy_section_status', true, 'contact_enable' );

        if ( true !== $contact_section_enable ) {
            return false;
        }

        // Render contact section
        tp_philosophy_render_contact_section();

    }
endif;
add_action( 'tp_philosophy_homepage_section_footer', 'tp_philosophy_add_contact_section', 10 );


if ( ! function_exists( 'tp_philosophy_render_contact_section' ) ) :
    /**
     * Start contact section
     *
     * @return string contact section content
     * @since 0.1
     *
     */
    function tp_philosophy_render_contact_section() {
        $options = tp_philosophy_get_theme_options();
        $content_type = $options['contact_content_type']; 

        switch ( $content_type ) {
            
            case 'custom':
                $contact_custom_title = ! empty( $options['contact_custom_title'] ) ? $options['contact_custom_title'] : '';
                $address_label     = ! empty( $options['contact_address_label'] ) ? $options['contact_address_label'] : '';
                $address_text     = ! empty( $options['contact_address'] ) ? $options['contact_address'] : '';
                $phone_label       = ! empty( $options['contact_phone_label'] ) ? $options['contact_phone_label'] : '';
                $phone_number     = ! empty( $options['contact_phone_number'] ) ? $options['contact_phone_number'] : '';
                $email_label       = ! empty( $options['contact_email_label'] ) ? $options['contact_email_label'] : '';
                $email_id         = ! empty( $options['contact_email'] ) ? $options['contact_email'] : '';
                $background_src   = ! empty( $options['contact_background_image'] ) ? $options['contact_background_image'] : '';
            break;

            default:
            break;
        }

        $background_style = '';
        if ( ! empty( $background_src ) ){
            $background_style = 'style="background-image: url('. esc_url( $background_src ) .')"';
        }
    ?>
    <section id="contact" class="col-2">
        <div class="row">
            <div class="column-wrapper" <?php echo $background_style; ?>>
                <div class="page-section">
                    <div class="black-overlay"></div>

                        <?php if ( ! empty( $contact_custom_title ) ) : ?>
                            <header class="entry-header text-center 'add-gray-border">
                                <?php
                                    if ( ! empty( $contact_custom_title ) ) {
                                        echo '<h2 class="entry-title color-white">'. esc_html( $contact_custom_title ) .'</h2>';
                                    }
                                ?>
                            </header><!--.entry-header-->
                        <?php endif; ?>

                        <div class="entry-content">
                            <ul class="address-block">
                                <?php if ( ! empty( $address_label ) || ! empty( $address_text ) ) : ?>
                                    <li class="address">
                                        <?php 
                                            echo '<i class="fa fa-map-marker"></i>';

                                            if ( ! empty( $address_label ) ){
                                                echo '<label>'. esc_html( $address_label ). '</label>';
                                            }

                                            if ( ! empty( $address_text ) ){
                                                echo '<span>'. esc_html( $address_text ) .'</span>';
                                            }
                                        ?>
                                    </li>
                                <?php endif; ?>

                                <?php if ( ! empty( $phone_label ) || ! empty( $phone_number ) ) : ?>
                                    <li class="phone">
                                        <?php 
                                            echo '<i class="fa fa-phone"></i>';

                                            if ( ! empty( $phone_label ) ) {
                                                echo '<label>'. esc_html( $phone_label ). '</label>';
                                            }
                                        
                                            if ( ! empty( $phone_number ) ) {
                                                echo '<span><a href="tel:'. esc_attr( preg_replace('/\D+/', '', $phone_number ) ) .'">'. esc_html( $phone_number ) .'</a></span>';
                                            }
                                        ?>
                                        
                                    </li>
                                <?php endif; ?>

                                <?php if ( ! empty( $email_label ) || ! empty( $email_id ) ) : ?>
                                    <li class="email">
                                        <?php 
                                            echo '<i class="fa fa-envelope"></i>';

                                            if ( ! empty( $email_label ) ){
                                                echo '<label>'. esc_html( $email_label ). '</label>';
                                            }

                                            if ( ! empty( $email_id ) ){
                                                echo '<span><a href="mailto:'. esc_url( $email_id ) .'">'. esc_html( $email_id ) .'</a></span>';
                                            }
                                        ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div><!--.entry-content-->
                </div><!-- .page-section -->
            </div><!--.column-wrapper-->

            <?php
                if( ! empty( $options['contact_form_shortcode'] ) ) { 
                ?>
                <div class="column-wrapper">
                    <div class="form-wrapper clear">
                
                        <?php 
                            echo do_shortcode( wp_kses_post( $options['contact_form_shortcode'] ) );
                        ?>
                    </div><!--form-wrapper-->
                </div><!--.column-wrapper-->
            <?php
                }
            ?>

        </div><!--.row-->
    </section><!-- #contact-->
    <?php 
    }
endif;