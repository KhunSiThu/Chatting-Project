<?php
header('Content-Type: application/json');

require_once("./dbConnect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$sendId = $_SESSION['user_id'];
$receiveId = $_SESSION['chooseId'];

$data = json_decode(file_get_contents('php://input'), true);
$sendMessage = $data['message'] ?? '';

if (empty($sendMessage)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input: 'message' is required"]);
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "INSERT INTO messages (send_id, receive_id, message, createdAt) VALUES (?, ?, ?, NOW())";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "iis", $sendId, $receiveId, $sendMessage);
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to send message"]);
    }
    mysqli_stmt_close($stmt);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database error"]);
}

mysqli_close($conn);
?>