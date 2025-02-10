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

$sendMessage = $_POST['message'] ?? '';

try {
    $conn->begin_transaction();

    $query = "INSERT INTO groupMessage (groupId, sendId, message, createdAt) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $groupId, $userId, $sendMessage);

    if (!$stmt->execute()) {
        throw new Exception("Failed to send message.");
    }

    $messageId = $stmt->insert_id;
    $imageFiles = $_FILES['image_files'] ?? [];
    $documentFiles = $_FILES['document_files'] ?? [];

    $images = [];
    $documents = [];
    $allowedExtensions = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'pdf'];

    // Handle image uploads
    if ($imageFiles) {
        foreach ($imageFiles['tmp_name'] as $index => $tmpName) {
            $fileType = mime_content_type($tmpName);
            if (strpos($fileType, 'image/') !== 0) {
                throw new Exception("Invalid image file type.");
            }

            $fileName = "image_" . $messageId . "_" . $index . ".jpg";
            $destination = "uploads/images/" . $fileName;
            if (!move_uploaded_file($tmpName, $destination)) {
                throw new Exception("Failed to upload image.");
            }
            $images[] = $fileName;
        }
    }

    // Handle document uploads
    if ($documentFiles) {
        foreach ($documentFiles['tmp_name'] as $index => $tmpName) {
            $fileExt = strtolower(pathinfo($documentFiles['name'][$index], PATHINFO_EXTENSION));

            if (!in_array($fileExt, $allowedExtensions)) {
                throw new Exception("Invalid file type.");
            }

            $fileName = "document_" . $messageId . "_" . $index . "." . $fileExt;
            $destination = "uploads/documents/" . $fileName;
            if (!move_uploaded_file($tmpName, $destination)) {
                throw new Exception("Failed to upload document.");
            }
            $documents[] = $fileName;
        }
    }

    $imageFilesString = implode(",", $images);
    $documentFilesString = implode(",", $documents);

    $query = "UPDATE groupMessage SET images = ?, file = ? WHERE messageId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $imageFilesString, $documentFilesString, $messageId);

    if (!$stmt->execute()) {
        throw new Exception("Failed to update message files.");
    }

    $conn->commit();
    echo json_encode(["success" => true, "message" => "Message sent successfully"]);

} catch (Exception $e) {
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
