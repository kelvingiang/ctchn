<div style="margin-top: -32px;">
    <header id="header">
        <div id="header-logo">
            <a href="<?php echo home_url(''); ?>">
                <img src="<?php echo get_image('digiwin_logo.png') ?>" title="ctchn_logo"/>
            </a>
            <div class="header-language"> 
                <a href="" class="link-languages" data-type="cn" onclick="changeLanguages(this)">
                    中 文
                </a> |
                <a href="" class="link-languages" data-type="vn" onclick="changeLanguages(this)">
                    Tiếng Việt
                </a> |
                <a href="" class="link-languages" data-type="en" onclick="changeLanguages(this)">
                    English
                </a>
            </div>
            <?php get_template_part('templates/template', 'menu'); ?>
        </div>
    </header>
</div>
<div><?php get_template_part('templates/template', 'slider'); ?></div>

<script>
    //function thay doi ngon ngu
    function changeLanguages(el){
        var type = jQuery(el).attr('data-type');
        jQuery.ajax({
            url: '<?php echo get_template_directory_uri() . '/ajax/change_languages.php' ?>',
            dataType: 'json',
            type: 'post',
            data: {
                type: type
            },
            success: function(res) {
                // alert(res.status);
                if (res.status === 'ok') {
                    //window.location = location.href;
                    //location.reload();
                    window.location = 'http://localhost/ctchn/';
                    //jQuery('.link-languages').addClass('lang-color');
                }
            }
        });
    } 
    
    
</script>