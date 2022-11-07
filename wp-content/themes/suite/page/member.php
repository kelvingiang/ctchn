<?php //ob_start() ?>
<?php
/*
  Template Name: 會員 (Member)
 */
?>
<?php get_header(); ?>
<div class="row">
    <div class="col-lg-7 col-md-12">
        <?php get_template_part('templates/template', 'member'); ?>
    </div>
    <div class="col-lg-5 col-md-12">
        <?php get_template_part('templates/template', 'member-industry'); ?>
    </div>
</div>
<?php get_footer();