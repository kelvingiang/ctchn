<?php

// KIEM TRA  WP_List_Table CO TON TAI CHUA NEU CHUA SE INCLUSE VAO
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php ';
}

class Admin_Model_Member extends WP_List_Table {
    private $_pre_page = 30;
    private $_sql;

    public function __construct($args = array())
    {
        $args = array(
            'plural' => 'id', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'singular' => 'id', // GIA TRI NAY TUONG UNG VOI key TRONG table
            'ajax' => FALSE,
            'screen' => null,
        );
        parent::__construct($args);
    }

    /**
     * HAM NAY BAT BUOC PHAI CO QUAN TRONG DE SHOW LIST RA
     * CA THONG SO VA DU LIEU CAN CUNG CAP DE HIEN THI GIRDVIEW
     */
    public function prepare_items()
    {   
        $columns = $this->get_columns();  // NHUNG GI CAN HIEN THI TREN BANG 
        $hidden = $this->get_hidden_columns(); // NHUNG COT TA SE AN DI
        $sorttable = $this->get_sortable_columns(); // CAC COT DC SAP XEP TANG HOAC GIAM DAN

        $this->_column_headers = array($columns, $hidden, $sorttable); //DUA 3 GIA TRI TREN VAO DAY DE SHOW DU LIEU
        $this->items = $this->table_data(); // LAY DU LIEU TU DATABASE

        $total_items = $this->total_items(); // TONG SO DONG DA LIEU
        $per_page = $this->_pre_page; // SO TRANG 
        $total_pages = ceil($total_items / $per_page); // TONG SO TRANG

        // PHAN TRANG
        $args = array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        );
        $this->set_pagination_args($args);
    }
    /**
     * ===================================================
     * CAC FUNCTION NHAT DINH PHAI CO TRONG LIST
     * ====================================================
     */
    //LAY CAC COT TUONG UNG TREN DATABASE DAN VAO COT GIRDVIEW
    public function get_columns()
    {
        $arr = array(
            'cb' => '<input type="checkbox" />', //BAT BUOC
            'serial' => __('Serial'),
            'company_cn' => __('Company Name'),
            'address_cn' => __('Address'),
            'contact' => __('Contact'),
            'mobile' => __('Mobile'),
            'email' => __('Email'),
            'order' => __('Order'),
        );
        return $arr;
    }

    //KHAI BAO CAC COT BI AN TREN GIRDVIEW
    public function get_hidden_columns()
    {
        return array('');
    }

    //SAP XEP COT TANG DAN HAY GIAM DAN
    public function get_sortable_columns()
    {
        return array(
            'serial' => array('serial', true),
            'id' => array('ID', true),
        );
    }
    
    /**
     * ===================================================
     * CAC FUNCTION LAY DATA TU DATABASE
     * ====================================================
     */
    //LAY DU LIEU TRONG DATABASE
    private function table_data()
    {
        $data = array();
        global $wpdb;
        // LAY GIA TRI SAP XEP DU LIEU TREN COT
        $orderby = (getParams('orderby') == ' ') ? 'ID' : $_GET['orderby'];
        $order = (getParams('order') == ' ') ? 'DESC' : $_GET['order'];
        $tblTest = $wpdb->prefix . 'member';
        $sql = 'SELECT * FROM ' . $tblTest ;
        $whereArr = array();  // TAO MANG WHERE

        //MAC DINH TRASH = 1: HIEN HANH, 0: DA XOA
        if (getParams('customvar') == 'trash') {
            $whereArr[] = "(trash = 0)";
        } else {
            $whereArr[] = "(trash = 1)";
        }

        //KIEM TRA FILTER INDUSTRY
        if(getParams('filter_industry') != ' ') {
            $indus = getParams('filter_industry');
            if ($indus > 0) {
                //do ta luu data duoi dang mang co dang ,$data,
                //vi du ,1,2, nen ta se loc gan dung theo dang cua no 
                $whereArr[] = "(industry_id LIKE '%,$indus,%' )"; 
            } elseif ($indus == -1) {
                $whereArr[] = "(industry_id  = ' ')";
            } else {
                $whereArr[] = '';
            }
        }

        //KIEM TRA SEARCH
        if (getParams('s') != ' ') {
            $s = esc_sql(getParams('s'));
            $whereArr[] = "(serial LIKE '$s' OR company_cn LIKE '%$s%')";
        }

        // CHUYEN CAC GIA TRI where KET VOI NHAU BOI and
        if (count($whereArr) > 0) {
            $sql .= " WHERE " . join(" AND ", $whereArr);
        }

        // orderby
        $sql .= 'ORDER BY ' . esc_sql($orderby) . ' ' . esc_sql($order);

        $this->_sql = $sql;

        //LAY GIA TRI PHAN TRANG PAGEING
        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_pre_page;

        $sql .= ' LIMIT  ' . $this->_pre_page . ' OFFSET ' . $offset;

        // LAY KET QUA  THONG QUA CAU sql
        $data = $wpdb->get_results($sql, ARRAY_A);

        return $data;
    }

    // TINH TONG SO DONG DU LIEU  DE AP DUNG CHO VIEC PHAN TRANG
    public function total_items()
    {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    // SO TONG ITEM DUNG DE PHAN TRANG
    public function total_list()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table");
    }

    // SO TONG ITEM TRONG TRASH(SO RAC)
    public function total_trash()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE trash = 0");
    }

    // SO TONG ITEM HIEN HANH
    public function total_publish()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        return $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE trash = 1");
    }

    /**
     * ===================================================
     * CAC FUNCTION SELECTBOX O PHAN DAU CUA LIST
     * ====================================================
     */
    //PHAN SHOW THONG KE SO ITEM O DAU LIST (All | Publish | Trash)
    function get_views()
    {
        $views = array();
        $current = (!empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');

        //All link
        $class = ($current == 'all' ? ' class="current"' : '');
        $all_url = remove_query_arg('customvar');
        $views['all'] = "<strong>" . __('All') . " (" . $this->total_list() . ")</strong>";

        //Foo link
        $foo_url = add_query_arg('customvar', 'published');
        $class = ($current == 'foo' ? ' class="current"' : '');
        $views['foo'] = "<a href='{$foo_url}' {$class} > " . __('Published') . " (" . $this->total_publish() . ")</a>";

        //Bar link
        $bar_url = add_query_arg('customvar', 'trash');
        $class = ($current == 'bar' ? ' class="current"' : '');
        $views['bar'] = "<a href='{$bar_url}' {$class} >" . __('Trash') . "(" . $this->total_trash() . ")</a>";

        return $views;
    }

    //CAC ITEM TRONG SELECT BOX CHUC NANG 'UNG DUNG'
    public function get_bulk_actions()
    {
        if ($_GET['customvar'] == 'trash') {
            $action44 = array(
                'restore' => __('Restore'),
                'delete' => __('Delete Permanently'),
            );
        } else {
            $action44 = array(
                'trash' => __('Trash'),
                // 'uncheckin' => __('Cancel Check-in')
            );
        }
        return $action44;
    }

    public function extra_tablenav($which)
    {
        require_once(DIR_MODEL . 'model-member-function.php');
        $model = new Admin_Model_Member_Function();

        if($which == 'top') {

            $first_row = array(array('ID' => 0, 'name' => __('Industries')));
            $last_row = array(array('ID' => -1, 'name' => __('Other')));
            $list1 = array_merge($first_row, $model->getIndustryNameByIndustryID());
            $list = array_merge($list1, $last_row);
            foreach ($list as $val) {
                $arrlist[$val['ID']] = $val['name'];
            }
            $options['data'] = $arrlist;

            ?>
             <select name="filter_industry" id="filter_industry">
                    <?php foreach( $list as $selects) : ?>
                    <option value ="<?php echo $selects['ID'] ?>"<?php if( $selects['ID'] == getParams('filter_industry') ): ?> 
                             selected= "selected" <?php endif; ?>><?php echo $selects['name'] ?></option>
                     <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="filter_action" class="button" value="Filter"> 
            <?php
        }
    
    }

    /**
     * ===================================================
     * CAC FUNCTION THIET LAP GIA TRI CHO CAC COLUMN
     * ====================================================
     */
    //TAO CAC CHECK BOX O DAU DONG TRONG CUA COT
    public function column_cb($item)
    {
        $html = '<input type="checkbox" name="' . 'ID' . '[]" value="' . $item['ID'] . '"/>';
        return $html;
    }

    //THEM CAC PHAN CHINH SUA NHANH TAI COLUMN NAY
    //DAT TEN column_ten COLUMN CAN TAO CAC CHINH SUA NHANH
    public function column_serial($item) 
    {
        $page = getParams('page');
        $name = 'security_code';

        if(isset($_GET['customvar']) == 'trash') {
            $actions = array(
                'restore' => '<a href=" ?page=' . $page . '&action=restore&id=' . $item['ID'] . ' " >' . __('Restore') . '</a>',
                'delete' => '<a href=" ?page=' . $page . '&action=delete&id=' . $item['ID'] . ' " >' . __('Delete Permanently') . ' </a>',
            );
        }else {
            $actions = array(
                'edit' => '<a href=" ?page=' . $page . '&action=edit&id=' . $item['ID'] . ' " >' . __('Edit') . '</a>',
                'trash' => '<a href=" ?page=' . $page . '&action=trash&id=' . $item['ID'] . ' " >' . __('Trash') . '</a>',
            );
        }
        $html = '<strong> <a href="?page=' . $page . '&action=edit&id=' . $item['ID'] . ' ">' . $item['serial'] . '</a> </strong>' . $this->row_actions($actions);
        return $html;
    }

    public function column_company($item)
    {
        return $item['company_cn'];
    }

    public function column_address($item)
    {
        echo '<lable>' . $item['address_cn'] . '</lable>';
    }

    //CAC COLUMN MAC DINH KHI LOAD TRANG SE HIEN LEN
    public function column_default($item,$column_name)
    {
        return $item[$column_name];
    }

}