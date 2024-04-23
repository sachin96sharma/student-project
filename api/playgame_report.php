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
            $userExist = getReportbyId($Id);
            // pr( $userExist);die;
            if (!$userExist) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['status' => false, 'message' => 'Invalid  ID']);
                exit;
            }
        }
        $game_id = sanitizeInput($_POST['game_id']);
        $choose_number = sanitizeInput($_POST['choose_number']);
        $user_id = sanitizeInput($_POST['user_id']);
        $bet_amount = sanitizeInput($_POST['bet_amount']);
        // Validate required fields
        $requiredFields = [
            'game_id',
            'choose_number',
            'user_id',
            'bet_amount',           
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
        if ($Id) {
            $sql = "UPDATE game_report SET game_id=?,choose_number=?, user_id=?, bet_amount=?  WHERE id=?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'iiisi', $game_id,$choose_number, $user_id, $bet_amount, $Id);
        } else {
            $sql = "INSERT INTO game_report (game_id,choose_number,user_id, bet_amount) VALUES (?, ?, ?, ?)";
            //  pr( $sql);die;
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'iiis', $game_id,$choose_number,$user_id, $bet_amount );
            
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
        $response = ['status' => true, 'message' => $Id ? 'Your Game Report been updated successfully.' : 'Your Game Report procedure has been completed.'];
        http_response_code($Id ? 200 : 201);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // Invalid request
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }



    // Check if the request method is POST and content type is JSON
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['key'] === 'qwertyupasdfghjklzxcvbnm' && !empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
//     // Decode JSON data from request body
//     $jsonData = json_decode(file_get_contents('php://input'), true);

//     // Check if required data fields are present
//     if (!isset($jsonData['game_id'], $jsonData['user_id'], $jsonData['bet_amount'])) {
//         http_response_code(400);
//         echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
//         exit;
//     }

//     // Sanitize input data
//     $game_id = mysqli_real_escape_string($link, $jsonData['game_id']);
//     $user_id = mysqli_real_escape_string($link, $jsonData['user_id']);
//     $bet_amount = mysqli_real_escape_string($link, $jsonData['bet_amount']);
//     // $game_biding = mysqli_real_escape_string($link, $jsonData['game_biding']);

//     // Prepare the SQL query
//     $sql = "INSERT INTO game_report (game_id, user_id, bet_amount) VALUES ('$game_id', '$user_id', '$bet_amount')";

//     // Execute the SQL query
//     $result = mysqli_query($link, $sql);

//     // If query executed successfully, return success response
//     if ($result) {
//         http_response_code(201);
//         echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
//     } else {
//         // If query failed, return error response and log the error
//         $errorMessage = mysqli_error($link);
//         error_log("Database error: $errorMessage");
//         http_response_code(500);
//         echo json_encode(['status' => 'error', 'message' => 'Query failed']);
//     }
// } else {
//     // Invalid request
//     http_response_code(400);
//     echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
// }
?> 
