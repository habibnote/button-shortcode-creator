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


/**
 * Function for Duplicate post 
 */
if( ! function_exists( 'bsc_duplicate_post' ) ) {
    function bsc_duplicate_post( $post_id ) {

        // Get the original post
        $post = get_post( $post_id );
    
        // Create an array with the post data
        $post_data = array(
            'post_title'    => $post->post_title,
            'post_content'  => '',
            'post_status'   => $post->post_status,
            'post_type'     => $post->post_type,
        );
    
        // Insert the new post
        $new_post_id = wp_insert_post( $post_data );
    
        // Duplicate custom fields (including repeater fields)
        $custom_fields = get_post_custom( $post_id );
        foreach ( $custom_fields as $key => $values ) {
            foreach ( $values as $value ) {
                add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );
            }
        }
    
        // Duplicate featured image
        $thumbnail_id = get_post_thumbnail_id( $post_id );
        if ( $thumbnail_id ) {
            set_post_thumbnail( $new_post_id, $thumbnail_id );
        }
    
        // Return the new post ID
        return $new_post_id;
    }
}
