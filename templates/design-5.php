<div class="ccs-unpw-news-post">
	<?php if( !empty($feat_image) ) { ?>
		<div class="ccs-unpw-news-image-bg<?php echo $no_feat_image; ?>">
			<div class="ccs-unpw-news-image-wrap">
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			</div>
			<a href="<?php echo $post_link; ?>" class="ccs-unpw-post-link" target="<?php echo $link_target ?>"></a>
		</div>
	<?php } ?>
	
	<div class="ccs-unpw-post-content-wrapper">
		<div class="ccs-unpw-post-content-inner-wrapper">

			<?php if($showCategory == "true" && !empty($cate_name)){ ?>
				<div class="ccs-unpw-categories">
					<?php echo $cate_name; ?>
				</div>
			<?php } ?>

			<div class="ccs-unpw-post-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target ?>">
					<?php the_title(); ?>
				</a>
			</div>	

			<?php if($show_date == 'true'){ ?>
				<div class="ccs-unpw-date">	
					<?php echo get_the_date(); ?>
				</div>
			<?php }  ?>	

			<?php if($show_content == 'true'){ ?>
				<div class="ccs-unpw-post-content">
					<?php echo ccs_unpw_get_post_excerpt($post->ID, get_the_content(), $word_limit, $readmore_tail ); ?>
				</div>
			<?php } ?>
		</div>
	
		<?php if($show_readmore == 'true'){ ?>
			<div class="ccs-unpw-readmore-link">
				<a class="ccs-unpw-readmore-btn" href="<?php echo $post_link; ?>" target="<?php echo $link_target ?>"><?php _e('Read More', 'ccs-ultimate-news-plus-widget'); ?></a>
			</div>
		<?php } ?>
	</div>
</div>