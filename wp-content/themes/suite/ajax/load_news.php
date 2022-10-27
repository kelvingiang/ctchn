<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$offset = $_POST['id'];
$cateName = $_POST['cate'];
//echo $cateID;
global $wp_query;
$url =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');

while($wp_query->have_posts()):
    $wp_query->the_post();

    // $html .= "<div class='page-item col-md-6' data_id =" . ++$offset . ">";
    // $html .= "<div class='page-img'> ";
    // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
   // $html .= " . $url . = " . wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full') . "";
                
    // $html .= "<img src=" . wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full')[0] . " class='w-100 img' />";
    // $html .= "</div>" ;
    // $html .= "<div class='page-title'>" ;
    // $html .= "<a href=" . the_permalink() . ">" . the_title() . "</a>";
    // $html .= "</div>";
    // $html .= "<div class='page-content'>";
    // $html .= "<span>" . the_content() . "</span>";
    // $html .= "</div>";
    // $html .= "<div class='page-read-more'>";
    // $html .= "<a href=" . get_the_permalink() . ">" . esc_html_e('Read More', 'ntl-csw') . "</a>";
    // $html .= "</div>";
    // $html .= "</div>";

    $html .= "<div class='page-item col-md-6' data_id =" . ++$offset . ">" +
                "<div class='page-img'> " +
                   
                    "<img src='" . $url[0] . "' class='w-100 img' />
                 </div>" +
                 "<div class='page-title'>" +
                      "<a href='" . get_permalink() . "'>" . get_the_title() . "</a> 
                 </div>" +
                 "<div class='page-content'>" +
                     "<span>" . the_content() . "</span>
                 </div>" +
                 "<div class='page-read-more'>" +
                     "<a href='" . get_permalink() . "'>" . esc_html_e('Read More', 'ntl-csw') . "</a>
                 </div>
             </div>";

endwhile;
$response = array(
    'status' => 'done',
    'html' => $html,
);

echo json_encode($response);