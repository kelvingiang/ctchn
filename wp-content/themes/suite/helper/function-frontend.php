<?php
/*
 * ==================================================
 * --------- FUNCTION DUNG CHO FRONT-END ------------
 * ==================================================
 */

/* ==============================================================
  CHECK THE ARRAY IS NULL
  =============================================================== */

function MenuMain($arr, $class = "menu-main-item", $item_link = 'menu-main-item-link', $item_bg = 'menu-main-item-bg', $hassub = 'has-sub')
{
    foreach ($arr as $key => $val) {
    ?>
        <div class="<?php echo $class ?>">
            <a href="<?php echo home_url($key) ?>" class="<?php echo $item_link ?> <?php echo is_array($val['sub']) ? $hassub : '' ?>">
                <?php echo $val[$_SESSION['languages']] ?>
            </a>
            <div class="<?php echo $item_bg ?>"></div>

            <?php if (is_array($val['sub'])) { ?>
                <div class="<?php echo $val['class'] ?>">
                    <!--/====== AP DUNG DEQUY CHO MENU NHIEU CAPV ================================================-->
                    <?php MenuMain($val['sub'], $val['class'] . '-item', $val['class'] . '-item-link', $val['class'] . '-item-bg', 'has-sub-sub'); ?>
                </div>
            <?php } ?>
        </div>
    <?php
    }
}

function MenuMobile($arr, $item_link = 'menu-mobile-item-link')
{
    foreach ($arr as $key => $val) {
    ?>

        <a href="<?php echo home_url($key) ?>" style="  " class="<?php echo $item_link ?>">
            <?php echo $val[$_SESSION['languages']] ?>
        </a>

    <?php
    }
}

//=============================== MENU ==============================
register_nav_menu('computer-menu-cn', __('Computer Menu Chinese'));
register_nav_menu('computer-menu-vn', __('Computer Menu Vietnamese'));
register_nav_menu('computer-menu-en', __('Computer Menu English'));
register_nav_menu('mobile-menu-cn', __('Mobile Menu Chinese'));
register_nav_menu('mobile-menu-vn', __('Mobile Menu Vietnamese'));
register_nav_menu('mobile-menu-en', __('Mobile Menu English'));  

//function khai bao trong template-head-menu.php
function suite_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => 'primary-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
    );

    wp_nav_menu($menu);
}

//function khai bao trong template-head-menu-mobile.php
function mobile_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => $slug, // class cua mennu
        'container_id' => 'nav-mobile-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-mobile-menu">%3$s</ul>'
    );
    wp_nav_menu($menu);
}

// ==================== FUNCTION SEO ========================
function seo()
{
    //  global $suite;
    global $suite;
    $suite = array(
        'txtTitleSeo' => get_option('company_name_vn'),
        'strDescriptionSeo' => get_option('company_name_vn') . '-' . get_option('company_address_vn'),
        'strKeywordsSeo' => get_option('company_name_vn'),
        'strPageName' => get_query_var('pagename'),
    );
    if (is_home() == true) {

        // THE DOI GIA TRI CUA TITLE WP_HEAD
        function custom_title()
        {
            global $suite;
            return $suite['txtTitleSeo'];
        }

        add_filter('wp_title', 'custom_title');
        echo '<title>' . $suite['txtTitleSeo'] . '</title>';
        echo '<meta name="description" content="' . $suite['strDescriptionSeo'] . '" />';
        echo '<meta name="keywords" content="' . $suite['strKeywordsSeo'] . '" />';
    } else if (is_single() || is_page()) {
        /* ==============================
          global $post;
          $strSeoTitle = get_post_meta($post->ID, '_seo_title', true);
          $strSeoDescription = get_post_meta($post->ID, '_seo_description', true);
          $strSeoKeywords = get_post_meta($post->ID, '_seo_key', true);

          global $strTitle;
          if (empty($strSeoTitle) != false) {
          $strTitle = $suite['txtTitleSeo'] . '-' . get_query_var('pagename');
          } else {
          $strTitle = $suite['txtTitleSeo'] . ' - ' . $strSeoTitle;
          }

          // THE DOI GIA TRI CUA TITLE WP_HEAD
          function custom_title() {
          global $strTitle;
          return $strTitle;
          }
         */

        $cate = get_query_var('cate');
        $sp = get_query_var('sp');

        if (empty($cate) && empty($sp)) {
            add_filter('wp_title', 'custom_title');
            echo '<title> Digiwin' . $suite['strPageName']  . '</title>';
            echo '<meta name="description" content="' . $suite['strDescriptionSeo'] . '" />';
            echo '<meta name="keywords" content="' . $suite['strPageName'] . ', ' . $suite['txtTitleSeo'] . '" />';
        } elseif (!empty($cate)) {
            $cateArr = get_category_by_id($cate);
            add_filter('wp_title', 'custom_title');
            echo '<title>' . $cateArr['name_vn'] . ' Digiwin</title>';
            echo '<meta name="description" content="beautiful, luggage,' . $suite['strDescriptionSeo'] . ' - ' . $cateArr['name_vn'] . '" />';
            echo '<meta name="keywords" content="beautiful, luggage,' . $suite['strPageName'] . ', ' . $suite['txtTitleSeo'] . ', ' . $cateArr['name_vn'] . '" />';
        } elseif (!empty($sp)) {
            $proArr = get_product($sp);
            add_filter('wp_title', 'custom_title');
            echo '<title> ' . $proArr['seo_title'] . ' Digiwin</title>';
            echo '<meta name="description" content="' . $proArr['seo_description'] . '" />';
            echo '<meta name="keywords" content="' . 'Beautiful, ' . $proArr['seo_key'] . '" />';
        }
    } else if (is_tax() || is_tag() || is_category()) {
        global $taxonomy, $term;
        $term = get_term_by('slug', $term, $taxonomy);
        $term_id = $term->term_id;
        $term_meta = get_option("taxonomy_$term_id");

        $strSeoTitle = $term_meta['txtTitleSeo'];
        $strSeoDescription = $term_meta['strDescriptionSeo'];
        $strSeoKeywords = $term_meta['seo_keywords'];

        if (empty($strSeoTitle) != false) {
            $strTitle = $suite['txtTitleSeo'];
        } else {
            $strTitle = $suite['txtTitleSeo'] . ' - ' . $strSeoTitle;
        }

        // THE DOI GIA TRI CUA TITLE WP_HEAD
        function custom_title()
        {
            global $strTitle;
            return $strTitle;
        }

        add_filter('wp_title', 'custom_title');
        echo '<title>' . $strTitle . '</title>';
        echo '<meta name="description" content="' . $strSeoDescription . '" />';
        echo '<meta name="keywords" content="' . $strSeoKeywords . '" />';
    }
    echo '<meta name="robots" content="INDEX, FOLLOW" />';
    echo '<meta http-equiv="REFRESH" content="1800" />';
}

//=================== GET POST TYPE ===============
function getPostType($postType,$cateID,$showNum,$offset)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            )
        ),  
        'paged' => '',
        'cat' => $cateID,
        'offset' => $offset,
    );
    return $args;
}

function getPostTypeSlider($postType,$cateID, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'slide_cat' => $cateID,
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            )
        )
    );
    return $args;
}

function getPostTypeActivity($postType,$cateID, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        //'activity_category' => $cateID,
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            ),
            array(
                'key' => '_meta_box_special',
                'value' => 1,
                'compare' => '='
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'activity_category',
                'field' => 'term_id',
                'terms'    => $cateID
            ),
        ),
    );
    return $args;
}

function getPostTypeFriendLink($postType, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            ),
            array(
                'key' => '_meta_box_website',
            )
        ),
        'order' => 'DESC'
    );
    return $args;
}

function getPostTypeAdvertising($postType, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => '_meta_box_website',
    );
    return $args;
}

function getPostTypePresidentCurrent($postType, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_meta_box_current',
                'value' => '1',
                'compare' => '='
            ),
            // array(
            //     'key' => '_meta_box_president',
            //     'value' => '1',
            //     'compare' => '='
            // ),
        )
    );
    return $args;
}

function getPostTypePresident($postType, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => array(
            // array(
            //     'key' => '_meta_box_current',
            //     'value' => '',
            //     'compare' => '='
            // ),
            array(
                'key' => '_meta_box_president',
                'value' => '1',
                'compare' => '='
            ),
        )
    );
    return $args;
}

function getPostTypeShowAtHome($postType,$showNum,$offset)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            ),
            array(
                'key' => '_meta_box_home',
                'value' => 1,
                'compare' => '='
            ),
        ),  
        'paged' => '',
        //'cat' => $cateID,
        'offset' => $offset,
    );
    return $args;
}

//================= RELATE POST TYPE =================
function getRelatePostType($showNum, $cate_id)
{
    $args = array(
        'category__in' => wp_get_post_categories(get_the_ID()),
        'posts_per_page' => $showNum,
        'post__not_in' => array(get_the_ID()),
        'cat' => $cate_id,
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            )
        ),
    );
    return $args;
}

function getRelatePostTypeActivity($postType, $showNum, $cate_id)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post__not_in' => array(get_the_ID()),
        'meta_query' => array(
            array(
                'key' => '_meta_box_language',
                'value' => $_SESSION['languages'],
                'compare' => '=='
            )
        ),
        'tax_query' => array(
            'taxonomy' => 'activity_category',
            'field' => 'id',
            'terms' => $cate_id,
        ),
    );
    return $args;
}

// ================ XU LY LOAD MORE BUTTON PHIA SERVER ====================
// article page
add_action( 'wp_ajax_nopriv_article_loadmore', 'prefix_load_more' );
add_action( 'wp_ajax_article_loadmore', 'prefix_load_more' );
function prefix_load_more(){
    $showNum = 6;
    $cateID = $_POST['cate'];
    $offset = isset($_POST['offset']) ? (int)( $_POST['offset'] ) : 0; //lay du lieu gui len client 
    if($offset) {
        $wp_query = new WP_Query(
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $showNum,
                'post_status' => 'publish',
                'cat' => $cateID,
                'offset' => $offset,
                'meta_query' => array(
                    array(
                        'key' => '_meta_box_language',
                        'value' => $_SESSION['languages'],
                        'compare' => '=='
                    )
                ),
                'post__not_in' => array(get_the_ID()),
            )
        );
        if($wp_query->have_posts()) : 
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="page-item col-md-3" data_id = "<?php echo ++$offset; ?>">
                    <div class="page-img">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        if($url != '') {?>
                            <img src="<?php echo $url[0]; ?>" class="w-100 img" />
                        <?php } else{ ?>
                            <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img" />
                        <?php } ?>   
                    </div>
                    <div class="page-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </div>
                    <div class="page-content">
                        <span><?php the_content() ?></span>
                    </div>
                    <div class="page-read-more">
                        <a href="<?php //echo get_the_permalink()?>"><?php //echo translate('Read More vvv') ?></a>
                    </div>
                </div>
                <?php
            endwhile;
            endif;
        wp_reset_postdata();
        wp_reset_query();    
    }
    die();
}
//single article page
add_action( 'wp_ajax_nopriv_single_article_loadmore', 'prefix_single_article_loadmore' );
add_action( 'wp_ajax_single_article_loadmore', 'prefix_single_article_loadmore' );
function prefix_single_article_loadmore(){
    $showNum = 2;
    $cate_id = $_POST['cateID'];
    $offset = !empty($_POST['offset']) ? intval( $_POST['offset'] ) : ''; //lay du lieu gui len client 
    if($offset) {
        $wp_query = new WP_Query(
            $args = array(
                'post_type' => 'post',
                'category__in' => wp_get_post_categories(get_the_ID()),
                'posts_per_page' => $showNum,
                'post__not_in' => array(get_the_ID()),
                'offset' => $offset,
                'cat' => $cate_id,
                'meta_query' => array(
                    array(
                        'key' => '_meta_box_language',
                        'value' => $_SESSION['languages'],
                        'compare' => '=='
                    )
                ),
            )
        );
        if($wp_query->have_posts()) : 
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="row single-relate" data_id = "<?php echo ++$offset; ?>">
                        <div class="single-relate-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <?php 
                                // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                if($url != ''){ ?>
                                    <div class="single-relate-image-col">
                                        <img src="<?php echo $url[0]; ?>" class="single-relate-image" title="<?php the_title(); ?>" />
                                    </div>
                                    <div class="single-relate-content">
                                        <?php the_content(); ?>
                                    </div>
                                    <hr class="hr2">
                                <?php }else { ?>  
                                    <div class="single-relate-content">
                                        <?php the_content(); ?>
                                    </div>
                                    <hr class="hr2">
                            <?php } ?>   
                        </div>
                    </div>
                <?php
            endwhile;
            endif;
        wp_reset_postdata();
        wp_reset_query();    
    }
    die();
}

//activity page
add_action( 'wp_ajax_nopriv_activity_loadmore', 'prefix_activity_load_more' );
add_action( 'wp_ajax_activity_loadmore', 'prefix_activity_load_more' );
function prefix_activity_load_more(){
    $showNum = 6;
    $cateID = $_POST['cate'];
    $offset = isset($_POST['offset']) ? (int)( $_POST['offset'] ) : 0; //lay du lieu gui len client 
    if($offset) {
        $wp_query = new WP_Query(
            $args = array(
                'post_type' => 'activity',
                'posts_per_page' => $showNum,
                'post_status' => 'publish',
                'activity-cat' => $cateID,
                'offset' => $offset,
                'meta_query' => array(
                    array(
                        'key' => '_meta_box_language',
                        'value' => $_SESSION['languages'],
                        'compare' => '=='
                    )
                ),
                'post__not_in' => array(get_the_ID()),
            )
        );
        if($wp_query->have_posts()) : 
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="page-item col-md-3" data_id = "<?php echo ++$offset; ?>">
                    <div class="page-img">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        if($url != '') {?>
                            <img src="<?php echo $url[0]; ?>" class="w-100 img" />
                        <?php } else{ ?>
                            <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img" />
                        <?php } ?>   
                    </div>
                    <div class="page-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </div>
                </div>
                <?php
            endwhile;
            endif;
        wp_reset_postdata();
        wp_reset_query();    
    }
    die();
}

//single activity page
add_action( 'wp_ajax_nopriv_single_activity_loadmore', 'prefix_single_activity_loadmore' );
add_action( 'wp_ajax_single_activity_loadmore', 'prefix_single_activity_loadmore' );
function prefix_single_activity_loadmore(){
    $showNum = 2;
    $cate_id = $_POST['cateID'];
    $offset = !empty($_POST['offset']) ? intval( $_POST['offset'] ) : ''; //lay du lieu gui len client 
    if($offset) {
        $wp_query = new WP_Query(
            $args = array(
                'post_type' => 'activity',
                'posts_per_page' => $showNum,
                'post__not_in' => array(get_the_ID()),
                'offset' => $offset,
                'meta_query' => array(
                    array(
                        'key' => '_meta_box_language',
                        'value' => $_SESSION['languages'],
                        'compare' => '=='
                    )
                ),
                'tax_query' => array(
                    'taxonomy' => 'activity_category',
                    'field' => 'id',
                    'terms' => $cate_id,
                ),
            )
        );
        if($wp_query->have_posts()) : 
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="row single-relate" data_id = "<?php echo ++$offset; ?>">
                        <div class="single-relate-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <?php 
                                // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                if($url != ''){ ?>
                                    <div class="single-relate-image-col">
                                        <img src="<?php echo $url[0]; ?>" class="single-relate-image" title="<?php the_title(); ?>" />
                                    </div>
                                    <div class="single-relate-content">
                                        <?php the_content(); ?>
                                    </div>
                                    <hr class="hr2">
                                <?php }else { ?>  
                                    <div class="single-relate-content">
                                        <?php the_content(); ?>
                                    </div>
                                    <hr class="hr2">
                            <?php } ?>   
                        </div>
                    </div>
                <?php
            endwhile;
            endif;
        wp_reset_postdata();
        wp_reset_query();    
    }
    die();
}

//member page
add_action( 'wp_ajax_nopriv_member_loadmore', 'prefix_member_loadmore' );
add_action( 'wp_ajax_member_loadmore', 'prefix_member_loadmore' );
function prefix_member_loadmore(){
    $offset = $_POST['id']; 
    $industry = $_POST['indus'];
    $industryName = $_POST['indusName'];

    require_once(DIR_MODEL . 'model-member-function.php');
    $model = new Admin_Model_Member_Function();
    $data = $model->getMoreDataMemberByIndustry($industry, $offset);
    if (!empty($data)) {
        foreach ($data as $key => $val) {
            ?>
            <div class="member-item" data_id = "<?php echo ++$offset; ?>">
            <div class="member-head <?php echo $offset; ?> " data_id = "<?php echo $offset; ?>" 
                onclick="showContent(<?php echo $offset++; ?>)">
                    <div class="member-title">
                        <i><?php echo $val['serial'] . ' </i> ' . $val['company_cn'] ?>
                    </div>
                    <div class="member-icon">
                        <a class="show-icon"><i class="fas fa-angle-double-down"></i></a>
                    </div>
                </div>
                <div class="member-content">
                    <div class="row">
                        <div class="col-lg-12"><label><?php echo $val['company_vn'] ?></label></div>
                        <div class="col-lg-12"><label><?php echo $val['address_cn'] ?></label></div>
                        <div class="col-lg-12"><label><?php echo $val['address_vn'] ?></label></div>
                        <div class="col-lg-6"><label><?php echo _e('Full Name') . ' : ' . $val['contact'] ?></label></div>
                        <div class="col-lg-6"><label><?php echo _e('Regency') . ' : ' . $val['position'] ?></label></div>
                        <div class="col-lg-6"><label><?php echo _e('Phone') . ' : ' . $val['phone'] ?></label></div>
                        <div class="col-lg-6"><label><?php echo _e('Email') . ' : ' . $val['email'] ?></label></div>
                        <div class="col-lg-6"><label><?php echo _e('Service List') . ' : ' . $val['service'] ?></label></div>
                        <div class="col-lg-12"><label><?php echo _e('Industry') . ' : ' . $industryName ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    die();
    
}

//================= FUNCTION SLIDER ====================
function mySlider($cateID)
{
    ?>
    <div class="skitter skitter-large with-dots">
        <ul>
        <?php
            $wp_query = new WP_Query(getPostTypeSlider('slider', $cateID, -1));
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    // cac hieu ung chuyen doi lay
                    $a = array("fade", "circlesRotate", "cubeSpread", "glassCube", "blindHeight", "circles", "swapBars", "tube", "cubeJelly", "blindWidth", "paralell", "showBarsRandom", "block");
                    $random_keys = array_rand($a); // random array tren de doi hieu ung
                    ?>
                    <li>
                        <a href="#cubeStop"></a>
                        <?php 
                        // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                        <img src="<?php echo $url[0]; ?>" class="<?php echo $a[$random_keys] ?>"/> 
                        <div class="label_text">
                            <p> <?php the_title(); ?> </p>                            
                        </div>
                    </li>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
        ?>
        </ul>
    </div>
    <?php
}



