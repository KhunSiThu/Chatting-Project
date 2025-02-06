<?php
require_once("./dbConnect.php");

session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

// Ensure groupId is available and valid
$groupId = $_SESSION['groupId'] ?? null;

if (is_null($groupId) || !is_numeric($groupId)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid or missing group ID"]);
    exit();
}

// Query to get all user data and the group membership (LEFT JOIN)
$sql = "SELECT * FROM groupMember WHERE groupId = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    // Database connection or statement preparation failed
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare statement"]);
    exit();
}

$stmt->bind_param("i", $groupId);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $members = [];

    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }

    // Return the members as part of the response
    echo json_encode(["success" => true, "members" => $members]);
} else {
    // Execution failed, report the error
    http_response_code(500);
    echo json_encode(["error" => "Database query execution failed"]);
}

$stmt->close();
$conn->close();
?>
