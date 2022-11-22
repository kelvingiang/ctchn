<?php //ob_start() ?>
<?php
/*
  Template Name: 會員 (Member)
 */
?>
<?php get_header(); ?>
<!-- hien thi slider cua trang member -->
<div><?php mySlider(4); ?></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-12 order-lg-1 order-md-2">
            <?php get_template_part('templates/template', 'member'); ?>
        </div>
        <div class="col-lg-4 col-md-12 order-lg-2 order-md-1">
            <?php get_template_part('templates/template', 'member-industry'); ?>
        </div>
    </div>    
</div>
<?php get_footer();