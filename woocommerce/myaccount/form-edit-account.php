<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<form class="edit-account" enctype="multipart/form-data" action="" method="post">
            <?php if ( is_user_logged_in() ) { ?>
                    <div>
                        <?php
                            $user_ID    = get_current_user_id();                            
                            $user       = new WP_User( $user_ID );
                            if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                                foreach ( $user->roles as $role ) {
                                    if( $role == 'administrator' || $role == 'trader') {
                        ?>
                                        <!--Dashboard Link-->
                                        <a class="dokan-btn dokan-btn-theme dokan-right" href="<?php echo dokan_get_navigation_url( 'products' ); ?>"><?php _e('Dashboard','esbwoodemo'); ?></a>
                        <?php
                                    }
                                    if( $role == 'seller' ) {
                        ?>
                                        <!--Dashboard Link-->
                                        <a class="dokan-btn dokan-btn-theme dokan-right" href="<?php echo dokan_get_navigation_url( 'orders' ); ?>"><?php _e('Dashboard','esbwoodemo'); ?></a>
                        <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="clear"></div>
            <?php
                }
            ?>
            <?php
            $tax_cer_no     = !empty( get_user_meta( $user->ID , 'tax_cer_no', true ) ) ? get_user_meta( $user->ID , 'tax_cer_no', true ) : ''; 
            $tax_cer_img    = !empty( get_user_meta( $user->ID , 'tax_cer_img', true ) ) ? get_user_meta( $user->ID , 'tax_cer_img', true ) : '';
        ?>
        
	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="form-row form-row-first">
		<label for="account_first_name"><?php _e( 'First name', 'esbwoodemo' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="form-row form-row-last">
		<label for="account_last_name"><?php _e( 'Last name', 'esbwoodemo' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>
	<p class="form-row form-row-wide">
		<label for="account_email"><?php _e( 'Email address', 'esbwoodemo' ); ?> <span class="required">*</span></label>
		<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
        <?php if( current_user_can('trader') ) { ?>
        <h2><?php _e( 'Tax Certificate Information', 'esbwoodemo' ); ?></h2>
        <p class="form-row form-row-wide">
            <label for="tax_cer_no"><?php _e( 'Tax Certificate Number', 'esbwoodemo' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="tax_cer_no" id="tax_cer_no" value="<?php echo $tax_cer_no; ?>" />
	</p>
        <p class="form-row form-row-wide file-input-advanced">
            
            <label for="tax_cer_img"><?php _e( 'Tax Certificate Document', 'esbwoodemo' ); ?> <span class="required">*</span></label>
            <input type='text' class='esbwoodemo-upload-file-link cer-upload' name='tax_cer_img' value='<?php echo $tax_cer_img; ?>'  placeholder='http://'/>
            <span class='esbwoodemo-upload-files'><a class='esbwoodemo-upload-fileadvanced button' href='javascript:void(0);'><?php _e( 'Upload','esbwoodemo') ?></a></span>
            <?php if( !empty( $tax_cer_img )) { ?>
            <a href="<?php echo $tax_cer_img; ?>" target="_blank"><?php _e('View Certificate','esbwoodemo'); ?></a>
            <?php } ?>
	</p>
        <?php } ?>
        <div class="woocommerce-billing-fields">
            <h2><?php _e( 'Billing Address', 'esbwoodemo' ); ?></h2>
            <p class="form-row form-row-first">
                <label for="billing_first_name"><?php _e( 'First Name', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_first_name" id="billing_first_name" value="<?php echo esc_attr( $user->billing_first_name ); ?>" />
            </p>
            <p class="form-row form-row-last">
                <label for="billing_last_name"><?php _e( 'Last Name', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_last_name" id="billing_last_name" value="<?php echo esc_attr( $user->billing_last_name ); ?>" />
            </p>
            <div class="clear"></div>
            <p class="form-row form-row-wide">
                <label for="billing_company"><?php _e( 'Company', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_company" id="billing_company" value="<?php echo esc_attr( $user->billing_company ); ?>" />
            </p>        
            <div class="clear"></div>
            <p class="form-row form-row-first">
                <label for="billing_address_1"><?php _e( 'Address 1', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_address_1" id="billing_address_1" value="<?php echo esc_attr( $user->billing_address_1 ); ?>" />
            </p>
            <p class="form-row form-row-last">
                <label for="billing_address_2"><?php _e( 'Address 2', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_address_2" id="billing_address_2" value="<?php echo esc_attr( $user->billing_address_2 ); ?>" />
            </p>
            <div class="clear"></div>
            <p class="form-row form-row-first">
                <label for="billing_city"><?php _e( 'City', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_city" id="billing_city" value="<?php echo esc_attr( $user->billing_city ); ?>" />
            </p>
            <p class="form-row form-row-last">
                <label for="billing_postcode"><?php _e( 'Zipcode', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_postcode" id="billing_postcode" value="<?php echo esc_attr( $user->billing_postcode ); ?>" />
            </p>
            <div class="clear"></div>
            <?phP
                // Enqueue scripts
                wp_enqueue_script( 'wc-country-select' );
                wp_enqueue_script( 'wc-address-i18n' );
                $key = 'billing_country';
                $field = array( 'type' => 'country', 'label' => 'Country', 'required' => '1','class'=>array('form-row-wide','address-field','update_totals_on_change') ,'value'=>'IN');
                woocommerce_form_field( $key, $field, $field['value'] );
                $key = 'billing_state';
                $field = array( 'type' => 'state', 'label' => 'State / County', 'required' => '1','class'=>array('form-row-wide','address-field'),'validate'=>array('state'));
                woocommerce_form_field( $key, $field, $field['value'] );
            ?>
            <div class="clear"></div>
            <p class="form-row form-row-first">
                <label for="billing_email"><?php _e( 'Email', 'esbwoodemo' ); ?></label>
                <input type="email" class="input-text" name="billing_email" id="billing_email" value="<?php echo esc_attr( $user->billing_email ); ?>" />
            </p>
            <p class="form-row form-row-last">
                <label for="billing_phone"><?php _e( 'Phone', 'esbwoodemo' ); ?></label>
                <input type="text" class="input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
            </p>
        </div>
        <div class="clear"></div>
        <div class="woocommerce-shipping-fields">
            <p>                
                <input type="checkbox" id="chk_sameship" class="chk_sameship" name="chk_sameship">
                <label for="chk_sameship"><?php _e('Use Billing As Shipping Address','localhost'); ?></label>
            </p>
        <div class="clear"></div>
        <h2><?php _e( 'Delivery Address', 'esbwoodemo' ); ?></h2>
        <p class="form-row form-row-first">
            <label for="shipping_first_name"><?php _e( 'First Name', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_first_name" id="shipping_first_name" value="<?php echo esc_attr( $user->shipping_first_name ); ?>" />
	</p>
        <p class="form-row form-row-last">
            <label for="shipping_last_name"><?php _e( 'Last Name', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_last_name" id="shipping_last_name" value="<?php echo esc_attr( $user->shipping_last_name ); ?>" />
	</p>
        <div class="clear"></div>
        
        <p class="form-row form-row-wide">
            <label for="shipping_company"><?php _e( 'Company', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_company" id="shipping_company" value="<?php echo esc_attr( $user->shipping_company ); ?>" />
	</p>        
        <div class="clear"></div>
        <p class="form-row form-row-first">
            <label for="shipping_address_1"><?php _e( 'Address 1', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_address_1" id="shipping_address_1" value="<?php echo esc_attr( $user->shipping_address_1 ); ?>" />
	</p>
        <p class="form-row form-row-last">
            <label for="shipping_address_2"><?php _e( 'Address 2', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_address_2" id="shipping_address_2" value="<?php echo esc_attr( $user->shipping_address_2 ); ?>" />
	</p>
        <div class="clear"></div>
        <p class="form-row form-row-first">
            <label for="shipping_city"><?php _e( 'City', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_city" id="shipping_city" value="<?php echo esc_attr( $user->shipping_city ); ?>" />
	</p>
        <p class="form-row form-row-last">
            <label for="shipping_postcode"><?php _e( 'Zipcode', 'esbwoodemo' ); ?></label>
            <input type="text" class="input-text" name="shipping_postcode" id="shipping_postcode" value="<?php echo esc_attr( $user->shipping_postcode ); ?>" />
	</p>
        <div class="clear"></div>
        <?phP
                // Enqueue scripts
                wp_enqueue_script( 'wc-country-select' );
                wp_enqueue_script( 'wc-address-i18n' );
                $key = 'shipping_country';
                $field = array( 'type' => 'country', 'label' => 'Country', 'required' => '1','class'=>array('form-row-wide','address-field','update_totals_on_change') ,'value'=>'');
                woocommerce_form_field( $key, $field, $field['value'] );
                $key = 'shipping_state';
                $field = array( 'type' => 'state', 'label' => 'State / County', 'required' => '1','class'=>array('form-row-wide','address-field'),'validate'=>array('state'));
                woocommerce_form_field( $key, $field, $field['value'] );
        ?>
        </div>
        <div class="clear"></div>
	<fieldset>
		<legend><?php _e( 'Password Change', 'esbwoodemo' ); ?></legend>
		<p class="form-row form-row-wide">
			<label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'esbwoodemo' ); ?></label>
			<input type="password" class="input-text" name="password_current" id="password_current" />
		</p>
		<p class="form-row form-row-wide">
			<label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'esbwoodemo' ); ?></label>
			<input type="password" class="input-text" name="password_1" id="password_1" />
		</p>
		<p class="form-row form-row-wide">
			<label for="password_2"><?php _e( 'Confirm New Password', 'esbwoodemo' ); ?></label>
			<input type="password" class="input-text" name="password_2" id="password_2" />
		</p>
        </fieldset>
       	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'esbwoodemo' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>
