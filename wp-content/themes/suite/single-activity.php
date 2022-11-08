<?php get_header(); ?>
    <div>
        <?php get_template_part('templates/template', 'advertising') ?>
        <span class="single-head"><?php echo get_the_date(); ?> | <?php _e('By'); echo get_the_author() ?></span>
        <div>
            <h2 class="single-title"><?php the_title() ?></h2>
            <div class="single-content"><?php the_content() ?></div>
            <?php get_template_part('templates/template', 'single-activity-category') ?>
        </div>
    </div>
<?php get_footer(); ?>