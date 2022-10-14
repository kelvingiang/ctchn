<?php 

class Admin_Model_Member_Industry {
    private $table;

    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'member_industry';
    }

    //LAY TAT CA DATA CUA INDUSTRY
    public function getDataIndustry() 
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

    //LAY DATA CUA 1 INDUSTRY ITEM
    public function getIndustryItem($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM $this->table WHERE ID = $id";
        $row = $wpdb->get_row($sql, ARRAY_A);
        return $row;
    }

    public function save($arr, $option)
    {
        global $wpdb;
        $data = array(
            'name' => $arr['txt_indus_name'],
            'order' => $arr['txt_indus_order'],
        );
        $dataAdd = array(
            'create_date' => date('d-m-Y'),
        );
        $insertData = array_merge($data, $dataAdd);

        //KIEM TRA OPTION LA ADD HAY UPDATE
        if($option == "add") {
            $wpdb->insert($this->table, $insertData);
        }elseif ($option == "update") {
            $where = array('ID' => $arr['hidden_id']);
            $wpdb->update($this->table, $data, $where);
        }
    }

    public function deleteIndustry($id)
    {
        global $wpdb;
        $where = array('ID' => absint($id));
        $wpdb->delete($this->table, $where);
    }

    //LAY CAC MEMBER CO SU DUNG INDUSTRY ID
    public function getMemberIndustry()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT industry_id FROM $table WHERE industry_id != '' ";
        $row = $wpdb->get_results($sql, ARRAY_A);
        return $row;
    }

}