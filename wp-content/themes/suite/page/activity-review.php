<?php
/*
  Template Name: 活動回顧 (Activity)
 */
?>
<?php get_header(); ?>
<div class="row">
  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <?php get_template_part('templates/template', 'activity-review'); ?>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <?php get_template_part('templates/template', 'friendly-link'); ?>
  </div>
</div>
<?php get_footer();