jQuery(document).ready(function () {

    
})

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
function loadNewArticle($counts, $cateID, $listID)
{
    var lastID = jQuery('.page-item:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
        url: 'http://localhost/ctchn/wp-admin/admin-ajax.php', 
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
            if(offset >= $counts){
                jQuery('#load-more').hide(); 
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    });
}

//function su dung button load more cho single
function loadNewSingleArticle($counts, $cateID, $listID)
{
    var lastID = jQuery('.single-relate:last').attr('data_id');
    var offset = lastID;
    jQuery.ajax({
        url: 'http://localhost/ctchn/wp-admin/admin-ajax.php',
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
            if(offset >= $counts ){
                jQuery('#single-load-more').hide(); 
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    })
}