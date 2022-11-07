<div>
    <div class="member-title">
        <a href="<?php echo home_url('members') ?>"><?php _e("Industry") ?></a>
    </div>
    <?php 
        require_once(DIR_MODEL . 'model-member-industry.php');
        $model = new Admin_Model_Member_Industry();
        $data = $model->getDataIndustry();
        foreach ($data as $key => $val) { ?>
        <div class="list-group member-item">
            <a href="<?php echo home_url('members') . '/industry/' . $val['ID'] ?>"><?php echo $val['name'] ?></a>  
        </div>
    <?php } ?>
</div>