<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../Category/index.php";
switch ($action) {
	case "save":
		$field = array();
		$field['user_id'] = get_safe_post('user_id');
		$field['p_cat'] = "0";

		$field['cat_sub'] = get_safe_post('cat_sub');
		$field['cat_name'] = get_safe_post('cat_name');
		$field['cat_description'] = get_safe_post('cat_description');
		$field['url'] = get_safe_post('url');
		$field['yurl'] = get_safe_post('yurl');
		$field['p_range'] = get_safe_post('p_range');
		$field['mrp'] = get_safe_post('mrp');
		$field['cat_startfrom'] = date('Y-m-d H:i:s');
		$field['cat_status'] = get_safe_post('display_status');

		$field['pagetype'] = get_safe_post('pagetype');
		$field['times'] = get_safe_post('times');
		$field['formate'] = get_safe_post('formate');
		$img_name = "";
        if ($_FILES["image"]["error"] == 0) {
            $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["image"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "/upload/image" . $config['game_image'] . $img_name);
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name);

        }
        
        if (!empty($img_name)) {
            $field['image'] = $img_name;
        }
		
		$img_name = "";
		if ($_FILES["logo"]["error"] == 0) {
			$img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["logo"]["name"]));
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
		}
		if ((isset($_FILES["logo"])) && !empty($img_name)) {
			$field['logo'] = $img_name;
		}
		$primary_value = get_safe_post('data_id');

		$output =  save_command(tbl_categories, $field, "cat_id", $primary_value);
		// echo 'sdfsdf';die;
		$_SESSION['msg'] = $output;

		break;

	case "del":
		$field = array();
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_categories, "cat_id", $primary_value, false);
		$_SESSION['message'] = $output;
		break;

	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getCategory_byID($id);
			$st = $row['cat_status'];
		}
		if ($st == "0") {
			$status = "1";
		} else {
			$status = "0";
		}
		$field['cat_status'] = $status;
		$primary_value = $id;
		$output =  save_command(tbl_categories, $field, "cat_id", $primary_value);
		$_SESSION['msg'] = $output;

		break;
}
header("Location:" . $url_return);
