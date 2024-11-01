<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Ccs_Unpw_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'ccs_unpw_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'ccs_unpw_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Ultimate News Plus Widget
 	 * @since 1.0
	 */
	function ccs_unpw_front_style() {
		
		// Registring and enqueing slick css
		if( !wp_style_is( 'ccs-slick-style', 'registered' ) ) {
			wp_register_style( 'ccs-slick-style', CCS_UNPW_URL.'assets/css/slick.css', null, CCS_UNPW_VERSION );
			wp_enqueue_style('ccs-slick-style');
		}

		// Registring public style
		wp_register_style( 'ccs-unpw-public-style', CCS_UNPW_URL.'assets/css/ccs-news-style.css', null, CCS_UNPW_VERSION );
		wp_enqueue_style('ccs-unpw-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Ultimate News Plus Widget
 	 * @since 2.0
	 */
	function ccs_unpw_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'ccs-slick-jquery', 'registered' ) ) {
			wp_register_script( 'ccs-slick-jquery', CCS_UNPW_URL . 'assets/js/slick.min.js', array('jquery'), CCS_UNPW_VERSION, true );
		}
		
		// Registring public script
		wp_register_script( 'ccs-unpw-public-script', CCS_UNPW_URL.'assets/js/ccs-unpw-public-script.js', null, CCS_UNPW_VERSION );
		wp_localize_script( 'ccs-unpw-public-script', 'UnpW', array(
																'is_mobile' => (wp_is_mobile()) ? 1 : 0,
															));
	}
}

$ccs_unpw_script = new Ccs_Unpw_Script();