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
                                $bsc_btn_count          = count( $bsc_btn_info['bsc_btn_text'] );
                                
                                $bsc_btn_text           = $bsc_btn_info['bsc_btn_text'];
                                $bsc_btn_url            = $bsc_btn_info['bsc_btn_url'];
                                $bsc_btn_padding        = $bsc_btn_info['bsc_btn_padding'];
                                $bsc_btn_margin         = $bsc_btn_info['bsc_btn_margin'];
                                $bsc_btn_color          = $bsc_btn_info['bsc_btn_color'];
                                $bsc_btn_background     = $bsc_btn_info['bsc_btn_background'];
                                $bsc_btn_border_color   = $bsc_btn_info['bsc_btn_border-color'];
                                $bsc_btn_hover_bg_color = $bsc_btn_info['bsc_btn_hover_bg_color'];
                                $bsc_btn_font_size      = $bsc_btn_info['bsc_btn_font_size'];
                                $bsc_btn_font_weight    = $bsc_btn_info['bsc_btn_font_weight'];
                                $bsc_btn_font_style     = $bsc_btn_info['bsc_btn_font-style'];
                                
                                echo "<div class='bsc-btns'>";

                                for( $i = 0; $i < $bsc_btn_count; $i++ ) {
                                    printf(
                                        '<button
                                        class="bsc-btn" 
                                        style="margin:%3$spx;border-color:%7$s;"
                                        ><a
                                        id="bsc-btn-a"
                                        style="padding:%4$spx;color:%5$s;background-color:%6$s; font-size:%8$spx; font-weight:%9$s; font-style:%10$s;"
                                        href="%1$s">%2$s</a></button><br>',
                                        esc_url( $bsc_btn_url[$i] ),
                                        esc_html( $bsc_btn_text[$i] , 'bsc' ),
                
                                        esc_attr( $bsc_btn_margin[$i] ),
                                        esc_attr( $bsc_btn_padding[$i] ),
                                        esc_attr( $bsc_btn_color[$i] ),
                                        esc_attr( $bsc_btn_background[$i] ),
                                        esc_attr( $bsc_btn_border_color[$i] ),
                                        esc_attr( $bsc_btn_font_size[$i] ),
                                        esc_attr( $bsc_btn_font_weight[$i] ),
                                        esc_attr( $bsc_btn_font_style[$i] ),
                                    );

                                    if(  )
                                    printf(
                                        "<style>
                                            #bsc-btn-a:hover{
                                                color:;
                                            }
                                        </style>"
                                    );

                                }

                                echo "</div>";

                                // echo "<pre>";
                                // print_r( $bsc_btn_info );
                                // echo "</pre>";
                            }
                        ?>
                    </div>
                </div>
            <?php 
        }
    }
}