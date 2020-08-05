<?php
/**
 * Change Benefício Title Placeholder 
 *
 */
function dsr_change_beneficio_title_placeholder( $title ){
    
    $screen = get_current_screen();

    if  ( 'beneficio' == $screen->post_type ) {
         $title = 'Nome da empresa';
    }
 
    return $title;
}
add_filter( 'enter_title_here', 'dsr_change_beneficio_title_placeholder' );