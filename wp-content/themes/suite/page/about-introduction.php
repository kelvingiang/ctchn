<?php
/*
  Template Name: 商會簡介 (About)
 */
?>
<?php get_header(); ?>
<div>
    <div class="row about">
        <h2 class="about-title"><?php echo _e('Introduction'); ?> </h2> 
        <div class="about-content"><?php  echo get_post_meta('1', '_introduction_' . $_SESSION['languages'], TRUE) ?></div>
    </div>
</div>
<?php get_footer();