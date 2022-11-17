jQuery(document).ready(function () {

    
})

//khai bao url
$urls = 'http://localhost/ctchn/wp-admin/admin-ajax.php';

//function su dung infinity scroll
function loadmore(e, $cateID, $page, $listID){
    // lay vi tri top & bottom cua element
    var rect = e.getClientRects()[0];
    // Xac dinh do cao cua man hinh
    var heiscre = window.innerHeight;
    if(rect.top <= heiscre) {
        //console.log('aa');
        //lấy id cuối cùng của danh sách
        var lastID = jQuery('.page-item:last').attr('data_id');
        var cateID = $cateID;
        var page = $page;
        jQuery.ajax({
            //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
            url: 'http://localhost/ctchn/wp-admin/admin-ajax.php',
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
                jQuery($listID).append(res);
                page++;
                // var $target = jQuery('html,body');
                // $target.animate({
                //     scrollTop: $target.height()
                // }, 2000);
            },
            error: function (xhr) {
                console.log(xhr.reponseText);
            }
        });
    }
}


//function su dung button load more cho article page
function loadNewArticle($cateID, $listID)
{
    var lastID = jQuery('.page-item:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
        url: $urls, 
        type: "post",
        dataType: 'html',
        cache: false,
        data: {
            cate : $cateID,
            action: 'article_loadmore',
            offset : offset, //offset lay so luong bai viet cuoi cung qua last id
        },
        success: function(res) {
            jQuery($listID).append(res);
            var $target = jQuery('html,body');
            $target.animate({
                scrollTop: $target.height()
            }, 2000);

            //ẩn button khi không còn bài viết hiển thị 
            if('' === res){
                jQuery('#load-more').hide(); 
                return;
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    });
}

//function su dung button load more cho single
function loadNewSingleArticle($cateID, $listID)
{
    var lastID = jQuery('.single-relate:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        url: $urls,
        type: "post",
        dataType: 'html',
        cache: false,
        data: {
            action: 'single_article_loadmore',
            offset : offset,
            cateID : $cateID,
        },
        success: function(res) {
            jQuery($listID).append(res);
            var $target = jQuery('html,body');
            $target.animate({
                scrollTop: $target.height()
            }, 2000);

            //ẩn button khi không còn bài viết hiển thị 
            if('' === res){
                jQuery('#single-load-more').hide(); 
                return;
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    })
}

//function su dung button load more cho activity page
function loadNewActivity($cateID, $listID)
{
    var lastID = jQuery('.page-item:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
        url: $urls, 
        type: "post",
        dataType: 'html',
        cache: false,
        data: {
            cate : $cateID,
            action: 'activity_loadmore',
            offset : offset, //offset lay so luong bai viet cuoi cung qua last id
        },
        success: function(res) {
            jQuery($listID).append(res);
            var $target = jQuery('html,body');
            $target.animate({
                scrollTop: $target.height()
            }, 2000);

            //ẩn button khi không còn bài viết hiển thị 
            if('' === res){
                jQuery('#activity-load-more').hide(); 
                return;
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    });
}

//function su dung button load more cho single activity
function loadNewSingleActivity($cateID, $listID)
{
    var lastID = jQuery('.single-relate:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        url: $urls,
        type: "post",
        dataType: 'html',
        cache: false,
        data: {
            action: 'single_activity_loadmore',
            offset : offset,
            cateID : $cateID,
        },
        success: function(res) {
            jQuery($listID).append(res);
            var $target = jQuery('html,body');
            $target.animate({
                scrollTop: $target.height()
            }, 2000);

            //ẩn button khi không còn bài viết hiển thị 
            // if(offset >= $counts ){
            //     jQuery('#single-activity-load-more').hide(); 
            // }
            if('' === res){
                jQuery('#single-activity-load-more').hide(); 
                return; 
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    })
}

//function su dung button load more cho member
function loadNewMember($indus, $indusName, $listID)
{
    var lastID = jQuery('.member-item:last-child').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        //url: 'http://localhost/ctchn/wp-content/themes/suite/ajax/load_new_member.php',
        url: $urls, 
        type: "post",
        dataType: 'html',
        cache: false,
        data: {
            id : offset, //offset lay so luong member cuoi cung qua last id
            indus : $indus,
            indusName : $indusName,
            action : 'member_loadmore',
        },
        success: function(res) {
            //if(res.status === 'done'){
                jQuery($listID).append(res);
                var $target = jQuery('html,body');
                $target.animate({
                    scrollTop: $target.height()
                }, 2000);
            //}
            
            //ẩn button khi không còn bài viết hiển thị 
            if('' === res){
                jQuery('#member-load-more').hide(); 
                return;
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    });
}


