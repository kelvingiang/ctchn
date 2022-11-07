<div class="row">
    <ul class="list-group" id="member-list">
        <li class="list-group-item active member-title" aria-current="true""><?php _e('Member') ?></li>
        <?php  
            require_once(DIR_MODEL . 'model-member-function.php');
            $model = new Admin_Model_Member_Function();
            $cate = get_query_var('industry'); // industry trùng với tên khai báo trong rewrite.class.php
            $data = $model->getAllDataMemberByIndustry($cate);
            $itemCount = 1;
            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    ?>
                    <li class="list-group-item member-item" data_id = "<?php echo $itemCount++; ?>">
                        <a><?php echo $val['company_cn'] ?></a>  
                    </li>
                    <?php
                }
            }
        ?>
    </ul>  
    <div id="member-load-more">
        <!-- <a href="#!" class="btn ">Load more <i class="fas fa-chevron-double-down"></i></a> -->
        <svg style=" font-size: 35px; color: #999; height: 50px;" 
            class="svg-inline--fa fa-angle-double-down fa-w-10" 
            aria-hidden="true" focusable="false" data-prefix="fa" 
            data-icon="angle-double-down" role="img" xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 320 512" data-fa-i2svg="">
            <path fill="currentColor" d="M143 256.3L7 120.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 
                33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0L313 86.3c9.4 9.4 9.4 
                24.6 0 33.9l-136 136c-9.4 9.5-24.6 9.5-34 .1zm34 192l136-136c9.4-9.4 9.4-24.6 
                0-33.9l-22.6-22.6c-9.4-9.4-24.6-9.4-33.9 0L160 352.1l-96.4-96.4c-9.4-9.4-24.6-9.4-33.9 
                0L7 278.3c-9.4 9.4-9.4 24.6 0 33.9l136 136c9.4 9.5 24.6 9.5 34 .1z">
            </path>
        </svg>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#member-load-more').click(function() {
            var lastID = jQuery('.member-item:last').attr('data_id');
            var offset = lastID;
            jQuery.ajax({
                url: 'http://localhost/ctchn/wp-content/themes/suite/ajax/load_new_member.php',
                //url: 'http://localhost/ctchn/wp-admin/admin-ajax.php', 
                type: "post",
                dataType: 'json',
                cache: false,
                data: {
                    id : offset, //offset lay so luong member cuoi cung qua last id
                    value : <?php echo $val ?>,
                },
                success: function(res) {
                    if(res.status === 'done'){
                        jQuery("#member-list").append(res.html);
                        var $target = jQuery('html,body');
                        $target.animate({
                            scrollTop: $target.height()
                        }, 2000);
                    }
                    
                    //ẩn button khi không còn bài viết hiển thị 
                    if(offset >= 20){
                        jQuery('#member-load-more').hide(); 
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
        })
    })
</script>  