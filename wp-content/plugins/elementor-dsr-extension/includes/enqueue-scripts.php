<?php
/**
 * Enqueue Scripts and Styles
 * 
 */
function elementor_dsr_extension_enqueue_scripts() {
	wp_enqueue_script( 
		'elementor-dsr-extension-script', 
		site_url() . '/wp-content/plugins/elementor-dsr-extension/dist/js/bundle-min.js', 
		array(),
		'1.0.0',
		true 
	);
	wp_enqueue_style(
		'elementor-dsr-extension-style',
		site_url() . '/wp-content/plugins/elementor-dsr-extension/dist/css/stylesheet.css',
		array(),
		'1.0.0'
	);
	wp_localize_script( 'elementor-dsr-extension-script', 'dsr', 
		  	array( 
				'site_url' => site_url()
			) 
	);
}
add_action( 'wp_enqueue_scripts', 'elementor_dsr_extension_enqueue_scripts');