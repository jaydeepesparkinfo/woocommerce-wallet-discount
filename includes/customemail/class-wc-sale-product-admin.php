<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'LV_Email_Pending_Sales' ) ) :

/**
 * Customer New Account.
 *
 * An email sent to the customer when they create an account.
 *
 * @class       LV_Email_Pending_Sales
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class LV_Email_Pending_Sales extends WC_Email {
	
	public $seller_id;
	public $product_id;
        
	function __construct() {

		$this->id             = 'pending_sales';
		$this->title          = __( 'Product Sale Request', 'woocommerce' );
		$this->description    = __( 'Customer Add New Product.', 'woocommerce' );
                $this->recipient      = get_option( 'admin_email' );
		$this->template_html  = 'emails/sale-product-html.php';
		$this->template_plain = 'emails/plain/sale-product-plain.php';

		$this->subject        = __( 'Product Sale Request ', 'woocommerce');
		$this->heading        = __( 'Product Sale Request ', 'woocommerce');

		// Call parent constuctor
		parent::__construct();
                //do_action('esbwoo_email_pending');
                add_action('publish_pending_sell',array( $this, 'trigger' ));
                add_action('new_to_publish', array( $this, 'trigger' ));
                add_action('draft_to_publish', array( $this, 'trigger' ));
                add_action('pending_to_publish', array( $this, 'trigger' ));
	}

	/**
	 * Trigger.
	 *
	 * @param int $seller_id
	 * @param string $product_id
	 * @param bool $password_generated
	 */
	public function trigger( $order_id ) {
                
		//if ( $seller_id ) {
			//$this->object               = new WP_User( $seller_id );
			//$this->product_id           = $product_id;
			$this->recipient            = get_option( 'admin_email' );
		//}

		if ( ! $this->is_enabled() || ! $this->recipient ) {
			return;
		}

		$this->send( $this->recipient , $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	
                }

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'email_heading'      => $this->get_heading(),
			'sent_to_admin'      => false,
			'plain_text'         => false,
			'email'              => $this
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'email_heading'      => $this->get_heading(),
			'sent_to_admin'      => false,
			'plain_text'         => true,
			'email'			     => $this
		) );
	}
}

endif;