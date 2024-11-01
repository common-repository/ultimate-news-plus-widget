<?php
/**
 * Register Post type functionality
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */
function ccs_unpw_register_post_type() {

  	// 'ccs_news' post type
	$news_labels = array(
		'name'                 => _x('Latest News', 'ccs-ultimate-news-plus-widget'),
		'singular_name'        => _x('Latest News', 'ccs-ultimate-news-plus-widget'),
		'add_new'              => _x('Add News Item', 'ccs-ultimate-news-plus-widget'),
		'add_new_item'         => __('Add New News Item', 'ccs-ultimate-news-plus-widget'),
		'edit_item'            => __('Edit News Item', 'ccs-ultimate-news-plus-widget'),
		'new_item'             => __('New News Item', 'ccs-ultimate-news-plus-widget'),
		'view_item'            => __('View News Item', 'ccs-ultimate-news-plus-widget'),
		'search_items'         => __('Search  News Items', 'ccs-ultimate-news-plus-widget'),
		'not_found'            => __('No News Items found', 'ccs-ultimate-news-plus-widget'),
		'not_found_in_trash'   => __('No News Items found in Trash', 'ccs-ultimate-news-plus-widget'), 
		'_builtin'             =>  false,
		'parent_item_colon'    => '',
		'menu_name'            => __('Latest News', 'ccs-ultimate-news-plus-widget'),
	);

	$news_args = array(
		'labels'              => $news_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 
										'slug'       => apply_filters('ccs_unpw_post_slug', 'ccc-unpw-news'),
										'with_front' => false
									),
		'capability_type'   => 'post',
		'has_archive'       => true,
		'hierarchical'      => false,
		'menu_position'     => 5,
		'menu_icon'         => 'dashicons-feedback',
		'supports'          => array('title','editor','thumbnail','excerpt', 'publicize')
	);

	// Register post type
    register_post_type( CCS_UNPW_POST_TYPE, apply_filters('ccs_unpw_register_post_type', $news_args) );
}

// Action to register plugin post type
add_action('init', 'ccs_unpw_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0
 */
function ccs_unpw_register_taxonomies() {

    $labels = array(
        'name'              => _x( 'Category', 'ccs-ultimate-news-plus-widget' ),
        'singular_name'     => _x( 'Category', 'ccs-ultimate-news-plus-widget' ),
        'search_items'      => __( 'Search Category', 'ccs-ultimate-news-plus-widget' ),
        'all_items'         => __( 'All Category', 'ccs-ultimate-news-plus-widget' ),
        'parent_item'       => __( 'Parent Category', 'ccs-ultimate-news-plus-widget' ),
        'parent_item_colon' => __( 'Parent Category:', 'ccs-ultimate-news-plus-widget' ),
        'edit_item'         => __( 'Edit Category', 'ccs-ultimate-news-plus-widget' ),
        'update_item'       => __( 'Update Category', 'ccs-ultimate-news-plus-widget' ),
        'add_new_item'      => __( 'Add New Category', 'ccs-ultimate-news-plus-widget' ),
        'new_item_name'     => __( 'New Category Name', 'ccs-ultimate-news-plus-widget' ),
        'menu_name'         => __( 'News Category', 'ccs-ultimate-news-plus-widget' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('ccs_unpw_cat_slug', 'latest-news-category'), ),
    );

    // Register taxonomies
    register_taxonomy( CCS_UNPW_CAT, array( CCS_UNPW_POST_TYPE ), apply_filters('ccs_unpw_register_category', $args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'ccs_unpw_register_taxonomies');