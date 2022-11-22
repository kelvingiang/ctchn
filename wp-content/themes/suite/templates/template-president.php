<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="page-list" style="background-color: #efefef;">
        <?php
            $wp_query = new WP_Query(getPostTypePresidentCurrent('president', -1));
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                        <div class="page-item col-xl-4 col-lg-4 col-md-12">
                            <div class="page-img">
                                <?php 
                                // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                if($url != '') {?>
                                    <img src="<?php echo $url[0]; ?>" class="w-100 img-president" title="<?php the_title() ?>"/>
                                <?php } else{ ?>
                                    <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img-president" title="<?php the_title() ?>" />
                                <?php } ?>  
                            </div>
                            <div class="page-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                            </div>
                            <div class="page-content-president">
                                <span><?php the_content() ?></span>
                            </div>
                        </div>    
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();        
        ?>
    </div>
    <div class="page-list">
        <?php
            $wp_query_1 = new WP_Query(getPostTypePresident('president', -1,));
            if ($wp_query_1->have_posts()):
                while ($wp_query_1->have_posts()):
                    $wp_query_1->the_post();
                    ?>
                        <div class="page-item col-xl-3 col-lg-3 col-md-12">
                            <div class="page-img">
                                <?php 
                                // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                if($url != '') {?>
                                    <img src="<?php echo $url[0]; ?>" class="w-100 img-president" title="<?php the_title() ?>"/>
                                <?php } else{ ?>
                                    <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img-president" title="<?php the_title() ?>" />
                                <?php } ?>  
                            </div>
                            <div class="page-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                            </div>
                            <div class="page-content-president">
                                <span><?php the_content() ?></span>
                            </div>
                        </div>    
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();        
        ?>
    </div>
</div>