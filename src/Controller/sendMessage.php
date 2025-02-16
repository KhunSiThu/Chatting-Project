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

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("INSERT INTO messages (send_id, receive_id, message, createdAt) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $sendId, $receiveId, $message);
    $stmt->execute();
    $messageId = $stmt->insert_id;

    // File upload handling
    $uploads = [
        'image_files' => 'uploads/images/',
        'document_files' => 'uploads/documents/',
        'video_files' => 'uploads/videos/'
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

    $stmt = $conn->prepare("UPDATE messages SET images = ?, file = ?, videos = ? WHERE message_id = ?");
    $stmt->bind_param(
        "sssi",
        implode(",", $filesData['image_files']),
        implode(",", $filesData['document_files']),
        implode(",", $filesData['video_files']),
        $messageId
    );
    $stmt->execute();

    $conn->commit();
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(["error" => "Error processing request. Please try again."]);
} finally {
    $stmt->close();
    $conn->close();
}
?>
