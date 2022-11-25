<?php 

class Admin_Controller_Check_In_Setting{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'AddToMenu'));
    }

    public function AddToMenu() {
        $parent_slug = 'page_member';  //giống slug $menu_slug của member
        $page_title = __('Check In Setting');
        $menu_title = __('Check In Setting');
        $capability = 'manage_categories';
        $menu_slug = 'page_check_in_setting'; //tên slug của check in setting
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    } 

    public function dispatchActive()
    {
        // echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'export_member':
                $this->exportMemberAction();
                break;
            case 'import_member':
                $this->importMemberAction();
                break;
            default :
                $this->displayPage();
                break;        
        }
    }

    public function displayPage() {
        require_once(DIR_VIEW . 'view-check-in-setting.php');
    }

    //Function dung cho export
    public function exportMemberAction()
    {
        $model = new Admin_Model_Check_In_Setting();
        $model->exportMember();
    }

    //Function dung cho import
    public function importMemberAction()
    {
        if(isPost()) { //neu co post
            $errors = array();
            $file_name = $_FILES['myfile']['name'];
            $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            $file_type = $_FILES['myfile']['type'];

            $file_trim = ((explode('.', $_FILES['myfile']['name'])));
            $trim_name = strtolower($file_trim[0]);
            $trim_type = strtolower($file_trim[1]);
            //$name = $_SESSION['login'];
            // $cus_name = 'avatar-'.$name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

            $extensions = array("xls", "xlsx");
            if (in_array($trim_type, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a excel file.";
            }
            if ($file_size > 20097152) {
                $errors[] = 'File size must be excately 20 MB';
            }
            if (empty($errors)) {
                $path = DIR_FILE;
                move_uploaded_file($file_tmp, ($path . $file_name));

                $excelList = $path . $file_name;
                $model = new Admin_Model_Check_In_Setting();
                $model->importMember($excelList);

                $paged = max(1, getParams('paged'));
                $url = 'admin.php?page=' . 'page_check_in_setting' . '&paged=' . $paged . '&msg=1';
                //$url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=1';
                wp_redirect($url);
            }
        }
        require_once(DIR_VIEW . 'view-member-import.php');
    }
}