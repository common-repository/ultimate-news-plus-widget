<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Unpw_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'unpw_news_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'unpw_save_metabox_value') );

		// Filter to add extra column in `news-category` table
		add_filter( 'manage_'.CCS_UNPW_CAT.'_custom_column', array($this, 'unpw_news_category_data'), 10, 3 );
		add_filter( 'manage_edit-'.CCS_UNPW_CAT.'_columns', array($this, 'unpw_manage_category_columns') ); 
	}

	/**
	 * News Post Settings Metabox
	 * 
	 * @package Ultimate News Plus Widget
	 * @since 1.0.0
	 */
	function unpw_news_metabox() {
		add_meta_box( 'wpnw-pro-post-sett', __( 'News Other Details', 'ccs-ultimate-news-plus-widget' ), array($this, 'unpw_news_mb_content'), CCS_UNPW_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * News Post Settings Metabox HTML
	 * 
	 * @package Ultimate News Plus Widget
	 * @since 1.0.0
	 */
	function unpw_news_mb_content() {
		include_once( CCS_UNPW_DIR .'/includes/admin/metabox/unpw-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Ultimate News Plus Widget
	 * @since 1.0.0
	 */
	function unpw_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  CCS_UNPW_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = CCS_UNPW_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? ccs_unpw_slashes_deep(trim($_POST[$prefix.'more_link'])) : '';

		update_post_meta($post_id, $prefix.'more_link', $read_more_link);
	}

	/**
	 * Add extra column to news category
	 * 
	 * @package Ultimate News Plus Widget
	 * @since 2.0.0
	 */
	function unpw_manage_category_columns($columns) {

		$new_columns['news_shortcode'] = __( 'News Category Shortcode', 'ccs-ultimate-news-plus-widget' );

		$columns = unpw_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package Ultimate News Plus Widget
	 * @since 2.0.0
	 */
	function unpw_news_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'news_shortcode' ){
			$ouput .= '[ccs_news category="' . $tax_id. '"]<br/>';
			$ouput .= '[ccs_news_slider category="' . $tax_id. '"]';
	    }
		
	    return $ouput;
	}
}

$unpw_admin = new Unpw_Admin();