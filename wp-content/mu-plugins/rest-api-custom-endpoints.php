<?php
/**
 * Rest API Register Custom Endpoints
 * 
 */
function dsr_register_beneficio_paginacao_output( $data ) {

    // Sanitize Params
    $categoria  = (int) $data['categoria'];
    $local      = (int) $data['local'];
    $orderby    = sanitize_text_field( $data['orderby'] );
    $order      = sanitize_text_field( $data['order'] );
    $limit      = (int) $data['limit'];
  
    // Get number page
    $paged = 1;

    // Query args
    $args = array(  
        'post_type' => 'beneficio',
        'post_status' => 'publish',
        'posts_per_page' => $limit, 
        'orderby' => $orderby, 
        'order' => $order, 
        'paged' => $paged,
    );

    // Get Tax Queries
    $tax_query = array( 'relation' => 'AND' );
    if( 0 != $categoria ){
        $tax_query[] = array(
            'taxonomy' => 'categoria_beneficio',
            'field' => 'term_id',
            'terms' => $categoria,
            'operator' => 'IN',
        );
    }
    if( 0 != $local ){
        $tax_query[] = array(
            'taxonomy' => 'local',
            'field' => 'term_id',
            'terms' => $local,
            'operator' => 'IN',
        );
    }

    // Merge Tax Queries
    if( count( $tax_query ) > 0 ){
        $args['tax_query'] = $tax_query;
    }

    $loop = new WP_Query( $args ); 

    while ( $loop->have_posts() ) { $loop->the_post(); }

    $paginacao = paginate_links( array(
        'current' => 1,
        'total' => $loop->max_num_pages
    ));
    
    $url = "/wp-json/beneficio_paginacao/v1/dsr/{$categoria}/{$local}/{$orderby}/{$order}/{$limit}";
    $paginacao = str_replace( $url, '', $paginacao); 

    $query_vars = "";
    if( 0 != $categoria || 0 != $local ) $query_vars .= '?';
    if( 0 != $categoria ) $query_vars .= "categoria={$categoria}"; 
    if( 0 != $categoria) $query_vars .= "&";  
    if( 0 != $local ) $query_vars .= "local_={$local}"; 

    if( '' != $query_vars){
        $paginacao = preg_replace( '/[page][\/][\d][\/]/', '$0' . $query_vars, $paginacao );
    }

    return array('data' => "<div class='numeros'>{$paginacao}</div>"); 
        
}
add_action( 'rest_api_init', function () {
    register_rest_route( 'beneficio_paginacao/v1', '/dsr/(?P<categoria>\d+)/(?P<local>\d+)/(?P<orderby>[a-z]+)/(?P<order>[a-z]+)/(?P<limit>\d+)', array(
      'methods' => 'GET',
      'callback' => 'dsr_register_beneficio_paginacao_output',
    ));
});