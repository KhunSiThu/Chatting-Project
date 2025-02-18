<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "chattingdb");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Post Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-800">
    <div class="w-11/12 md:w-2/3 mx-auto" style="max-height:550px;">

        <!-- Post Input -->
        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg my-12">
            <div class="flex items-center space-x-3">
                <img src="https://www.perfocal.com/blog/content/images/2021/01/Perfocal_17-11-2019_TYWFAQ_82_standard-3.jpg" class="w-10 h-10 object-cover rounded-full" />
                <a href="../Posts/newfeed2.php" class="flex-1 bg-transparent border-none focus:ring-0 text-gray-700 dark:text-gray-200">"Share your thoughts..."</a>
            </div>
            <!-- <div class="mt-3 flex justify-between">
                <button class="flex items-center text-blue-500">
                    📷 <span class="ml-1">Photo</span>
                </button>
                <button class="flex items-center text-green-500">
                    🎥 <span class="ml-1">Video</span>
                </button>
                <button class="flex items-center text-red-500">
                    📅 <span class="ml-1">Event</span>
                </button>
                <button class="flex items-center text-yellow-500">
                    😊 <span class="ml-1">Feeling / Activity</span>
                </button>
            </div> -->
        </div>

        <!-- Post Display Section -->
        <div class="flex flex-col space-y-6">
            <?php
            $sql = "SELECT * FROM posts ORDER BY createdAt DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) == 0) {
                echo "<p class='text-center text-gray-500 dark:text-gray-400'>No posts available.</p>";
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['post_id'];
                    $caption = $row['capation'];
                    $createdAt = $row['createdAt'];
                    $photos_json = $row['photos'];

                    $photos = json_decode($photos_json, true);
                    $photoCount = count($photos);
            ?>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                        <!-- User Info -->
                        <div class="flex items-center space-x-3">
                            <img src="https://www.perfocal.com/blog/content/images/2021/01/Perfocal_17-11-2019_TYWFAQ_82_standard-3.jpg" class="w-10 h-10 object-cover rounded-full" />
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Jame</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><?= $createdAt ?></p>
                            </div>
                        </div>

                        <!-- Caption -->
                        <p class="mt-3 text-gray-700 dark:text-gray-300">
                            <?= nl2br(htmlspecialchars($caption)) ?>
                        </p>

                        <!--  Photo Box -->
                        <?php if ($photoCount > 0): ?>
                            <div class="grid grid-cols-<?= min($photoCount, 2) ?> gap-1 mt-3 relative">
                                <?php foreach ($photos as $index => $photo): ?>
                                    <?php if ($index < 4): //  4 images 
                                    ?>
                                        <a href="javascript:void(0);" onclick="openGallery(<?= htmlspecialchars(json_encode($photos)) ?>, <?= $index ?>)" class="relative">
                                            <img src="../Posts/uploads/<?= htmlspecialchars($photo) ?>" class="w-full h-40 object-cover rounded-lg <?= ($index == 3 && $photoCount > 4) ? 'opacity-50' : '' ?>" />
                                            <?php if ($index == 3 && $photoCount > 4): ?>
                                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-2xl font-bold">
                                                    +<?= $photoCount - 4 ?>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Like, Comment Section -->

                         <div class="flex justify-between items-center mt-3 text-gray-500 dark:text-gray-400">
                            <button class="flex items-center">👍<span class="ml-1">Like</span></button>
                            <button class="flex items-center">💬 <span class="ml-1">Comment</span></button>
                        </div> 

                    
                        

                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- Fullscreen Modal Gallery -->
    <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50">
        <button onclick="closeGallery()" class="absolute top-5 right-5 text-white text-2xl font-bold">✕</button>
        <button onclick="prevImage()" class="absolute left-5 text-white text-3xl font-bold">◀</button>
        <button onclick="nextImage()" class="absolute right-5 text-white text-3xl font-bold">▶</button>
        <img id="galleryImage" class="max-w-full max-h-[80vh] rounded-lg" />
    </div>

    <script src="..\Posts\Js_Post\newFeeds.js"> </script>



</body>

</html>