<?php
/**
 * Custom Meta Fields
 *
 */

/**
 * Add Benefício Custom Metabox 
 *
 */
function dsr_add_beneficio_custom_meta_box()
{
    add_meta_box(
        'dsr_box_geral',                  // Unique ID
        'Geral',                          // Box title
        'dsr_beneficio_custom_box_html',  // Content callback, must be of type callable
        'beneficio',                      // Post type
    );
}
add_action('add_meta_boxes', 'dsr_add_beneficio_custom_meta_box');

/**
 * Custom Metabox HTML
 * 
 */
function dsr_beneficio_custom_box_html( $post )
{ 
    $beneficio_logo_empresa     = get_post_meta( $post->ID, 'beneficio_logo_empresa', true );
    $beneficio_url_empresa      = get_post_meta( $post->ID, 'beneficio_url_empresa', true );
    $beneficio_desconto = get_post_meta( $post->ID, 'beneficio_desconto', true );
    wp_nonce_field( 'dsr_save_beneficio_data', 'dsr_nonce' ); 
    ?>

        <label for="beneficio_logo_empresa" style="margin-bottom: 7px; display: block">*Logotipo da empresa:</label>

        <img id="img_beneficio_logo_empresa" width="100" src="<?php if( '' != $beneficio_logo_empresa ){ echo wp_get_attachment_image_url( $beneficio_logo_empresa ); }?>" />
        <input id="beneficio_logo_empresa" type="hidden" class="regular-text" name="beneficio_logo_empresa" value="<?php echo esc_attr( $beneficio_logo_empresa ); ?>">
        
        <button class="set_custom_image button">Selecionar imagem</button>
        <button class="remove_custom_image button" <?php if( '' == $beneficio_logo_empresa ){ ?>style="display: none"<?php } ?> >Remover</button>
        
        <script>
            jQuery(document).ready(function() {
                var $ = jQuery;
                if ($('.set_custom_image').length > 0) {
                    if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
                        // Btn Selecionar imagem
                        $('.set_custom_image').on('click', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var button_remove = $(".remove_custom_image");
                            var input = $("#beneficio_logo_empresa");
                            var img = $("#img_beneficio_logo_empresa");
                            wp.media.editor.send.attachment = function(props, attachment) { //console.log(attachment);
                                input.val(attachment.id);
                                img.attr("src", attachment.url);
                                button_remove.css("display", "");
                            };
                            wp.media.editor.open(button);
                            return false;
                        });
                        // Btn Selecionar Remover
                        $('.remove_custom_image').on('click', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var input = $("#beneficio_logo_empresa");
                            var img = $("#img_beneficio_logo_empresa");
                            input.val("");
                            img.attr("src", "");
                            button.css("display", "none");
                            return false;
                        });
                    }
                }
            });
        </script>

        <p>
            <label for="beneficio_url_empresa" style="margin-bottom: 7px; display: block">*URL da empresa:</label>
            <input type="text" class="regular-text" name="beneficio_url_empresa" value="<?php echo esc_attr( $beneficio_url_empresa ); ?>">
        </p>

        <p>
            <label for="beneficio_desconto" style="margin-bottom: 7px; display: block">*Porcentagem de desconto:</label>
            <input type="text" name="beneficio_desconto" value="<?php echo esc_attr( $beneficio_desconto ); ?>">
        </p>
        
    <?php
}

/**
 * Save Meta Fields
 * 
 */
function dsr_save_beneficio_data( $post_id ){

    // Check if nounce exists
    if( ! isset( $_POST['dsr_nonce'] ) ){
        return;
    }
    // Check if nounce is valid
    if( ! wp_verify_nonce( $_POST['dsr_nonce'], 'dsr_save_beneficio_data' ) ){
        return;
    }
    // Check if it is not doing autosave
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    // Check user permission
    if( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // Save logo
    $beneficio_logo_empresa = trim( $_POST['beneficio_logo_empresa'] );
    if( '' == $beneficio_logo_empresa ){ 
        add_filter('redirect_post_location', function( $location ) {
            return add_query_arg( 'error', 0, $location );
        }); 
        return;
    }else{
        update_post_meta( $post_id, 'beneficio_logo_empresa', sanitize_text_field( $beneficio_logo_empresa ) );
    }

    // Validate beneficio_url_empresa
    $beneficio_url_empresa = trim( $_POST['beneficio_url_empresa'] );
    if( '' == $beneficio_url_empresa ){ 
        add_filter('redirect_post_location', function( $location ) {
            return add_query_arg( 'error', 1, $location );
        }); 
        return;
    }else{
        update_post_meta( $post_id, 'beneficio_url_empresa', sanitize_text_field( $beneficio_url_empresa ) );
    }

    // Validate beneficio_desconto
    $beneficio_desconto = trim( $_POST['beneficio_desconto'] );
    if( '' == $beneficio_desconto ){
        add_filter('redirect_post_location', function( $location ) {
            return add_query_arg( 'error', 2, $location );
        }); 
        return;
    }elseif( ! ( 0 < (int) $beneficio_desconto && 100 > $beneficio_desconto ) ){
        add_filter('redirect_post_location', function( $location ) {
            return add_query_arg( 'error', 3, $location );
        }); 
        return;
    }else{
        update_post_meta( $post_id, 'beneficio_desconto', (int) $beneficio_desconto );
    }

}
add_action( 'save_post_beneficio', 'dsr_save_beneficio_data' );

/**
 * Benefício Error Handling
 * 
 */
if ( isset( $_GET['error'] ) ) {
    function dsr_beneficio_error_messages(){
        ?>
            <div class="error">
                <p>
                    <?php 
                        if( 0 == $_GET['error'] ){
                            echo 'O campo <strong>Logotipo da empresa</strong> é obrigatório';
                        }elseif( 1 == $_GET['error'] ){
                            echo 'O campo <strong>URL da empresa</strong> é obrigatório';
                        }elseif( 2 == $_GET['error'] ){
                            echo 'O campo <strong>Porcentagem de desconto</strong> é obrigatório';
                        }
                        if( 3 == $_GET['error'] ){
                            echo 'O campo <strong>Porcentagem de desconto</strong> deve ser um número inteiro válido';
                        }
                    ?>
                </p>
            </div>
        <?php
    }
    add_action( 'admin_notices', 'dsr_beneficio_error_messages' );
}
