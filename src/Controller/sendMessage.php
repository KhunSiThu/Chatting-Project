<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
session_start();

$allowedExtensions = [
    // Document extensions
    'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'pdf',

    // Image extensions
    'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp', 'svg',

    // Video extensions
    'mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'webm', 'ogv', '3gp', 'mpeg'
];

if (!isset($_SESSION['user_id']) || !isset($_SESSION['chooseId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

$sendId = $_SESSION['user_id'];
$receiveId = $_SESSION['chooseId'];
$message = $_POST['message'] ?? '';

// Sanitize inputs
$sendId = mysqli_real_escape_string($conn, $sendId);
$receiveId = mysqli_real_escape_string($conn, $receiveId);
$message = mysqli_real_escape_string($conn, $message);

try {
    mysqli_begin_transaction($conn);

    // Insert message into the database
    $sql = "INSERT INTO messages (send_id, receive_id, message, createdAt) VALUES ('$sendId', '$receiveId', '$message', NOW())";
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("Failed to insert message: " . mysqli_error($conn));
    }
    
    $messageId = mysqli_insert_id($conn);

    // File upload handling
    $uploads = [
        'image_files' => '../uploads/images/',
        'document_files' => '../uploads/documents/',
        'video_files' => '../uploads/videos/'
    ];

    $filesData = ['image_files' => [], 'document_files' => [], 'video_files' => []];

    foreach ($uploads as $inputName => $uploadPath) {
        if (!empty($_FILES[$inputName]['name'][0])) {
            foreach ($_FILES[$inputName]['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES[$inputName]['name'][$index];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($fileExt, $allowedExtensions)) {
                    continue;
                }

                $newFileName = "{$inputName}_{$messageId}_{$index}.{$fileExt}";
                $destination = $uploadPath . $newFileName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $filesData[$inputName][] = $newFileName;
                }
            }
        }
    }

    // Update message with file paths
    $images = implode(",", $filesData['image_files']);
    $documents = implode(",", $filesData['document_files']);
    $videos = implode(",", $filesData['video_files']);

    $sql = "UPDATE messages SET images = '$images', file = '$documents', videos = '$videos' WHERE message_id = '$messageId'";
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("Failed to update message: " . mysqli_error($conn));
    }

    mysqli_commit($conn);
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    mysqli_rollback($conn);
    http_response_code(500);
    echo json_encode(["error" => "Error processing request. Please try again."]);
} finally {
    mysqli_close($conn);
}
?>