<div class="group-border">
    <div class="group-title">
        <label><?php _e("Industries") ?></label>
    </div>
        <div class="member-industry-list">
            <?php 
                require_once(DIR_MODEL . 'model-member-industry.php');
                $model = new Admin_Model_Member_Industry();
                $data = $model->getDataIndustry();
                foreach ($data as $key => $val) { ?>
                <li>
                    <a class="member-industry-item" href="<?php echo home_url('members') . '/industry/' . $val['ID'] ?>"><?php echo $val['name'] ?></a>  
                </li>
            <?php } ?>
        </div>
    
</div>