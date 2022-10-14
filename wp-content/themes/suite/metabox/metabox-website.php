<?php 

class Meta_Box_Website{
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-website';
        $title = translate('Website');
        $callback = array($this, 'display');
        $screen = array('advertising','friendly-link','president'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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
        echo '<div class="meta-row">'
        . '<div class="title-cell"><label for ="metabox-website">' . '網站' . ' </label></div>'
        . '<div class="text-cell" >'
            .'<input class="type-web" id="metabox-website" name="metabox-website"'.
            'value= ' . get_post_meta($post->ID, '_meta_box_website', true) . '>
            <label id="error_web" style="color: red; font-weight: bold"></label>
            </div>'
        . '</div>';  

    }

    public function save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            //su dung cho nhieu trang
            if (isset($_POST['metabox-website'])) {
                update_post_meta($post_id, '_meta_box_website', $_POST['metabox-website']);
            }
        }
    }
}