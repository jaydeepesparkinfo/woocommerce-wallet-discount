<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Dokan Registration Add Role Trader
 */
function esbwoodemo_dokan_seller_registration_errors_add( $error ) {
    $allowed_roles  = apply_filters( 'dokan_register_user_role', array( 'customer', 'seller','trader' ) );
    $role           = $_POST['role'];
    
    if ( isset( $_POST['role'] ) && !in_array( $_POST['role'], $allowed_roles ) ) {
        return new WP_Error( 'role-error', __( 'Cheating, eh?', 'esbwoodemo' ) );
    }
    $first_name     = trim( $_POST['first_name'] );
    $last_name      = trim( $_POST['first_name'] );
    if ( empty( $first_name ) ) {
            return new WP_Error( 'trader_fname-error', __( 'Please enter your first name.', 'esbwoodemo' ) );
    }
    if ( empty( $last_name ) ) {
            return new WP_Error( 'trader_lname-error', __( 'Please enter your last name.', 'esbwoodemo' ) );
    }
    
    //Trader Field Validation
    if ( $role == 'trader' ) {
        $tax_cer_no     = trim( $_POST['tax_cer_no'] );
        $tax_cer_img    = ( $_FILES['tax_cer_img'] );
        if ( empty( $tax_cer_no ) ) {
            return new WP_Error( 'tax_cer_img-error', __( 'Please enter Tax Cerificate No.', 'esbwoodemo' ) );
        }
        if ( empty( $tax_cer_img ) ) {
            return new WP_Error( 'tax_cer_img-error', __( 'Please enter Tax Cerificate.', 'esbwoodemo' ) );
        }
    }
    return $error;
}

/*
 * Add Dokan New Customer Data
 */
function esbwoodemo_dokan_new_customer_data_add( $data ) {
    $allowed_roles  = array( 'customer', 'seller', 'trader' );
    $role           = ( isset( $_POST['role'] ) && in_array( $_POST['role'], $allowed_roles ) ) ? $_POST['role'] : 'seller';

    $data['role']       = $role;
    $data['first_name'] = strip_tags( $_POST['first_name'] );
    $data['last_name']  = strip_tags( $_POST['last_name'] );
    
    
    if ( $role == 'trader' ) {      
        $data['tax_cer_no']         = strip_tags( $_POST['tax_cer_no'] );
        $data['tax_cer_img']        = strip_tags( $_POST['tax_cer_img'] );
    }
    return $data;
}

/*
 * Add Custom Registration Field
 */
function esbwoodemo_dokan_add_registration_fields() {
    //Get and set any values already sent
    $role       = isset( $_POST['role'] ) ? $_POST['role']  : 'seller';
    $role_style = ( $role == 'seller' ) ? ' style="display:none"' : '';
?>
        <p class="form-row form-row-wide">
            <label for="first_name"><?php _e( 'First Name', 'esbwoodemo' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="first_name" id="first_name" />
        </p>
        <p class="form-row form-row-wide">
            <label for="last_name"><?php _e( 'Last Name', 'esbwoodemo' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="last_name" id="last_name" />
        </p>
    <div class="show_if_trader" <?php echo $role_style ; ?>>
        
        <p class="form-row form-group">
                 <label for="tax_cer_no"><?php _e( 'Resale Certificate Number', 'esbwoodemo' ); ?> <span class="required">*</span></label>
                 <input type="text" class="input-text" name="tax_cer_no" id="tax_cer_no" value="<?php if ( ! empty( $_POST['tax_cer_no'] ) ) echo esc_attr($_POST['tax_cer_no']); ?>" required="required" />
        </p>
        
        <p class="form-row form-group">
                 <label for="tax_cer_img"><?php _e( 'Upload Resale Certificate', 'esbwoodemo' ); ?> <span class="required">*</span></label>
                 <input type="file" class="input-file" name="tax_cer_img" id="tax_cer_img" value="<?php if ( ! empty( $_FILES['tax_cer_img'] ) ) echo esc_attr($_FILES['tax_cer_img']); ?>" required="required" />
        </p>
        <?php  do_action( 'dokan_seller_registration_field_after' ); ?>
    </div>

    <?php do_action( 'dokan_reg_form_field' ); ?>

    <div class="rdo-register-role">
        
        <p class="form-row form-group user-role">
                <input id="checked-2" type="radio" name="role" value="seller"<?php checked( $role, 'seller' ); ?>>
                <label class="radio" for="checked-2">
                    <span></span>
                    <?php _e( 'Customer Account', 'esbwoodemo' ); ?>
                </label>
                <input id="checked-3" type="radio" name="role" value="trader"<?php checked( $role, 'trader' ); ?>>
                <label class="radio" for="checked-3">
                    <span></span>
                    <?php _e( 'Trade Account', 'esbwoodemo' ); ?>
                </label>
            <?php do_action( 'dokan_registration_form_role', $role ); ?>
        </p>
        
    </div>
<?php
}

/*
 * Save User Meta(Custom User Profile Fields)
 */
function esbwoodemo_wooc_save_extra_register_fields( $customer_id ) {
    if( isset( $_FILES ) ) {
        foreach( $_FILES as $file ) {
          if( is_array( $file ) ) {
            $attachment_id = esbwoodemo_upload_user_file( $file );
            update_user_meta( $customer_id, 'tax_cer_img', sanitize_text_field( $attachment_id ) );
          }
        }
    }
    if( isset( $_POST['tax_cer_no'] ) ) {
        update_user_meta( $customer_id, 'tax_cer_no', $_POST['tax_cer_no'] );
    }
}



//Update Role
remove_filter( 'woocommerce_process_registration_errors', 'dokan_seller_registration_errors' );
remove_filter( 'registration_errors', 'dokan_seller_registration_errors' );
add_filter( 'woocommerce_process_registration_errors', 'esbwoodemo_dokan_seller_registration_errors_add' );
add_filter( 'registration_errors', 'esbwoodemo_dokan_seller_registration_errors_add' );

//Dokan New Customer Data
remove_filter( 'woocommerce_new_customer_data', 'dokan_new_customer_data');
add_filter( 'woocommerce_new_customer_data', 'esbwoodemo_dokan_new_customer_data_add');

//Dokan Register Form
remove_action('register_form','dokan_seller_reg_form_fields');
add_action( 'register_form', 'esbwoodemo_dokan_add_registration_fields' );

//Save User Meta(Custom User Profile Fields)
add_action( 'woocommerce_created_customer', 'esbwoodemo_wooc_save_extra_register_fields',10 , 1 );