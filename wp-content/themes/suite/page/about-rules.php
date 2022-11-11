<?php
/*
  Template Name: 商會章程 (About)
 */
?>
<?php get_header() ?>
<div class="container">
    <div class="row about">
        <h2 class="about-title"><?php echo _e('Rules'); ?></h2> 
        <div class="about-content"><?php echo get_post_meta('1', '_rule_' . $_SESSION['languages'], TRUE) ?></div>
    </div>
</div>
<?php get_footer() ?>