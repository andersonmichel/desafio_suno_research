<?php
/**
 * The site's entry point.
 *
 */

/**
 * Header Content
 * 
 */
get_header();

/**
 * Page Content
 * 
 */
while ( have_posts() ) { the_post();
	the_content(); 
}

/**
 * Footer Content
 * 
 */
get_footer();