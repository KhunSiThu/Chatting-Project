<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
session_start();

// Check if the user is logged in and has a chosen recipient
if (!isset($_SESSION['user_id']) || !isset($_SESSION['chooseId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$sendId = $_SESSION['user_id'];
$receiveId = $_SESSION['chooseId'];

try {
    // Prepare SQL query to fetch messages between two users
    $query = "SELECT messages.*, user.*, messages.createdAt 
              FROM messages 
              LEFT JOIN user ON user.userId = messages.send_id 
              WHERE (receive_id = ? AND send_id = ?) OR (receive_id = ? AND send_id = ?) 
              ORDER BY messages.message_id ASC";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Failed to prepare the SQL statement.");
    }

    // Bind parameters
    $stmt->bind_param("iiii", $sendId, $receiveId, $receiveId, $sendId);

    // Execute the query
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute the SQL statement.");
    }

    // Fetch the result
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Failed to fetch the result.");
    }

    // Fetch all messages
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        // Split images into an array if they exist
        $row['images'] = !empty($row['images']) ? explode(",", $row['images']) : [];

        // Split file attachments into an array if they exist
        $row['files'] = !empty($row['file']) ? explode(",", $row['file']) : [];

        $messages[] = $row;
    }

    // Return the messages as JSON
    echo json_encode(["success" => true, "messages" => $messages]);
} catch (Exception $e) {
    // Handle errors
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    // Close the statement and connection
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>
