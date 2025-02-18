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

$userId = $_SESSION['user_id'] ?? null;
$capation = $_POST['capation'] ?? '';

if (!$userId) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized access."]);
    exit;
}

try {
    mysqli_begin_transaction($conn);

    // Insert post into the database
    $sql = "INSERT INTO posts (user_id, capation, createdAt) VALUES ('$userId', '$capation', NOW())";
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("Failed to insert post: " . mysqli_error($conn));
    }
    $postId = mysqli_insert_id($conn);

    // File upload handling
    $uploads = [
        'image_files' => '../posts/images/',
        'document_files' => '../posts/documents/',
        'video_files' => '../posts/videos/'
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

                $newFileName = "{$inputName}_{$postId}_{$index}.{$fileExt}";
                $destination = $uploadPath . $newFileName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $filesData[$inputName][] = $newFileName;
                }
            }
        }
    }

    // Update post with file paths
    $images = implode(",", $filesData['image_files']);
    $documents = implode(",", $filesData['document_files']);
    $videos = implode(",", $filesData['video_files']);

    $sqlUpdate = "UPDATE posts SET images = '$images', file = '$documents', videos = '$videos' WHERE post_id = '$postId'";
    if (!mysqli_query($conn, $sqlUpdate)) {
        throw new Exception("Failed to update post: " . mysqli_error($conn));
    }

    mysqli_commit($conn);
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    mysqli_rollback($conn);
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    mysqli_close($conn);
}
?>
