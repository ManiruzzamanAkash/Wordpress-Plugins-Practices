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
    $dimension = apply_filters('pqrc_qrcode_dimension', '220x220');

    /**
     * Extra Image attribute like class
     */
    $attributes = apply_filters('pqrc_extra_attributes', null);

    $image_source = sprintf('https://api.qrserver.com/v1/create-qr-code/?data=%s&size=%s&margin=0', $current_post_url, $dimension);
    $content .= sprintf("<div class='qr-code'><img %s src='%s' alt='%s' /></div>", $attributes, $image_source, $current_post_title);
    return $content;
}
add_filter('the_content', 'pqrc_display_qrcode');
