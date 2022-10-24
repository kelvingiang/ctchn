<?php global $post; ?>
<div class="skitter skitter-large with-dots">
    <ul>
    <?php
        $args = array(
            'post_type' => 'slider',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'slide-category' => 'home',
            // 'meta_query' => array(
            //     array(
            //         'key' => '',
            //         'value' => '',
            //         'compare' => '='
            //     )
            // 
        );
        $wp_query = new WP_Query($args);
        //print_r($wp_query);
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                // cac hieu ung chuyen doi lay
                $a = array("fade", "circlesRotate", "cubeSpread", "glassCube", "blindHeight", "circles", "swapBars", "tube", "cubeJelly", "blindWidth", "paralell", "showBarsRandom", "block");
                $random_keys = array_rand($a); // random array tren de doi hieu ung
                ?>
                <li>
                    <a href="#cubeStop"></a>
                    <?php 
                    // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                    ?>
                    <img src="<?php echo $url[0]; ?>" class="<?php echo $a[$random_keys] ?>"/> 
                    <div class="slider">
                        <p> <?php the_title() ?> </p>
                    </div>
                </li>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
    </ul>
</div>
<script>
    jQuery(document).ready(function() {
        //skitter
        jQuery('.skitter-large').skitter({
            dots: false,
            interval: 5000, //thoi gian chuyen man hinh
        });
    })
</script>