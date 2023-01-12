<form action="" method="post" enctype="multipart/form-data" id="f-about" name="f-about">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row" colspan="2"> <h2><?php echo __('商 會 資 訊') ?></h2></th>
            </tr>
            <tr>
                <td>
                    <div class="title-cell">
                        <label>聯絡電話</label>
                        <input class="type-phone" type="text" name="txt_phone" id="txt_phone" value="<?php echo get_option('about_phone') ?>" />
                    </div>
                    <div class="title-cell">
                        <label>E-Mail</label>
                        <input class="type-email" type="text" name="txt_email" id="txt_email" value="<?php echo get_option('about_email') ?>" />
                        <i id="error-email" class="error"></i>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="tabs_about">
                        <ul>
                            <li><a href="#tabs-cn">中文 (cn)</a></li>
                            <li><a href="#tabs-vn">越文 (vn)</a></li>
                            <li><a href="#tabs-en">英文 (en)</a></li>
                        </ul>
                        <!-- cn -->
                        <div id="tabs-cn">
                            <div class="title-cell"> 
                                <label>商會名稱 (cn)</label>
                                <input class="type-text" type="text" name="txt_name_cn" id="txt_name_cn" value="<?php echo get_option('about_name_cn') ?>" />
                                <i id="error-name-cn" class="error"></i>
                            </div>
                            <div class="title-cell">
                                <label>地址 (cn)</label>
                                <input class="type-text" style="margin-right: 10px;" type="text" name="txt_address_cn" id="txt_address_cn" value="<?php echo get_option('about_address_cn') ?>" />
                                <i id="error-address-cn" class="error"></i>
                            </div>
                            <div class="title-cell"> 
                                <label>台灣商會簡介 (cn)<i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_cn', TRUE), 'txt_introduction_cn', array('wpautop' => false, 'editor_height' => '300px')); 
                                ?>
                            </div>
                            <div class="title-cell"> 
                                <label>台灣商會規則 (cn)<i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_cn', TRUE), 'txt_rule_cn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                        <!-- vn -->
                        <div id="tabs-vn">
                            <div class="title-cell">
                                <label>商會名稱 (vn)</label>
                                <input class="type-text" type="text" name="txt_name_vn" id="txt_name_vn" value="<?php echo get_option('about_name_vn') ?>" />
                                <i id="error-name-vn" class="error"></i>
                            </div>
                            <div class="title-cell"> 
                                <label>地址 (vn)</label>  
                                <input class="type-text" type="text" name="txt_address_vn" id="txt_address_vn" value="<?php echo get_option('about_address_vn') ?>" />
                                <i id="error-address-vn" class="error"></i>
                            </div>
                            <div class="title-cell">
                                <label>台灣商會簡介 (vn)<i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_vn', TRUE), 'txt_introduction_vn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                            <div class="title-cell"> 
                                <label>台灣商會規則 (vn)<i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_vn', TRUE), 'txt_rule_vn', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                        <!-- en -->
                        <div id="tabs-en">
                            <div class="title-cell">
                                <label>商會名稱 (en) <i id="error-name" class="error"></i></label>
                                <input class="type-text" type="text" name="txt_name_en" id="txt_name_en" value="<?php echo get_option('about_name_en') ?>" />
                            </div>
                            <div class="title-cell">
                                <label>地址 (en) <i id="error-address" class="error"></i></label>  
                                <input class="type-text" type="text" name="txt_address_en" id="txt_address_en" value="<?php echo get_option('about_address_en') ?>" />
                            </div>
                            <div class="title-cell">
                                <label>台灣商會簡介 (en) <i id="error-introduction" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_introduction_en', TRUE), 'txt_introduction_en', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                            <div class="title-cell"> 
                                <label>台灣商會規則 (en) <i id="error-rule" class="error"></i></label>
                                <?php wp_editor(get_post_meta('1', '_rule_en', TRUE), 'txt_rule_en', array('wpautop' => false, 'editor_height' => '300px')); ?>
                            </div>
                        </div>
                    </div>
                </td>   
            </tr>
            <tr>
                <td colspan="2" style=" text-align: left; padding-left: 43% ">
                    <input type="submit" name="btn_submit" id="btn_submit" value="發佈" class="button button-primary button-large" >
                </td>            
            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#tabs_about').tabs();
        jQuery('#btn_submit').click(function(e) {
            //kiem tra các truong khong duoc rong
            var name_cn = jQuery('#txt_name_cn').val();
            var name_vn = jQuery('#txt_name_vn').val();
            if (name_cn === '') {
                jQuery('#error-name-cn').text('<?php echo __('請輸入商會名稱 !'); ?>');
                e.preventDefault();
            }
            if (name_vn === '') {
                jQuery('#error-name-vn').text('<?php echo __('請輸入商會名稱 !'); ?>');
                e.preventDefault();
            }

            var address_cn = jQuery('#txt_address_cn').val();
            var address_vn = jQuery('#txt_address_vn').val();
            if (address_cn === '') {
                jQuery('#error-address-cn').text('<?php echo __('請輸入地址 !'); ?>');
                e.preventDefault();
            }
            if (address_vn === '') {
                jQuery('#error-address-vn').text('<?php echo __('請輸入地址 !'); ?>');
                e.preventDefault();
            }
        })
    })
</script>