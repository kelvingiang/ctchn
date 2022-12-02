<div class="col-xl-12 col-lg-12 col-md-12">
    <ul class="friend-link-list">
    <?php 
        $wp_query = new WP_Query(getPostTypeFriendLink('friendly-link', -1));
        if($wp_query->have_posts()):
            while($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                    <li class="friend-link-item">
                        <a href="<?php echo get_post_meta(get_the_ID(),'_meta_box_website',true) ?>"
                        target="blank"><?php the_title() ?></a>
                    </li>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query(); 
    ?>
    </ul>
</div>