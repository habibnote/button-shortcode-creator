<?php 

namespace Habib\Button_Shortcode_Creator\App;

/**
 * Admin Class
 */
class Shortcode {
    /**
     * Class constructor
     */
    public function __construct( ) {
        add_shortcode( 'bsc_button', [$this, 'button_shortcode'] );
    }
    
    /**
     * Shortcode
     */
    /**
     * Create shortcode
     */
    public function button_shortcode( $atts ) {
        $post_id = $atts['id'];

        // Get post object by post ID
        $post = get_post($post_id);

        if( $post ) {

            $post_id = $post->ID;

            $sub_title      = get_post_meta( $post_id, 'bsc_subtitle', true );
            $bsc_offer      = get_post_meta( $post_id, 'bsc_offer', true );
            $bsc_btn_info   = get_post_meta( $post_id, 'bsc_btn_info', true );

            ?>
                <div class="bsc-container">
                    <div class="bsc-image">
                        <?php
                            if( has_post_thumbnail( $post_id ) ) {
                                echo get_the_post_thumbnail( $post_id );
                            }
                        ?>
                    </div>
                    <div class="bsc-content">
                        <h2><?php the_title(); ?></h2>
                        <?php
                            if( $sub_title ) {
                                printf( '<h3>%s</h3>', $sub_title );
                            }
                            if( $bsc_offer ) {
                                printf( '<h4>%s</h4>', $bsc_offer );
                            }

                            if( $bsc_btn_info ) {
                                $bsc_btn_count = count( $bsc_btn_info['bsc_btn_text'] );
                                $bsc_btn_text = $bsc_btn_info['bsc_btn_text'];
                                $bsc_btn_padding = $bsc_btn_info['bsc_btn_padding'];
                                $bsc_btn_margin = $bsc_btn_info['bsc_btn_margin'];
                                $bsc_btn_color = $bsc_btn_info['bsc_btn_color'];
                                $bsc_btn_background = $bsc_btn_info['bsc_btn_background'];
                                $bsc_btn_border_color = $bsc_btn_info['bsc_btn_border-color'];
                                $bsc_btn_hover_bg_color = $bsc_btn_info['bsc_btn_hover_bg_color'];
                                $bsc_btn_font_size = $bsc_btn_info['bsc_btn_font_size'];
                                $bsc_btn_font_weight = $bsc_btn_info['bsc_btn_font_weight'];
                                $bsc_btn_font_style = $bsc_btn_info['bsc_btn_font-style'];

                                // echo md5('habib');
                                

                                for( $i = 0; $i < $bsc_btn_count; $i++ ) {
                                    printf(
                                        "",
                                    );
                                }
                            //     foreach( $bsc_btn_info as $bsc_btns ) {
                            //         foreach( $bsc_btns as $info ) {
                                        // printf( "<a href='%s' >%s</a>", $info);
                                    // }
                                    echo "<pre>";
                                    print_r( $bsc_btn_info );
                                    echo "</pre>";
                                    
                            //     }
                            }
                        ?>
                    </div>
                </div>
            <?php 
        }
    }
}