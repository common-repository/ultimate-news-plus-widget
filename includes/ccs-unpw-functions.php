<?php
/**
 * Plugin generic functions file
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to unique number value
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_slashes_deep($data = array(), $flag = false) {
	
	if($flag != true) {
		$data = ccs_unpw_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('ccs_unpw_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Function to get featured content column
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */
function ccs_unpw_column( $row = '' ) {
	if($row == 2) {
		$per_row = 6;
	} else if($row == 3) {
		$per_row = 4;	
	} else if($row == 4) {
		$per_row = 3;
	} else if($row == 1) {
		$per_row = 12;
	} else{
        $per_row = 12;
    }

    return $per_row;
}

/**
 * Function to get post excerpt
 * 
 * @package Ultimate News Plus Widget
 * @since 2.0
 */
function ccs_unpw_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '55';

	// If post id is passed
	if( !empty($post_id) ) {
		
		if (has_excerpt($post_id)) {

			$has_excerpt 	= true;
			$content 		= get_the_excerpt();
		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}

	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Function to get shortcode designs
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_designs() { 
	$design_arr = array(
		'design-1'	=> __('Design 1', 'ccs-ultimate-news-plus-widget'),
		'design-2'	=> __('Design 2', 'ccs-ultimate-news-plus-widget'),
		'design-3'	=> __('Design 3', 'ccs-ultimate-news-plus-widget'),
		'design-4'	=> __('Design 4', 'ccs-ultimate-news-plus-widget'),
		'design-5'	=> __('Design 5', 'ccs-ultimate-news-plus-widget'),
		'design-6'	=> __('Design 6', 'ccs-ultimate-news-plus-widget'),
		);
	return apply_filters('ccs_unpw_news_designs', $design_arr );
}

/**
 * Function to get post external link or permalink
 * 
 * @package Ultimate News Plus Widget
 * @since 2.0.0
 */
function ccs_unpw_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		$prefix = CCS_UNPW_META_PREFIX;
		
		$post_link = get_post_meta( $post_id, $prefix.'more_link', true );
		
		if( empty($post_link) ) {
			$post_link = get_post_permalink( $post_id );	
		}
	}
	return $post_link;
}

/**
 * Function to add array after specific key
 * 
 * @package Ultimate News Plus Widget
 * @since 2.0.0
 */
function unpw_add_array(&$array, $value, $index) {
	
	if( is_array($array) && is_array($value) ){
		$split_arr 	= array_splice($array, max(0, $index));
    	$array 		= array_merge( $array, $value, $split_arr);
	}

	return $array;
}