<?php 

class Admin_Model_Schedule_Function
{
    /**
     * =======================================================================
     * -------------------- CÁC FUNCTION XỬ LÝ DATA ------------------------
     * =======================================================================
     * 
     */
    private $table;
    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'schedule'; //prefix tiền tố là wphn
    }

    // SAVE DATA DEN DATABASE
    public function save_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $action = $option['action'];
        $id = $option['id'];


        // KIEM TRA action LA add HAY edit DE CHUYEN THAM CHO VIEC CAP GIA TRI CHO slug
        // if ($action == 'add') {
        //     // LA ADD CHI CAN CHUYEN 2 THAM SO table va field CHUA slug
        //     $optionSlug = array('table' => 'schedule');
        // } else if ($option == 'edit') {
        //     // LA EDIT PHAI CHUYEN THEM THAM SO exception VOI field la id và value la id CUA DOI TUONG CAN SUA
        //     $optionSlug = array('table' => 'schedule', 'exception' => array('field' => 'id', 'value' => absint($arrData['id'])));
        // }


        // CAC DOI TUONG date THANH CAC PHAN NHO 
        $date = $arrData['getdate'];
        $arrDate = explode('/', $date);

        //KIEM TRA STATUS
        if(isset($arrData['cb-status'])){
            $status = $arrData['cb-status'];
        } else{
            $status = '1';
        }

        // kIEM ADD NEW OR UPDATE
        $data = array(
            'title' => $arrData['title'],
            'year' => $arrDate[2],
            'month' => $arrDate[1],
            'day' => $arrDate[0],
            'weekdays' => $arrData['weekdays'],
            'time' => $arrData['timeStart'] . '-' . $arrData['timeEnd'],
            'branch' => $arrData['branch'],
            'place' => $arrData['place'],
            'note' => $arrData['note'],
            'status' => $status,
            // cac muc save gia tri co su ly
            'date' => $date,
            'create-date' => date('Y-m-d'),
        );


        if ($action == 'add') {
            $wpdb->insert($this->table, $data);
        } else if ($action == 'edit') {
            $where = array('id' => absint($arrData['id']));  // CHUYEN THEM DK DE UPDATE 
            $wpdb->update($this->table, $data, $where);
        }
        // $url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
        // wp_redirect($url);
    }

    // LAY DU LIEU CAN CHINH SUA
    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        // THONG SO id DUA CHUYEN TREN url DE LAY DONG DU LIEU CAN CHINH SUA
        $id = absint($arrData['id']);  // ham absint  chuyen ky tu sang kieu so
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);  // LAY DONG DU LIEU TRA VE KIEU array
        return $row;
    }

    // XOA DATA
    public function deleteItem($arrData = array(), $options = array())
    {
        global $wpdb;

        // KIEM TRA PHAN DELETE CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $where = array('id' => absint($arrData['id']));
            $wpdb->delete($this->table, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            echo '<br>' . $ids;
            $sql = "DELETE FROM $this->table  WHERE id IN ($ids)";
            $wpdb->query($sql);
        }
    }

    // THAY DOI TRANG THAI 
    public function changeStatus($arrData = array(), $options = array())
    {
        global $wpdb;

        $status = ($arrData['action'] == 'restore') ? 1 : 0;
        // KIEM TRA PHAN UPFDATE CÓ PHAN DANG CHUOI HAY KHONG
        if (!is_array($arrData['id'])) {
            $data = array('status' => absint($status));
            $where = array('id' => absint($arrData['id']));
            $wpdb->update($this->table, $data, $where);
        } else {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
            echo '<br>' . $ids;
            $sql = "UPDATE $this->table SET status = $status WHERE id IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function sendMail(array $contentData)
    {
        //LAY TAT CA CAC THANH VIEN
        $arrMember = array(
            'post_type' => 'member',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'm_active',
                    'value' => 'on',
                )
            )
        );
        $arrMailTo = array('giaminh0265@yahoo.com', 'giaminh_vn@digiwin.biz', 'giaminh0265@gmail.com');
        //        $memQuery = new WP_Query($arrMember);
        //        if ($memQuery->have_posts()):
        //            while ($memQuery->have_posts()):
        //                $memQuery->the_post();
        //                $arrMailTo[] = get_post_meta(get_the_ID(), 'm_email', true);
        //            endwhile;
        //        endif;
        //   if ($send == 'true') {
        ////          $arrMailTo = array('giaminh0265@yahoo.com', 'giaminh0265@gmail.com','giaminh_vn@digiwin.biz');
        //          $arrMailTo = 'giaminh0265@yahoo.com;giaminh0265@gmail.com;giaminh_vn@digiwin.biz';
        $subj = '台灣商會總會的行事曆';
        $content = '<h3>台灣商會總會的行事曆</h3></br>';
        $content .= '<h2 style= "color:blue">' . $contentData['title'] . '</h2>';
        $content .= '<p><i>日期 :</i> ' . $contentData['date'] . ' - ' . $contentData['weekdays'] . '</p>';
        $content .= '<p><i>時間 :</i> ' . $contentData['timeStart'] . ' - ' . $contentData['timeEnd'] . '</p>';
        $content .= '<p><i>地點 :</i> ' . $contentData['branch'] . ' - ' . $contentData['place'] . '</p>';
        $content .= '<p>' . $contentData['note'] . '</p>';
        $content .= '<a href="http://ctcvn.vn/schedule/"><h3>' . '台灣商會總會網站' . '</h3></a>';

        wp_mail($arrMailTo, $subj, $content);
        //    SAU KHI SEND XONG CHUYEN VE TRANG SHOW
        $url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
        wp_redirect($url);
        //  }
    }

    // LAT TAT CA DATA CUA SCHEDULE
    public function getAllDataSchedule()
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY year DESC, month DESC, day DESC";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //LAY DATA CUA SCHEDULE THEO ID
    public function getDataScheduleByID($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE id = $id AND status = 1 ORDER BY year DESC, month DESC, day DESC";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }
}