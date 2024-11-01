<?php
/*
Plugin Name: Ultimate News Plus Widget
Plugin URI: http://www.conceptcorners.com/
Description: A simple Ultimate News Plus Widgets plugin. Display News with latest News Designs.
Version: 2.2
Author: Concept Corners
Author URI: http://www.conceptcorners.com/
*/

if( !defined( 'CCS_UNPW_VERSION' ) ) {
    define( 'CCS_UNPW_VERSION', '2.2' ); // Version of plugin
}
if( !defined( 'CCS_UNPW_DIR' ) ) {
    define( 'CCS_UNPW_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'CCS_UNPW_URL' ) ) {
    define( 'CCS_UNPW_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'CCS_UNPW_PLUGIN_BASENAME' ) ) {
    define( 'CCS_UNPW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'CCS_UNPW_POST_TYPE' ) ) {
    define( 'CCS_UNPW_POST_TYPE', 'ccc-unpw-news' ); // Plugin post type
}
if( !defined( 'CCS_UNPW_CAT' ) ) {
    define( 'CCS_UNPW_CAT', 'ccs-unpw-cat' ); // Plugin category name
}
if( !defined( 'CCS_UNPW_META_PREFIX' ) ) {
    define( 'CCS_UNPW_META_PREFIX', '_ccsnpw_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */
function ccs_unpw_load_textdomain() {
    load_plugin_textdomain( 'ccs-ultimate-news-plus-widget', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'ccs_unpw_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'ccs_unpw_install' );

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */
function ccs_unpw_install() {

    // Call to generate new rules
    flush_rewrite_rules();
}

// Functions file
require_once( CCS_UNPW_DIR . '/includes/ccs-unpw-functions.php' );

// Script class
require_once( CCS_UNPW_DIR . '/includes/ccs-unpw-script.php' );

// admin file
require_once( CCS_UNPW_DIR . '/includes/admin/class-unpw-admin.php' );

// Plugin Post type file
require_once( CCS_UNPW_DIR . '/includes/ccs-unpw-post-types.php' );

// shortcode
require_once( CCS_UNPW_DIR . '/includes/shortcode/ccs-unpw-shortcode.php');
require_once( CCS_UNPW_DIR . '/includes/shortcode/ccs-unpw-slider-shortcode.php');

// Widget Class
require_once( CCS_UNPW_DIR . '/includes/widgets/ccs-unpw-news-list-widget.php' );