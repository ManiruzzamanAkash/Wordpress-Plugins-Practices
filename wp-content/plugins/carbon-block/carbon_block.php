<?php

/**
 * Plugin Name:       Carbon Block Plugin
 * Plugin URI:        https://wordpress.com/plugins/carbontest/
 * Description:       Generate a carbon block code
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Maniruzzaman akash
 * Author URI:        https://akash.devsenv.com
 * License:           GPL v2 or later
 * Text Domain:       post-to-qr-code
 * Domain Path:       /languages
 */

function carbontest_boot()
{
}
add_action('plugins_loaded', 'carbontest_boot');
