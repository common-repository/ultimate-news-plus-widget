<?php 
/**
 * 'ccs_news_slider' Shortcode
 * 
 * @package Ultimate News Plus Widget
 * @since 2.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function ccs_unpw_get_news_slider( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit'					=> 10,
		'category' 				=> '',
		'design'	 			=> 'design-1',
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
		'slides_column' 		=> 3,
		'slides_scroll' 		=> 1,
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'loop' 					=> 'true',
		), $atts));
	
	$shortcode_designs 		= ccs_unpw_designs();
	$posts_per_page			= (!empty($limit)) 						? $limit 						: 10;
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$slides 				= (!empty($slides))						? $slides 						: '3';
	$show_date 				= ( $show_date == 'true' ) 				? 'true' 						: 'false';
	$showCategory 			= ( $show_category_name == 'true' ) 	? 'true' 						: 'false';
	$show_content 			= ( $show_content == 'true' ) 			? 'true' 						: 'false';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= (!empty($orderby))					? $orderby						: 'post_date';
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$exclude_post 			= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$posts 					= !empty($posts)						? explode(',', $posts) 			: array();
	$show_readmore 			= ( $show_readmore == 'true' ) 			? 'true' 						: 'false';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$word_limit 			= (!empty($word_limit)) 				? $word_limit 					: 20;
	$readmore_tail 			= (!empty($readmore_tail)) 				? $readmore_tail 				: '...';
	$slides_column 			= !empty($slides_column) 				? $slides_column 				: '3';
	$slides_scroll 			= !empty($slides_scroll) 				? $slides_scroll				: '1';
	$dots 					= ( $dots == 'true' ) 					? 'true' 						: 'false';
	$arrows 				= ( $arrows == 'true' ) 				? 'true' 						: 'false';
	$autoplay 				= ( $autoplay == 'true' ) 				? 'true' 						: 'false';
	$loop 					= ( $loop == 'true' ) 					? 'true' 						: 'false';




	$design_file_path 	= CCS_UNPW_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) 		? $design_file_path : '';

	// Slider configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'loop');

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
	$news_main_cls 	= 'ccs-unpw-news-slider-wrapper ccs-unpw-'.$design;
	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	$unique 		= ccs_unpw_get_unique();

	wp_enqueue_script('ccs-slick-jquery');
	wp_enqueue_script('ccs-unpw-public-script');

	ob_start();

	if ( $query->have_posts() ) { ?>
		
		<div class="ccs-unpw-main-wrp css-clearfix">
			
			<div id="ccs-unpw-slider-<?php echo $unique; ?>" class="<?php echo $news_main_cls; ?>">

				<?php while ( $query->have_posts() ) : $query->the_post(); 
				
					$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$no_feat_image 	= empty($feat_image) ? ' ccs-no-feat-img' : '';
					$news_links = array();
					$terms 		= get_the_terms( $post->ID, CCS_UNPW_CAT );
					$post_link	= ccs_unpw_get_post_link( $post->ID );
					
					if($terms) {
						
						foreach ( $terms as $term ) {
						
							$term_link = get_term_link( $term );
						
							$news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					
					$cate_name = join( "", $news_links ); ?>
						
					<?php if( $design_file ) {
						
						include( $design_file );
					} ?>
				<?php endwhile; ?>
			</div>
			<div class="ccs-unpw-slider-confi" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>
	<?php }
	
	wp_reset_query();
	$content .= ob_get_clean();
	return $content;
}
// 'ccs_news_slider' shortcode
add_shortcode('ccs_news_slider', 'ccs_unpw_get_news_slider');