<?php 

class Admin_Controller_Member_Industry {
    public function __construct()
    {
        add_action('admin_menu', array($this, 'AddSubMenu'));
    }

    //PHAN TAO MENU CON TRON MENU CHA CUNG LA POST TYOE
    public function AddSubMenu()
    {
        $parent_slug = 'page_member';  //giống slug $menu_slug của member
        $page_title = __('Industry');
        $menu_title = __('Industry');
        $capability = 'manage_categories';
        $menu_slug = 'page_member_industry'; //tên slug của member industry
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive()
    {
        $action = getParams('action');
        switch ($action) {
            case 'edit':
                $this->editAction();
                break;
            case 'del':
                $this->deleteAction();
                break;
            default :
                $this->displayPage();
                break;        
        }
    }

    public function displayPage() {
        //nếu có post
        if (isPost()) {
            require_once (DIR_MODEL . 'model-member-industry.php');
            $model = new Admin_Model_Member_Industry();
            $option = 'add';
            
            $model->save($_POST, $option);
        }
        require_once ( DIR_VIEW . 'view-member-industry.php');
    }

    public function editAction() {
        //nếu có post
        if (isPost()) {
            require_once (DIR_MODEL . 'model-member-industry.php');
            $model = new Admin_Model_Member_Industry();
            $model->save($_POST, 'update');
            ToBack();
        }
        require_once ( DIR_VIEW . 'view-member-industry.php');
    }

    public function deleteAction(){
        $id = getParams('id');
        require_once (DIR_MODEL . 'model-member-industry.php');
        $model = new Admin_Model_Member_Industry();
        $model->deleteIndustry($id);
        ToBack();
    }
}