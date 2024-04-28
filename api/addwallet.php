<?php
include("../system_config.php");
include_once("../common/head.php");
// pr($_POST['key']);die;

// Check if the request method is POST and content type is JSON
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key'] == 'qwertyupasdfghjklzxcvbnm') {

// pr('hello');die;
    $Id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    if ($Id) {
        $userExist = getwallet_byID($Id);
        // pr( $userExist);die;
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid  ID']);
            exit;
        }
    }
    $user_id = sanitizeInput($_POST['user_id']);
    $user_amount = sanitizeInput($_POST['user_amount']);
    // $transaction_id = sanitizeInput($_POST['transaction_id']);
    // $payment_status = sanitizeInput($_POST['payment_status']);
    // Validate required fields
    $requiredFields = [
        'user_id',
        'user_amount',
             
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
        $sql = "UPDATE wallet SET user_id=?, user_amount=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'isi', $user_id, $user_amount,$Id);
    } else {
        $sql = "INSERT INTO wallet (user_id,user_amount) VALUES (?, ?)";
        //  pr( $sql);die;
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'is', $user_id, $user_amount);

        
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
    $response = ['status' => true, 'message' => $Id ? 'Your Wallet  has been updated successfully.' : 'Your Wallet procedure has been completed. '];
    http_response_code($Id ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}else {
        // Invalid request
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }




// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm'  && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
//     // Decode JSON data from request body
//     $jsonData = json_decode(file_get_contents('php://input'), true);

//     // Check if required data fields are present
//     if (!isset($jsonData['id'], $jsonData['user_id'], $jsonData['user_amount'], $jsonData['transaction_id'], $jsonData['payment_status'])) {
//         http_response_code(400);
//         echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
//         exit;
//     }

//     // Sanitize input data (optional but recommended)
//     $id = mysqli_real_escape_string($link, $jsonData['id']);
//     $user_id = mysqli_real_escape_string($link, $jsonData['user_id']);
//     $user_amount = mysqli_real_escape_string($link, $jsonData['user_amount']);
//     $transaction_id = mysqli_real_escape_string($link, $jsonData['transaction_id']);
//     $payment_status = mysqli_real_escape_string($link, $jsonData['payment_status']);

//     // Prepare the SQL query
//     $sql = "INSERT INTO wallet (id, user_id, user_amount, transaction_id, payment_status) 
//             VALUES ('$id', '$user_id', '$user_amount', '$transaction_id', '$payment_status')";

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
