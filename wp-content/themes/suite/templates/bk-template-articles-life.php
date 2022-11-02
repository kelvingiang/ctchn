<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-head"><h1></h1></div>
    <div class="page-list" id="articles-life-list">
        <?php 
            //$cateName = '生活情報';
            $itemCount = 1;
            $wp_query = new WP_Query(getPostType('post', 8, 3, ''));
            if($wp_query->have_posts()):
                while($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                        <div class="page-item col-md-4" data_id = "<?php echo $itemCount++; ?>">
                            <div class="page-img">
                                <?php 
                                    // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                                    $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                ?>
                                <img src="<?php echo $url[0]; ?>" class="w-100 img" />
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
        ?>
    </div>
</div>
<script type="text/javascript">
    var page = 2;   
    var stopped = false;
    function loadmore(e){
        // lay vi tri top & bottom cua element
        var rect = e.getClientRects()[0];
        console.log(rect);
        // Xac dinh do cao cua man hinh
        var heiscre = window.innerHeight;
        console.log(heiscre);
        if(rect.top <= heiscre ) {
            console.log('aa');
            //lấy id cuối cùng của danh sách
            var lastID = jQuery('.page-item:last').attr('data_id');
            console.log(lastID);
            var cateID = 8;
            jQuery.ajax({
                //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: "post",
                dataType: 'html',
                cache: false,
                data: {
                    id: lastID,
                    cate : cateID,
                    action: 'article_scrolling_loadmore',
                    page: page,
                },
                success: function(res) {
                    jQuery('#articles-life-list').append(res);
                    page++;
                    var $target = jQuery('html,body');
                    $target.animate({
                        scrollTop: $target.height()
                    }, 2000);
                   // window.location = window.location;
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
            if( stopped == false){
                return true;
            }
        }
        
    }

    function displayElements() {
        //chay vong lap de them bai viet
        elements.forEach((el) => {
            loadmore(el);
        });
    }

    //FUNCTION LOAD MORE PHIA SERVER
    // function prefix_article_scrolling_load_more(){
//     $paged = $_POST['page'];
//     $offset = $_POST['id'];
//     $cateID = $_POST['cate'];
//     $showNum = 3;
//     $wp_query = new WP_Query(
//         $args = array(
//             'post_type' => 'post',
//             'posts_per_page' => $showNum,
//             'post_status' => 'publish',
//             'meta_query' => array(
//                 array(
//                     'key' => '_meta_box_language',
//                     'value' => $_SESSION['languages'],
//                     'compare' => '=='
//                 )
//             ),  
//             'paged' => $paged,
//             'cat' => $cateID,
//             'offset' => $offset,
//         )
//     );
//     if($paged){
//         if ($wp_query->have_posts()):
//             $flag = $offset + 1;
//             while ($wp_query->have_posts()):
//                 $wp_query->the_post();
//                 ?>
    <div class="page-item col-md-4" data_id = "<?php //echo $flag; ?>">
                    <div class="page-img">
                     <?php 
                        // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                     <!-- <img src="<?php //echo $url[0]; ?>" class="w-100 img" />
                     </div>
                     <div class="page-title">
                         <a href="<?php //the_permalink(); ?>"><?php //the_title() ?></a>
                   </div>
                     <div class="page-content">
                         <span ><?php //the_content() ?></span>
                     </div>
                     <div class="page-read-more">
                         <a href="<?php //echo get_the_permalink()?>"><?php //esc_html_e('Read More', 'ntl-csw') ?></a>
                     </div>
                 </div> 
//                 $flag + 1;
//             endwhile;
//         endif;
//         wp_reset_postdata();
//         wp_reset_query(); 
//     }
//     die();
// }
</script>
