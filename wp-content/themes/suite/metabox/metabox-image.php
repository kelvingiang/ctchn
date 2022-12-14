<?php

class Meta_Box_Image {

    public function __construct() {
        // echo __METHOD__;
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        //      echo __METHOD__;
        $id = 'tw-metabox-image';
        $title = translate('Image');
        $callback = array($this, 'display');
        $screen = array('post','activity'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //     add_action('admin_enqueue_scripts' , array($this,'add_css_file'));
    }

    public function display($post) {
        //        echo __METHOD__;
        // thanh an nham bao mat trong wp
        $action = 'tw-metabox-data';
        $name = 'tw-metabox-data-nonce';
        wp_nonce_field($action, $name);
        ?>
        <div class="my-row">
            <div class="column-75">
                <?php wp_editor(get_post_meta($post->ID, '_meta_box_image', TRUE), 'metabox-image', array('wpautop' => false, 'editor_height' => '300px')); ?>
            </div>
        </div>
    
        <?php
    }

    // LUU GIA TRI VAO DATABASE
    public function save($post_id) {
        // kiem thanh phan an bao mat cua wp
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id
        if (!isset($_POST['tw-metabox-data-nonce']))
            return$post_id;
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id 
        if (wp_verify_nonce('tw-metabox-data-nonce', 'tw-metabox-data'))
            return $post_id;
        // HAM TU DONG LUU KHI DE QUA LAU NEU TRA VE FLASE return $post_id
        // if (define('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        //    return $post_id;

        if (!current_user_can('edit_post', $post_id))
            return$post_id;
        // 4 BON PHAN TREN DUNG DE BAO MAT KHI LUU METABOX TRONG WP 
        
        update_post_meta($post_id, '_meta_box_image', ($_POST['metabox-image']));
    }
}
