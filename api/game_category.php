<?php
include("../system_config.php");
//  pr($file_name);die;
// Check if the request method is POST and content type is JSON
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
function handleFileUpload($fileKey, $columnName, $Id)
{
    global $link, $config;
    
    if (!empty($_FILES[$fileKey]["name"]) && $_FILES[$fileKey]["error"] == 0) {
        $getUserByID = getCategory_byID($Id);
        $customerNameWithoutSpacesLowercase = strtolower(str_replace(' ', '', $getUserByID['cat_name']));
        $cat = empty($getUserByID['cat_name']) ? 'NoCategory' : $getUserByID['cat_name'];
        $imageName = $customerNameWithoutSpacesLowercase . '_' . $cat;
        $file_name = $_FILES[$fileKey]["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $user_img_name = $imageName . '_' . time() . '_' . $fileKey . "." . $file_ext;
        $path = '../' . $config['image'] . $user_img_name;
        
        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $path)) {
            unlink('../' . $config['image'] . $getUserByID[$columnName]);
            $update_sql = "UPDATE categories SET $columnName = ? WHERE cat_id = ?";
            // pr($user_img_name);
            $update_stmt = mysqli_prepare($link, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'si', $user_img_name, $Id);
            mysqli_stmt_execute($update_stmt);
            // pr('if');die;
        // }else{
            // pr('else');die;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key'] == 'qwertyupasdfghjklzxcvbnm') {
// pr($_FILES);die;
    $Id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    if ($Id) {
        $userExist = getCategory_byID($Id);
        
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid  ID']);
            exit;
        }
    }

    $cat_name = sanitizeInput($_POST['cat_name']);
    $url = sanitizeInput($_POST['url']);
    $cat_status = sanitizeInput($_POST['cat_status']);
    
    // Validate required fields
    $requiredFields = [
        'cat_name',
        'url',
        'cat_status'    
    ];
    $emptyFields = [];
    foreach ($requiredFields as $fieldName) {
        if (empty($_POST[$fieldName])) {
            $emptyFields[] = $fieldName;
        }
    }
    if (!empty($emptyFields)) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'The following fields are required: ' . implode(', ', $emptyFields)]);
        exit;
    }
    
    $userExist = getUserByCatOrId($cat_name);
    if ($userExist && !$Id) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'You are already add category name . ']);
        exit;
    }
    // Prepare and execute SQL query
    if ($Id) {
        $sql = "UPDATE categories SET cat_name=?, url=?, cat_status=?  WHERE cat_id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $cat_name, $url, $cat_status, $Id);
    } else {
        $sql = "INSERT INTO categories (cat_name,url, cat_status) VALUES (?, ?,?)";
        //  pr( $sql);die;
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $cat_name, $url, $cat_status);
        
    }


    if (!mysqli_stmt_execute($stmt)) {
        $error_message = mysqli_error($link); // Get the error message
        error_log("SQL Error: $error_message"); // Log the error
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'Registration/update failed. ' . $error_message]);
        exit;
    }
    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $last_inserted_id = $Id ? $Id : mysqli_insert_id($link);
        // pr($last_inserted_id);die;
        handleFileUpload("image", "image", $last_inserted_id);
    }
    // Respond with success message
    $response = ['status' => true, 'message' => $Id ? 'Your category has been successfully updated.' : 'Your process for the new category is complete.'];
    http_response_code($Id ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>