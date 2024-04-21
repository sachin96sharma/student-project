<?php
include("../system_config.php");
//   pr($_POST['key']);die;
// Check if the request method is POST and content type is JSON
// function sanitizeInput($data)
// {
//     return htmlspecialchars(strip_tags(trim($data)));
// }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key'] == 'qwertyupasdfghjklzxcvbnm') {
// pr('hell0');die;
    $Id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    if ($Id) {
        $userExist = gettransaction_byID($Id);
        // pr( $userExist);die;
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid  ID']);
            exit;
        }
    }
    $username = sanitizeInput($_POST['username']);
    $amount = sanitizeInput($_POST['amount']);
    $remaining_amount = sanitizeInput($_POST['remaining_amount']);
    $ref_id = sanitizeInput($_POST['ref_id']);
    $type = sanitizeInput($_POST['type']);
    $wallet = sanitizeInput($_POST['wallet']);
    $status = sanitizeInput($_POST['status']);
    $order_id = sanitizeInput($_POST['order_id']);
    // Validate required fields
    $requiredFields = [
        'username',
        'amount',
        'remaining_amount',
        'ref_id',
        'type',
        'wallet',
        'status',
        'order_id',
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
    // Prepare and execute SQL query
    if ($Id) {
        $sql = "UPDATE wallet_history SET username=?, amount=?, remaining_amount=?, ref_id=?, type=?, wallet=?, status=?, order_id=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $username, $amount, $remaining_amount, $ref_id, $type, $wallet, $status, $order_id, $Id);
    } else {
        $sql = "INSERT INTO wallet_history (username,amount, remaining_amount,ref_id, type,wallet, status,order_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        //  pr( $sql);die;
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $username, $amount, $remaining_amount, $ref_id, $type, $wallet, $status, $order_id,);
        
    }


    if (!mysqli_stmt_execute($stmt)) {
        $error_message = mysqli_error($link); // Get the error message
        error_log("SQL Error: $error_message"); // Log the error
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'Registration/update failed. ' . $error_message]);
        exit;
    }
    // Respond with success message
    $response = ['status' => true, 'message' => $Id ? 'Your tansaction has been updated successfully.' : 'Your transaction procedure has been completed.'];
    http_response_code($Id ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
//     // Decode JSON data from request body
//     $jsonData = json_decode(file_get_contents('php://input'), true);

//     // Check if required data fields are present
//     if (!isset($jsonData['id'], $jsonData['username'], $jsonData['amount'], $jsonData['remaining_amount'], $jsonData['ref_id'], $jsonData['type'], $jsonData['wallet'], $jsonData['status'], $jsonData['order_id'])) {
//         http_response_code(400);
//         echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
//         exit;
//     }

//     // Sanitize input data (optional but recommended)
//     $id = mysqli_real_escape_string($link, $jsonData['id']);
//     $username = mysqli_real_escape_string($link, $jsonData['username']);
//     $amount = mysqli_real_escape_string($link, $jsonData['amount']);
//     $remaining_amount = mysqli_real_escape_string($link, $jsonData['remaining_amount']);
//     $ref_id = mysqli_real_escape_string($link, $jsonData['ref_id']);
//     $type = mysqli_real_escape_string($link, $jsonData['type']);
//     $wallet = mysqli_real_escape_string($link, $jsonData['wallet']);
//     $status = mysqli_real_escape_string($link, $jsonData['status']);
//     $order_id = mysqli_real_escape_string($link, $jsonData['order_id']);

//     // Prepare the SQL query
//     $sql = "INSERT INTO wallet_history (id, username, amount, remaining_amount, ref_id, type, wallet, status, order_id) 
//     VALUES ('$id', '$username', '$amount', '$remaining_amount', '$ref_id', $type, '$wallet', '$status', '$order_id')";

//     // Execute the SQL query
//     $result = mysqli_query($link, $sql);

//     // Check for query execution errors
//     if (!$result) {
//         $errorMessage = mysqli_error($link);
//         error_log("Database error: $errorMessage");
//         http_response_code(500);
//         echo json_encode(['status' => 'error', 'message' => 'Query failed: ' . $errorMessage]);
//         exit;
//     }

//     // If query executed successfully, return success response
//     http_response_code(201);
//     echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
// } else {
//     // Invalid request
//     http_response_code(400);
//     echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
// }
?>