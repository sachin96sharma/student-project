<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../game/index.php"; // Adjust the return URL as needed

switch ($action) {
    case "save":
        $field = array();
        $field['category_id'] = get_safe_post('category_id'); 
        $field['name'] = get_safe_post('name');
        $field['gamestart'] = get_safe_post('gamestart');
        $field['gameend'] = get_safe_post('gameend');
        $field['gamebiding'] = get_safe_post('gamebiding');
        $field['countdown'] = get_safe_post('countdown'); 
        $field['result'] = get_safe_post('result');
        $field['status'] = get_safe_post('status');
        
        $img_name = "";
        if ($_FILES["image"]["error"] == 0) {
            $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["image"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "/upload/image" . $config['game_image'] . $img_name);
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name);

        }
        
        if (!empty($img_name)) {
            $field['image'] = $img_name;
        }
        
        $primary_value = get_safe_post('data_id');
        $output =  save_command("games", $field, "game_id", $primary_value);
        $_SESSION['msg'] = $output;
        break;
        // update
        
    
        case "status":
            if (isset($_GET['game_id'])) {
                // Decode the ID parameter
                $id = decryptIt(urldecode($_GET['game_id']));
                // Retrieve game details by ID
                $row1 = getGameDetailsByID($id); // Implement this function to get game details by ID
            
                // Check if game details are retrieved successfully
                if ($row1) {
                    $st = $row1['status'];
        
                    // Toggle status
                    if ($st == "active") {
                        $status = "inactive";
                    } else {
                        $status = "active";
                    }
        
                    // Update status in the database
                    $field['status'] = $status;
                    $primary_value = $id;
                    $output = save_command("games", $field, 'game_id', $primary_value); 
                // Ensure correct table name and primary key field
                    $_SESSION['msg'] = $output; // Store output message in session variable
                } else {
                    $_SESSION['msg'] = "Game details not found for the given ID."; // Error message if game details not found
                }
            } else {
                $_SESSION['msg'] = "ID parameter is missing."; // Error message if ID parameter is not provided in the URL
            }
            break;
        
        }
header("Location:".$url_return);
?>
