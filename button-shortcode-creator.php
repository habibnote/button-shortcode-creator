<?php 
/*
 * Plugin Name:       Button Shortcode Creator
 * Plugin URI:        https://github.com/habibnote/button-shortcode-creator
 * Description:       This plugin for button cretor with shortcode
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md. Habib
 * Author URI:        https://me.habibnote.com
 * Text Domain:       bsc
*/

namespace Habib\Button_Shortcode_Creator;

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Main Class
 */
final class BSC {
    static $instance = false;

    /**
     * class constructor
     */
    private function __construct() {
        $this->include();
        $this->define();
        $this->hooks();
    }

    /**
     * Include all needed files
     */
    private function include() {
        require_once( dirname( __FILE__ ) . '/inc/functions.php' );
        require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
    }

    /**
     * define all constant
     */
    private function define() {
        define( 'BSC', __FILE__ );
        define( 'BSC_DIR', dirname( BSC ) );
        define( 'BSC_ASSET', plugins_url( 'assets', BSC ) );
    }

    /**
     * All hooks
     */
    private function hooks() {
        new App\Admin();
        new App\Metabox();
    }

    /**
     * Singleton Instance
    */
    static function get_bsc_plugin() {
        
        if( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Cick off the plugins 
 */
BSC::get_bsc_plugin();