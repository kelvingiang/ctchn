<?php get_header(); ?>
    <div>
        <div>
            <h2 class="home-title"><?php _e('Articles') ?></h2>
            <div class="hr3"></div>
            <?php get_template_part('templates/template', 'articles'); ?>
        </div>
    </div>
<?php get_footer();