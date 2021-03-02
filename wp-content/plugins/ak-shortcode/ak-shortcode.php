<?php

/**
 * Plugin Name:       Short Code Generator
 * Plugin URI:        https://wordpress.com/plugins/ak-shortcode/
 * Description:       Short Code Generator
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Maniruzzaman akash
 * Author URI:        https://akash.devsenv.com
 * License:           GPL v2 or later
 * Text Domain:       ak-shortcode
 * Domain Path:       /languages
 */

function tp_philosophy_button($attributes)
{
    $is_outline = isset($attributes['is_outline']) ? 'is-style-outline' : '';

    return sprintf(
        '<div class="wp-block-button %s">
          <a class="wp-block-button__link button-%s" href="%s">%s</a>
        </div>',
        $is_outline,
        $attributes['type'],
        $attributes['url'],
        $attributes['title'],
    );
}
add_shortcode('button', 'tp_philosophy_button');



function tp_philosophy_button2($attributes, $content)
{
    $is_outline = isset($attributes['is_outline']) ? 'is-style-outline' : '';

    return sprintf(
        '<div class="wp-block-button %s">
          <a class="wp-block-button__link button-%s" href="%s">%s</a>
        </div>',
        $is_outline,
        $attributes['type'],
        $attributes['url'],
        do_shortcode($content),
    );
}
add_shortcode('button2', 'tp_philosophy_button2');

function tp_philosophy_google_map($attributes){
    $default = array(
        'place' => 'Dhaka Museum',
        'width'=>'800',
        'height'=>'500',
        'zoom'=>'14'
    );

    $params = shortcode_atts($default, $attributes);

    $map = <<<EOD
    <div>
        <div>
            <iframe width="{$params['width']}" height="{$params['height']}"
                    src="https://maps.google.com/maps?q={$params['place']}&t=&z={$params['zoom']}&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
            </iframe>
        </div>
    </div>
    EOD;

    return $map;
}
add_shortcode('gmap', 'tp_philosophy_google_map');