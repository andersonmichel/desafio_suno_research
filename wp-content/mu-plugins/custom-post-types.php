<?php
/**
 * Custom Post Types
 *
 */
 
/**
 * The custom function to register "beneficio" post type
 * 
 */
function dsr_custom_post_types() {
 
  $labels = array(
    'name'               => 'Benefícios',
    'singular_name'      => 'Benefício',
    'add_new'            => 'Adicionar novo',
    'add_new_item'       => 'Adicionar Novo Benefício',
    'edit_item'          => 'Editar Benefício',
    'new_item'           => 'Novo Benefício',
    'all_items'          => 'Todos os Benefícios',
    'view_item'          => 'Visualizar Benefício',
    'search_items'       => 'Buscar Benefícios',
    'featured_image'     => 'Imagem ilustrativa',
    'set_featured_image' => 'Adicionar Imagem'
  );
 
  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor', 'thumbnail' ),
    'has_archive'       => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'show_in_rest'      => true,
    'rest_base'         => 'beneficios',
    'has_archive'       => true,
    'query_var'         => 'beneficio',
    'menu_icon'         => 'dashicons-clipboard'
  );
 
  register_post_type( 'beneficio', $args);
}
add_action( 'init', 'dsr_custom_post_types' );