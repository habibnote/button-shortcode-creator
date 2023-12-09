<?php 
/*
 * Plugin Name:       Button Shortcode Creator
 * Plugin URI:        https://github.com/habibnote/political-corruption
 * Description:       
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md. Habib
 * Author URI:        https://me.habibnote.com
 * Text Domain:       bsc
*/

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Main Class
 */
final class BSC {
    static $instance = false;

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