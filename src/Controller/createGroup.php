<?php

require_once("./dbConnect.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userId = $_SESSION['user_id'];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
    exit();
}

// File upload check
if (!isset($_FILES['groupProfileImage']) || $_FILES['groupProfileImage']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid file upload"]);
    exit();
}

// Validate input
$groupName = $_POST['groupName'] ?? '';
if (empty($groupName)) {
    http_response_code(400);
    echo json_encode(["error" => "Group name is required"]);
    exit();
}

// Upload directory
$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// File processing
$file = $_FILES['groupProfileImage'];
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff', 'ico', 'avif'];

if (!in_array($fileExtension, $allowedExtensions)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid file type"]);
    exit();
}

$newFileName = uniqid('group_', true) . "." . $fileExtension;
$uploadPath = $uploadDir . $newFileName;

if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to upload file"]);
    exit();
}

// Insert into database
$sql = "INSERT INTO `group` (groupName, adminId, groupProfile) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $groupName, $userId, $newFileName);

if ($stmt->execute()) {
    $groupId = $conn->insert_id; // Get the last inserted group ID
    $_SESSION['groupId'] = $groupId;

    // Insert into database
    $sql1 = "INSERT INTO `groupMember` (groupId, memberId) VALUES (? , ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ii", $groupId, $userId);

    if ($stmt1->execute()) { 
        echo json_encode(["success" => true, "message" => "Group created successfully", "groupId" => $groupId]);
    }

    
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
