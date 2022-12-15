<div class="col-xl-12 col-lg-12 col-md-12 page">
    <!-- current president -->
    <div class="page-list president-list" style="background-color: #efefef;">
        <?php
            $wp_query = new WP_Query(getPostTypePresidentCurrent('president', -1));
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                        <div class="page-item col-xl-4 col-lg-4 col-md-12 animation-item">
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
                                <h5><?php the_title() ?></h5>
                                <label><?php the_content() ?></label>
                            </div>
                            
                        </div>    
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();        
        ?>
    </div>
    <!-- president -->
    <div class="page-list president-list">
        <?php
             //getPostTypePresident('president', -1);
            $wp_query_1 = new WP_Query(getPostTypePresident('president', -1));
            if ($wp_query_1->have_posts()):
                while ($wp_query_1->have_posts()):
                    $wp_query_1->the_post();
                    ?>
                        <div class="page-item col-xl-3 col-lg-3 col-md-12 animation-item">
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
                                <h5><?php the_title() ?></h5>
                                <label><?php the_content() ?></label>
                            </div>
                          
                        </div>    
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();        
        ?>
    </div>
    <!-- president no image -->
    <div class="group group-border">
        <div class="group-title"><label><?php _e('President') ?></label></div>
        <?php
            $wp_query_2 = new WP_Query(getPostTypePresident('president', -1));
            if ($wp_query_2->have_posts()):
                while ($wp_query_1->have_posts()):
                    $wp_query_1->the_post();
                    ?>
                        <div class="row president-item">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <label><?php the_title(); ?></label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <label><?php the_content(); ?></label>
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