<?php
@session_start();
date_default_timezone_set('asia/calcutta');

// define("ABSPATH", $_SERVER['DOCUMENT_ROOT']);
// define("ABSPATH", $_SERVER['DOCUMENT_ROOT']."https://www.studentdatabasekart.in/");
// define("SITEPATH", "https://www.studentdatabasekart.in/");

define("SITEPATH", "https://new.sumiran.co/");
define("ABSPATH", $_SERVER['DOCUMENT_ROOT'] . "/");
// define("SITEPATH", "http://localhost/student/");
// define("ABSPATH", $_SERVER['DOCUMENT_ROOT'] . "/student");
header('Access-Control-Allow-Origin: *');
error_reporting(1);
define("ADMIN_FOLDER", "admin");
function myUrlEncode($string)
{
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}

//echo "asdasdsad";
//echo encryptIt('123456');
function encryptIt($q)
{
    $ciphering_value = "AES-128-CTR";
    $encryption_key = "JavaTpoint";
    $encryption_value   = openssl_encrypt($q, $ciphering_value, $encryption_key);
    return ($encryption_value);
}
function decryptIt($q)
{
    $ciphering_value = "AES-128-CTR";
    $encryption_key = "JavaTpoint";
    $encryption_value   = openssl_decrypt($q, $ciphering_value, $encryption_key);
    return ($encryption_value);
}

function encryptor($action, $string)
{
    $output = false;

    $encrypt_method = "aes128";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $secret_iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_iv);
    }

    return $output;
}
function RemoveSpecialChar($str)
{

    // Using str_replace() function
    // to replace the word
    $res = str_replace(array(
        '\'', '"',
        ',', ';', '<', '>'
    ), ' ', $str);

    // Returning the result
    return $res;
}

function pr($data)
{
    // Convert the data to a string representation
    if (is_array($data) || is_object($data)) {
        $formatted_data = print_r($data, true);
    } else {
        $formatted_data = htmlentities($data);
    }

    // Echo the formatted data
    echo "<pre>{$formatted_data}</pre>";
    // die;
}
// pr(ABSPATH . "/config_setting/database.php");die;
include(ABSPATH . "/config_setting/database.php");
include(ABSPATH . "/config_setting/common_function.php");;
include(ABSPATH . "/modules/cms.php");
include(ABSPATH . "/modules/login.php");
//include(ABSPATH."/config_setting/data.php");


$config['category_thumb'] = "upload/thumb/";
$config['image'] = "upload/image/";
$config['category_large'] = "upload/large/";
$config['category_video'] = "upload/video/";
$config['category_video'] = "upload/video/";
$config['document_file'] = "upload/document_file/";
$config['document_sample'] = "upload/document_sample/";
define("NOIMAGE", $config['image'].'noimage.jpg');
$config['display_status'] = array("0" => "Active", "1" => "Inactive");
$config['sms_type'] = array("0" => "Normal", "1" => "Unicode");
$config['send_type'] = array("0" => "SMS", "1" => "CronJob");
$config['paid_status'] = array("0" => "Cr", "1" => "Dr");
$config['gender'] = array("0" => "Male", "1" => "Female");
$config['banner_type'] = array("0" => "Top Silder", "1" => "Bottom Silder");
$config['typeofpurchase'] = array("0" => "fund_add", "1" => "order");
$config['paper'] = array("1" => "Yes", "2" => "No");
$config['user_type'] = array("0" => "Admin", "1" => "User", "2" => "Supplier", "3" => "Salesman", "4" => "Customer");
// $config['type'] = array("1" => "Payment", "2" => "Receipt", "3" => "Car Booking", "4" => "Purchase", "5" => "Sales Account", "6" => "Cost of Sales", "7" => "Expense");
// $config['type1'] = array("1" => "Payment", "2" => "Receipt");

$config['payment_type'] = array("1" => "Credit", "2" => "Debit");
$config['payment_by'] = array("0" => "Select Payment Type", "1" => "Supplier", "2" => "Customer", "3" => "Account");
$config['typeofsale'] = array("1" => "Cash", "2" => "Cheque", "3" => "Finance");
$config['m_status'] = array("0" => "Choose one", "1" => "Never Married", "2" => "Divorced", "3" => "Awaiting Divorce", "4" => "Widowed");
$config['source'] = array("0" => "Source", "1" => "Youtube");

$config['disposition'] = array("1" => "Select", "15" => "BOOKING", "24" => "Interested", "25" => "Highly Interested", "26" => "Not Interested", "30" => "Continue", "31" => "Others");
$config['newdisposition'] = array("0" => "Others", "15" => "BOOKING", "24" => "Interested", "25" => "Highly Interested", "26" => "Not Interested", "30" => "Continue", "31" => "Others");
$config['ledlaptop'] = array("0" => "LED", "1" => "LAPTOP");
$config['pagetype'] = array("0" => "Thanku Page", "1" => "Upsell + Thanku");
$config['paymentyype'] = array("0" => "Wallet", "1" => "Online Payment");
$config['paymentstatus'] = array("0" => "Panding", "1" => "Done");
$config['orderstatus'] = array("0" => "Panding", "1" => "Completed", "2" => "Cancel");
$config['customer_type'] = array("0" => "Organization", "1" => "Individual");
$config['country'] = array("0" => "India", "1" => "Other Country");
$config['type2'] = array("0"=>"Offer", "1"=>"Winning", "2"=>"Games");