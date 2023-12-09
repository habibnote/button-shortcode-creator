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
    public function bsc_post_meta() {
        $metabox = <<<EOD
        <div class="bsc_button_metaboxes">
            <div class="bsc-left-area">
                <h4>Upload Image</h4>

            </div>
            <div class="right-area">
                
            </div>
        </div>
EOD;
        echo $metabox;
    }   
    
}
?>

