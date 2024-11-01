<?php
/**
 * Widget API: Latest News Widget Class
 *
 * @package Ultimate News Plus Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/* Register the widget */
function ccs_unpw_widget_load_widgets() {
    register_widget( 'Ccs_Unpw_News_Widget' );
}

/* Load the widget */
add_action( 'widgets_init', 'ccs_unpw_widget_load_widgets' );

class Ccs_Unpw_News_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package Ultimate News Plus Widget
     * @since 1.0
     */
    function __construct() {

        $widget_ops = array('classname' => 'ccs_unpw_News_Widget', 'description' => __('Displayed Latest News Items from the News in a sidebar', 'ccs-ultimate-news-plus-widget') );
        parent::__construct( 'ccs_unpw_news_widget', __('CCS - Latest News Widget', 'ccs-ultimate-news-plus-widget'), $widget_ops );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package Ultimate News Plus Widget
     * @since 1.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']          = sanitize_text_field($new_instance['title']);
        $instance['num_items']      = $new_instance['num_items'];
        $instance['date']           = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']  = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']       = intval( $new_instance['category'] );
        $instance['list_type']      = $new_instance['list_type'];
        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package Ultimate News Plus Widget
     * @since 1.0
     */
    function form($instance) {
        $defaults = array(
        'num_items'         => 5,
        'title'             => __( 'Latest News', 'ccs-ultimate-news-plus-widget' ),
        "date"              => 0,
        'show_category'     => 0,
        'category'          => 0,
        'list_type'         => 'news_list',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>  
        <!-- Title -->
      	<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e( 'Title:', 'ccs-ultimate-news-plus-widget' ); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </label>
        </p>

        <!-- Number of news -->
      	<p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items: ', 'ccs-ultimate-news-plus-widget' ); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" min="1" value="<?php echo $instance['num_items']; ?>" />
            </label>
        </p>
      	
        <!-- Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'ccs-ultimate-news-plus-widget' ); ?></label>
        </p>
        
        <!-- Show category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'ccs-ultimate-news-plus-widget' ); ?></label>
        </p>
        
        <!-- Categories -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'ccs-ultimate-news-plus-widget' ); ?></label>
            <?php
                $news_cat_args = array( 
                    'taxonomy'          => CCS_UNPW_CAT, 
                    'class'             => 'widefat', 
                    'show_option_all'   => __( 'All', 'ccs-ultimate-news-plus-widget' ), 
                    'id'                => $this->get_field_id( 'category' ), 
                    'name'              => $this->get_field_name( 'category' ), 
                    'selected'          => $instance['category'] 
                );
                wp_dropdown_categories( $news_cat_args );
            ?>
            <span class="description"><em><?php _e( 'Note: categories will be shown here when you have added category in Latest News.', 'ccs-ultimate-news-plus-widget' ) ?></em></span>
        </p>

        <!-- List Type -->
        <p>
            <label for="<?php echo $this->get_field_id( 'list_type' ); ?>"><?php _e( 'List Type:', 'ccs-ultimate-news-plus-widget' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'list_type' ); ?>" id="<?php echo $this->get_field_id( 'list_type' ); ?>">
                <option value="news_list" <?php selected( $instance['list_type'], 'news_list' ); ?>><?php _e( 'Latest News List', 'ccs-ultimate-news-plus-widget' ) ?></option>
                <option value="news_thumb" <?php selected( $instance['list_type'], 'news_thumb' ); ?>><?php _e( 'Latest News List with Thumb', 'ccs-ultimate-news-plus-widget' ) ?></option>
            </select>
        </p>

    <?php
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package Ultimate News Plus Widget
     * @since 1.0
     */
    function widget($news_args, $instance) {
       
        extract($news_args, EXTR_SKIP);

        $title          = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest News', 'ccs-ultimate-news-plus-widget' ), $instance, $this->id_base );
        $num_items      = $instance['num_items'];
        $date           = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category  = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category       = $instance['category'];
        $list_type       = $instance['list_type'];

        global $post;

        $news_args = array(
                       'posts_per_page' => $num_items,
                       'post_type'      => CCS_UNPW_POST_TYPE,
                       'post_status'    => array( 'publish' ),
                       'order'          => 'DESC'
                    );

        if( $category != 0 ) {
            $news_args['tax_query'] = array(
                                        array(
                                            'taxonomy'  => CCS_UNPW_CAT,
                                            'field'     => 'term_id',
                                            'terms'     => $category
                                        ));
        }

        $ccs_custom_loop = new WP_Query($news_args);
        
        echo $before_widget;

        if ( $title ) { ?>
             <div class="widget-title">
                <?php echo $before_title . $title . $after_title; ?>
            </div>
        <?php } ?>

        <?php if ($ccs_custom_loop->have_posts()) : ?>
          
            <div class="ccs-unpw-recent-news-items">
          
                <ul>
                        
                    <?php while ($ccs_custom_loop->have_posts()) : $ccs_custom_loop->the_post();
                       
                        $post_link  = ccs_unpw_get_post_link( $post->ID );
                        $terms = get_the_terms( $post->ID, CCS_UNPW_CAT );
                        $feat_image     = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
                        $no_feat_image  = empty($feat_image) ? ' ccs-no-feat-img' : '';
                        $news_links = array();
                            
                        if($terms){

                            foreach ( $terms as $term ) {
                            
                                $term_link = get_term_link( $term );
                                $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                            }
                    	}

                        $cate_name = join( ", ", $news_links );

                        if($list_type == 'news_list'){
                            include(CCS_UNPW_DIR.'/templates/news-list-widget.php');
                        }else{
                            include(CCS_UNPW_DIR.'/templates/news-thumb-list-widget.php');
                        }
                    endwhile;
                wp_reset_query(); ?>
                </ul>
            </div><?php
        endif;
        echo $after_widget;
    }
}