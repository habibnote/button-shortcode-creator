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
        add_action( 'wp_enqueue_scripts', [$this, 'enque_scripts'] );
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