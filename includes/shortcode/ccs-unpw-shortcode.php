<?php 
/**
 * 'ccs_news' Shortcode
 * 
 * @package Ultimate News Plus Widget
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function ccs_unpw_get_news( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit'					=> 10,
		'category' 				=> '',
		'design'	 			=> 'design-1',
		'grid' 					=> 3,
		'show_date' 			=> 'true',
		'show_category_name'	=> 'true',
		'show_content' 			=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'post_date',
		'link_target'			=> 'self',
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'show_readmore' 		=> 'true',
		'word_limit' 			=> 20,
		'readmore_tail' 		=> '...',
		'pagination' 			=> 'false',
		), $atts));
	
	$shortcode_designs 	= ccs_unpw_designs();
	$posts_per_page		= (!empty($limit)) 						? $limit 						: 10;
	$cat 				= (!empty($category))					? explode(',',$category) 		: '';
	$gridcol 			= (!empty($grid))						? $grid 						: '3';
	$show_date 			= ( $show_date == 'true' ) 				? 'true' 						: 'false';
	$showCategory 		= ( $show_category_name == 'true' ) 	? 'true' 						: 'false';
	$show_content 		= ( $show_content == 'true' ) 			? 'true' 						: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 			= (!empty($orderby))					? $orderby						: 'post_date';
	$link_target 		= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$exclude_post 		= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$posts 				= !empty($posts)						? explode(',', $posts) 			: array();
	$show_readmore 		= ( $show_readmore == 'true' ) 			? 'true' 						: 'false';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$grid_clmn       	= ccs_unpw_column($grid);
	$grid_cls       	= 'ccs-medium-'.$grid_clmn.' ccs-column';
	$word_limit 		= (!empty($word_limit)) 				? $word_limit 					: 20;
	$readmore_tail 		= (!empty($readmore_tail)) 				? $readmore_tail 				: '...';
	$pagination 		= ( $pagination == 'true' ) 			? 'true' 						: 'false';

	$design_file_path 	= CCS_UNPW_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) 		? $design_file_path : '';

	global $post;

	$args = array (
		'post_type'      	=> CCS_UNPW_POST_TYPE,
		'orderby'        	=> $orderby,
		'order'          	=> $order,
		'posts_per_page' 	=> $posts_per_page,
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
		);

	if($cat != "") {
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => CCS_UNPW_CAT, 
				'field' => 'id', 
				'terms' => $cat
			) 
		);
	}

	// Taking some defaults
	$count 			= 0;
	$news_main_cls 	= 'ccs-unpw-news-wrapper ccs-unpw-'.$design.' css-clearfix';
	
	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	if ( $query->have_posts() ) { ?>

		<div class="<?php echo $news_main_cls; ?>">

			<?php while ( $query->have_posts() ) : $query->the_post(); 
			
			$feat_image 	= wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			$no_feat_image 	= empty($feat_image) ? ' ccs-no-feat-img' : '';
			$count++;
			$css_class 		= "first-last";
			$news_links 	= array();
			$terms 			= get_the_terms( $post->ID, CCS_UNPW_CAT );
			$post_link		= ccs_unpw_get_post_link( $post->ID );
			
			if($terms) {
				
				foreach ( $terms as $term ) {
				
					$term_link = get_term_link( $term );
				
					$news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
				}
			}
			
			$cate_name = join( "", $news_links );

			if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
			if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; } ?>

			<div class="ccs-grid <?php echo $grid_cls; ?> <?php  echo $css_class; ?>">
				
				<?php 	
				
					if( $design_file ) {
					include( $design_file );
				} ?>
			</div>

			<?php endwhile;
			
			if($pagination == 'true'){ ?>
			
				<div class="ccs-unpw-pagination css-clearfix">
			
					<div class="ccs-unpw-prev ccs-unpw-page"><?php next_posts_link( __('Next >>', 'ccs-ultimate-news-plus-widget'), $query->max_num_pages ); ?></div>
			
					<div class="ccs-unpw-next ccs-unpw-page"><?php previous_posts_link( __('<< Previous', 'ccs-ultimate-news-plus-widget') ); ?> </div>
				</div>
			<?php } ?>
		</div>
	<?php }
	
	wp_reset_query();
	$content .= ob_get_clean();
	return $content;
}
// 'ccs_news' shortcode
add_shortcode('ccs_news', 'ccs_unpw_get_news');