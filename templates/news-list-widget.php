<li class="ccs-unpw-news-li">
    
    <a class="ccs-unpw-newspost-title" href="<?php echo $post_link ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    
    <?php if($date == "true" ||  $show_category == "true"){ ?>
   
        <div class="ccs-unpw-widget-date-post">
            
            <?php echo ($date == "true") ? get_the_date() : "" ;?>
            <?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " | " : "";?>
            <?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name : "" ?>
        </div>
   <?php } ?>
</li>