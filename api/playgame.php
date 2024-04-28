<?php
include("../system_config.php");

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
// Function to handle file upload
// pr($_FILES);die;
function handleFileUpload($fileKey, $columnName, $gameId)
{
    global $link, $config;

    if (!empty($_FILES[$fileKey]["name"]) && $_FILES[$fileKey]["error"] == 0) {
        $getGamebyid = getgame_byID($gameId);
        $gamename = strtolower(str_replace(' ', '', $getGamebyid['cat_name']));
        $game = empty($getGamebyid['name']) ? 'NoCategory' : $getGamebyid['name'];
        $imageName = $gamename . '_' . $game;


        $file_name = $_FILES[$fileKey]["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $user_img_name = $imageName . '_' . time() . '_' . $fileKey . "." . $file_ext;
        $path = '../' . $config['image'] . $user_img_name;

        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $path)) {
            unlink('../' . $config['image'] . $getGamebyid[$columnName]);
            $update_sql = "UPDATE games SET $columnName = ? WHERE game_id = ?";
            $update_stmt = mysqli_prepare($link, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'si', $user_img_name, $gameId);
            mysqli_stmt_execute($update_stmt);
        }
    }
}

// Check if the request method is POST and the key matches
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    // Validate and sanitize user ID
    $gameId = isset($_POST['game_id']) ? (int)$_POST['game_id'] : null;
    if ($gameId) {
        $userExist = getgame_byID($gameId);
        // pr( $userExist);die;
        if (!$userExist) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Invalid Game ID']);
            exit;
        }
    }

    // Validate and sanitize input fields
    $category_id = sanitizeInput($_POST['category_id']);
    $name = sanitizeInput($_POST['name']);
    $gamebiding = date('Y-m-d H:i:s', strtotime($_POST['gamebiding']));
    $gamebiding = sanitizeInput($gamebiding);
    $gamestart = date('Y-m-d H:i:s', strtotime($_POST['gamestart']));
    $gamestart = sanitizeInput($gamestart);
    $gameend = date('Y-m-d H:i:s', strtotime($_POST['gameend']));
    $gameend = sanitizeInput($gameend);
    $countdown = sanitizeInput($_POST['countdown']);
    $result = sanitizeInput($_POST['result']);
    $status = sanitizeInput($_POST['status']);

    // Validate required fields
    $requiredFields = [
        'name',
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
    if ($gameId) {
        $sql = "UPDATE games SET category_id=?, name=?, gamebiding=?, gamestart=?, gameend=?, countdown=?, result=?, status=? WHERE game_id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'isssssisi', $category_id, $name, $gamebiding, $gamestart, $gameend, $countdown, $result, $status, $gameId);
    } else {
        $sql = "INSERT INTO games (category_id,name, gamebiding,gamestart, gameend,countdown, result,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'isssssis', $category_id, $name, $gamebiding, $gamestart, $gameend, $countdown, $result, $status);
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
        $last_inserted_id = $gameId ? $gameId : mysqli_insert_id($link);
        // pr($last_inserted_id);die;
        handleFileUpload("image", "image", $last_inserted_id);
    }

    // Respond with success message
    $response = ['status' => true, 'message' => $gameId ? 'Your game has been updated successfully.' : 'Your game procedure has been completed.'];
    http_response_code($gameId ? 200 : 201);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
