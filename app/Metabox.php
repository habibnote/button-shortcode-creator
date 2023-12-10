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
            <div class="right-area">
                <p class="single-row">  
                    <label for="sub-title"><?php esc_html_e( 'Subtitle', 'bsc' ) ?></label><br>
                    <input type="text" value="<?php esc_html_e( $sub_title_value , 'bsc' ); ?>" name="sub_title" id="sub_title">
                </p>
                <p>
                </p>
                <p class="single-row">
                    <label for="bsc-offer"> <?php esc_html_e( 'Offer Title', 'bsc' ) ?> </label><br>
                    <input type="text" value="<?php esc_html_e( $bsc_offer_value, 'bsc' ) ?>" name="bsc_offer" id="bsc-offer">
                </p>

                <p class="single-row">
                    <?php
                        $bsc_btn_text = get_post_meta( $post_id, 'bsc_btn_text', true );
                        $bsc_btn_url   = get_post_meta( $post_id, 'bsc_btn_url', true );

                        for( $i = 0; $i < $number_of_btn; $i++ ){
                            ?>
                            <div class="bsc-btn-meta single-btn">
                                <div class="left-area">
                                    <div class="bsc-btn-text-field">
                                        <p>
                                            <label>Button Text:</label>
                                            <input type="text" name="bsc_btn_text[]" value="<?php echo $bsc_btn_text[$i] ?? ''; ?>" />
                                        </p>
                                        <p>
                                            <label>Button Url:</label>
                                            <input type="text" name="bsc_btn_url[]" value="<?php echo $bsc_btn_url[$i] ?? ''; ?>" />
                                        </p>
                                    </div>
                                    <div class="bsc-btn-space-field">
                                        
                                        <div class="single-field">
                                            <label>Padding: <span>px</span></label>
                                            <input type="number" name="bsc_btn_padding[]" value="" />
                                        </div>
                                        <div class="single-field">
                                            <label>Margin: <span>px</span> </label>
                                            <input type="number" name="bsc_btn_margin[]" value="" />
                                        </div>
                                    </div>
                                    <div class="bsc-btn-color-field">
                                        <div class="single-field">
                                            <label>Color: </label>
                                            <input type="text" class="color-picker" name="bsc_btn_color[]">
                                        </div>
                                        <div class="single-field">
                                            <label>Background: </label>
                                            <input type="text" class="color-picker" name="bsc_btn_background[]">
                                        </div>
                                        <div class="single-field">
                                            <label>Border-color: </label>
                                            <input type="text" class="color-picker" name="bsc_btn_border-color[]">
                                        </div>
                                    </div>
                                    <div class="bsc-btn-color-field">
                                        <div class="single-field">
                                            <label>Hover Color: </label>
                                            <input type="text" name="bsc_btn_hover_color[]" value="" />
                                        </div>
                                        <div class="single-field">
                                            <label>Hover Background: </label>
                                            <input type="text" name="bsc_btn_hover_bg_color[]" value="" />
                                        </div>
                                        <div class="single-field">
                                            <label>Border-color: </label>
                                            <input type="text" name="bsc_btn_border_color[]" value="" />
                                        </div>
                                    </div>
                                    <div class="bsc-btn-color-field">
                                        <div class="single-field">
                                            <label>Font Size: <span>px</span> </label>
                                            <input type="text" name="bsc_btn_font_size[]" value="" />
                                        </div>
                                        <div class="single-field">
                                            <label>Font Weight: </label>
                                            <select name="bsc_btn_font-weight[]">
                                                <option value="normal">normal</option>
                                                <option value="bold">bold</option>
                                            </select>
                                        </div>
                                        <div class="single-field">
                                            <label>Font Style: </label>
                                            <select name="bsc_btn_font-style[]">
                                                <option value="normal">normal</option>
                                                <option value="italic">Italic</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-area">
                                    <div class="btn-right-area">
                                        <p class="bsc-delete" item="<?php echo $i; ?>" post_id="<?php echo $post_id; ?>"><span class="dashicons dashicons-trash"></span></p>
                                        <p class="bsc-add-new" post_id="<?php echo $post_id; ?>"><span class="dashicons dashicons-plus-alt"></span></p>
                                    </div>
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

        $bsc_btn_text  = $_POST['bsc_btn_text'] ?? '';
        $bsc_btn_url   = $_POST['bsc_btn_url'] ?? '';

        update_post_meta( $post_id, 'bsc_btn_text', $bsc_btn_text );
        update_post_meta( $post_id, 'bsc_btn_url', $bsc_btn_url );

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

