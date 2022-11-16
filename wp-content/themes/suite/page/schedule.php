<?php
/*
  Template Name: 行事曆 (Schedule)
 */
?>
<?php get_header(); ?>
<div class="row">
  <!-- hien thi slider cua trang schedule -->
  <div><?php mySlider(4); ?></div>
  <?php get_template_part('templates/template', 'schedule'); ?>
</div>
<?php get_footer();