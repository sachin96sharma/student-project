<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../notification/index.php"; // Adjust the return URL as needed

switch ($action) {
    case "save":
        $field = array();
  
        $field['type'] = get_safe_post('type');
        
        $field['description'] = get_safe_post('description');
        $field['status'] = get_safe_post('status');
        
        
        
        $primary_value = get_safe_post('data_id');
        $output =  save_command("notifications", $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;
        // update
        
    
        case "status":
            if (isset($_GET['id'])) {
                // Decode the ID parameter
                $id = decryptIt(urldecode($_GET['id']));
                // Retrieve game details by ID
                $row1 = getNotificationDetailsByID($id); // Implement this function to get game details by ID
            
                // Check if game details are retrieved successfully
                if ($row1) {
                    $st = $row1['status'];
        
                    // Toggle status
                    if ($st == "Active") {
                        $status = "Inactive";
                    } else {
                        $status = "Active";
                    }
        
                    // Update status in the database
                    $field['status'] = $status;
                    $primary_value = $id;
                    $output = save_command("notifications", $field, 'id', $primary_value); 
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
