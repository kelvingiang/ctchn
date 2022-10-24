<?php
/*
  Template Name: 商會簡介
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <h2 class="about-title"><?php echo _e('Introduction'); ?> </h2> 
        <p class="about-content"><?php echo get_post_meta('1', '_introduction_' . $_SESSION['languages'], TRUE) ?></p>
    </div>
</div>
<?php get_footer();