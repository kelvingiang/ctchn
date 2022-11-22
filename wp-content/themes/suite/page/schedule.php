<?php
/*
  Template Name: 行事曆 (Schedule)
 */
?>
<?php get_header(); ?>
<!-- hien thi slider cua trang schedule -->
<div><?php mySlider(4); ?></div>
<div class="container-fluid">
  <div class="row">
    <?php get_template_part('templates/template', 'schedule'); ?>
  </div>
</div>
<?php get_footer();