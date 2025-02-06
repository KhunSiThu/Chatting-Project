<?php
header('Content-Type: application/json');

require_once("./dbConnect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id']; // Fetch the user ID from session

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);
$groupId = $_SESSION['chooseId'];  // Retrieve group ID from session or request if necessary
$sendMessage = $data['message'] ?? '';

// Validate message input
if (empty($sendMessage)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input: 'message' is required"]);
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "INSERT INTO groupMessage (groupId, sendId, message) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "iis", $groupId, $userId, $sendMessage);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Message sent successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to send message: " . mysqli_stmt_error($stmt)]);
    }
    
    mysqli_stmt_close($stmt);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
