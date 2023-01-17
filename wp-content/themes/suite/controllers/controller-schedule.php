<?php
require_once(DIR_MODEL . 'model-schedule-function.php');

class Admin_Controller_Schedule
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
    }

    public function Create()
    {
        // THEM 1 NHOM MENU MOI VAO TRONG ADMIN MENU
        $page_title = __('Calendars'); // TIEU DE CUA TRANG 
        $menu_title = __('Calendars');  // TEN HIEN TRONG MENU
        // CHON QUYEN TRUY CAP manage_categories DE role ADMINNITRATOR VÀ EDITOR DEU THAY DUOC
        $capability = 'manage_categories'; // QUYEN TRUY CAP DE THAY MENU NAY
        $menu_slug = 'calendar'; // TEN slug TEN DUY NHAT KO DC TRUNG VOI TRANG KHAC GAN TREN THANH DIA CHI OF MENU
        // THAM SO THU 5 GOI DEN HAM HIEN THI GIAO DIEN TRONG MENU
        $icon = PART_ICON . 'schedule-icon.png';  // THAM SO THU 6 LA LINK DEN ICON DAI DIEN
        $position = 16; // VI TRI HIEN THI TRONG MENU

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'), $icon, $position);
    }

    // Phan dieu huong 
    public function dispatchActive()
    {
        $params = getParams();
        $action = $params['action'];
        if ($action == 'add' or $action == 'edit') {
            $this->saveAction();
        } elseif ($action == 'delete') {
            $this->deleteAction();
        } elseif ($action == 'trash' or $action == 'restore') {
            $this->statusAction();
        } else {
            $this->displayPage();
        }
    }

    public function createUrl()
    {
        echo $url = 'admin.php?page=' . getParams('page');

        //filter_status
        if (getParams('filter_status') != '0') {
            $url .= '&filter_status=' . getParams('filter_status');
        }

        if (mb_strlen(getParams('s'))) {
            $url .= '&s=' . getParams('s');
        }

        return $url;
    }

    //---------------------------------------------------------------------------------------------
    // Cmt CAC CHUC NANG THEM XOA SUA VA HIEN THI
    //---------------------------------------------------------------------------------------------
    // CAC DISPLAY PAGE
    public function displayPage()
    {
        // LOC DU LIEU KHI action = -1 CO NGHIA LA DANG LOI DU LIEU (CHO 2 TRUONG HOP search va filter)
        if (getParams('action') == -1) {
            $url = $this->createUrl();
            wp_redirect($url);
        }
        // NEN TACH ROI HTML VA CODE WP RA CHO DE QUAN LY
        require_once(DIR_VIEW . 'view-schedule.php');
    }


    public function saveAction()
    {
        if (isPost()) {
            $save = new Admin_Model_Schedule_Function();
            $save->save_item($_POST, array('action' => $_GET['action']));
            toBack(1);
        }
        require_once(DIR_VIEW . 'form-schedule.php');
    }


    // XOA DU LIEU
    public function deleteAction()
    {
        $arrParam = getParams();
        // if (!is_array($arrParam['id'])) {
        //     $action = 'delete_id' . $arrParam['id'];
        //     check_admin_referer($action, 'security_code');
        // } else {
        //     wp_verify_nonce('_wpnonce');
        // }

        $model = new Admin_Model_Schedule_Function();
        $model->deleteItem($arrParam);
        ToBack();
    }

    public function statusAction()
    {

        $arrParam = getParams();
        // GOI DEN MODEL 
        $model = new Admin_Model_Schedule_Function();
        $model->changeStatus($arrParam);

        ToBack();
    }
}
