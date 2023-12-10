<?php

if( ! function_exists( 'bsc_is_secured' ) ) {
    
    function bsc_is_secured( $nonce, $action, $post_id ) {

        if( $nonce == '' ) {
            return false;
        }
        if( ! wp_verify_nonce( $nonce, $action ) ) {
            return false;
        }
        if( ! current_user_can( 'edit_post', $post_id ) ) {
            return false;
        }
        if( wp_is_post_autosave( $post_id ) ){
            return false;
        }
        if( wp_is_post_revision( $post_id ) ) {
            return false;
        }

        return true;
    }
}

/**
 * check for selected option
 */
if( ! function_exists( 'bsc_is_selected' ) ) {
    function bsc_is_selected( $retrive_value, $current_value ) {
        if( $retrive_value == $current_value ) {
            return 'selected';
        }
    }
}