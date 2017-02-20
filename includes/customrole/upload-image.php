<?php
function esbwoodemo_upload_user_file( $file = array() , $ret = 'url') {
	require_once( ABSPATH . 'wp-admin/includes/admin.php' );
        $file_return = wp_handle_upload( $file, array('test_form' => false ) );
        if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
            return false;
        } else {
            $filename = $file_return['file'];
            $attachment = array(
                'post_mime_type' => $file_return['type'],
                'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                'post_content' => '',
                'post_status' => 'inherit',
                'guid' => $file_return['url']
            );
            $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            if( 0 < intval( $attachment_id ) ) {
              if($ret == 'url'){  
                  return $file_return['url'];
              }else
              {
                  return $attachment_id;
              }
            }
        }
        return false;
}
function esbwoodemo_upload_user_file_array( $file = array() , $post_id, $set_thu='') {
        require_once( ABSPATH . 'wp-admin/includes/admin.php' );
        $file_return = wp_handle_upload( $file, array('test_form' => false ) );
      
        if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
            return false;
        } else {
            $filename = $file_return['file'];
            $attachment = array(
                'post_mime_type' => $file_return['type'],
                'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                'post_content' => '',
                'post_status' => 'inherit',
                'guid' => $file_return['url']
            );
            $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            if(!empty( $set_thu )) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
            if( 0 < intval( $attachment_id ) ) {
                  return $file_return;
            }
        }
        return false;
}
?>