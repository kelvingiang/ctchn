<?php 

class Meta_Box_Language{
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-language';
        $title = translate('Language');
        $callback = array($this, 'display');
        $screen = array('post','slider','activity'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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

        $lang = get_post_meta($post->ID, '_meta_box_language', true);
        ?><label class="radio-inline checkbox-label" style="margin-right:10px;">
                <input type="radio" id=" metabox-language" name="metabox-language" value="cn"
                <?php echo $lang == '' ? 'checked' : ($lang == 'cn' ? 'checked' : '') ?>/>中文 (cn)
            </label>
            <label class="radio-inline checkbox-label" style="margin-right:10px;">
                <input type="radio" id="metabox-language" name="metabox-language" value="vn"
                <?php echo $lang == 'vn' ? 'checked' : '' ?>/>越文 (vn)
            </label>
            <label class="radio-inline checkbox-label">
                <input type="radio" id="metabox-language" name="metabox-language" value="en"
                <?php echo $lang == 'en' ? 'checked' : '' ?>/>英文 (en)
            </label>            
        <?php
    }

    public function save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            //su dung cho nhieu trang
            if (isset($_POST['metabox-language'])) {
                update_post_meta($post_id, '_meta_box_language', $_POST['metabox-language']);
            }
            
        }
    }
}