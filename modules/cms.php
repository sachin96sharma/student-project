<?php
if (!defined('ABSPATH'))
    die('-1');
define("tbl_user", "reg_user");
define("tbl_user_permission", "user_permission");
define("tbl_district", "district");
define("tbl_categories", "categories");
define("tbl_state", "states");
define("tbl_news", "news");
define("tbl_fourm", "fourm");
define("tbl_banner", "banner");
define("tbl_customer", "customer");
define("tbl_gallery", "gallery");
define("tbl_gallery_category", "gallery_category");
define("tbl_contact", "contactus");
define("tbl_document", "document");
define("tbl_order", "ordertable");
define("tbl_ordertable_product", "ordertable_product");
define("tbl_wallet_history", "wallet_history");
define("tbl_games", "games");
define("tbl_notifications", "notifications");
define("tbl_game_report", "game_report");
define("tbl_wallet", "wallet");
define("tbl_city", "city");




function getwallet_history_list()
{
    $sql = "select * from " . tbl_wallet_history . "   order by  id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getwallet_list()
{
    $sql = "select * from " . tbl_wallet . "   order by  id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getwallet_byID($Id)
{
    $sql = "select user_id,user_amount,payment_status,created_at from " . tbl_wallet . " where user_id='" . $Id . "' ";
    $array = FetchAll($sql);
    return $array;
}
function getWalletUserbyID($id_or_user_id = null)
{    
    if (is_numeric($id_or_user_id)) {
        $sql = "SELECT * FROM " . tbl_wallet . " WHERE id = '" . $id_or_user_id . "' LIMIT 1";
    } else {
        $sql = "SELECT * FROM " . tbl_wallet . " WHERE user_id = '" . $id_or_user_id . "' LIMIT 1";
    }
    $array = FetchRow($sql);
    return $array;
}

function getwallet_history_byID($Id)
{
    $sql = "select * from " . tbl_wallet_history . "   where id = '" . $Id . "'";
    $array = FetchRow($sql);
    return $array;
}

function getwallet_history_byUser($id)
{
    $sql = "select * from " . tbl_wallet_history . "   where username = '" . $id . "' order by id DESC";
    $array = FetchAll($sql);
    return $array;
}


function getorders_list_by_index()
{
    $sql = "select * from " . tbl_order . " where new_status = 0  order by  order_id desc limit 0,1";
    //	echo $sql;
    $array = FetchAll($sql);
    return $array;
}
function getorders_list()
{
    $sql = "select * from " . tbl_order . "   order by  order_id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getorders_byID($id)
{
    $sql = "select * from " . tbl_order . "   where order_id = '" . $id . "'";
    $array = FetchAll($sql);
    return $array;
}
function getorders_byID_new_admin($id)
{
    $sql = "select * from " . tbl_order . "   where order_id = '" . $id . "'";
    $array = FetchRow($sql);
    return $array;
}
function getorders_byID_new($id)
{
    $sql = "select * from " . tbl_order . "   where order_id = '" . $id . "'";
    $array = FetchRow($sql);
    return $array;
}
function getorders_byID_user($id)
{
    $sql = "select * from " . tbl_order . "   where customer_id = '" . $id . "' and paymentstatus='1' and orderstatus = '1' order by  order_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getorders_byID_user_acc($id)
{
    $sql = "select * from " . tbl_order . "   where customer_id = '" . $id . "' order by  order_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getorders_byID_product($id)
{
    $sql = "select * from " . tbl_ordertable_product . " where order_product_id='" . $id . "' order by  order_product_id desc ";
    $array = FetchRow($sql);
    return $array;
}
function getorders_byID_product_index($id)
{
    $sql = "select * from " . tbl_ordertable_product . " where order_id='" . $id . "' order by  order_product_id desc ";
    $array = FetchAll($sql);
    return $array;
}


function getdocument_byList()
{

    $sql = "select * from " . tbl_document . " order by  document_id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getdocument_byList_dash($id)
{

    $sql = "select * from " . tbl_document . " where document_status = 0 and cat_id='" . $id . "' order by  document_sort asc ";
    $array = FetchAll($sql);
    return $array;
}
function getdocument_byList_dash_search($id)
{

    $sql = "select * from " . tbl_document . " where document_status = 0 and document_name LIKE  '%" . $id . "%' order by  document_id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getdocument_byID($id)
{

    $sql = "select * from " . tbl_document . "  where document_id = '" . $id . "'";
    $array = FetchRow($sql);
    return $array;
}


function getcustomer_byList_dah()
{
    $sql = "select * from " . tbl_customer . " order by  user_id desc limit 0,10 ";
    $array = FetchAll($sql);
    return $array;
}



function getcustomer_byList()
{
    $sql = "select * from " . tbl_customer . " order by  user_id desc ";
    $array = FetchAll($sql);
    return $array;
}
function getcustomer_bycount()
{
    $sql = "SELECT COUNT(user_id)  FROM " . tbl_customer . "";
    $array = FetchAll($sql);
    return $array;
}

function getcontact_byList()
{

    $sql = "select * from " . tbl_contact . " order by  contactus_id desc ";
    $array = FetchAll($sql);
    return $array;
}

function getcontact_byID($id)
{

    $sql = "select * from " . tbl_contact . "  where contactus_id = '" . $id . "'";
    $array = FetchRow($sql);
    return $array;
}
function get_gallery_category()
{
    $sql = "select * from " . tbl_gallery_category . " order by  id desc ";
    //echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function get_gallery_category_home()
{
    $sql = "select * from " . tbl_gallery_category . " WHERE cat_status = '0' order by  id asc ";
    //echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}

function get_gallery_category_byID($id)
{
    $sql = "select * from " . tbl_gallery_category . " where id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}


function get_page_gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_category ='" . $id . "' ";
    $array = FetchAll($sql);
    return $array;
}
function getgallery_list()
{
    $sql = "select * from " . tbl_gallery . " WHERE gallery_status = '0' ORDER BY gallery_id desc ; ";
    $array = FetchAll($sql);
    return $array;
}

function getgallery_listid($id)
{
    if ($id !== "1") {
        $id = "and user_id = " . $id;
    } else {
        $id = "";
    }

    $sql = "select * from " . tbl_gallery . " WHERE gallery_status = '0' $id ORDER BY gallery_id desc ; ";
    $array = FetchAll($sql);
    return $array;
}



function getgallery_lists()
{
    $sql = "select * from " . tbl_gallery . " ORDER BY gallery_id desc";

    $array = FetchAll($sql);
    return $array;
}

function getgallery_ID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_id =  '" . $id . "'  limit 0,1";
    //echo $sql;die(); 
    $array = FetchAll($sql);
    return $array;
}

function gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function get_gallery_byID($id)
{
    $sql = "select * from " . tbl_gallery . " where gallery_category='" . $id . "' ";
    $array = FetchAll($sql);
    return $array;
}
function getgallery_count()
{
    $sql = "SELECT COUNT(*) FROM " . tbl_gallery . "";
    //echo $sql;die(); 
    $array = FetchAll($sql);
    return $array;
}

function getcustomer_byID($id)
{
    $sql = "select * from " . tbl_customer . " where user_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getgame_byID($gameId)
{
    $sql = "select * from " . tbl_games . " where game_id='" . $gameId . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}


function gettransaction_byID($Id)
{
    $sql = "select * from " . tbl_wallet_history . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getUserByEmailOrId($id_or_email = null)
{
    if (is_numeric($id_or_email)) {
        $sql = "select * from " . tbl_customer . " where user_id = '" . $id_or_email . "' limit 0,1 ";
    } else {
        $sql = "select * from " . tbl_customer . " where user_email = '" . $id_or_email . "' limit 0,1 ";
    }
    $array = FetchRow($sql);
    return $array;
}

function getGameDetailsByID($id)
{
    $sql = "select * from " . tbl_games . " where game_id='" . $id . "' limit 0,1 ";

// pr($sql);die;
    $array = FetchRow($sql);
    return $array;
}

function getGameResultById($id)
{
    $sql = "select * from " . tbl_games . " where result='" . $id . "' limit 0,1 ";

    $array = FetchRow($sql);
    return $array;
}

function getWalletDetailsById($id)
{
    $sql = "select * from " . tbl_wallet . " where id='" . $id . "' limit 0,1 ";

    $array = FetchRow($sql);
    return $array;
}
function  getNotificationDetailsByID($id)
{
    $sql = "select * from " . tbl_notifications . " where id='" . $id . "' limit 0,1 ";

    $array = FetchRow($sql);
    return $array;
}

function getcustomer_list()
{
    $sql = "select * from " . tbl_customer . " order by  user_id desc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}



function getbanner_byID($id)
{
    $sql = "select * from " . tbl_banner . " where banner_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getbanner_list()
{
    $sql = "select * from " . tbl_banner . " order by  banner_id desc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getbanner_list_status()
{
    $sql = "select * from " . tbl_banner . " where banner_status = '0' and banner_type = '0' order by  banner_id asc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}
function getbanner_list_status_bot()
{
    $sql = "select * from " . tbl_banner . " where banner_status = '0' and banner_type = '1' order by  banner_id asc";
    // echo $sql;die();
    $array = FetchAll($sql);
    return $array;
}

function getfourm_byID($id)
{
    $sql = "select * from " . tbl_fourm . " where fourm_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}




function getfourm_byID_user($id)
{
    $sql = "select * from " . tbl_fourm . " where user_district='" . $_SESSION['user_district'] . "' order by  fourm_id desc ";
    $array = FetchAll($sql);
    return $array;
}


function getfourm_list()
{
    $sql = "select * from " . tbl_fourm . " order by  fourm_id desc";
    $array = FetchAll($sql);
    return $array;
}


function getnews_byID($id)
{
    $sql = "select * from " . tbl_news . " where news_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getnews_list()
{
    $sql = "select * from " . tbl_news . " order by  news_id desc";
    $array = FetchAll($sql);
    return $array;
}

function getnews_list_by_dash()
{
    $sql = "select * from " . tbl_news . " order by  news_id desc limit 0,10";
    $array = FetchAll($sql);
    return $array;
}

function getcity_bystateID($id)
{
    $sql = "SELECT * FROM city WHERE stateID = '".$id."' ";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getcity_list()
{
    $sql = "select * from " . tbl_city . " order by city_id asc";
    // pr($sql);die;
    $array = FetchAll($sql);
    return $array;
}
function getallGame_list()
{
    $sql = "SELECT name,game_id, image FROM " . tbl_games . " ORDER BY game_id DESC";
    $array = FetchAll($sql);
    return $array;
}
function getGameby_Id($id)
{
    $sql = "SELECT name,image,id FROM " . tbl_games . " WHERE game_id = '" . $id . "' LIMIT 1";
    $array = FetchRow($sql);
    return $array;
}
function getUserWallet_list(){
    $sql = "SELECT user_id, user_amount FROM " . tbl_wallet . " ORDER BY id DESC ";
    $array = FetchAll($sql);
    return $array;
}
function getUserWallet_Id($id){ 
    $sql = "SELECT user_id, user_amount FROM " . tbl_wallet . " WHERE user_id = '" . $id . "' ORDER BY id DESC LIMIT 1";
    $array = FetchAll($sql);
    return $array;        
}

function getState_byID($id)
{
    $sql = "select * from " . tbl_state . " where stateID='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getState_list()
{
    $sql = "select * from " . tbl_state . " order by  stateID asc ";
    $array = FetchAll($sql);
    return $array;
}

function getCategory_byList_byuser($id)
{
    $sql = "select * from " . tbl_categories . " where user_id='" . $id . "'  ";
    $array = FetchAll($sql);
    return $array;
}


function getCategory_byID($Id)
{
    
    $sql = "select * from " . tbl_categories . " where cat_id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getUserByCatOrId($id_or_cat_name = null)
{
    if (is_numeric($id_or_cat_name)) {
        $sql = "select * from " . tbl_categories . " where cat_id = '" . $id_or_cat_name . "' limit 0,1 ";
    } else {
        $sql = "select * from " . tbl_categories . " where cat_name = '" . $id_or_cat_name . "' limit 0,1 ";
    }
    $array = FetchRow($sql);
    return $array;
}
function getCategoryName_byID($id)
{
    $sql = "select cat_name from " . tbl_categories . " where cat_id='" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}


function getCategory_list()
{
    $sql = "select * from " . tbl_categories . " order by  cat_id desc ";
    $array = FetchAll($sql);
    return $array;
}



function getCategory_list_index()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0' order by  cat_id DESC limit 0,10";
    $array = FetchAll($sql);
    return $array;
}
function categories_list()
{
    $sql = "select * from " . tbl_categories . " where cat_status = '0'  order by  sort desc ";
    $array = FetchAll($sql);
    return $array;
}

function getdashuser()
{
    $sql = "select  COUNT(user_id) from " . tbl_user . " ";
    $array = FetchRow($sql);
    return $array;
}
function getdashusertoday($id)
{
    $sql = "select  COUNT(user_id) from " . tbl_user . " WHERE Date(`user_startfrom`)='$id';";
    $array = FetchRow($sql);
    return $array;
}

function getuser_permission_byID($id)
{
    $sql = "select * from " . tbl_user_permission . " where user_id = '" . $id . "'";
    $array = FetchAll($sql);
    return $array;
}

function getuser_byID($id)
{
    $sql = "select * from " . tbl_user . " where user_id = '" . $id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}

function getuser_byList_byuser($id)
{
    $sql = "select * from " . tbl_user . " where user_id = '" . $id . "' limit 0,1 ";
    $array = FetchAll($sql);
    return $array;
}
function getuser_byList_bydash()
{
    $sql = "select * from " . tbl_user . " order by  user_id desc limit 0,10";
    $array = FetchAll($sql);
    return $array;
}

function getuser_byList()
{

    $sql = "select * from " . tbl_user . " order by  user_id desc ";
    echo  $sql;
    $array = FetchAll($sql);
    return $array;
}

function getuser_byList_byCate($id)
{
    $sql = "select * from " . tbl_user . " where cat_id = '" . $id . "' order by  user_id desc  ";
    $array = FetchAll($sql);
    return $array;
}
// get game list
function getGame_list()
{
    $sql = "SELECT * FROM games ORDER BY game_id DESC";
    $games = FetchAll($sql);
    return $games;
}
function getReport_bylist($gameId = null)
{
    if ($gameId) {
        $sql = "SELECT * FROM " . tbl_game_report . " WHERE game_id = " . $gameId . " ORDER BY id DESC";
    } else {
        $sql = "SELECT * FROM " . tbl_game_report . " ORDER BY id DESC";
    }
    // pr($sql);die;
    $games = FetchAll($sql);
    
    // Return the fetched results
    return $games;
}

function getReportbyId($Id)
{
    $sql = "select * from " . tbl_game_report . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function gameReportbyId($Id)
{
    $sql = "select * from " . tbl_game_report . " where game_id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function gameReport_list()
{
    $sql = "SELECT * FROM game_report ORDER BY id DESC";
    $games = FetchAll($sql);
    return $games;
}


function getNotificationbyId($Id)
{
    $sql = "select * from " . tbl_notifications . " where id='" . $Id . "' limit 0,1 ";
    $array = FetchRow($sql);
    return $array;
}
function getNotificationtypeOrId($Id_or_type = null)
{
    if (is_numeric($Id_or_type)) {
        $sql = "select * from " . tbl_notifications . " where id = '" . $Id_or_type . "' limit 0,1 ";
    } else {
        $sql = "select * from " . tbl_notifications . " where type = '" . $Id_or_type . "' limit 0,1 ";
    }
    $array = FetchRow($sql);
    return $array;
}

function getNotification_list()
{
    $sql = "SELECT * FROM notifications ORDER BY id DESC";
    $games = FetchAll($sql);
    return $games;
}
function getTransaction_list()
{
    $sql = "SELECT * FROM wallet_history ORDER BY id DESC";
    $games = FetchAll($sql);
    return $games;
}


// Define getCategoryNameByID function
function getCategoryNameByID($category_id)
{
    // Implement logic to retrieve category name from the database based on category_id
    // For example:
    $sql = "SELECT cat_name FROM categories WHERE cat_id = :category_id";
    // Execute SQL query and return the category name
}
