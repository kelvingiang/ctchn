<?php
/*
  Template Name: 商會簡介
 */
?>
<?php get_header(); ?>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo _e('台灣商會簡介 '); ?>: </label> <span><?php echo get_post_meta('1', '_introduction_cn', TRUE) ?></span>
        </div>
    </div>
    
<?php get_footer();