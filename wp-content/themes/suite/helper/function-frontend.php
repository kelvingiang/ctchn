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
// register_nav_menu('mobile-menu-cn', __('Mobile Menu Chinese'));
// register_nav_menu('mobile-menu-vn', __('Mobile Menu Vietnamese'));
// register_nav_menu('mobile-menu-en', __('Mobile Menu English'));  

//function khai bao trong template-menu.php
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
        'slide-cat' => $cateID,
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
        'activity-cat' => $cateID,
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

function getRelatePostTypeActivity($showNum, $cate_id)
{
    $args = array(
        'category__in' => wp_get_post_categories(get_the_ID()),
        'posts_per_page' => $showNum,
        'post__not_in' => array(get_the_ID()),
        'activity-cat' => $cate_id,
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




