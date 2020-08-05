<?php
/**
 * Theme functions and definitions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue Theme Father and Theme Child Style
 * 
 */
function desafio_suno_research_child_enqueue_scripts() {
	wp_enqueue_script( 'jquery-ui-mouse', false, array( 'jquery' ) );
	wp_enqueue_style( 
		'father-style',  
		get_template_directory_uri() . '/style.css',
		array(),
		'1.0.0',
	);
	wp_enqueue_style(
		'desafio-suno-research-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array('father-style'),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'desafio_suno_research_child_enqueue_scripts');

