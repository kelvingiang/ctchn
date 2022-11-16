<div id="header">
    <?php get_template_part('templates/template', 'header-logo'); ?> 
    <?php //get_template_part('templates/template', 'header-language'); ?> 
    <?php get_template_part('templates/template', 'header-scroll'); ?> 
    <?php get_template_part('templates/template', 'header-menu'); ?> 
</div>
<div id="header-mobile">
    <?php get_template_part('templates/template', 'header-logo-mobile'); ?> 
    <?php get_template_part('templates/template', 'header-menu-mobile'); ?> 
</div>
<?php 
    //cac single, cac page tru members,schedule khong hien thi slider
    if( !is_single() && is_page(array('members', 'schedule'))) {?>
        <div><?php get_template_part('templates/template', 'slider'); ?></div>
<?php } ?>