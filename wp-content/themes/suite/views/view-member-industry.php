<?php
include_once (DIR_MODEL . 'model-member-industry.php');
$model = new Admin_Model_Member_Industry();
$data = $model->getDataIndustry(); //lấy tất cả dữ liệu
$page = getParams('page'); 
$val = array(
    'ID' => '',
    'name' => '',
    'order' => '',
);
$industryAll = $model->getMemberIndustry();
foreach ($industryAll as $val) {
    $ss .= $val['industry_id'] . ','; //lấy các industry_id trong member
}
$ss = substr($ss, 0, -1); 
$arr = explode(',', $ss);
$arr_id = array_count_values($arr); //thống kê giá trị và số lượng trong array

if(getParams('action') == 'edit' && !empty(getParams('id'))) {
    $val = $model->getIndustryItem(getParams('id'));
}
?>

<div>
    <div style="width: 50%; float: left">
        <form id="f_member_industry" name="f_member_industry" action="" method="post">
            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $val['ID'] ?>"/>
            <h1><?php __('Member Industry') ?></h1>
            <!-- name -->
            <div class="meta-row">
                <div class="title-cell">
                    <label><?php echo __('Industry Name'); ?><i id="error-cate-name" class="error"></i></label>
                </div>
                <div class="text-cell">
                    <input class="type-text" type="text" id="txt_indus_name" name="txt_indus_name" value="<?php echo $val['name'] ?>"/>
                </div>
            </div>
            <!-- order -->
            <div class="meta-row">
                <div class="title-cell">
                    <label><?php echo __('Order'); ?><i id="error-order" class="error"></i></label>
                </div>
                <div class="text-cell">
                    <input class="type-text" type="text" id="txt_indus_order" name="txt_indus_order" value="<?php echo $val['order'] ?>"/>
                </div>
            </div> 
            <div class="button-row">
                <input type="button" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
            </div>
        </form>
    </div>
    <div style="width: 50%;float: left">
        <div class="button-row">
            <input type="submit" name="btn-add" id="btn-add" 
                class="button button-primary button-large" value="<?php echo __('Add New') ?>" onclick="addNew('add')"/>
        </div>
        <ul class="category_list">
            <li>
                <div><?php _e('ID') ?></div>
                <div><?php _e('Industry Name') ?></div>
                <div><?php _e('Order') ?></div>
                <div><?php _e('Use') ?></div>
            </li>
            <?php
            foreach ($data as $val) {
                ?>
                <li>
                    <div><label><?php echo $val['ID'] ?></label></div>
                    <div><a href="<?php echo "admin.php?page=$page&action=edit&id=" . $val["ID"] ?>"><?php echo $val['name'] ?></a></div>
                    <div><a href="<?php echo "admin.php?page=$page&action=edit&id=" . $val["ID"] ?>"><?php echo $val['order'] ?></a></div>
                    <div>
                    <?php
                        $flag = FALSE;
                        foreach ($arr_id as $key => $valID) {
                            if ($key == $val['ID']) {
                                ?>
                                <a href="<?php echo "admin.php?page=page_member&filter_industry=" . $val['ID'] ?>"> <?php echo $valID; ?></a>  
                                <?php
                                $flag = TRUE;
                            }
                        }
                        ?>
                        <?php if (!$flag) { ?>
                            <a onclick="myFunction('<?php echo __('Do you sure to delete this industry ?') ?>', 'del', 
                            <?php echo $val['ID'] ?>)"style="color: red" > <?php _e('Delete') ?></a>
                    <?php } ?>    
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script type="text/javascript" >
    function myFunction($mess, $action, $id) {
        if (confirm($mess)) {
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action + "&id=" + $id;
        } else {
            window.stop();
        }
    }

    function addNew($action){
        if($action == 'add'){
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action;
        }
    }

    jQuery(document).ready(function(){
        jQuery('#btn-submit').click(function(e){
            var name = document.getElementById('txt_indus_name');
            if( !jQuery(name).val() ) { //is empty
                jQuery('#error-cate-name').text('請輸入正確行業名稱 ! ');
                name.focus(); 
            }else{
                jQuery('#error-cate-name').text(' ');
                //jQuery('#cate-form').submit()
            } 
            
            var order = document.getElementById('txt_indus_order');
            if( !jQuery(name).val() ) { //is empty
                jQuery('#error-order').text('請輸入正確順序 ! ');
                order.focus(); 
            }else{
                jQuery('#error-cate-name').text(' ');
                jQuery('#f_member_industry').submit()
            } 
        })
    })
</script>