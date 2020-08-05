<?php
/**
 * Custom Meta Fields
 *
 */

/**
 * Categoria Benefício Add Form HTML
 *
 */
function dsr_categoria_beneficio_add_meta_field() {
    ?>
        <div class="form-field">
            <label for="cor">Cor</label>
            <input type="text" name="cor" id="cor" class="color-picker" value="">
            <p class="description"></p>
        </div>
        <script>
            jQuery(document).ready(function() {
                var $ = jQuery;
                $('.color-picker').wpColorPicker();
            });
        </script>
    <?php
}
add_action( 'categoria_beneficio_add_form_fields', 'dsr_categoria_beneficio_add_meta_field' );
  
/**
 * Categoria Benefício Edit Form HTML
 * 
 */
function dsr_categoria_beneficio_edit_meta_field( $term ) {
  
    $term_id = $term->term_id;
    $cor = esc_attr( get_term_meta( $term_id, 'cor', true ) );
  
    ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="cor">Cor</label>
            </th>
            <td>
                <input type="text" name="cor" id="cor" class="color-picker" value="<?php echo $cor; ?>">
                <p class="description"></p>

                <script>
                    jQuery(document).ready(function() {
                        var $ = jQuery;
                        $('.color-picker').wpColorPicker();
                    });
                </script>
            </td>
        </tr>
    <?php 
}
add_action( 'categoria_beneficio_edit_form_fields', 'dsr_categoria_beneficio_edit_meta_field' );

/**
 * Save Meta Field
 * 
 */
function dsr_save_categoria_beneficio_meta( $term_id ) {

    if ( isset( $_POST['cor'] ) ) {
        $cor = sanitize_text_field( trim( $_POST['cor'] ) );
        update_term_meta( $term_id, 'cor', $cor );
    }

}
add_action( 'edited_categoria_beneficio', 'dsr_save_categoria_beneficio_meta' );
add_action( 'created_categoria_beneficio', 'dsr_save_categoria_beneficio_meta' );

/**
 * Load Color-Picker Scripts
 * 
 */
function my_plugin_admin_scripts($hook) {
    if( is_admin() ) { 
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
        // Include custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
     }
}
add_action( 'admin_enqueue_scripts',  'my_plugin_admin_scripts' );