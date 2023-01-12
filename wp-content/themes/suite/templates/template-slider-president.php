<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div id="slider-presidents">
            <div class="owl-carousel owl-theme">
                <?php
                    $wp_query = new WP_Query(getPostTypePresidentCurrent('president', -1));
                    if ($wp_query->have_posts()):
                        while ($wp_query->have_posts()):
                            $wp_query->the_post();
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                            $img = $url[0] != '' ? $url[0] : PART_IMAGES . 'no-image.jpg';
                            ?>
                                <div class="page-item president">
                                    <div class="page-img">
                                        <img src="<?php echo $img ?>" class="w-100 " title="<?php the_title() ?>"/>
                                    </div>
                                    <div class="page-title">
                                        <label><?php the_title() ?></label>
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
        bodyContainerWidth = jQuery("#slider-presidents").width();
        if(bodyContainerWidth <= 500) {
            var count = 1;
        }else if(bodyContainerWidth <= 950) {
            var count = 2;
        }else if(bodyContainerWidth <= 1170) {
            var count = 3;
        }else {
            var count = 3;
        }

        jQuery('#slider-presidents .owl-carousel').owlCarousel({
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