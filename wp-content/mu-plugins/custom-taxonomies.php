<?php
/**
 * Taxonomies
 *
 */

// Init action hook
add_action( 'init', 'dsr_custom_taxonomies' );
 
/**
 * The custom function to register "categoria_beneficio" and "local" taxonomies
 * 
 */
function dsr_custom_taxonomies() {
 
  /**
   * categoria_benefico taxonomie
   */
  $labels = array(
    'name' => 'Categorias',
    'singular_name' => 'Categoria',
    'search_items' =>  'Buscar Categorias',
    'all_items' => 'Todas as Categorias',
    'parent_item' => 'Categoria Pai',
    'parent_item_colon' => 'Categoria Pai:',
    'edit_item' => 'Editar Categoria', 
    'update_item' => 'Atualizar Categoria',
    'add_new_item' => 'Adicionar nova Categoria',
    'menu_name' => 'Categorias',
  ); 	

  register_taxonomy('categoria_beneficio', array('beneficio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
 
  /**
   * local taxonomie
   */
  $labels = array(
    'name' => 'Locais de cobertura',
    'singular_name' => 'Local de cobertura',
    'search_items' =>  'Buscar Locais de cobertura',
    'all_items' => 'Todos os Locais',
    'parent_item' => 'Local de cobertura Pai',
    'parent_item_colon' => 'Local de cobertura Pai:',
    'edit_item' => 'Editar Local de cobertura', 
    'update_item' => 'Atualizar Local de cobertura',
    'add_new_item' => 'Adicionar novo Local de cobertura',
    'menu_name' => 'Locais',
  ); 	

  register_taxonomy('local', array('beneficio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}