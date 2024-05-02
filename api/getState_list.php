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
        // $Id = sanitizeInput(date('Y-m-d H:i:s',strtotime($_POST['stateID']));
        $Statedata = getState_byID($Id);
        if ($Statedata) {            
            $response = array(
                'status' => true,
                'message' => 'State  retrieved successfully',
                'data' => $Statedata
            );

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($response);
            exit;
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'error' => 'States not found']);
            exit;
        }
    } else {
        $result =  getState_list();
        $response = array(
            'status' => true,
            'message' => 'All State  retrieved successfully',
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
