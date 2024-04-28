<?php
include("../system_config.php");

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// pr($_POST);die;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    if (isset($_POST['user_id'])) {
        $Id = sanitizeInput($_POST['user_id']);
        $userData = getUserWallet_Id($Id);
        if ($userData) {            
            $response = array(
                'status' => true,
                'message' => 'User   retrieved successfully',
                'data' => $userData
            );

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($response);
            exit;
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'error' => 'Game not found']);
            exit;
        }
    } else {
        $result =  getUserWallet_list();
        $response = array(
            'status' => true,
            'message' => 'All Users   retrieved successfully',
            'data' => $result,
        );
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }
} else {
    // Invalid request method or key
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'error' => 'Invalid request method or key']);
    exit;
}
