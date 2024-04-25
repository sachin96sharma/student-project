<?php
include("../system_config.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'], $_POST['user_email'], $_POST['user_pass'])) {

    // Verify the authorization key
    $key = $_POST['key'];
    // pr($_POST);die;
    // echo $key; die;
    if ($key != 'qwertyupasdfghjklzxcvbnm') {
        // echo 'jkj';die;
        http_response_code(401); // Unauthorized
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'error' => 'Unauthorized']);
        exit;
    }

    $email = sanitizeInput($_POST['user_email']);
    $password = sanitizeInput($_POST['user_pass']);
    $sql = "SELECT * FROM " . tbl_customer . " WHERE user_email = ?";
    $response = handleLogin($sql, $email, $password);

    http_response_code($response['status'] ? 200 : 401);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    http_response_code(400); // Bad Request
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'error' => 'Invalid request']);
    exit;
}

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function handleLogin($sql, $email, $password)
{
    global $link;

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // pr($sql);
    // die;
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // pr($password);
        // pr($row);die;
        // Verify password
        // echo encryptIt($password);die;
        if (encryptIt($password) == $row['user_pass']) {
            return handleCustomerLogin($row);
        }
    }

    return ['status' => false, 'error' => 'Authorization failed'];
}

// Function to handle customer login
function handleCustomerLogin($row)
{
    global $config ;
    if ($row['user_status'] == 0) {
        return [
            'status' => true,
            'user_id' => $row['user_id'],
            'name' => $row['first_name'],
            'type' => $config['user_type'][$row['user_type']]
        ];
    } else {
        return ['status' => false, 'error' => 'Account under review'];
    }
}
