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
        add_action( 'manage_bs_creator_posts_custom_column', [$this, 'bsc_addshortcode_in_column'], 10, 2 );
        add_filter( 'default_content', [$this, 'bsc_setdefault_btn_quantity'], 10, 2 );
        add_filter( 'manage_edit-bs_creator_columns', [$this, 'bsc_manage_post_columns'] );
    }

    /**
     * manage posts column
     */
    public function bsc_manage_post_columns( $columns ) {
        print_r($columns);

        unset($columns['date']);
        $columns['shortcode'] = __( 'Shortcode', 'bsc' );
        $columns['date'] = __( 'Date', 'bsc' );

        return $columns;
    }

    /**
     * Add shortcode in column
     */
    public function bsc_addshortcode_in_column( $column, $post_id ) {
        if( 'shortcode' == $column ) {
            printf( "[bsc_button id=%s/]", $post_id );
        }
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

        add_meta_box(
            'bsc_button_shortcode',
            __( 'Button Shortcode', 'bsc' ),
            [$this, 'bsc_shortcode'],
            'bs_creator',
            'side',
        );
    }

    /**
     * Shortcode Metabox
     */
    public function bsc_shortcode( $post ) {
        echo "<pre>";
        printf( "[bsc_button id=%s/]", $post->ID );
        echo "</pre>";
    }

    /**
     * all meta
     */
    public function bsc_post_meta( $post ) {

        $post_id = $post->ID;

        //all prevent data
        $sub_title_value = get_post_meta( $post_id, 'bsc_subtitle', true );
        $bsc_offer_value = get_post_meta( $post_id, 'bsc_offer', true );

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

                <?php ( new MetaField() )->bsc_btn_repeater( $post_id ); ?>

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


        $bsc_btn_info    = [];
        $bsc_btn_info['bsc_btn_text']           = $_POST['bsc_btn_text'] ?? '';
        $bsc_btn_info['bsc_btn_url']            = $_POST['bsc_btn_url'] ?? '';
        $bsc_btn_info['bsc_btn_padding']        = $_POST['bsc_btn_padding'] ?? '';
        $bsc_btn_info['bsc_btn_margin']         = $_POST['bsc_btn_margin'] ?? '';
        $bsc_btn_info['bsc_btn_color']          = $_POST['bsc_btn_color'] ?? '';
        $bsc_btn_info['bsc_btn_background']     = $_POST['bsc_btn_background'] ?? '';
        $bsc_btn_info['bsc_btn_border-color']   = $_POST['bsc_btn_border-color'] ?? '';
        $bsc_btn_info['bsc_btn_hover_color']    = $_POST['bsc_btn_hover_color'] ?? '';
        $bsc_btn_info['bsc_btn_hover_bg_color'] = $_POST['bsc_btn_hover_bg_color'] ?? '';
        $bsc_btn_info['bsc_btn_font_size']      = $_POST['bsc_btn_font_size'] ?? '';
        $bsc_btn_info['bsc_btn_font_weight']    = $_POST['bsc_btn_font_weight'] ?? '';
        $bsc_btn_info['bsc_btn_font-style']     = $_POST['bsc_btn_font-style'] ?? '';
        

        update_post_meta( $post_id, 'bsc_btn_info', $bsc_btn_info );

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


