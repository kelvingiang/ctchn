<?php get_template_part('templates/template', 'footer'); ?>

<script>
    //Hien thi menu mobile
    jQuery('#menu-mobile-icon').on('click', function(e) {
        var show = jQuery('#menu-mobile-content').hasClass('show-nav');
        if(!show){
            jQuery('#menu-mobile-content').addClass('show-nav');
            jQuery('#menu-mobile-content').removeClass('close-nav');
        }else{
            jQuery('#menu-mobile-content').addClass('close-nav');
            jQuery('#menu-mobile-content').removeClass('show-nav');
        }
    })

    jQuery('.menu-item-has-children a').on('click', function(e) {
        jQuery(this).siblings('.sub-menu').slideToggle('slow');
    })
</script>
<script type="text/javascript">
    //var elements = document.querySelectorAll("#footers");
    jQuery(document).ready( function () {
        // Khoi tao chay slider skitter
        jQuery('.skitter-large').skitter({
            thumbs: false,
            theme: 'Minimalist',
            numbers_align: 'center',
            numbers: false,
            progressbar: false,
            dots: false,
            navigation: false,
            preview: false,
            interval: 5000, //thoi gian chuyen man hinh
            label: true,
        });

        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            // phan an hien menu
            // kiem tra header khac none moi thuc hien
            if(jQuery('#header').css('display') !== 'none') {
                menuAnimation();
            } 
            // load them du lieu khi gan den footer
            //displayElements();  

            // phan show hinh anh khi re chuot xuong toi
            if(document.querySelector('.animation-item')) {
                animationShow();
            }

            // Phan an hien header trong mobile
            var currentScrollPos = window.pageYOffset;
            if(prevScrollpos > currentScrollPos) {
                document.getElementById("header-mobile").style.top = "0";
            } else {
                document.getElementById("header-mobile").style.top = "-320px";
            }
            prevScrollpos = currentScrollPos;
        }
    });
</script>
<script>
    var myAnimationElements = document.querySelectorAll('.animation-item');
    // tao hieu ung khi cuon noi dung trang web
    function myCheck1(el){
        // lay vi tri top va bottom cua element
        var rect = el.getClientRects()[0];
        // xac dinh do cao man hinh
        var heiscre = window.innerHeight;
        if(!(rect.bottom < 0 || rect.top > heiscre)) {
            el.classList.add('animation-show');
        }
    }
    function animationShow(){
        //lay tat ca cac doi tuong co class .show-on-scroll
        //var animationElements = document.querySelectorAll('.show-on-scroll')
        //chay vong lap de them class
        myAnimationElements.forEach((el) => {
            myCheck1(el);
        });
        //animationElements.myCheck1();
    }
</script>
</body>
</html>