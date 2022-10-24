<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

if(isset($_POST['type']) == 'cn'){
    $_SESSION['languages'] = $_POST['type'];
}elseif(isset($_POST['type']) == 'vn'){
    $_SESSION['languages'] = $_POST['type'];
}elseif(isset($_POST['type']) == 'en'){
    $_SESSION['languages'] = $_POST['type'];
}
$respone = array('status' => 'ok');  
  
echo json_encode($respone);