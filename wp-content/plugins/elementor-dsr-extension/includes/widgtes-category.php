<?php 
/**
 * Add Custom Widget Category
 * 
 */
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'elementor-dsr-extension',
		[
			'title' => 'DSR Extension',
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );