<li class="ccs-unpw-news-li">
    
    <div class="ccs-unpw-news-thumb-left<?php echo $no_feat_image; ?>">
    
        <?php if (!empty($feat_image[0])) { ?>
    
                <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>">                      
    
                    <img src="<?php echo $feat_image[0]; ?>" />
                </a>
        <?php } ?>
    </div>
	
    <div class="ccs-unpw-news-thumb-right">
    
        <a class="ccs-unpw-newspost-title" href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	
    		<?php if($date == "true" ||  $show_category == "true"){ ?>
	
    		   	<div class="ccs-unpw-widget-date-post">
	
    				<?php echo ($date == "true")? get_the_date() : "" ;?>
	          		<?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " | " : "";?>
	          		<?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name : "" ?>
				</div>
		   <?php } ?>
	</div>
</li>