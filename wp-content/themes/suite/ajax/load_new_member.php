<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$offset = $_POST['id'];
$val = $_POST['value'];
// require_once(DIR_MODEL . 'model-member-function.php');
// $model = new Admin_Model_Member_Function();
// $cate = get_query_var('cate'); // cate trùng với tên khai báo trong rewrite.class.php
// $data = $model->getAllDataMemberByIndustry($cate);
// if (!empty($data)) {
    //foreach ($data as $key => $val) {
        $html .= "<li class='list-group-item member-item' data_id = " . ++$offset . ">";
        $html .= "<a>" . $val['company_cn'] . "</a>";  
        $html .= "</li>";
    //}
//}  

$response = array(
    'status' => 'done',
    'html' => $html,
);

echo json_encode($response);