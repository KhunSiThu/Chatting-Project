<?php 

$conn = mysqli_connect("localhost","khun","khun","chattingDB");

if(!$conn) {
    echo mysqli_connect_error();
    die();
}


// Target directory
$targetDir = "uploads/";

// Maximum file size (100MB in bytes)
$maxFileSize = 100 * 1024 * 1024; // 100MB

// Allowed image MIME types
$allowedTypes = [
    'image/jpeg', // JPEG
    'image/png',  // PNG
    'image/gif',  // GIF
    'image/webp', // WEBP
    'image/svg+xml', // SVG
    'image/bmp',  // BMP
    'image/tiff', // TIFF
    'image/x-icon' // ICO
];

// Check if files were uploaded
if (isset($_FILES["files"]) && !empty($_FILES["files"]["name"][0])) {
    $fileCount = count($_FILES["files"]["name"]);

    // Loop through each file
    for ($i = 0; $i < $fileCount; $i++) {
        // Check for errors
        if ($_FILES["files"]["error"][$i] !== UPLOAD_ERR_OK) {
            echo "Error uploading file: " . $_FILES["files"]["name"][$i] . "<br>";
            continue;
        }

        // Check file size
        if ($_FILES["files"]["size"][$i] > $maxFileSize) {
            echo "Error: File size exceeds the maximum limit of 100MB for file: " . $_FILES["files"]["name"][$i] . "<br>";
            continue;
        }

        // Check file type
        $fileType = $_FILES["files"]["type"][$i];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Only image files are allowed for file: " . $_FILES["files"]["name"][$i] . "<br>";
            continue;
        }

        // Get file details
        $fileName = basename($_FILES["files"]["name"][$i]);
        $targetPath = $targetDir . $fileName;

        // Move the file to the target directory
        if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $targetPath)) {
            // Insert file details into the database
            $sql = "INSERT INTO files (filename, filepath) VALUES ('$fileName', '$targetPath')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded and saved to DB: " . $fileName . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error moving the file: " . $fileName . "<br>";
        }
    }
} else {
    echo "No files uploaded or there was an error during upload.";
}

$conn->close();
?>