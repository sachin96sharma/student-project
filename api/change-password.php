<?php
include("../system_config.php");

// Check if the request method is POST
// pr($_POST);exit;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] == 'qwertyupasdfghjklzxcvbnm' && isset($_POST['old_pass'], $_POST['new_pass'], $_POST['user_id'])) {

    $old_pass = sanitizeInput(encryptIt($_POST['old_pass']));
    $new_pass = sanitizeInput($_POST['new_pass']);
    $userId = sanitizeInput($_POST['user_id']);
    $sql = "SELECT * FROM " . tbl_customer . " WHERE user_id = ?";
    $response = handleCheckPass($sql, $userId, $old_pass, $new_pass);

    http_response_code($response['status'] ? 200 : 401);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'error' => 'Invalid request']);
    exit;
}

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function handleCheckPass($sql, $userId, $old_pass, $new_pass)
{
    global $link;

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['user_pass'] == $old_pass) {
            return handleChangePassword($row, $userId, $new_pass);
        }
    }

    return ['status' => false, 'error' => 'Authorization failed'];
}


// Function to handle password change
function handleChangePassword($row, $userId, $new_pass)
{
    global $link;
    $new_pass_hashed = encryptIt($new_pass);
    $update_sql = "UPDATE " . tbl_customer . " SET user_pass = ? WHERE user_id = ?";
    $update_stmt = mysqli_prepare($link, $update_sql);
    mysqli_stmt_bind_param($update_stmt, 'si', $new_pass_hashed, $userId);
    mysqli_stmt_execute($update_stmt);

    // Check if the update was successful
    if (mysqli_affected_rows($link) > 0) {
        return ['status' => true, 'message' => 'Password changed successfully'];
    } else {
        return ['status' => false, 'error' => 'Failed to change password'];
    }
}
