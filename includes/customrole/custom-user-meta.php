<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
/*
 * Backend User Custom Meta
 */
function esbwoodemo_extra_user_profile_fields( $user ) {
?>
    <h3><?php _e("Tax Certificate Information", "esbwoodemo"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="tax_cer_no"><?php _e("Tax Certificate Number"); ?></label></th>
            <td>
                <input type='text' name='tax_cer_no' value='<?php echo get_the_author_meta( 'tax_cer_no', $user->ID ); ?>' style='width:40%;' class='woocomtest-tax-cer-no'/>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <tr>
            <th><label for="tax_cer_img"><?php _e("Tax Certificate Document"); ?></label></th>
            <td>
                <div class='file-input-advanced'>
                <input type='text' name='tax_cer_img' value='<?php echo get_the_author_meta( 'tax_cer_img', $user->ID ); ?>' style='width:40%;' class='esbwoodemo-upload-file-link' placeholder='http://'/>
                <span class='esbwoodemo-upload-files'><a class='esbwoodemo-upload-fileadvanced button' href='javascript:void(0);'><?php _e( 'Upload','esbwoodemo') ?></a></span>
                <a href="<?php echo get_the_author_meta( 'tax_cer_img', $user->ID ); ?>" target="_blank"><?php _e('View Certificate','esbwoodemo'); ?></a>
                </div>
            </td>
        </tr>
    </table>
<?php }
add_action( 'show_user_profile', 'esbwoodemo_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'esbwoodemo_extra_user_profile_fields' );
/*
 * Save User Custom Meta
 */
function esbwoodemo_save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
    update_user_meta( $user_id, 'tax_cer_img', $_POST['tax_cer_img'] );
    update_user_meta( $user_id, 'tax_cer_no', $_POST['tax_cer_no'] );
}
add_action( 'personal_options_update', 'esbwoodemo_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'esbwoodemo_save_extra_user_profile_fields' );
?>