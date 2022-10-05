<form action="" method="post" enctype="multipart/form-data" id="f-about" name="f-about">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row" colspan="2"> <h2><?php echo __('商 會 資 訊') ?></h2></th>
            </tr>
            <tr>
                <td>
                    <nav>
                        <div class="nav nav-tabs" id="nav-name-tab" role="tablist">
                            <button class="active btn-nav-cn" id="name_cn_tab" data-bs-toggle="tab" 
                                data-bs-target="#name_cn" type="button" role="tab" aria-controls="name_cn" aria-selected="true">中文 (cn)</button>
                            <button class=" btn-nav-vn" id="name_vn_tab" data-bs-toggle="tab" 
                                data-bs-target="#name_vn" type="button" role="tab" aria-controls="name_vn" aria-selected="false">越文 (vn)</button>
                            <button class=" btn-nav-en" id="name_en_tab" data-bs-toggle="tab" 
                                data-bs-target="#name_en" type="button" role="tab" aria-controls="name_en" aria-selected="false">英文 (en)</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-name-content">
                        <!-- cn -->
                        <div class="tab-pane fade show active" id="name_cn" role="tabpanel" aria-labelledby="name_cn_tab" tabindex="0">
                            <div class="title-cell"> 
                                <label><?php echo __('商會名稱'); ?></label>
                                <input class="type-text" type="text" name="txt_name_cn" id="txt_name_cn" value="<?php echo get_option('about_name_cn') ?>" />
                                <i id="error-name-cn" class="error"></i>
                            </div>
                            <div class="title-cell">
                                <label><?php echo __('地址'); ?></label>
                                <input class="type-text" style="margin-right: 10px;" type="text" name="txt_address_cn" id="txt_address_cn" value="<?php echo get_option('about_address_cn') ?>" />
                                <i id="error-address-cn" class="error"></i>
                            </div>
                            <div class="title-cell">
                                <label><?php echo __('聯絡電話'); ?></label>
                                <input class="type-phone" type="text" name="txt_phone" id="txt_phone" value="<?php echo get_option('about_phone') ?>" />
                            </div>
                            <div class="title-cell">
                                <label><?php echo __('E-Mail'); ?></label>
                                <input class="type-email email" type="text" name="txt_email" id="txt_email" value="<?php echo get_option('about_email') ?>" />
                                <i id="error-email" class="error"></i>
                            </div>
                            <div class="title-cell"> 
                                <label><?php echo __('台灣商會簡介'); ?><i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_cn', TRUE), 'txt_introduction_cn', array('wpautop' => false, 'editor_height' => '300px')); 
                                ?>
                            </div>
                            <div class="title-cell"> 
                                <label><?php echo __('台灣商會規則'); ?><i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_cn', TRUE), 'txt_rule_cn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                        <!-- vn -->
                        <div class="tab-pane fade" id="name_vn" role="tabpanel" aria-labelledby="name_vn_tab" tabindex="0">
                            <div class="title-cell">
                                <label><?php echo __('Tên Hiệp Hội'); ?></label>
                                <input class="type-text" type="text" name="txt_name_vn" id="txt_name_vn" value="<?php echo get_option('about_name_vn') ?>" />
                                <i id="error-name-vn" class="error"></i>
                            </div>
                            <div class="title-cell"> 
                                <label><?php echo __('Địa Chỉ'); ?></label>  
                                <input class="type-text" type="text" name="txt_address_vn" id="txt_address_vn" value="<?php echo get_option('about_address_vn') ?>" />
                                <i id="error-address-vn" class="error"></i>
                            </div>
                            <div class="title-cell">
                                <label><?php echo __('Giới Thiệu'); ?><i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_vn', TRUE), 'txt_introduction_vn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                            <div class="title-cell"> 
                                <label><?php echo __('Nội Quy'); ?><i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_vn', TRUE), 'txt_rule_vn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                        <!-- en -->
                        <div class="tab-pane fade" id="name_en" role="tabpanel" aria-labelledby="name_en_tab" tabindex="0">
                            <div class="title-cell">
                                <label>Name <i id="error-name" class="error"></i></label>
                                <input class="type-text" type="text" name="txt_name_en" id="txt_name_en" value="<?php echo get_option('about_name_en') ?>" />
                            </div>
                            <div class="title-cell">
                                <label>Address <i id="error-address" class="error"></i></label>  
                                <input class="type-text" type="text" name="txt_address_en" id="txt_address_en" value="<?php echo get_option('about_address_en') ?>" />
                            </div>
                            <div class="title-cell">
                                <label>Introduction <i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_en', TRUE), 'txt_introduction_en', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                            <div class="title-cell"> 
                                <label>Rules <i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_en', TRUE), 'txt_rule_en', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                    </div>
                
            </tr>
            <tr>
                <td colspan="2" style=" text-align: left; padding-left: 43% ">
                    <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button button-primary button-large" >
                </td>            
            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#btn_submit').click(function(e) {
            //kiểm tra các trường không được rỗng
            var name_cn = jQuery('#txt_name_cn').val();
            var name_vn = jQuery('#txt_name_vn').val();
            if (name_cn === '') {
                jQuery('#error-name-cn').text('<?php echo __('請輸入商會名稱 !'); ?>');
                e.preventDefault();
            }
            if (name_vn === '') {
                jQuery('#error-name-vn').text('<?php echo __('Tên không được để trống !'); ?>');
                e.preventDefault();
            }

            var address_cn = jQuery('#txt_address_cn').val();
            var address_vn = jQuery('#txt_address_vn').val();
            if (address_cn === '') {
                jQuery('#error-address-cn').text('<?php echo __('請輸入地址 !'); ?>');
                e.preventDefault();
            }
            if (address_vn === '') {
                jQuery('#error-address-vn').text('<?php echo __('Địa chỉ không được để trống !'); ?>');
                e.preventDefault();
            }
        })
    })
</script>