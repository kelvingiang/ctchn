<?php
/*
  Template Name: 商會章程
 */
?>
<?php get_header() ?>
<div class="meta-row">
    <div class="title-cell">
        <label><?php echo _e('台灣商會規則'); ?>: </label> <span><?php echo get_post_meta('1', '_rule_cn', TRUE) ?></span>
    </div>
</div>
<?php get_footer() ?>