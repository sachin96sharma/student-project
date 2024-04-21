<?php
include("../system_config.php");

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
// Function to handle file upload
// pr($_FILES);die;
function handleFileUpload($fileKey, $columnName, $userId)
{
    global $link, $config;
    
    if (!empty($_FILES[$fileKey]["name"]) && $_FILES[$fileKey]["error"] == 0) {
        $getUserByID = getcustomer_byID($userId);
        $customerNameWithoutSpacesLowercase = strtolower(str_replace(' ', '', $getUserByID['first_name']));
        $phone = empty($getUserByID['user_phone']) ? 'NoPhone' : $getUserByID['user_phone'];
        $imageName = $customerNameWithoutSpacesLowercase . '_' . $phone;

        $file_name = $_FILES[$fileKey]["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $user_img_name = $imageName . '_' . time() . '_' . $fileKey . "." . $file_ext;
        $path = '../' . $config['image'] . $user_img_name;

        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $path)) {
            unlink('../' . $config['image'] . $getUserByID[$columnName]);
            $update_sql = "UPDATE customer SET $columnName = ? WHERE user_id = ?";
            $update_stmt = mysqli_prepare($link, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'si', $user_img_name, $userId);
            mysqli_stmt_execute($update_stmt);
        }
    }
}

// Check if the request method is POST and the key matches
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    // Validate and sanitize user ID
    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    if ($userId) {
        $userExist = getcustomer_byID($userId);
        // pr( $userExist);die;
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid User ID']);
            exit;
        }
    }

    // Validate and sanitize input fields
    $first_name = sanitizeInput($_POST['first_name']);
    $email = sanitizeInput($_POST['user_email']);
    $phone = sanitizeInput($_POST['user_phone']);
    $user_country = sanitizeInput($_POST['user_country']);
    $user_state = sanitizeInput($_POST['user_state']);
    $user_district = sanitizeInput($_POST['user_district']);
    $user_address = sanitizeInput($_POST['user_address']);
    $user_pincode = sanitizeInput($_POST['user_pincode']);
    $password = sanitizeInput($_POST['user_pass']);
    $hashed_password = encryptIt($password);
    $fund_wallet = sanitizeInput($_POST['fund_wallet']);
    $bank_accountno = sanitizeInput($_POST['bank_accountno']);
    $bank_ifsccode = sanitizeInput($_POST['bank_ifsccode']);
    $bank_name = sanitizeInput($_POST['bank_name']);
    $accountholder_name = sanitizeInput($_POST['accountholder_name']);
    $ref_id = sanitizeInput($_POST['ref_id']);
    $ref_by = sanitizeInput($_POST['ref_by']);
    $balance = sanitizeInput($_POST['balance']);
    // $user_logo = sanitizeInput($_FILES['image']['name']);

    // Validate required fields
    $requiredFields = [
        'first_name',
        'user_email',
        'user_phone',
        'user_country',
        'user_state',
        'user_district',
        'user_address',
        'user_pass',
        'fund_wallet',
        'bank_accountno',
        'bank_ifsccode',
        'bank_name',
        'accountholder_name',
        'ref_id',
        'ref_by',
        'balance'
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

    // Check if the user already exists
    $userExist = getUserByEmailOrId($email);
    if ($userExist && !$userId) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'You are already registered. Our team will connect with you shortly.']);
        exit;
    }

    // Prepare and execute SQL query
    if ($userId) {
        $sql = "UPDATE customer SET first_name=?, user_phone=?, user_country=?, user_state=?, user_district=?, user_address=?, fund_wallet=?, bank_accountno=?, bank_ifsccode=?, bank_name=?, accountholder_name=?, ref_id=?, ref_by=?, balance=? WHERE user_id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssississssssssi', $first_name, $phone, $user_country, $user_state, $user_district, $user_address, $fund_wallet, $bank_accountno, $bank_ifsccode, $bank_name, $accountholder_name, $ref_id, $ref_by, $balance, $userId);
    } else {
        $sql = "INSERT INTO customer (first_name,user_email, user_phone,user_country, user_state,user_district, user_address,user_pincode,user_pass, fund_wallet, bank_accountno, bank_ifsccode, bank_name, accountholder_name, ref_id, ref_by, balance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssisssssssssssi', $first_name, $email, $phone, $user_country, $user_state, $user_district, $user_address, $user_pincode, $hashed_password, $fund_wallet, $bank_accountno, $bank_ifsccode, $bank_name, $accountholder_name, $ref_id, $ref_by, $balance);
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
        $last_inserted_id = $userId ? $userId : mysqli_insert_id($link);
        // pr($last_inserted_id);die;
        handleFileUpload("image", "image", $last_inserted_id);
    }

    // Respond with success message
    $response = ['status' => true, 'message' => $userId ? 'Your Profile has been updated successfully.' : 'Your registration procedure has been completed. Our team will connect with you shortly.'];
    http_response_code($userId ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
