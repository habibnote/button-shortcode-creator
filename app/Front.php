<?php 

namespace Habib\Button_Shortcode_Creator\App;

/**
 * Admin Class
 */
class Front {

    /**
     * Class constructor
     */
    public function __construct() {
        add_shortcode( 'bsc_button', [$this, 'button_shortcode'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enque_scripts'] );
    }

    /**
     * Create shortcode
     */
    public function button_shortcode( $atts ) {
        $post_id = $atts['id'];

        // Get post object by post ID
        $post = get_post($post_id);

        if( $post ) {
            echo $post->post_title;
        }
    }

    /**
     * load all fornt assets
     */
    public function enque_scripts() {
        if( ! is_admin() ) {
            wp_enqueue_style( 'front', BSC_ASSET . '/front/css/front.css', '', time(), 'all' );

            wp_enqueue_script( 'front', BSC_ASSET . '/front/js/front.js', ['jquery'], time(), true );
        }
    }   
}