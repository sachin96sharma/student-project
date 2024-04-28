<?php
include("../system_config.php");

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// pr($_POST);die;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key']) && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm') {

    if (isset($_POST['game_id'])) {
        $Id = sanitizeInput($_POST['game_id']);
        $gameDetails = getGameby_Id($Id);
        if ($gameDetails) {
            $gameImage = ($gameDetails['image']) ? SITEPATH . $config['image'] . $gameDetails['image'] : SITEPATH . NOIMAGE;
            $gameDetails['image'] = $gameImage;

            $response = [
                'status' => true,
                'message' => 'Game  retrieved successfully',
                'data' => $gameDetails,
            ];


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
        $result =  getallGame_list();
        $totalData = [];

        foreach ($result as $value) {
            $gameImage = ($value['image']) ? SITEPATH . $config['image'] . $value['image'] : SITEPATH . NOIMAGE;
            $value['image'] = $gameImage;
            $totalData[] = $value;
        }

        $response = [
            'status' => true,
            'message' => 'Game list retrieved successfully',
            'data' => $totalData,
        ];


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
