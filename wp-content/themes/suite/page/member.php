<?php //ob_start() ?>
<?php
/*
  Template Name: 會員 (Member)
 */
?>
<?php get_header(); ?>
<div class="row">
    <!-- hien thi slider cua trang member -->
    <div><?php mySlider(4); ?></div>
    <div class="col-lg-8 col-md-12 order-lg-1 order-md-2 order-sm-2">
        <?php get_template_part('templates/template', 'member'); ?>
    </div>
    <div class="col-lg-4 col-md-12 order-lg-2 order-md-1 order-sm-1">
        <?php get_template_part('templates/template', 'member-industry'); ?>
    </div>
</div>
<?php get_footer();