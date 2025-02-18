<?php
session_start();


$userId = $_SESSION['user_id'];

require_once "../Controller/dbConnect.php";


// File upload 
$upload_dir = 'uploads/';
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    $user_id = $_SESSION['user_id'] ?? 1; 
    //$userId = $_SESSION['user_id'];

    $photos = [];
    
    //  file uploads
    if (!empty($_FILES['photos']['name'][0])) {
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $file_type = $_FILES['photos']['type'][$key];
            $file_size = $_FILES['photos']['size'][$key];
            
            if (in_array($file_type, $allowed_types) && $file_size < 5000000) {
                $ext = pathinfo($_FILES['photos']['name'][$key], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                
                if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                    $photos[] = $filename;
                }
            }
        }
        
    }

    // Insert post into database
    $stmt = $conn->prepare("INSERT INTO posts (user_id, capation, photos, createdAt) 
                          VALUES (?, ?, ?, NOW())");
   // $photos_json = !empty($photos) ? json_encode($photos) : null;
   $photos_json = !empty($photos) ? json_encode($photos) : '[]';
    $stmt->bind_param('iss', $user_id, $caption, $photos_json);
    
    if ($stmt->execute()) {
        //header(header: 'location:'.SITEURL.'../Posts/newFeeds.php');
       // header("localhost://Chatting Project/src/Posts/newFeeds.php");
        //die();
        

        
           header('Location:../Posts/newFeeds.php');
          exit();   
       
        
        
    } else {
        $error = "Error creating post: " . $conn->error;
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <head>
    <link rel="stylesheet" href="../Posts/postStyle/poststyle.css">
    <link rel="stylesheet" href="../Posts/postStyle/newfeed2.css">
</head>
<body>
    <div class="post-box">
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <textarea name="caption" 
                      placeholder="What's on your mind?" 
                      rows="3" 
                      style="width: 100%" class="textarea" required></textarea>
            
            <div id="preview-container"></div>
            
            <div style="margin: 10px 0;">
                <input type="file" name="photos[]" id="photo-input" multiple 
                       accept="image/*" style="display: none;">
                <button type="button" onclick="document.getElementById('photo-input').click()" class="button button-outline">
                    Upload Photos
                </button>
                <button type="button" onclick="clearPreview()" class="button button-outline" style="border:1px solid red; color:red;">Remove All</button>
            </div>
            
            <button type="submit" class="button button-primary">Upload Post</button>
        </form>
    </div>
    <script src="../Posts/PostJs/photosView.js"></script>
</body>
</html>