<div id="header">
    <div id="header-logo">
        <a href="<?php echo home_url(''); ?>">
            <img src="<?php echo get_image('ctchn_logo.png') ?>" title="ctchn_logo"/>
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
        
        var animationElements = document.querySelectorAll("#header-logo");
        //tao hieu ung khi cuon noi dung trang web
        function myCheck(e) {
            // lay vi tri top & bottom cua element
            var rect = e.getClientRects()[0];
            // xac dinh do cao cua man hinh
            var heiscre = window.innerHeight;
            if(rect.bottom < 0) {
                document.querySelector('.show-on-scroll').classList.add("start");
            } else {
                document.querySelector('.show-on-scroll').classList.remove("start");
            }
        }
        function menuAnimation() {
            //lay tat ca cac doi tuong co class .show-on-scroll
            //var animationElements = document.querySelectorAll('.show-on-scroll')
            //chay vong lap de them class
            animationElements.forEach((el) => {
                myCheck(el);
            });
            //animationElements.myCheck();
        }
    </script>
    <div class="show-on-scroll">
        <div>
            <a href="<?php echo home_url(''); ?>">
                <img src="<?php echo get_image('ctchn_logo.png') ?>" alt="ctchn_logo" 
                title="ctchn_logo" width="60px" style="padding: 5px;" />
            </a>
        </div>
        <div class="menu-computer"><?php get_template_part('templates/template', 'menu'); ?></div>
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
    </div> 
    <div class="menu-computer"><?php get_template_part('templates/template', 'menu'); ?></div>   
</div>

<?php 
    //cac single, cac page tru members,schedule khong hien thi slider
    if( !is_single() && is_page(array('members', 'schedule'))) {?>
        <div><?php get_template_part('templates/template', 'slider'); ?></div>
<?php } ?>