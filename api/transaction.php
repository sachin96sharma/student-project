<?php
include("../system_config.php");
include_once("../common/head.php");

// Check if the request method is POST and content type is JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    // Decode JSON data from request body
    $jsonData = json_decode(file_get_contents('php://input'), true);

    // Check if required data fields are present
    if (!isset($jsonData['id'], $jsonData['username'], $jsonData['amount'], $jsonData['remaining_amount'], $jsonData['ref_id'], $jsonData['wallet'], $jsonData['status'], $jsonData['order_id'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    // Sanitize input data (optional but recommended)
    $id = mysqli_real_escape_string($link, $jsonData['id']);
    $username = mysqli_real_escape_string($link, $jsonData['username']);
    $amount = mysqli_real_escape_string($link, $jsonData['amount']);
    $remaining_amount = mysqli_real_escape_string($link, $jsonData['remaining_amount']);
    $ref_id = mysqli_real_escape_string($link, $jsonData['ref_id']);
    $wallet = mysqli_real_escape_string($link, $jsonData['wallet']);
    $status = mysqli_real_escape_string($link, $jsonData['status']);
    $order_id = mysqli_real_escape_string($link, $jsonData['order_id']);

    // Prepare the SQL query
    $sql = "INSERT INTO wallet_history (id, username, amount, remaining_amount, ref_id, wallet, status, order_id) 
    VALUES ('$id', '$username', '$amount', '$remaining_amount', '$ref_id', '$wallet', '$status', '$order_id')";

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
