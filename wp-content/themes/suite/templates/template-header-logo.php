<div id="header-logo">
    <a href="<?php echo home_url(''); ?>">
        <img src="<?php echo get_image('ctchn_logo.png') ?>" title="ctchn_logo" alt="ctchn_logo"/>
    </a>
    <?php get_template_part('templates/template', 'header-language') ?>
</div>
<script>
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