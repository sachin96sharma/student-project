<?php
include("../system_config.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'], $_POST['user_email'], $_POST['user_pass'], $_POST['user_type'])) {

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
    $password =  encryptIt($password);
    $user_type = sanitizeInput($_POST['user_type']);

    if ($user_type == 1) {
        $sql = "SELECT * FROM " . tbl_customer . " WHERE user_email = ?";
    } else {
        http_response_code(400); // Bad Request
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'error' => 'Invalid user type']);
        exit;
    }

    $response = handleLogin($sql, $email, $password, $user_type);

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

function handleLogin($sql, $email, $password, $user_type)
{
    global $link;

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

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
    if ($row['user_pass'] == 0) {
        return [
            'status' => true,
            'user_id' => $row['user_id'],
            'name' => $row['first_name'],
            'type' => $row['user_type'],
        ];
    } else {
        return ['status' => false, 'error' => 'Account under review'];
    }
}
?>
