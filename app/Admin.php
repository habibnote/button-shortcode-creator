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
        add_action( 'admin_menu', [$this, 'setting_submenu'] );

        add_action( 'admin_init', [$this, 'duplicate_post_action'] );
        add_filter( 'post_row_actions', [$this, 'add_duplicate_link_before_trash'], 10, 2 );
    }

    /**
     * Plugin Setting Page
     */
    public function setting_submenu() {

        add_submenu_page(
            'edit.php?post_type=bs_creator',
            'Settings',
            'Settings',
            'manage_options',
            'bsc_settings',
            [$this, 'setting_callback']
        );
    }

    public function setting_callback() {
        ?>
        <div class="wrap">
            <h1>Settings</h1>
            <hr>
            <p>To use this plugin you need to acitve it first</p>
            <div class="bsc-license_form">
                <form>
                    <p>
                        <label for="bsc-ls-website">Website:</label>
                        <input type="text"/>
                    </p>
                    <p>
                        <label for="bsc-ls-website">License Key:</label>
                        <input type="text"/>
                    </p>
                    <p>
                        <button class="button button-primary">Active</button>
                    </p>
                </form>
            </div>
        </div>
        <?php
    }

    /**
     * Create duplicate post
     */
    function duplicate_post_action() {
        if ( isset( $_GET['action'] ) && $_GET['action'] === 'duplicate_post' && isset( $_GET['post_id'] ) ) {

            $post_id        = intval( $_GET['post_id'] );
            $new_post_id    = \bsc_duplicate_post( $post_id );
    
            // Redirect to the new duplicate post
            wp_redirect( admin_url('post.php?action=edit&post=' . $new_post_id ) );
            exit;
        }
    }
    

    /**
     * duplicate link button
     */
    public function add_duplicate_link_before_trash( $actions, $post ) {

        if ( $post->post_type == 'bs_creator' ) {
            
            // Add Duplicate link
            $actions['duplicate'] = '<a href="' . esc_url(add_query_arg(array('post_id' => $post->ID), admin_url('admin-post.php?action=duplicate_post'))) . '">Duplicate</a>';
            
        }
        return $actions;
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
            $bsc_btn_info = get_post_meta( $post_id, 'bsc_btn_info', true );

            foreach( $bsc_btn_info as &$info ) {
                unset( $info[$item_no] );
            }

            //reindex array
            $bsc_btn_info = array_map( 'array_values' , $bsc_btn_info );

            update_post_meta( $post_id, 'bsc_btn_info', $bsc_btn_info );

            //update the btn quantity
            $number_of_btn   = get_post_meta( $post_id, 'bsc_number_of_btn', true );
            update_post_meta( $post_id, 'bsc_number_of_btn', $number_of_btn-1 );
        }

        wp_send_json_success();
        // print_r( $bsc_btn_info );
        die();
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