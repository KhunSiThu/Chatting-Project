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

// Handle text message
$sendMessage = $_POST['message'] ?? '';

// Handle image uploads
$uploadedFiles = [];
if (!empty($_FILES['files'])) {
    // Check if more than 5 files are uploaded
    if (count($_FILES['files']['tmp_name']) > 5) {
        http_response_code(400);
        echo json_encode(["error" => "You can upload a maximum of 5 images."]);
        exit();
    }

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['files']['name'][$key]);
        $targetPath = $targetDir . uniqid() . "_" . $fileName;

        // Validate file type (allow only images)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($tmpName);
        if (!in_array($fileType, $allowedTypes)) {
            http_response_code(400);
            echo json_encode(["error" => "Only image files are allowed."]);
            exit();
        }

        // Move the file to the target directory
        if (move_uploaded_file($tmpName, $targetPath)) {
            $uploadedFiles[] = $targetPath;
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to upload file."]);
            exit();
        }
    }
}

// Ensure at least one of message or images is provided
if (empty($sendMessage) && empty($uploadedFiles)) {
    http_response_code(400);
    echo json_encode(["error" => "Please provide a message or an image."]);
    exit();
}

// Insert message and file paths into the database
$query = "INSERT INTO messages (send_id, receive_id, message, images, createdAt) VALUES (?, ?, ?, ?, NOW())";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    $images = !empty($uploadedFiles) ? implode(",", $uploadedFiles) : null;
    mysqli_stmt_bind_param($stmt, "iiss", $sendId, $receiveId, $sendMessage, $images);

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