<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../Customer/";

switch ($action) {
	case "save":
		$field = array();
		// pr($_POST);die;
		$field['user_email'] = get_safe_post('user_email');
		$field['user_phone'] = get_safe_post('user_phone');
		$field['user_pass'] = encryptIt(get_safe_post('confirm_password'));

		$field['user_type'] = get_safe_post('user_type');
		$field['first_name'] = get_safe_post('first_name');
		$field['o_name'] = get_safe_post('o_name');

		$field['gst'] = get_safe_post('gst');
		$field['user_address'] = get_safe_post('user_address');
		$field['user_country'] = get_safe_post('user_country');
		$field['user_state'] = get_safe_post('user_state');
		$field['user_district'] = get_safe_post('user_district');
		$field['user_pincode'] = get_safe_post('user_pincode');

		$field['user_startfrom'] = date('Y-m-d H:i:s');
		$field['ref_id'] = get_safe_post('ref_id');
		$field['ref_by'] = get_safe_post('ref_by');
		$field['balance'] = get_safe_post('balance');
		$field['dob'] = date('Y-m-d',strtotime(get_safe_post('dob')));

		$field['accountholder_name'] = get_safe_post('accountholder_name');
		$field['bank_accountno'] = get_safe_post('bank_accountno');
		$field['bank_ifsccode'] = get_safe_post('bank_ifsccode');
		$field['bank_name'] = get_safe_post('bank_name');

		$field['user_desc'] = get_safe_post('user_desc');
		$img_name = "";
        if ($_FILES["image"]["error"] == 0) {
            $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["image"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/image" . $config['game_image'] . $img_name);
			move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name);
        }
        
        if (!empty($img_name)) {
            $field['image'] = $img_name;
        }


		$field['user_status'] = get_safe_post('user_status');
		$primary_value = get_safe_post('data_id');

		$output =  save_command(tbl_customer, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;
		break;


	case "del":
		$field = array();
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_customer, "user_id", $primary_value, false);
		$_SESSION['message'] = $output;
		break;


	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getcustomer_byID($id);
			$st = $row['user_status'];
		}
		if ($st == "0") {
			$status = "1";
		} else {
			$status = "0";
		}
		$field['user_status'] = $status;
		$primary_value = $id;
		$output =  save_command(tbl_customer, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;

		break;
}
header("Location:" . $url_return);
