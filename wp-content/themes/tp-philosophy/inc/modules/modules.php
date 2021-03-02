<?php
/**
 * Add TP Philosophy Theme modules
 *
 * This is the template that includes all featured modules of TP Philosophy Theme
 *
 * @package Theme_Palace
 * @subpackage TP Philosophy
 * @since 0.1
 */

// Add featured category section
require get_template_directory() .'/inc/modules/slider.php';

// Add about section
require get_template_directory() .'/inc/modules/about.php';

// Add blog section
require get_template_directory() .'/inc/modules/blog.php';

// Add team section
require get_template_directory() .'/inc/modules/team.php';

// Add contact section
require get_template_directory() .'/inc/modules/contact.php';