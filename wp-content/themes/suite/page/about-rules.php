<?php
/*
  Template Name: 商會章程 (About)
 */
?>
<?php get_header() ?>
<div class="container-fluid">
  <div class="row">
    <div class="about-title"><h2><?php echo _e('Rules'); ?></h2></div> 
    <div class="about-content"><?php echo get_post_meta('1', '_rule_' . $_SESSION['languages'], TRUE) ?></div>
  </div>
</div>
<?php get_footer() ?>