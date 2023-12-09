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
        add_filter( 'default_content', [$this, 'bsc_setdefault_btn_quantity'], 10, 2 );
        add_action( 'add_meta_boxes', [$this, 'bsc_metaboxes'] );
        add_action( 'save_post', [$this, 'bsc_save_meta_info'] );
    }

    /**
     * Set Inital button quontity
     */
    public function bsc_setdefault_btn_quantity( $content, $post ) {
        if ($post->post_type === 'bs_creator' && $post->post_status === 'auto-draft') {
            update_post_meta( $post->ID, 'bsc_number_of_btn', 1 );
        }
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

        //all prevent data
        $number_of_btn   = get_post_meta( $post_id, 'bsc_number_of_btn', true );
        $sub_title_value = get_post_meta( $post_id, 'bsc_subtitle', true );
        $bsc_offer_value = get_post_meta( $post_id, 'bsc_offer', true );


        $color_value = get_post_meta( $post_id, 'color_picker', true );

        //meta box dom
        wp_nonce_field( 'bsc_nonce', 'bsc_nonce_field' );
        ?>
        <div class="bsc_button_metaboxes">
            <div class="bsc-left-area">
                <h4>Upload Image</h4>
            </div>
            <div class="right-area">
                <p class="single-row">
                    <label for="sub-title"><?php esc_html_e( 'Subtitle', 'bsc' ) ?></label><br>
                    <input type="text" value="<?php esc_html_e( $sub_title_value , 'bsc' ); ?>" name="sub_title" id="sub_title">
                </p>
                <p>
                    <input type="text" class="color-picker" name="color_picker" value="$color_value">
                </p>
                <p class="single-row">
                    <label for="bsc-offer"> <?php esc_html_e( 'Offer Title', 'bsc' ) ?> </label><br>
                    <input type="text" value="<?php esc_html_e( $bsc_offer_value, 'bsc' ) ?>" name="bsc_offer" id="bsc-offer">
                </p>

                <p class="single-row">
                    <?php
                        for( $i = 0; $i < $number_of_btn; $i++ ){
                            ?>
                            <div class="<?php printf( "bsc-btn-meta_%s", $i )?> single-btn">
                                <div class="bsc-btn-text-field">
                                    <p>
                                        <label for="bsc_btn_text">Button Text:</label>
                                        <input type="text" name="<?php printf( 'bsc_btn_text_%s', $i ) ?>" id="bsc_btn_text" />
                                    </p>
                                    <p>
                                        <label for="bsc_btn_url">Button Url:</label>
                                        <input type="text" name="<?php printf( 'bsc_btn_url_%s', $i ) ?>" id="bsc_btn_url" />
                                    </p>
                                </div>
                                <div class="bsc-btn-color-field">
                                    
                                </div>
                                <div class="btn-right-area">
                                    <p class="bsc-delete" item="<?php echo $i; ?>" post_id="<?php echo $post_id; ?>"><span class="dashicons dashicons-trash"></span></p>
                                    <p class="bsc-add-new" post_id="<?php echo $post_id; ?>"><span class="dashicons dashicons-plus-alt"></span></p>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                    
                </p>
                
            </div>
        </div>
        <?php
    }   

    /**
     * Saved button meta info
     */
    public function bsc_save_meta_info( $post_id ) {
        $bsc_nonce_value = $_POST['bsc_nonce_field'] ?? '';
        $sub_title       = $_POST['sub_title'] ?? '';
        $bsc_offer       = $_POST['bsc_offer'] ?? '';

        if( ! bsc_is_secured( $bsc_nonce_value, 'bsc_nonce', $post_id ) ) {
            return $post_id;
        }   

        if( in_array( '', [ $sub_title, $bsc_offer ] ) ) {
            return $post_id;
        }

        update_post_meta( $post_id, 'bsc_subtitle', $sub_title );
        update_post_meta( $post_id, 'bsc_offer', $bsc_offer );
    }
}
?>

