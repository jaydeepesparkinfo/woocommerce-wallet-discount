<?php
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * A custom Sold Product WooCommerce Email class
 *
 * @since 0.1
 * @extends \WC_Email
 */
class WC_Notifi_Pro_Admin extends WC_Email {
 
    /**
     * Constructor.
     */
    function __construct() {

            $this->id               = 'lvneworder';
            $this->title            = __( 'New order Notification', 'esbwoodemo' );
            $this->description      = __( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'esbwoodemo' );
            $this->heading          = __( 'New customer order', 'esbwoodemo' );
            $this->subject          = __( '[{site_title}] New customer order ({order_number}) - {order_date}', 'esbwoodemo' );
            $this->template_html    = 'emails/admin-new-order.php';
            $this->template_plain   = 'emails/plain/admin-new-order.php';

            // Triggers for this email
            add_action( 'woocommerce_order_status_pending_to_processing_notification', array( $this, 'trigger' ) );
            add_action( 'woocommerce_order_status_pending_to_completed_notification', array( $this, 'trigger' ) );
            add_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $this, 'trigger' ) );
            add_action( 'woocommerce_order_status_failed_to_processing_notification', array( $this, 'trigger' ) );
            add_action( 'woocommerce_order_status_failed_to_completed_notification', array( $this, 'trigger' ) );
            add_action( 'woocommerce_order_status_failed_to_on-hold_notification', array( $this, 'trigger' ) );
            
            // Other settings
            //$this->heading_downloadable = $this->get_option( 'heading_downloadable', __( 'Your order is complete - download your files', 'esbwoodemo' ) );
            //$this->subject_downloadable = $this->get_option( 'subject_downloadable', __( 'Your {site_title} order from {order_date} is complete - download your files', 'esbwoodemo' ) );

            // Call parent constuctor
            parent::__construct();
            
            // Other settings
            $this->recipient =  get_option( 'admin_email' );
    }
   
    /**
    * Determine if the email should actually be sent and setup email merge variables
    *
    * @since 0.1
    * @param int $order_id
    */
    public function trigger( $order_id ) {
        if ( $order_id ) {
                $this->object                  = wc_get_order( $order_id );
                $this->find['order-date']      = '{order_date}';
                $this->find['order-number']    = '{order_number}';
                $this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->order_date ) );
                $this->replace['order-number'] = $this->object->get_order_number();
        }

        if ( ! $this->is_enabled() || !  $this->recipient ) {
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
                    'order'         => $this->object,
                    'email_heading' => $this->get_heading(),
                    'sent_to_admin' => true,
                    'plain_text'    => false,
                    'email'         => $this
            ) );
    }

    /**
     * Get content plain.
     *
     * @return string
     */
    function get_content_plain() {
            return wc_get_template_html( $this->template_plain, array(
                    'order'         => $this->object,
                    'email_heading' => $this->get_heading(),
                    'sent_to_admin' => true,
                    'plain_text'    => true,
                    'email'         => $this
            ) );
    }

    /**
     * Initialise settings form fields.
     */
    function init_form_fields() {
            $this->form_fields = array(
                    'enabled' => array(
                            'title'         => __( 'Enable/Disable', 'esbwoodemo' ),
                            'type'          => 'checkbox',
                            'label'         => __( 'Enable this email notification', 'esbwoodemo' ),
                            'default'       => 'yes'
                    ),
                    'subject' => array(
                            'title'         => __( 'Subject', 'esbwoodemo' ),
                            'type'          => 'text',
                            'description'   => sprintf( __( 'Defaults to <code>%s</code>', 'esbwoodemo' ), $this->subject ),
                            'placeholder'   => '',
                            'default'       => '',
                            'desc_tip'      => true
                    ),
                    'heading' => array(
                            'title'         => __( 'Email Heading', 'esbwoodemo' ),
                            'type'          => 'text',
                            'description'   => sprintf( __( 'Defaults to <code>%s</code>', 'esbwoodemo' ), $this->heading ),
                            'placeholder'   => '',
                            'default'       => '',
                            'desc_tip'      => true
                    ),
                    'email_type' => array(
                            'title'         => __( 'Email type', 'esbwoodemo' ),
                            'type'          => 'select',
                            'description'   => __( 'Choose which format of email to send.', 'esbwoodemo' ),
                            'default'       => 'html',
                            'class'         => 'email_type wc-enhanced-select',
                            'options'       => $this->get_email_type_options(),
                            'desc_tip'      => true
                    )
            );
    }
}