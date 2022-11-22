<?php get_header(); ?>
    <div>
        <!-- hien thi slider trang home -->
        <div><?php mySlider(4); ?></div>
        <div class="container-fluid">
            <h2 class="home-title"><?php _e('Articles') ?></h2>
            <div class="hr3"></div>
            <?php get_template_part('templates/template', 'articles'); ?>
        </div>
        <div class="container-fluid">
            <h2 class="home-title"><?php _e('Activity') ?></h2>
            <div class="hr3"></div>
            <?php get_template_part('templates/template', 'activity'); ?>
        </div>
        <div class="container-fluid">
            <h2 class="home-title"><?php _e('President') ?></h2>
            <div class="hr3"></div>
            <?php get_template_part('templates/template', 'slider-president'); ?>
        </div>
        <div>
            <?php get_template_part('templates/template', 'map'); ?>
        </div>
    </div>
<?php get_footer();