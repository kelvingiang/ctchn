<?php 

class Meta_Box_Special{
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-special';
        $title = translate('Special');
        $callback = array($this, 'display');
        $screen = array('post'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //  add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
    }

    public function display($post)
    {
        //        echo __METHOD__;
        // thanh an nham bao mat trong wp
        $action = 'dn-metabox-data';
        $name = 'dn-metabox-data-nonce';
        wp_nonce_field($action, $name);


        // Tao text box
        if(get_post_meta($post->ID, '_meta_box_special', true) == 1){ //1: show, 0: hide
            ?> <label class="checkbox-label"> Special </label>
            <div class="form-check">
                <label class="form-check-label mr-3" for="metabox-special"> <?php translate('Special') ?> </label>
                <input class="form-check-input mt-1" type="checkbox" id=" metabox-special" name="metabox-special" value="1" checked />
            </div>
            <?php
        }else{
            ?> <label class="checkbox-label"> Special </label>
            <div class="form-check">
                <label class="form-check-label mr-3" for="metabox-special"> <?php translate('Special') ?> </label>
                <input class="form-check-input mt-1" type="checkbox" id=" metabox-special" name="metabox-special" value="1" />
            </div>
            <?php
        }   

    }

    public function save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            $check = 1;
            //su dung cho nhieu trang
            if (isset($_POST['metabox-special']) == $check) {
                update_post_meta($post_id, '_meta_box_special', $_POST['metabox-special']);
            }else{
                update_post_meta($post_id, '_meta_box_special', $_POST['metabox-special']);
            }
        }
    }
}