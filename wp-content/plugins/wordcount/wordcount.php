<?php
/**
 * Plugin Name:       Word Count Plugin
 * Plugin URI:        https://wordpress.com/plugins/wordocunt/
 * Description:       Count the Post word
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Maniruzzaman akash
 * Author URI:        https://akash.devsenv.com
 * License:           GPL v2 or later
 * Text Domain:       word-count
 * Domain Path:       /languages
 */

function wordcount_activation_hook(){}
register_activation_hook(__FILE__, "wordcount_activation_hook");

function wordcount_deactivation_hook(){}
register_deactivation_hook(__FILE__, "wordcount_deactivation_hook");


function wordcount_load_textdomain(){
	load_plugin_textdomain('word-count', false, dirname(__FILE__)."/languages");
}
add_action ("plugins_loaded", "wordcount_load_textdomain");

function wordcount_count_words($content)
{
	$stripped_content = strip_tags($content);
	$word_number = str_word_count($stripped_content);
	$label = __('Total Number Of Words', 'word-count');
	$label = apply_filters("wordcoutn_heading", $label);
	$tag = apply_filters("wordcount_tag", 'h2');
	$content .= sprintf('<%s>%s: %s</%s>', $tag, $label, $word_number, $tag);
	return $content;
}
add_filter('the_content', 'wordcount_count_words');