<?php

/**
 * Plugin Name:       Posts to QR Code Plugin
 * Plugin URI:        https://wordpress.com/plugins/wordocunt/
 * Description:       Generate a R Code to the post
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Maniruzzaman akash
 * Author URI:        https://akash.devsenv.com
 * License:           GPL v2 or later
 * Text Domain:       post-to-qr-code
 * Domain Path:       /languages
 */

function post_to_qrcode_activation_hook() //post_to_qrcode >> pqrc_
{
}
register_activation_hook(__FILE__, "post_to_qrcode_activation_hook");

function post_to_qrcode_deactivation_hook()
{
}
register_deactivation_hook(__FILE__, "post_to_qrcode_deactivation_hook");


function post_to_qrcode_load_textdomain()
{
    load_plugin_textdomain('post-to-qr-code', false, dirname(__FILE__) . "/languages");
}
add_action("plugins_loaded", "post_to_qrcode_load_textdomain");

function pqrc_display_qrcode($content)
{
    $current_post_id = get_the_ID();
    $current_post_title = get_the_title($current_post_id);
    $current_post_url = urlencode(get_the_permalink($current_post_id));
    $current_post_type = get_post_type($current_post_id);

    /**
     * Post Type Check
     */
    $excluded_post_tyeps = apply_filters('pqrc_exclude_post_types', array());
    if (in_array($current_post_type, $excluded_post_tyeps)) {
        return $content;
    }

    /**
     * Dimension
     */
    $width = get_option('pqrc_width');
    $height = get_option('pqrc_height');
    $width = $width ? $width : 100;
    $height = $height ? $height : 100;
    $dimension = apply_filters('pqrc_qrcode_dimension', "{$width}x{$height}");

    /**
     * Extra Image attribute like class
     */
    $attributes = apply_filters('pqrc_extra_attributes', null);

    $image_source = sprintf('https://api.qrserver.com/v1/create-qr-code/?data=%s&size=%s&margin=0', $current_post_url, $dimension);
    $content .= sprintf("<div class='qr-code'><img %s src='%s' alt='%s' /></div>", $attributes, $image_source, $current_post_title);
    return $content;
}
add_filter('the_content', 'pqrc_display_qrcode');

function pqrc_settings_init(){
    add_settings_section('pqrc_section', __('Posts to qr Code', 'post-to-qr-code'), 'pqrc_section_callback', 'general');

    add_settings_field('pqrc_width', __('qr Code Width', 'post-to-qr-code'), 'pqrc_display_field', 'general', 'pqrc_section', array('pqrc_width'));
    add_settings_field('pqrc_height', __('qr Code Height', 'post-to-qr-code'), 'pqrc_display_field', 'general', 'pqrc_section', array('pqrc_height'));
    add_settings_field('pqrc_select', __('Dropdown', 'post-to-qr-code'), 'pqrc_display_select_field', 'general', 'pqrc_section');
    add_settings_field('pqrc_checkbox', __('Multiple Checkbox', 'post-to-qr-code'), 'pqrc_display_checkbox_field', 'general', 'pqrc_section');

    register_setting('general', 'pqrc_height', array('sanitize_callback' => 'esc_attr'));
    register_setting('general', 'pqrc_width', array('sanitize_callback' => 'esc_attr'));
    register_setting('general', 'pqrc_select', array('sanitize_callback' => 'esc_attr'));
    register_setting('general', 'pqrc_checkbox');
}
function pqrc_section_callback(){
    echo "<p>".__('Settings for Post to qr code plugin', 'post-to-qr-code')."</p>";
}
function pqrc_display_field($args){
    $option = get_option($args[0]);
    printf("<input type='text' id='%s' name='%s' value='%s' />", $args[0], $args[0], $option);
}

function pqrc_display_checkbox_field(){
    $option = get_option('pqrc_checkbox');
    $countries = array(
        'Afganistan',
        'Bangladesh',
        'India',
        'Maldives',
        'Nepal',
        'Pakistan',
        'Srilanka',
        'Bhutan'
    );
    
    foreach ($countries as $country) {
        $selected = '';
        if(is_array($option) && in_array($country, $option)) {
            $selected = "checked";
        }
        printf('<input type="checkbox" name="%s" value="%s" %s /> %s<br />', 'pqrc_checkbox[]', $country, $selected, $country);
    }
}

function pqrc_display_select_field(){
    $option = get_option('pqrc_select');
    $countries = array(
        'None',
        'Afganistan',
        'Bangladesh',
        'India',
        'Maldives',
        'Nepal',
        'Pakistan',
        'Srilanka',
        'Bhutan'
    );
    
    printf('<select id="%s" name="%s" >', 'pqrc_select', 'pqrc_select');
    foreach ($countries as $country) {
        $selected = '';
        if($option == $country) {
            $selected = "selected";
        }
        printf('<option value="%s" %s>%s</option>', $country, $selected, $country);
    }
    printf('</select>');
}
add_action('admin_init', 'pqrc_settings_init');