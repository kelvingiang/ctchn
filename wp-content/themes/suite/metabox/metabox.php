<?php

class Meta_box_Main
{

    private $_controller_name = 'main_controller_options';
    private $_controller_options = array();

    public function __construct()
    {
        $default_option = array(
            'meta_box_special' => true,
            'meta_box_language' => true,
            'meta_box_president' => TRUE,
            'meta_box_order' => TRUE,
            'meta_box_website' => TRUE,
            'meta_box_current' => TRUE,
            'meta_box_show_at_home' => TRUE,
        );

        $this->_controller_options = get_option($this->_controller_name, $default_option);

        $this->meta_box_special();
        $this->meta_box_language();
        $this->meta_box_president();
        $this->meta_box_order();
        $this->meta_box_website();
        $this->meta_box_current();
        $this->meta_box_show_at_home();


        add_action('admin_init', array($this, 'do_output_buffer'));
    }


    public function meta_box_special()
    {
        if ($this->_controller_options['meta_box_special'] == true) {
            require_once(DIR_META_BOX . 'metabox-special.php');
            new Meta_Box_Special();
        }
    }

    public function meta_box_language()
    {
        if ($this->_controller_options['meta_box_language'] == true) {
            require_once(DIR_META_BOX . 'metabox-language.php');
            new Meta_Box_Language();
        }
    }

    public function meta_box_president()
    {
        if ($this->_controller_options['meta_box_president'] == TRUE) {
            require_once(DIR_META_BOX . 'metabox-president.php');
            new Meta_Box_President();
        }
    }

    public function meta_box_website()
    {
        if ($this->_controller_options['meta_box_website'] == true) {
            require_once(DIR_META_BOX . 'metabox-website.php');
            new Meta_Box_Website();
        }
    }

    public function meta_box_order()
    {
        if ($this->_controller_options['meta_box_order'] == true) {
            require_once(DIR_META_BOX . 'metabox-order.php');
            new Meta_Box_Order();
        }
    }

    public function meta_box_current()
    {
        if ($this->_controller_options['meta_box_current'] == true) {
            require_once(DIR_META_BOX . 'metabox-current.php');
            new Meta_Box_Current();
        }
    }

    public function meta_box_show_at_home()
    {
        if ($this->_controller_options['meta_box_show_at_home'] == true) {
            require_once(DIR_META_BOX . 'metabox-home.php');
            new Meta_Box_Home();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
