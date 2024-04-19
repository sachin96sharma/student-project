<?php
include("../system_config.php");

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    // Validate and sanitize user ID
    $userId = isset($_POST['userId']) ? (int)$_POST['userId'] : null;
    if ($userId) {
        $userExist = getuser_byID($userId);
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'error' => 'Invalid User ID']);
            exit;
        }
    }


    $first_name = sanitizeInput($_POST['first_name']);
    $email = sanitizeInput($_POST['user_email']);
    $phone = sanitizeInput($_POST['user_phone']);
    $password = sanitizeInput($_POST['user_pass']);
    $hashed_password = encryptIt($password);
    

    // Validate required fields
    $requiredFields = [
        'first_name' => $first_name,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
       
    ];

    $emptyFields = [];
    foreach ($requiredFields as $fieldName => $fieldValue) {
        if (empty($fieldValue)) {
            $emptyFields[] = $fieldName;
        }
    }

    if (!empty($emptyFields)) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'error' => 'The following fields are required: ' . implode(', ', $emptyFields)]);
        exit;
    }

    // Check if the user already exists
    $userExist = getuser_byID($email);

    if ($userExist && !$userId) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'error' => 'You are already registered. Our team will connect with you shortly.']);
        exit;
    }

    // Prepare and execute SQL query
    if ($userId) {
        $sql = "UPDATE customer SET first_name=?, user_pass=?, user_phone=?,  WHERE user_id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $first_name, $hashed_password, $phone,  $userId);
    } else {
        $sql = "INSERT INTO customer (first_name,user_email, user_pass,user_phone, ) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssiiiss', $first_name, $email, $hashed_password, $phone );
    }

    if (!mysqli_stmt_execute($stmt)) {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'error' => 'Registration/update failed. ' . mysqli_error($link)]);
        exit;
    }

    // Handle file upload
    $last_inserted_id = $userId ? $userId : mysqli_insert_id($link);
    handleFileUpload("user_logo", "user_logo", $last_inserted_id);

    // Respond with success message
    $response = ['status' => true, 'message' => $userId ? 'Your Profile has been updated successfully.' : 'Your registration procedure has been completed. Our team will connect with you shortly.'];
    http_response_code($userId ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'error' => 'Invalid request method or key']);
    exit;
}
