<?php

class Controller_Main
{

    private $_controller_name = 'main_controller_options';
    private $_controller_options = array();

    public function __construct()
    {

        $default_option = array(
            'controller_about' => true,
            'controller_slider' => true,
            'controller_schedule' => true,
        );

        $this->_controller_options = get_option($this->_controller_name, $default_option);
        $this->post_slider();
        $this->page_about();
        $this->page_schedule();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    // FUNCTION ===========================================================


    public function page_about()
    {
        if ($this->_controller_options['controller_about'] == true) {
            require_once(DIR_CONTROLLER . 'controller-about.php');
            new Admin_Controller_About();
        }
    }

    public function page_schedule()
    {
        if ($this->_controller_options['controller_schedule'] == true) {
            require_once(DIR_CONTROLLER . 'controller-schedule.php');
            new Admin_Controller_Schedule();
        }
    }





    public function post_slider()
    {
        if ($this->_controller_options['controller_slider'] == true) {
            require_once(DIR_CONTROLLER . 'controller-slider.php');
            new Admin_Controller_Slider();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
