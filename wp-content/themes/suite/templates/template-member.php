<div class="group group-border" id="member-list">
    <div class="group-title" aria-current="true"><label><?php _e('Member') ?></label></div>
    <?php  
        require_once(DIR_MODEL . 'model-member-function.php');
        $model = new Admin_Model_Member_Function();
        $cate = get_query_var('industry'); // industry trùng với tên khai báo trong rewrite.class.php
        $data = $model->getAllDataMemberByIndustry($cate);
        $itemCount = 1;
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                ?>
                <div class="member member-item" data_id = "<?php echo $itemCount++; ?>" >
                    <!-- <div class="member-head <?php //echo $itemCount; ?> " data_id = "<?php //echo $itemCount; ?>" 
                    onclick="showContent(<?php //echo ++$offset; ?>)"> -->
                    <div class="member-head">
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
                            <!-- <div class="col-lg-6"><label><?php //echo _e('Full Name') . ' : ' . $val['contact'] ?></label></div>
                            <div class="col-lg-6"><label><?php //echo _e('Regency') . ' : ' . $val['position'] ?></label></div>
                            <div class="col-lg-6"><label><?php //echo _e('Phone') . ' : ' . $val['phone'] ?></label></div>
                            <div class="col-lg-6"><label><?php //echo _e('email') . ' : ' . $val['email'] ?></label></div>
                            <div class="col-lg-6"><label><?php //echo _e('Service List') . ' : ' . $val['service'] ?></label></div> -->
                            <div class="col-lg-12">
                                <?php 
                                    global $wpdb;
                                    $table = $wpdb->prefix . 'member_industry';
                                    //do trong database industry id duoc luu duoi dang ' ,id1,id2,...'
                                    $sql = "SELECT name FROM $table WHERE ID IN (" . substr($val['industry_id'], 1, -1) . ")";
                                    $industryName = $wpdb->get_results($sql, ARRAY_A);
                                    $stt = 1; $indus = '';
                                    //lay industry name khi duoc check box
                                    foreach($industryName as $val){
                                        $indus .= $val['name'];
                                        if(count($industryName) > $stt){
                                            $indus .= ', &nbsp; ';
                                        }
                                        $stt++;
                                    }
                                ?>
                                <label><?php echo _e('Industries') . ' : ' . $indus ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>  
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
<script type="text/javascript">
    //function dung de dong mo content khi goi ajax neu jQuery.on('click') khong hoat dong
    //function showContent(id){
        //     var ids = '.' + id;
        //     var contentDisplay = jQuery(ids).siblings(".member-content").css('display');
        //     if(contentDisplay == 'none'){
        //         //dong cac content dang mo
        //         jQuery(".member-content").css('display', 'none');
        //         jQuery(ids).siblings(".member-content").slideDown('slow');
        //         jQuery(ids).children().children().children('i').removeClass('fas fa-angle-double-down');
        //         jQuery(ids).children().children().children('i').addClass('fas fa-angle-double-up');     
        //     } else {
        //         //hien thi content duoc click
        //         jQuery(ids).siblings(".member-content").slideUp('30');
        //         jQuery(ids).children().children().children('i').removeClass('fas fa-angle-double-up');
        //         jQuery(ids).children().children().children('i').addClass('fas fa-angle-double-down');
        //     }
    //}

    jQuery(document).ready(function() {
        jQuery('#member-load-more').click(function() {
            loadNewMember('<?php echo $cate ?>', '<?php echo $indus ?>', "#member-list");
            // var lastID = jQuery('.member-item:last-child').attr('data_id');
            // var offset = lastID;
            // jQuery.ajax({
                //     url: 'http://localhost/ctchn/wp-content/themes/suite/ajax/load_new_member.php',
                //     //url: $urls, 
                //     type: "post",
                //     dataType: 'json',
                //     cache: false,
                //     data: {
                //         id : offset, //offset lay so luong member cuoi cung qua last id
                //         indus : '<?php //echo $cate ?>',
                //         indusName : '<?php //echo $indus ?>',
                //         //action : 'member_loadmore',
                //     },
                //     success: function(res) {
                //         if(res.status === 'done'){
                //             jQuery("#member-list").append(res.html);
                //             var $target = jQuery('html,body');
                //             $target.animate({
                //                 scrollTop: $target.height()
                //             }, 2000);
                //         }
                        
                //         //ẩn button khi không còn bài viết hiển thị 
                //         if('' === res){
                //             jQuery('#member-load-more').hide(); 
                //         }
                //     },
                //     error: function (xhr) {
                //         console.log(xhr.reponseText);
                //     }
            // });
        })

        jQuery("body").on("click", ".member-head", function() {
            var contentDisplay = jQuery(this).siblings(".member-content").css('display');
            jQuery(".member-item").children('.member-head').removeClass('show');
      
            if(contentDisplay == 'none'){
                //dong cac content dang mo
                jQuery(".member-content").css('display', 'none');


                jQuery(this).addClass('show');
             
                jQuery(this).siblings(".member-content").slideDown('slow');
                jQuery(this).children().children().children('svg').removeClass('fas fa-angle-double-down');
                jQuery(this).children().children().children('svg').addClass('fas fa-angle-double-up');     
            } else {
                //hien thi content duoc click
                jQuery(this).removeClass('show');
                jQuery(this).siblings(".member-content").slideUp('30');
                jQuery(this).children().children().children('svg').removeClass('fas fa-angle-double-up');
                jQuery(this).children().children().children('svg').addClass('fas fa-angle-double-down');
            }
        })
    })
</script>  