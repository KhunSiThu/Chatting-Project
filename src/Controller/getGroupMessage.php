<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['chooseId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$userId = $_SESSION['user_id'];
$groupId = $_SESSION['chooseId'];

// Prepare SQL query to get messages from the groupMessage table
$query = "SELECT groupMessage.*, user.*, groupMessage.createdAt
          FROM groupMessage
          LEFT JOIN user ON user.userId = groupMessage.sendId
          WHERE groupMessage.groupId = ?
          ORDER BY groupMessage.messageId ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $groupId); // Bind the groupId to the prepared statement
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages); // Return the messages as a JSON response
$stmt->close();
$conn->close();
?>
