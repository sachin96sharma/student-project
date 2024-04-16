<?php
include("../system_config.php");
include_once("../common/head.php");

// Check if the request method is POST and content type is JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    // Decode JSON data from request body
    $jsonData = json_decode(file_get_contents('php://input'), true);

    // Check if required data fields are present
    if (!isset($jsonData['id'], $jsonData['user_id'], $jsonData['user_amount'], $jsonData['transaction_id'], $jsonData['payment_status'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    // Sanitize input data (optional but recommended)
    $id = mysqli_real_escape_string($link, $jsonData['id']);
    $user_id = mysqli_real_escape_string($link, $jsonData['user_id']);
    $user_amount = mysqli_real_escape_string($link, $jsonData['user_amount']);
    $transaction_id = mysqli_real_escape_string($link, $jsonData['transaction_id']);
    $payment_status = mysqli_real_escape_string($link, $jsonData['payment_status']);

    // Prepare the SQL query
    $sql = "INSERT INTO wallet (id, user_id, user_amount, transaction_id, payment_status) 
            VALUES ('$id', '$user_id', '$user_amount', '$transaction_id', '$payment_status')";

    // Execute the SQL query
    $result = mysqli_query($link, $sql);

    // Check for query execution errors
    if (!$result) {
        $errorMessage = mysqli_error($link);
        error_log("Database error: $errorMessage");
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Query failed: ' . $errorMessage]);
        exit;
    }

    // If query executed successfully, return success response
    http_response_code(201);
    echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
} else {
    // Invalid request
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
<pre>sachin</pre>