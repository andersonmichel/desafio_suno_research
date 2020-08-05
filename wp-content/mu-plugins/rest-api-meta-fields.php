<?php
/**
 * Rest API Register Meta Fields
 * 
 */
add_action( 'rest_api_init', function () {

    register_rest_field( 'beneficio', 'thumb', array(
        'get_callback' => function( $post ) {
            $featured_media = $post['featured_media'];
            $thumb = wp_get_attachment_url( $featured_media );
            return $thumb;
        },
    ));
    register_rest_field( 'beneficio', 'beneficio_logo_empresa', array(
        'get_callback' => function( $post ) {
            $logo_empresa = get_post_meta( $post['id'], 'beneficio_logo_empresa', true );
            $logo_empresa_url = wp_get_attachment_url( $logo_empresa );
            return $logo_empresa_url;
        },
    ));
    register_rest_field( 'beneficio', 'beneficio_url_empresa', array(
        'get_callback' => function( $post ) {
            return get_post_meta( $post['id'], 'beneficio_url_empresa', true );
        },
    ));
    register_rest_field( 'beneficio', 'beneficio_desconto', array(
        'get_callback' => function( $post ) {
            return get_post_meta( $post['id'], 'beneficio_desconto', true );
        },
    ));
} );