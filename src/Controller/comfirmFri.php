<?php
header('Content-Type: application/json');

require_once("./dbConnect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? '';

if (empty($id)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input: 'id' is required"]);
    exit();
}

$id = mysqli_real_escape_string($conn, $id);

// Check if a friend request already exists between these users
$checkQuery = "SELECT * FROM friendList 
               WHERE (request = '$userId' AND confirm = '$id') 
               OR (request = '$id' AND confirm = '$userId')";
$checkResult = mysqli_query($conn, $checkQuery);

if (!$checkResult) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to check friend request: " . mysqli_error($conn)]);
    exit();
}

if (mysqli_num_rows($checkResult) > 0) {
    // If a request exists, delete it
    $deleteQuery = "DELETE FROM friendList 
                    WHERE (request = '$userId' AND confirm = '$id') 
                    OR (request = '$id' AND confirm = '$userId')";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if (!$deleteResult) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete friend request: " . mysqli_error($conn)]);
        exit();
    }

    echo json_encode(["success" => true, "message" => "Friend request deleted successfully"]);
} else {
    // If no request exists, insert a new one
    $insertQuery = "INSERT INTO friendList (request, confirm) VALUES ('$id','$userId')";
    $insertResult = mysqli_query($conn, $insertQuery);

    $deleteQuery = "DELETE FROM friendRequests 
                    WHERE (request_id = '$userId' AND forConfirm_id = '$id') 
                    OR (request_id = '$id' AND forConfirm_id = '$userId')";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if (!$insertResult) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to send friend request: " . mysqli_error($conn)]);
        exit();
    }

    echo json_encode(["success" => true, "message" => "Friend request sent successfully"]);
}

mysqli_close($conn);
?>