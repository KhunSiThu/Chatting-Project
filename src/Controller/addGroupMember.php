<?php

require_once("./dbConnect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
    exit();
}


$groupId = $_SESSION['groupId'];

// Fetch groupId from the database
$groupQuery = "SELECT groupId FROM `group` WHERE groupId = ?";
$stmt = $conn->prepare($groupQuery);
$stmt->bind_param("i", $groupId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Group not found"]);
    exit();
}

$groupRow = $result->fetch_assoc();
$groupId = $groupRow['groupId'];

$stmt->close();

// Receive JSON Data
$data = json_decode(file_get_contents("php://input"), true);
$memberId = $data['addId'] ?? null;

if (!$memberId || !$groupId) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid Data"]);
    exit();
}

// Check if member is already in the group
$checkSql = "SELECT * FROM groupMember WHERE groupId = ? AND memberId = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ii", $groupId, $memberId);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["error" => "Member is already in the group"]);
    exit();
}

// Insert into groupMember table
$insertSql = "INSERT INTO groupMember (groupId, memberId) VALUES (?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("ii", $groupId, $memberId);

if ($insertStmt->execute()) {
    echo json_encode(["success" => true, "message" => "Member added successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $insertStmt->error]);
}

$insertStmt->close();
$conn->close();

?>
