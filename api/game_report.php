<?php
include("../system_config.php");
include_once("../common/head.php");


// Check if the request method is POST and content type is JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    // Decode JSON data from request body
    $jsonData = json_decode(file_get_contents('php://input'), true);

    // Check if required data fields are present
    if (!isset($jsonData['game_id'], $jsonData['user_id'], $jsonData['bet_amount'], $jsonData['game_biding'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    // Sanitize input data
    $game_id = mysqli_real_escape_string($link, $jsonData['game_id']);
    $user_id = mysqli_real_escape_string($link, $jsonData['user_id']);
    $bet_amount = mysqli_real_escape_string($link, $jsonData['bet_amount']);
    $game_biding = mysqli_real_escape_string($link, $jsonData['game_biding']);

    // Prepare the SQL query
    $sql = "INSERT INTO game_report (game_id, user_id, bet_amount, game_biding) VALUES ('$game_id', '$user_id', '$bet_amount', '$game_biding')";

    // Execute the SQL query
    $result = mysqli_query($link, $sql);

    // If query executed successfully, return success response
    if ($result) {
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
    } else {
        // If query failed, return error response and log the error
        $errorMessage = mysqli_error($link);
        error_log("Database error: $errorMessage");
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Query failed']);
    }
} else {
    // Invalid request
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
