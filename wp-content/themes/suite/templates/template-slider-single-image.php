<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12" style="margin-top: 2rem;">
        <ul id="slider-single-image">
            <?php
                global $post;
                //lay chuoi chua the image
                $data = get_post_meta($post->ID, '_meta_box_image', TRUE);
                $image = explode('</p>',$data);
                foreach($image as $img){
                    ?>
                        <li><?php print_r($img) ?></li>
                    <?php
                }  
            ?>
        </ul>
    </div>
</div>
<script>
    //so luong item hien thi thong qua responsive
    var count = 0;
    bodyContainerWidth = jQuery("#slider-single-image").width();
    if(bodyContainerWidth <= 500) {
        var count = 1;
    }else if(bodyContainerWidth <= 950) {
        var count = 2;
    }else if(bodyContainerWidth <= 1170) {
        var count = 3;
    }else {
        var count = 3;
    }
    jQuery('#slider-single-image').flexisel({
        visibleItems: count,
        itemsToScroll: count,
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: false
        }
    });
</script>