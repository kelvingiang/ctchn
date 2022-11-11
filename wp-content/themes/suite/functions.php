<?php
if (!isset($_SESSION)) {
    session_start();
}

define('THEME_URL', get_stylesheet_directory());  // hang lay path thu muc theme
define('THEME_PART', get_template_directory_uri());

define('DS', DIRECTORY_SEPARATOR);  // phan nay thay doi dau / theo he dieu hanh khac nhau giua window va linx
define('HELPER', THEME_URL . DS . 'helper' . DS);

require_once(HELPER . 'define.php');
require_once(HELPER . 'function.php');
require_once(HELPER . 'style.php');
require_once(HELPER . 'require.php');
require_once(HELPER . 'function-frontend.php');


require_once(DIR_CLASS . 'rewrite.class.php');
new Rewrite_Url();

//================ CHANGE LANGUAGE =================
if (!isset($_SESSION['languages'])) {
    $_SESSION['languages'] = 'cn';
}

global $languages;
function change_translate_text($translated)
{
    if ($_SESSION['languages'] == 'cn') {
        $languages = 'zh_TW';
    } elseif ($_SESSION['languages'] == 'vn') {
        $languages = 'vi_VN';
    } else {
        $languages = 'en_EN';
    }

    if (is_admin()) {
        $file = DIR_LANGUAGES . "admin/data.php";
        // $file = DIR_LANGUAGES . 'admin_language/data.php';
    } else {
        $file = DIR_LANGUAGES . "{$languages}/data.php";
    }
    include_once $file;

    $data = getTranslate();
    if (isset($data[$translated])) {
        return $data[$translated];
    }
    return $translated;
}

add_filter('gettext', 'change_translate_text', 20);
add_theme_support('post-thumbnails');

//================= COT MAC DINH CUA POST ====================
// thay doi cac cot mac dinh cua post, cac cot home,language,setorder se duoc dung chung
// nen ta khong can khai bao chung trong cac slider, news,... dung metabox
add_filter('manage_posts_columns', 'set_custom_edit_columns');
function set_custom_edit_columns($columns)
{
    $date_label = _x('創建日期', 'suite');
    //unset($columns['author']);
    //            unset($columns['categories']);
    unset($columns['tags']);
    unset($columns['comments']);
    unset($columns['date']);
    //$columns['content'] = __('內容');
    $columns['author'] = __('Author');
   // $columns['category'] = __('Category');
    $columns['home'] = __('首頁');
    $columns['language'] = __('Language');
    $columns['setorder'] = __('Show Order');
    //$columns['date'] = __('日期');
    //$columns['publisher'] = __('Publisher', 'your_text_domain');


    $columns['date'] = $date_label;
    return $columns;
}
add_action('manage_posts_custom_column', 'Custom_Post_RenderCols');
function Custom_post_RenderCols($columns)
{
    global $post;
    switch ($columns) {

        case 'home':
            if ((get_post_meta($post->ID, '_meta_box_home', true)) == 1) {
                echo "<div class='show-home'></div>";
            }
            break;
        // case 'category':
        //     $terms = wp_get_post_terms($post->ID, 'solutions_category');
        //     if (count($terms) > 0) {
        //         foreach ($terms as $key => $term) {
        //             echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
        //         }
        //     }
        //     break;
        case 'language':
            _e(get_post_meta($post->ID, '_meta_box_language', true));
            break;

        case 'setorder':
            echo get_post_meta($post->ID, '_meta_box_order', true);
            break;
        default:
            break;
    }
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
                        <a href="<?php echo get_the_permalink()?>"><?php esc_html_e('Read More', 'ntl-csw') ?></a>
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

// ================ XU LY LOAD MORE SCROLL PHIA SERVER ================
// add_action( 'wp_ajax_nopriv_article_scrolling_loadmore', 'prefix_article_scrolling_load_more' );
// add_action( 'wp_ajax_article_scrolling_loadmore', 'prefix_article_scrolling_load_more' );
// function prefix_article_scrolling_load_more(){}


// function of  theme ==============================================================================================
// add_action('after_setup_theme', 'blankslate_setup');
// function blankslate_setup()
// {
//     load_theme_textdomain('blankslate', get_template_directory() . '/languages');
//     add_theme_support('title-tag');
//     add_theme_support('post-thumbnails');
//     add_theme_support('responsive-embeds');
//     add_theme_support('automatic-feed-links');
//     add_theme_support('html5', array('search-form', 'navigation-widgets'));
//     add_theme_support('woocommerce');
//     global $content_width;
//     if (!isset($content_width)) {
//         $content_width = 1920;
//     }
//     register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'blankslate')));
// }
add_action('admin_notices', 'blankslate_notice');
function blankslate_notice()
{
    $user_id = get_current_user_id();
    $admin_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $param = (count($_GET)) ? '&' : '?';
    if (!get_user_meta($user_id, 'blankslate_notice_dismissed_7') && current_user_can('manage_options'))
        echo '<div class="notice notice-info"><p><a href="' . esc_url($admin_url), esc_html($param) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__('Ⓧ', 'blankslate') . '</big></a>' . wp_kses_post(__('<big><strong>📝 Thank you for using BlankSlate!</strong></big>', 'blankslate')) . '<br /><br /><a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" target="_blank">' . esc_html__('Review', 'blankslate') . '</a> <a href="https://github.com/tidythemes/blankslate/issues" class="button-primary" target="_blank">' . esc_html__('Feature Requests & Support', 'blankslate') . '</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">' . esc_html__('Donate', 'blankslate') . '</a></p></div>';
}

add_action('admin_init', 'blankslate_notice_dismissed');
function blankslate_notice_dismissed()
{
    $user_id = get_current_user_id();
    if (isset($_GET['dismiss']))
        add_user_meta($user_id, 'blankslate_notice_dismissed_7', 'true', true);
}

add_action('wp_enqueue_scripts', 'blankslate_enqueue');
function blankslate_enqueue()
{
    wp_enqueue_style('blankslate-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
}

add_action('wp_footer', 'blankslate_footer');
function blankslate_footer()
{
?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (deviceAgent.match(/(Android)/)) {
                $("html").addClass("android");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </scrip>
<?php
}
add_filter('document_title_separator', 'blankslate_document_title_separator');
function blankslate_document_title_separator($sep)
{
    $sep = esc_html('|');
    return $sep;
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return esc_html('...');
    } else {
        return wp_kses_post($title);
    }
}
function blankslate_schema_type()
{
    $schema = 'https://schema.org/';
    if (is_single()) {
        $type = "Article";
    } elseif (is_author()) {
        $type = 'ProfilePage';
    } elseif (is_search()) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope itemtype="' . esc_url($schema) . esc_attr($type) . '"';
}
add_filter('nav_menu_link_attributes', 'blankslate_schema_url', 10);
function blankslate_schema_url($atts)
{
    $atts['itemprop'] = 'url';
    return $atts;
}
if (!function_exists('blankslate_wp_body_open')) {
    function blankslate_wp_body_open()
    {
        do_action('wp_body_open');
    }
}
add_action('wp_body_open', 'blankslate_skip_link', 5);
function blankslate_skip_link()
{
    echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__('Skip to the content', 'blankslate') . '</a>';
}
add_filter('the_content_more_link', 'blankslate_read_more_link');
function blankslate_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'blankslate'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}
add_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
function blankslate_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'blankslate'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}
add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'blankslate_image_insert_override');
function blankslate_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('wp_head', 'blankslate_pingback_header');
function blankslate_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
function blankslate_custom_pings($comment)
{
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url(comment_author_link()); ?></li>
<?php
}
add_filter('get_comments_number', 'blankslate_comment_count', 0);
function blankslate_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}
