<div id="president-advertising" style="width: 90%;">
    <div class="owl-carousel owl-theme">
        <?php
            $wp_query = new WP_Query(getPostTypeAdvertising('advertising', 10));
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
                                <a href="<?php echo get_post_meta($post->ID,'_meta_box_website',true); ?>"><?php the_title() ?></a>
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
<script>
    jQuery(document).ready(function() {
         jQuery('#president-advertising .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            auotplayTimeout: 5000,
            dots: false,
            autoplayHoverPause: true,
            items: 4,
            navText: ["<i class='fas fa-chevron-left nav-button art-left'></i>",
                "<i class='fas fa-chevron-right nav-button art-right'></i>"
            ],
            // responsive:{
            //     0:{
            //         items:1
            //     },
            //     600:{
            //         items:3
            //     },
            //     1000:{
            //         items:5
            //     }
            // }

        });
    })
</script>