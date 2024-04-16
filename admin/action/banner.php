<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../Banner/index.php";
switch ($action) {
    case "save":
         $field = array();
         $field['banner_name'] = get_safe_post('title');
		  $field['banner_name2'] = get_safe_post('title2');
		   $field['banner_name3'] = get_safe_post('title3');
		    $field['banner_name4'] = get_safe_post('title4');
			 $field['banner_name5'] = get_safe_post('title5');
		  $field['banner_startfrom'] = date('Y-m-d');
		  $img_name = "";
            if ($_FILES["images"]["error"] == 0) {
                $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["images"]["name"]));
                move_uploaded_file($_FILES["images"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
            }
            if ((isset($_FILES["images"])) && !empty($img_name)) {
                $field['banner_img'] = $img_name;
            }
			
         $field['banner_status'] = get_safe_post('select');
		 $field['banner_type'] = get_safe_post('banner_type');
         $primary_value = get_safe_post('data_id');
         $output =  save_command(tbl_banner, $field, "banner_id", $primary_value);
		 $_SESSION['msg'] = $output;
        break;
   
case "del":
		$field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_banner, "banner_id", $primary_value,false);
        $_SESSION['message'] = $output;
        break;
    
case "status":
			if(isset($_GET['id']))
			{
			  $id=urlencode(decryptIt($_GET['id']));
			  $row = getbanner_byID($id);
			  $st=$row['banner_status'];
			}
			if($st=="0")
			{
				$status="1";
			}
			else
			{
				$status="0";
			}
		 $field['banner_status'] = $status;
		 $primary_value =$id;
         $output =  save_command(tbl_banner,$field,"banner_id",$primary_value);
         $_SESSION['msg'] = $output;
		 
        break;
   
}
header("Location:".$url_return);
?>