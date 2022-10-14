<?php

// QUAN LY CAC PHAN CSS VA JS CHO ADMIN VA CLINET
// PHAN BIET ADD VO PHAN ADMIN HAY CLIENT
function style_header_scripts()
{
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
                //==== PHAN CLIENT================================================================ 
                //====BOOTSTRAP  ============================================
                wp_register_style('bootstrap-css', THEME_PART . '/style/bootstrap.min.css', array(), '1.0', 'all');
                wp_enqueue_style('bootstrap-css');

                wp_register_style('bootstrap-grid-css', THEME_PART . '/style/bootstrap-grid.min.css', array(), '1.0', 'all');
                wp_enqueue_style('bootstrap-grid-css');

                wp_register_style('bootstrap-reboot-css', THEME_PART . '/style/bootstrap-reboot.min.css', array(), '1.0', 'all');
                wp_enqueue_style('bootstrap-reboot-css');

                wp_register_style('bootstrap-utilities-css', THEME_PART . '/style/bootstrap-utilities.min.css', array(), '1.0', 'all');
                wp_enqueue_style('bootstrap-utilities-css');

                wp_register_script('bootstrap-script', THEME_PART . '/js/bootstrap.min.js', array('jquery'));
                wp_enqueue_script('bootstrap-script');

                wp_register_script('bootstrap-bundle-script', THEME_PART . '/js/bootstrap.bundle.min.js', array('jquery'));
                wp_enqueue_script('bootstrap-bundle-script');

                //===== AWEONE==================================================================
                wp_register_style('font-awesome-css', THEME_PART . '/style/aweone-all.min.css', array(), '1.0', 'all');
                wp_enqueue_style('font-awesome-css');

                wp_register_script('font-awesome-script', THEME_PART . '/js/aweone-all.min.js', array('jquery'));
                wp_enqueue_script('font-awesome-script');


                //==== SLIDER MAIN  ============================================
                wp_register_style('skitter-styles', THEME_PART . '/js/slider/skitter.styles.css', 'all');
                wp_enqueue_style('skitter-styles');

                wp_register_script('jquery.easing-js', THEME_PART . '/js/slider/jquery.easing.1.3.js', array('jquery'), '1.0.0'); // Custom scripts
                wp_enqueue_script('jquery.easing-js');

                wp_register_script('jquery.skitter-js', THEME_PART . '/js/slider/jquery.skitter.js', array('jquery'), '1.0.0'); // Custom scripts
                wp_enqueue_script('jquery.skitter-js');


                //==== SLIDER FOR MULTY ITEMS =====
                wp_register_style('owl-css', THEME_PART . '/js/slider-owl/css/owl.carousel.css', array(), '1.0', 'all');
                wp_enqueue_style('owl-css');

                wp_register_style('owl.theme.default-css', THEME_PART . '/js/slider-owl/css/owl.theme.default.css', array(), '1.0', 'all');
                wp_enqueue_style('owl.theme.default-css');

                wp_register_script('owl.carousel-js', THEME_PART . '/js/slider-owl/owl.carousel.js', array('jquery'), '1.0.0'); // Custom scripts
                wp_enqueue_script('owl.carousel-js');

                // ===== TU DONG  AN HIEN THANH   MAIN ME NU ===========================================
                // wp_register_script('autohidingnavbar', THEME_PART . '/js/jquery.bootstrap-autohidingnavbar.js', array('jquery'));
                // wp_enqueue_script('autohidingnavbar');

                //============SUPER FISH MENU ============
                wp_register_style('superfish-menu-styles', THEME_PART . '/js/superfish-menu/superfish.css', 'all');
                wp_enqueue_style('superfish-menu-styles');

                wp_register_script('superfish-menu-js', THEME_PART . '/js/superfish-menu/superfish.js', array('jquery'), '1.0.0'); // Custom scripts
                wp_enqueue_script('superfish-menu-js');

                //======SLICK=================================================

                // wp_register_style('slick-theme-css', THEME_PART . '/js/slick/slick-theme.css', array(), '1.0', 'all');
                // wp_enqueue_style('slick-theme-css');

                // wp_register_script('slick-js', THEME_PART . '/js/slick/slick.min.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('slick-js');




                // wp_register_style('camera-css', THEME_PART . '/js/slider/camera.css', array(), '1.0', 'all');
                // wp_enqueue_style('camera-css');

                // wp_register_script('camera-js', THEME_PART . '/js/slider/camera.min.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('camera-js');

                // wp_register_script('easing-js', THEME_PART . '/js/slider/jquery.easing.1.3.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('easing-js');

                // wp_register_script('mobile.customized-js', THEME_PART . '/js/slider/jquery.mobile.customized.min.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('mobile.customized-js');
                //        
                //        
                //==== MULTY SLIDER============================================
                // wp_register_style('flexisel-style', THEME_PART . '/js/slider-multi/flexisel.css', array(), '1.0', 'all');
                // wp_enqueue_style('flexisel-style');

                // wp_register_script('flexisel-js', THEME_PART . '/js/slider-multi/jquery.flexisel.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('flexisel-js');

                // wp_register_script('jcarousel-js', THEME_PART . '/js/jquery.jcarousellite-1.0.1.js', array('jquery'), '1.0.0'); // Custom scripts
                // wp_enqueue_script('jcarousel-js');


                //=====  ZOOM    =\================================
                // wp_register_script('prefixfree-js', THEME_PART . '/js/zoom/prefixfree.js', array('jquery'));
                // wp_enqueue_script('prefixfree-js');

                //====== MY STYLE ==================================================================
                wp_register_style('my-main-css', THEME_PART . '/style/style/main.css', array(), '1.0', 'all');
                wp_enqueue_style('my-main-css');
        } else {

                //====PHAN ADMIN=========================================================
                wp_register_style('admin-style', THEME_PART . '/style/admin_ctchn_suite/admin-style.css', array(), '1.0', 'all');
                wp_enqueue_style('admin-style');
                if (get_current_user_id() != 1) {
                        wp_register_style('admin-denied', THEME_PART . '/style/admin/admin-denied.css', array(), '1.0', 'all');
                        wp_enqueue_style('admin-denied');
                }

        }

        // ==ADD CHO CA ADMIN VA CLIENT=========================================================

        wp_register_script('jquery-ui-js', THEME_PART . '/js/jquery-ui.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('jquery-ui-js');

        wp_register_style('jquery-ui-css', THEME_PART . '/style/jquery-ui.min.css', array(), '1.0', 'all');
        wp_enqueue_style('jquery-ui-css');

        wp_register_script('jquery-custom-js', THEME_PART . '/js/custom.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('jquery-custom-js');
}

//add_action('wp_enqueue_scripts', 'style_header_scripts'); 
add_action('init', 'style_header_scripts');
