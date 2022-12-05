<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12" style="padding-top: 0.5rem;">
        <div id="articles">
            <div class="owl-carousel owl-theme">
                <?php
                    $wp_query = new WP_Query(getPostTypeShowAtHome('post', 10, ''));
                    if ($wp_query->have_posts()):
                        while ($wp_query->have_posts()):
                            $wp_query->the_post();
                            ?>
                                <div class="page-item">
                                    <div class="page-img">
                                        <?php 
                                        // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                        if($url != '') {?>
                                            <img src="<?php echo $url[0]; ?>" class="w-100 img" title="<?php the_title() ?>"/>
                                        <?php } else{ ?>
                                            <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img" title="<?php the_title() ?>" />
                                        <?php } ?>  
                                    </div>
                                    <div class="page-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
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
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        //so luong item hien thi thong qua responsive
        var count = 0;
        bodyContainerWidth = jQuery("body").width();
        if(bodyContainerWidth <= 500) {
            var count = 1;
        }else if(bodyContainerWidth <= 950) {
            var count = 2;
        }else if(bodyContainerWidth <= 1170) {
            var count = 4;
        }else {
            var count = 4;
        }

        jQuery('#articles .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: false,
            auotplayTimeout: 5000,
            dots: false,
            autoplayHoverPause: true,
            items: count,
            navText: ["<i class='fas fa-chevron-circle-left nav-button art-left'></i>",
                "<i class='fas fa-chevron-circle-right nav-button art-right'></i>"
            ],
        });
    })
</script>