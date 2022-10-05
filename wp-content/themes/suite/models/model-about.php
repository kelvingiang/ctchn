<?php 

class Admin_Model_About{
    public function Save($arr) 
    {   
        update_option("about_name_cn", $arr['txt_name_cn']);
        update_option("about_name_vn", $arr['txt_name_vn']);
        update_option("about_name_en", $arr['txt_name_en']);
        update_option("about_address_cn", $arr['txt_address_cn']);
        update_option("about_address_vn", $arr['txt_address_vn']);
        update_option("about_address_en", $arr['txt_address_en']);
        update_option("about_phone", $arr['txt_phone']);
        update_option("about_email", $arr['txt_email']);

        update_post_meta(1, '_introduction_cn', $arr['txt_introduction_cn']);
        update_post_meta(1, '_introduction_vn', $arr['txt_introduction_vn']);
        update_post_meta(1, '_introduction_en', $arr['txt_introduction_en']);
        update_post_meta(1, '_rule_cn', $arr['txt_rule_cn']);
        update_post_meta(1, '_rule_vn', $arr['txt_rule_vn']);
        update_post_meta(1, '_rule_en', $arr['txt_rule_en']);
    }
}