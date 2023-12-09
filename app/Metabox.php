<?php 

namespace Habib\Button_Shortcode_Creator\App;

/**
 * Main Class
 */
class Metabox {

    /**
     * class constructor
     */
    public function __construct() {
        add_action( 'add_meta_boxes', [$this, 'bsc_metaboxes'] );
        add_action( 'save_post', [$this, 'bsc_save_meta_info'] );
    }

    /**
     * BSC create all metabox
     */
    public function bsc_metaboxes() {
        add_meta_box(
            'bsc_buton_meta',
            __( 'Button Info', 'bsc' ),
            [ $this, 'bsc_post_meta' ],
            'bs_creator',
            'normal'
        );
    }

    /**
     * all meta
     */
    public function bsc_post_meta( $post ) {

        $post_id = $post->ID;

        //all label
        $sub_title_label = __( 'Subtitle', 'bsc' );

        //all prevent data
        $sub_title_value = get_post_meta( $post_id, 'bsc_subtitle', true );

        //meta box dom
        wp_nonce_field( 'bsc_nonce', 'bsc_nonce_field' );
        $metabox = <<<EOD
        <div class="bsc_button_metaboxes">
            <div class="bsc-left-area">
                <h4>Upload Image</h4>

            </div>
            <div class="right-area">
                <p class="single-row">
                    <label for="sub-title">{$sub_title_label}: </label><br>
                    <input type="text" value="{$sub_title_value}" name="sub_title" id="sub_title">
                </p>
            </div>
        </div>
EOD;
        echo $metabox;
    }   

    /**
     * Saved button meta info
     */
    public function bsc_save_meta_info( $post_id ) {
        $bsc_nonce_value = $_POST['bsc_nonce_field'] ?? '';
        $sub_title       = $_POST['sub_title'] ?? '';

        if( ! bsc_is_secured( $bsc_nonce_value, 'bsc_nonce', $post_id ) ) {
            return $post_id;
        }

        if( in_array( '', [ $sub_title ] ) ) {
            return $post_id;
        }

        update_post_meta( $post_id, 'bsc_subtitle', $sub_title );
    }
}
?>
