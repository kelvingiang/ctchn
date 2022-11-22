<?php
/*
  Template Name: 商會簡介 (About)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
    <div class="about-title"><h2><?php echo _e('Introduction'); ?></h2></div> 
    <div class="about-content"><?php echo get_post_meta('1', '_introduction_' . $_SESSION['languages'], TRUE) ?></div>
  </div>
</div>
<?php get_footer();