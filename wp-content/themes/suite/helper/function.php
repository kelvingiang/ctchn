<?php
/*
 * ==================================================
 * ---------- FUNCTION DUNG CHO BACK-END ------------
 * ==================================================
 */

//====== SAP LAI ARRAY THEO THU TU GIAM DAN AP DUNG CATEGORY =================
function cmp($a, $b)
{
    return strcmp($b['order'], $a['order']);
}

//============= FUNCTION GET HINH =============================
function get_image($name = '')
{
    return get_template_directory_uri() . '/images/' . $name;
}

//==== GET PARAM TREN URL============================================
function getParams($name = null)
{
    if ($name == null || empty($name)) {
        return $_REQUEST; // TRA VE GIA TRI REQUEST
    } else {
        // TRUONG HOP name DC CHUYEN VAO 
        // KIEM TRA name CO TON TAI TRA VE name NGUOI ''
        $val = (isset($_REQUEST[$name])) ? $_REQUEST[$name] : ' ';
        return $val;
    }
}

function custom_redirect($location)
{
    global $post_type;
    $location = admin_url('edit.php?post_type=' . $post_type);
    return $location;
}

//============= KIEM DU LIEU CHUYEN QUA BANG PHUONG POST HAY GET======================
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $flag = true;
    } else {
        $flag = false;
    }

    return $flag;
}

//==== FUNCTION SHOW SUB CONTENT============================================
function mySubContent($data)
{
    $str = explode('<!--more-->', $data);
    return $str[0] . '....';
}

function getImage($name = '')
{
    return PART_IMAGES . $name;
}

//===============FUNCTION =================
function createRandom($length)
{
    //$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $characters = "0123456789";
    $charsLength = strlen($characters) - 1;
    $string = "";
    for ($i = 0; $i < $length; $i++) {
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}

function ToBack($num = 1)
{
    $paged = max(1, getParams('paged'));

    $param = getParams();

    $url = 'admin.php?page=' . $_REQUEST['page'] . '&customvar=' . $param['customvar'] . '&paged=' . $paged . '&msg=' . $num;
    wp_redirect($url);
}

//======= THAY DOI LOGO DANG NHAP O ADMIN =====================================================
if (!is_admin()) {

    // custom admin login logo
    function custom_login_logo()
    {
        echo '<style type="text/css">
	h1 a { background-image: url(' . PART_IMAGES . 'logo.png' . ') !important; }
	</style>';
    }

    add_action('login_head', 'custom_login_logo');
} else {
    // require_once DIR_HELPER . 'code/function-add-media.php';
    // require_once DIR_HELPER . 'code/function-upload-file.php';
}

function uploadFileDownLoad($File, $name)
{

    if (!empty($File['file_upload']['name'])) {
        $errors = array();
        $file_name = $File['file_upload']['name'];
        $file_size = $File['file_upload']['size'];
        $file_tmp = $File['file_upload']['tmp_name'];
        //$file_type = $File['file_upload']['type'];
        //$file_trim = ((explode('.', $File['file_upload']['name'])));
        //$trim_name = strtolower($file_trim[0]);
        //$trim_type = strtolower($file_trim[1]);

        $cus_name = $file_name;

        if ($file_size > 100097152) {
            $errors[] = '上傳檔案容量不可大於 100 MB';
        }
        $path = DIR_FILE; /* get function path upload img dc khai bao tai file hepler */

        if (empty($errors) == true) {
            if (is_file(DIR_FILE . $name)) {
                unlink(DIR_FILE . $name);
            }

            move_uploaded_file($file_tmp, ($path . $cus_name));
            return $cus_name;
        } else {
            return $errors;
        }
    }
}
