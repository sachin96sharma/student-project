<?php
include("../system_config.php");


function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key'] == 'qwertyupasdfghjklzxcvbnm') {
    // pr('hello');die;
        $Id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        if ($Id) {
            $userExist = getNotificationbyId($Id);
            // pr( $userExist);die;
            if (!$userExist) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['status' => false, 'message' => 'Invalid  ID']);
                exit;
            }
        }
        $type = sanitizeInput($_POST['type']);
        $description = sanitizeInput($_POST['description']);
        $status = sanitizeInput($_POST['status']);
        // Validate required fields
        $requiredFields = [
            'type',
            'description',
            'status',           
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
        $userExist = getNotificationtypeOrId($type);
        //  pr($userExist);die;
        if ($userExist && !$Id) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'You are already add notification name . ']);
        exit;
    }
        // Prepare and execute SQL query
        if ($Id) {
            $sql = "UPDATE notifications SET type=?, description=?, status=?  WHERE id=?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'issi', $type, $description, $status, $Id);
        } else {
            $sql = "INSERT INTO notifications (type,description, status) VALUES (?, ?, ?)";
            //  pr( $sql);die;
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'iss', $type, $description, $status );
            
        }
    
    
        if (!mysqli_stmt_execute($stmt)) {
            $error_message = mysqli_error($link); // Get the error message
            error_log("SQL Error: $error_message"); // Log the error
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Registration/update failed. ' . $error_message]);
            exit;
        }
        // Respond with success message
        $response = ['status' => true, 'message' => $Id ? 'Your Notification been updated successfully.' : 'Your Notification procedure has been completed.'];
        http_response_code($Id ? 200 : 201);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // Invalid request
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }