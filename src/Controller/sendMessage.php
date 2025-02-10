<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
session_start();

// Allowed Microsoft file extensions
$allowedExtensions = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx','txt','pdf'];

// Check if the user is logged in and has a chosen recipient
if (!isset($_SESSION['user_id']) || !isset($_SESSION['chooseId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$sendId = $_SESSION['user_id'];
$receiveId = $_SESSION['chooseId'];

try {
    // Begin Transaction
    $conn->begin_transaction();

    // Insert the message
    $query = "INSERT INTO messages (send_id, receive_id, message, createdAt) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Failed to prepare SQL statement.");
    }

    // Bind parameters
    $stmt->bind_param("iis", $sendId, $receiveId, $message);
    $message = $_POST['message'] ?? '';

    // Execute the message query
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute SQL statement.");
    }

    $messageId = $stmt->insert_id;
    $imageFiles = $_FILES['image_files'] ?? [];
    $documentFiles = $_FILES['document_files'] ?? [];

    $images = [];
    $documents = [];

    // Handle image files
    if ($imageFiles) {
        foreach ($imageFiles['tmp_name'] as $index => $tmpName) {
            $fileName = "image_" . $messageId . "_" . $index . ".jpg";
            $destination = "uploads/images/" . $fileName;
            if (move_uploaded_file($tmpName, $destination)) {
                $images[] = $fileName;
            } else {
                throw new Exception("Failed to upload image.");
            }
        }
    }

    // Handle document files (Allow only Microsoft Office files)
    if ($documentFiles) {
        foreach ($documentFiles['tmp_name'] as $index => $tmpName) {
            $fileExt = strtolower(pathinfo($documentFiles['name'][$index], PATHINFO_EXTENSION));

            // Validate file type
            if (!in_array($fileExt, $allowedExtensions)) {
                throw new Exception("Invalid file type: Only Microsoft Office files allowed.");
            }

            // Save file
            $fileName = "document_" . $messageId . "_" . $index . "." . $fileExt;
            $destination = "uploads/documents/" . $fileName;
            if (move_uploaded_file($tmpName, $destination)) {
                $documents[] = $fileName;
            } else {
                throw new Exception("Failed to upload document.");
            }
        }
    }

    // Save file paths in the database
    $imageFilesString = implode(",", $images);
    $documentFilesString = implode(",", $documents);

    $query = "UPDATE messages SET images = ?, file = ? WHERE message_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $imageFilesString, $documentFilesString, $messageId);
    if (!$stmt->execute()) {
        throw new Exception("Failed to update message with files.");
    }

    // Commit the transaction if all operations succeed
    $conn->commit();

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Rollback if an error occurs
    $conn->rollback();
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>
