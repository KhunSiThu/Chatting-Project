<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['chooseId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$sendId = $_SESSION['user_id'];
$receiveId = $_SESSION['chooseId'];

// Prepare SQL query
$query = "SELECT messages.*, user.*, messages.createdAt 
          FROM messages 
          LEFT JOIN user ON user.userId = messages.send_id 
          WHERE (receive_id = ? AND send_id = ?) OR (receive_id = ? AND send_id = ?) 
          ORDER BY messages.message_id ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $sendId, $receiveId, $receiveId, $sendId);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
$stmt->close();
$conn->close();
