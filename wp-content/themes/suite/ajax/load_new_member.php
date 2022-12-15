<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

// code chua hoan chinh
$offset = $_POST['id']; 
$industry = $_POST['indus'];
$industryName = $_POST['indusName'];

require_once(DIR_MODEL . 'model-member-function.php');
$model = new Admin_Model_Member_Function();
$data = $model->getMoreDataMemberByIndustry($industry, $offset);

if (!empty($data)) {
    foreach ($data as $key => $val) {
        $html .= "<div class='member-item' data_id = ". ++$offset . " >";
        $html .= "<div class='member-head'>";
        $html .= "<div class='member-title'>";
        $html .= "<i>" . $val['serial'] . " </i> " . $val['company_cn'] .
                "</div>";
        $html .= "<div class='member-icon'>";
        $html .= "<a class='show-icon'><i class='fas fa-angle-double-down'></i></a>
                </div>
            </div>";
        $html .= "<div class='member-content'>
                <div class='row'>";
        $html .= "<div class='col-lg-12'><label>" . $val['company_vn'] . "</label></div>";
        $html .= "<div class='col-lg-12'><label>" . $val['address_cn'] . "</label></div>";
        $html .= "<div class='col-lg-12'><label>" . $val['address_vn'] . "</label></div>";
        $html .= "<div class='col-lg-6'><label>" . _e('Full Name') . ' : ' . $val['contact'] . "</label></div>";
        $html .= "<div class='col-lg-6'><label>" . _e('Regency') . ' : ' . $val['position'] . "</label></div>";
        $html .= "<div class='col-lg-6'><label>" . _e('Phone') . ' : ' . $val['phone'] . "</label></div>";
        $html .= "<div class='col-lg-6'><label>" . _e('Email') . ' : ' . $val['email'] . "</label></div>";
        $html .= "<div class='col-lg-6'><label>" . _e('Service List') . ' : ' . $val['service'] . "</label></div>";
        $html .= "<div class='col-lg-12'>";
        $html .= "<label>" . _e('Industry') . ' : ' . $industryName . "</label>
                    </div>
                </div>
            </div>
        </div>" ;
    }
}

$response = array(
    'status' => 'done',
    'html' => $html,
);

echo json_encode($response);