<?php 

namespace Habib\Button_Shortcode_Creator\App;

/**
 * Admin Class
 */
class Admin {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'init', [$this, 'register_post_type'] );
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
        add_action( 'wp_ajax_bsc_add_button', [$this, 'bsc_add_button'] );
        add_action( 'wp_ajax_bsc_remove_button', [$this, 'bsc_remove_button'] );
    }

    /**
     * Process remove button ajax request
     */
    public function bsc_remove_button() {
        $post_id = $_POST['post_id'];
        $nonce   = $_POST['nonce'];
        $item_no = $_POST['item_no'];

        if( wp_verify_nonce( $nonce, 'bsc_nonce_admin' ) ) {
            
            //get all meta
            $bsc_btn_text = get_post_meta( $post_id, 'bsc_btn_text', true );
            $bsc_btn_url   = get_post_meta( $post_id, 'bsc_btn_url', true );

            $bsc_btn_text = array_diff( $bsc_btn_text, [$bsc_btn_text[$item_no]] );
            $bsc_btn_url = array_diff( $bsc_btn_url, [$bsc_btn_url[$item_no]] );

            update_post_meta( $post_id, 'bsc_btn_text', array_values( $bsc_btn_text ) );
            update_post_meta( $post_id, 'bsc_btn_url', array_values( $bsc_btn_url ) );

            //update the btn quantity
            $number_of_btn   = get_post_meta( $post_id, 'bsc_number_of_btn', true );
            update_post_meta( $post_id, 'bsc_number_of_btn', $number_of_btn-1 );
        }

        // wp_send_json_success();
    }

    /**
     * Process add button ajax requrest
     */
    public function bsc_add_button() {
        $post_id = $_POST['post_id'];
        $nonce   = $_POST['nonce'];

        if( wp_verify_nonce( $nonce, 'bsc_nonce_admin' ) ) {
            $current_btn_count = get_post_meta( $post_id, 'bsc_number_of_btn', true );

            $update_value = $current_btn_count + 1;

            update_post_meta( $post_id, 'bsc_number_of_btn', $update_value );
            
            wp_send_json_success([
                'update' =>  $update_value,
                'meta'   =>  get_post_meta( $post_id, 'bsc_number_of_btn', true ),
            ]);
            die();
        }
        
    }

    /**
     * Register Custom post type
     */
    public function register_post_type() {
        include_once( BSC_DIR . "/views/admin/bsc-post.php" );
    }

    /*
    * load all admin assets
    */
   public function admin_enqueue_scripts() {
        wp_enqueue_style( 'admin', BSC_ASSET . '/admin/css/admin.css', '', time(), 'all' );

        wp_enqueue_script( 'admin', BSC_ASSET . '/admin/js/admin.js', ['jquery', 'wp-color-picker'], time(), true );

        $ajax_url = admin_url( 'admin-ajax.php' );
        $nonce    = wp_create_nonce( 'bsc_nonce_admin' );
        wp_localize_script( 'admin', 'BSC', array( 
            'ajax'  => $ajax_url,
            'admin_nonce'=> $nonce,
        ) );
   }   
}