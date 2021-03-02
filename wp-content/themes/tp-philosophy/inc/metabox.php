<?php

/**
 * TP Philosophy metabox file.
 *
 * This is the template that includes metaboxes of TP Philosophy theme
 *
 * @package Theme Palace
 * @subpackage TP Philosophy
 * @since TP Philosophy 0.1
 */
 
/**
 * Class to Renders and save metabox options
 *
 * @since TP Philosophy 0.1
 */
class TP_Philosophy_MetaBox {
    private $meta_box;

    private $fields;

    /**
    * Constructor
    *
    * @since TP Philosophy 0.1
    *
    * @access public
    *
    */
    public function __construct( $meta_box_id, $meta_box_title, $post_type ) {
        
        $this->meta_box = array (
                            'id'        => $meta_box_id,
                            'title'     => $meta_box_title,
                            'post_type' => $post_type,
                            );

        $this->fields = array(
                            'tp-philosophy-sidebar-position',
                            'tp-philosophy-selected-sidebar',
                            'tp-philosophy-header-image',
                            );


        // Add metaboxes
        add_action( 'add_meta_boxes', array( $this, 'add' ) );
        
        add_action( 'save_post', array( $this, 'save' ) );  
    }

    /**
    * Add Meta Box for multiple post types.
    *
    * @since TP Philosophy 0.1
    *
    * @access public
    */
    public function add($postType) {
        if( in_array( $postType, $this->meta_box['post_type'] ) ) {
            add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType, 'side' );
        }
    }

    /**
    * Renders metabox
    *
    * @since TP Philosophy 0.1
    *
    * @access public
    */
    public function show() {
        global $post;

        $layout_options         = tp_philosophy_sidebar_position();
        $sidebar_options        = tp_philosophy_selected_sidebar();
        $header_image_options   = tp_philosophy_header_image();
        
        // Use nonce for verification  
        wp_nonce_field( basename( __FILE__ ), 'tp_philosophy_custom_meta_box_nonce' );

        // Begin the field table and loop  ?>  
        <div id="philosophy-ui-tabs" class="ui-tabs">
            <ul class="philosophy-ui-tabs-nav" id="philosophy-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'tp-philosophy' ); ?></a></li>
                <li><a href="#frag3"><?php esc_html_e( 'Header Image Options', 'tp-philosophy' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Select Sidebar', 'tp-philosophy' ); ?></a></li>
            </ul> 
            <div id="frag1" class="catch_ad_tabhead">
                <table id="layout-options" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <select name="tp-philosophy-sidebar-position" id="custom_element_grid_class">
                                <option value=""><?php esc_html_e( 'Default ( to customizer option )', 'tp-philosophy' ); ?></option>
                                <?php  
                                    $metalayout = get_post_meta( $post->ID, 'tp-philosophy-sidebar-position', true );
                                    if( empty( $metalayout ) ){
                                        $metalayout='';
                                    }
                                    foreach ( $layout_options as $field => $value ) {  
                                ?>
                                    <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $metalayout, $field ); ?>><?php echo esc_html( $value ); ?></option>
                                <?php
                                } // end foreach 
                                ?>
                            </select>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <?php
                            $metasidebar = get_post_meta( $post->ID, 'tp-philosophy-selected-sidebar', true );
                            if ( empty( $metasidebar ) ){
                                $metasidebar='sidebar-1';
                            }

                            foreach ( $sidebar_options as $field => $value ) {  
                                ?>
                                <td style="vertical-align: top;">
                                    <label class="description">
                                        <input type="radio" name="tp-philosophy-selected-sidebar" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                                <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

            <div id="frag3" class="catch_ad_tabhead">
                <table id="header-image-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>                
                            <?php  
                            $metaheader = get_post_meta( $post->ID, 'tp-philosophy-header-image', true );
                            if ( empty( $metaheader ) ){
                                $metaheader='';
                            }
                            foreach ( $header_image_options as $field => $value ) { 
                            ?>
                                <td style="width: 100px;">
                                    <label class="description">
                                        <input type="radio" name="tp-philosophy-header-image" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metaheader ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php 
    }

    /**
     * Save custom metabox data
     * 
     * @action save_post
     *
     * @since TP Philosophy 0.1
     *
     * @access public
     */
    public function save( $post_id ) { 
    
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'tp_philosophy_custom_meta_box_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'tp_philosophy_custom_meta_box_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }
      
        foreach ( $this->fields as $field ) {      
            // Checks for input and sanitizes/saves if needed
            if( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        } // end foreach         
    }
}

$tp_philosophy_metabox = new TP_Philosophy_MetaBox( 
                                    'tp-philosophy-options',                  //metabox id
                                    esc_html__( 'TP Philosophy Meta Options', 'tp-philosophy' ), //metabox title
                                    array( 'page', 'post' )             //metabox post types
                                    );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_enqueue_script, and  wp_enqueue_style
 *
 * @since 0.1
 */
function tp_philosophy_enqueue_metabox_scripts( $hook ) {
    if( $hook == 'post.php' || $hook == 'post-new.php'  ){
        //Scripts
        wp_enqueue_script( 'tp-philosophy-metabox', get_template_directory_uri() . '/assets/js/metabox.min.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
        //CSS Styles
        wp_enqueue_style( 'tp-philosophy-metabox-tabs', get_template_directory_uri() . '/assets/css/metabox-tabs.min.css' );
    }
    return;
}
add_action( 'admin_enqueue_scripts', 'tp_philosophy_enqueue_metabox_scripts', 11 );