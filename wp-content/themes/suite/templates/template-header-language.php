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