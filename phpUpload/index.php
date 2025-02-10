<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple accept="image/*"> <!-- Allow only image files -->
        <input type="submit" value="Upload" style="margin-top: 10px;">
    </form>
</body>
</html>