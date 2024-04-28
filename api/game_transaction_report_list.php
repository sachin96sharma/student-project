<?php
include("../system_config.php");

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// pr($_POST);die;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    if (isset($_POST['id'])) {
        $Id = sanitizeInput($_POST['id']);
        $Transactiondata = getwallet_history_byID($Id);
        if ($Transactiondata) {            
            $response = array(
                'status' => true,
                'message' => 'user transaction data  retrieved successfully',
                'data' => $Transactiondata
            );

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($response);
            exit;
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'error' => 'Transaction Id  not found']);
            exit;
        }
    } else {
        $result = getwallet_history_list();
        $response = array(
            'status' => true,
            'message' => ' All user transaction data  retrieved successfully',
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
