<?php

class Admin_Model_Member_Function {
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
        $this->table = $wpdb->prefix . 'member'; //prefix tiền tố là wphn
    }
    public function get_item($arrData = array(), $option = array())
    {
        global $wpdb;
        $id = absint($arrData['id']); //chuyển id về kiều int
        $sql = "SELECT * FROM $this->table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row; 
    }

    public function trashItem($arrData = array(), $option = array())
    {
        global $wpdb;
        
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 0); //data ở trash
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($this->table,$data,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $this->table SET `trash` = '0' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function restoreItem($arrData = array(), $option = array())
    {
        global $wpdb;
        
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $data = array('trash' => 1); //data ở publish
            $where = array('ID' => absint($arrData['id']));
            $wpdb->update($this->table,$data,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "UPDATE $this->table SET `trash` = '1' WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function deleteItem($arrData = array(), $option = array())
    {
        global $wpdb;
        /*
            kiểm tra phần có phân dạng chuỗi hay không
            -- $arrData['ID'] là tên cột ID trong database
            -- $arrData['id'] là từ tên cột ID trong database chuyển đổi qua hàm absint()
        */
        if (!is_array($arrData['ID'])) {
            $where = array('ID' => absint($arrData['id']));
            $wpdb->delete($this->table,$where);
        }else {
            /**
             * $arrData['id] chuyển qua ID-barcode, ví dụ 111-222333
             * do sử dụng array_map('absint) nó chỉ lấy số nên khi
             * lấy để dấu '-' không tiếp tục lấy
             * vậy là chỉ lấy phần đầu là ID không cần tách chuỗi
             */
            $arrData['id'] = array_map('absint', $arrData['ID']);
            $ids = join(',', $arrData['id']);
            $sql = "DELETE FROM $this->table WHERE ID IN ($ids)";
            $wpdb->query($sql);
        }
    }

    public function saveItem($arrData = array(), $option = array())
    {
        global $wpdb;
        $indus = implode(",", $arrData['industry_id']);

        $data = array(
            'serial' => $arrData['txt_mem_serial'],
            'company_cn' => $arrData['txt_mem_company_cn'],
            'company_vn' => $arrData['txt_mem_company_vn'],
            'address_cn' => $arrData['txt_mem_address_cn'],
            'address_vn' => $arrData['txt_mem_address_vn'],
            'contact' => $arrData['txt_mem_contact'],
            'position' => $arrData['txt_mem_position'],
            'mobile' => $arrData['txt_mem_mobile'],
            'phone' => $arrData['txt_mem_phone'],
            'fax' => $arrData['txt_mem_fax'],
            'email' => $arrData['txt_email'],
            'region' => trim($arrData['txt_mem_region']),
            'service' => $arrData['txt_mem_service'],
            'industry' => trim($arrData['sel_mem_industry']),
            'industry_id' => ',' . $indus . ',',
            'order' => $arrData['txt_mem_order'],
            'logo' => $arrData['txt_mem_logo'],
            'website' => $arrData['txt_mem_website'],
            'note' => $arrData['txt_mem_note']
        );

        $dataAdd = array(
            'trash' => 1,
            'create_date' => date('d-m-Y'),
        );

        $dataInsert = array_merge($data,$dataAdd);

        //kiểm tra action update hay insert
        if($option['action'] == 'update'){
            $where = array('ID' => $option['ID']);
            $wpdb->update($this->table,$data,$where);    
        }elseif ($option['action'] == 'insert'){
            $wpdb->insert($this->table,$dataInsert);
        }
    }

    //function lay industry name tu database qua industry
    function getIndustryNameByIndustryID()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member_industry';
        $sql = "SELECT * FROM  $table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //function lat tat ca data cua member
    public function getAllDataMemberByIndustry($item)
    {
        global $wpdb;
        $item == '' ? $sql = "SELECT * FROM $this->table LIMIT 20 " : 
            $sql = "SELECT * FROM $this->table LIMIT 20 WHERE industry_id = $item";   
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }
}