<?php 

require_once (DIR_MODEL . 'model-member-function.php');
$model = new Admin_Model_Member_Function();
$industryList = $model->getIndustryNameByIndustryID();

if ((getParams('action')=='edit')) {
    $data = $model->get_item(getParams());
}
?>
<form action="" method="post" enctype="multipart/form-data" id="f_member" name="f_member" style="width: 120%;" >
    <div class="title-row">
        <?php
        $action = getParams('action');
        if ($action == 'edit') {
            $title = __('Update Member Info');
        } elseif ($action == 'add') {
            $title = __('Add New Member');
        }
        ?>
        <h2> <?php echo $title; ?></h2>
    </div>
    <!-- serial - order - logo -->
    <div class="meta-row-three-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Serial') ?><i class="error" id="error-serial"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt_mem_serial" id="txt_mem_serial" class="type-text"  
                value="<?php echo $data['serial']; ?>" />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Order') ?><i class="error" id="error-order"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt_mem_order" id="txt_mem_order" class="type-text"  
                    value="<?php echo $data['order'] != '' ? $data['order'] : 10 ?>" />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Logo'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-text" type="text" name="txt_mem_logo" id="txt_mem_logo" 
                value="<?php echo $data['logo'] ?>"/> 
            </div>
        </div>
    </div>
    <!-- company_cn -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Company Name') ?>(cn) <i class="error" id="error-company-cn"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt_mem_company_cn" id="txt_mem_company_cn" class="type-text"  
                value="<?php echo $data['company_cn']; ?>"  />
        </div>
    </div>
    <!-- company_vn -->
    <div class="meta-row">
        <div class="title-cell">
                <label><?php echo __('Company Name') ?>(vn) <i class="error" id="error-company-vn"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt_mem_company_vn" id="txt_mem_company_vn" class="type-text"  
                    value="<?php echo $data['company_vn']; ?>"  />
        </div>
    </div>
    <!-- address_cn -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address') ?>(cn) <i class="error" id="error-address-cn"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt_mem_address_cn" id="txt_mem_address_cn" class="type-text"  
                value="<?php echo $data['address_cn']; ?>"  />
        </div>
    </div>
    <!-- address_vn -->
    <div class="meta-row">
        <div class="title-cell">
                <label><?php echo __('Address') ?>(vn) <i class="error" id="error-address-vn"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt_mem_address_vn" id="txt_mem_address_vn" class="type-text"  
                    value="<?php echo $data['address_vn']; ?>"  />
        </div>
    </div>
    <!-- contact - position -->
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Contact'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-text" type="text" name="txt_mem_contact" id="txt_mem_contact" 
                value="<?php echo $data['contact'] ?>"/> 
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Position'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-text" type="text" name="txt_mem_position" id="txt_mem_position" 
                value="<?php echo $data['position'] ?>"/> 
            </div>
        </div>
    </div>   
    <!-- mobile - phone - fax -->
    <div class="meta-row-three-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Mobile'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-phone" type="text" name="txt_mem_mobile" id="txt_mem_mobile" 
                maxlength="90" value="<?php echo $data['mobile'] ?>"/> 
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Phone'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-phone" type="text" name="txt_mem_phone" id="txt_mem_phone" 
                maxlength="90" value="<?php echo $data['phone'] ?>"/> 
            </div>
        </div>    
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Fax'); ?></label>
            </div>
            <div class="text-cell">
                <input class="type-phone" type="text" name="txt_mem_fax" id="txt_mem_fax" 
                maxlength="90" value="<?php echo $data['fax'] ?>"/> 
            </div>
        </div>
    </div> 
    <!-- email - website -->
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Email'); ?><i id="error-email" class="error" ></i></label>
            </div>
            <div class="text-cell">
                <input class="type-email" type="text" name="txt_email" id="txt_email" 
                value="<?php echo $data['email'] ?>"/> 
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Website'); ?><i id="error-web" class="error"></i></label>
            </div>
            <div class="text-cell">
                <input class="type-text" type="text" name="txt_mem_website" id="txt_mem_website" 
                placeholder="http://domain.com" value="<?php echo $data['website'] ?>"/> 
            </div>
        </div>
    </div>
    <!-- region  -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Region'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-text" type="text" name="txt_mem_region" id="txt_mem_region" 
            value="<?php echo $data['region'] ?>"/> 
        </div>
    </div> 
    <!-- service -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Service'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-text" type="text" name="txt_mem_service" id="txt_mem_service" 
            value="<?php echo $data['service'] ?>"/> 
        </div>
    </div>   
    <!-- industry id -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Industry') ?><i class="error" id="error-indus-id"></i></label>
        </div>
        <div class="text-cell">
            <?php foreach ($industryList as $val) {
                $pos = strripos($data['industry_id'], ','.$val['ID'].','); //tim ky tu co trong chuoi
                ?>
            <div style="width: 34%; float: left; height: 30px;">
                <input type="checkbox" name="industry_id[]" id="industry_id[]" value="<?php echo $val['ID'] ?>" 
                    <?php echo  $pos === false  ?'': 'checked' ?>  />
                <?php echo $val['name'] ?>
            </div>    
            <?php } ?>
        </div>
    </div>
    <div style="clear: both"></div>
    <!-- note -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Note'); ?></label>
        </div>
        <div class="text-cell">
            <textarea class="type-text" type="text" name="txt_mem_note" id="txt_mem_note" rows="4"
            value="<?php echo $data['note'] ?>" style="height: 80%"></textarea> 
        </div>
    </div> 
    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>
</form>
<script type="text/javascript">
    // show hinh anh truoc khi up len
    jQuery(document).ready(function () {
        jQuery('#btn-submit').click(function (e) {
            // KIEM TRA CAC TRUONG KHONG DC RONG
            var serial = jQuery('#txt_mem_serial').val();
            if (serial === '') {
                jQuery('#error-serial').text('<?php echo __('請輸入正確編號 !'); ?>');
                e.preventDefault();
            }

            var order = jQuery('#txt_mem_order').val();
            if (order === '') {
                jQuery('#error-order').text('<?php echo __('請輸入正確順序 !'); ?>');
                e.preventDefault();
            }

            var comp_cn = jQuery('#txt_mem_company_cn').val();
            if (comp_cn === '') {
                jQuery('#error-company-cn').text('<?php echo __('請輸入正確公司名稱(cn) !'); ?>');
                e.preventDefault();
            }

            var comp_vn = jQuery('#txt_mem_company_vn').val();
            if (comp_vn === '') {
                jQuery('#error-company-vn').text('<?php echo __('請輸入正確公司名稱(vn) !'); ?>');
                e.preventDefault();
            }

            var address_cn = jQuery('#txt_mem_address_cn').val();
            if (address_cn === '') {
                jQuery('#error-address-cn').text('<?php echo __('請輸入正確地址(cn) !'); ?>');
                e.preventDefault();
            }

            var address_vn = jQuery('#txt_mem_address_vn').val();
            if (address_vn === '') {
                jQuery('#error-address-vn').text('<?php echo __('請輸入正確地址(vn) !'); ?>');
                e.preventDefault();
            }

            var industry = jQuery('#industry_id[]').val();
            if (industry === '') {
                jQuery('#error-indus-id').text('<?php echo __('請選擇會員行業 !') ?>');
                e.preventDefault();
            }

            var website = jQuery('#txt_mem_website').val();
            var filter = /^(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(website.value)) {
                jQuery('#error-web').text('請 輸 入 正 確 網 站 地 址 ! ');
                website.focus;
            } else {
                jQuery('#error-web').text('');
            }
        });
 
    });

</script>