<?php
session_start();
// $conn = mysqli_connect("localhost", "root", "", "chattingdb");
?>

<!-- Sticky Header -->
<div class="w-full flex items-center justify-between sticky top-0 left-0 z-40 h-20 bg-slate-200/95 dark:bg-gray-800/95 shadow-lg px-6 py-4 backdrop-blur-sm">
    <!-- Sidebar Toggle Button -->
    <div>
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
    </div>

    <!-- Search Form -->
    <form id="search-form" class="w-1/2 flex justify-between">
        <div class="relative w-full h-11 flex items-center justify-between bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 transition-all">
            <input name="searchText" type="search" id="default-search" class="searchBox px-4 block h-full w-full text-sm text-gray-900 bg-transparent dark:placeholder-gray-400 dark:text-white border-none focus:outline-none focus:ring-0" placeholder="Search friends..." required />
            <button type="submit" class="w-12 h-full flex items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-r-lg hover:bg-gray-200 dark:hover:bg-gray-500 transition-all">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </button>
        </div>
    </form>

    <!-- Profile Section -->
    <div class="flex justify-between items-center">
        <div class="p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all cursor-pointer">
            <img class="w-8 h-8 object-cover rounded-full" src="<?= !empty($userData['profileImage']) ? '../uploads/profiles/' . $userData['profileImage'] : 'https://t3.ftcdn.net/jpg/10/58/16/08/360_F_1058160846_MxdSa2GeeVAF5A7Zt9X7Bp0dq0mlzeDe.jpg' ?>" alt="Profile Image">
        </div>
    </div>
</div>

<!-- Post Creation Form -->
<div class="w-11/12 md:w-2/3 mx-auto" style="max-height:550px;">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg my-6 shadow-lg">
        <form method="POST" enctype="multipart/form-data">
            <!-- Caption Textarea -->
            <div class="flex items-start space-x-4 ">
                <div class="p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <img class="w-8 h-8 object-cover rounded-full" src="<?= !empty($userData['profileImage']) ? '../uploads/profiles/' . $userData['profileImage'] : 'https://t3.ftcdn.net/jpg/10/58/16/08/360_F_1058160846_MxdSa2GeeVAF5A7Zt9X7Bp0dq0mlzeDe.jpg' ?>" alt="Profile Image">
                </div>
                <textarea name="capation" id="capation" placeholder="What's on your mind?" rows="3" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
            </div>

            <!-- Image Preview Container -->
            <div id="preview-container" class="grid grid-cols-3 gap-4 justify-between"></div>

            <!-- File Upload and Actions -->
            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">

                    <input type="file" name="photos[]" id="photo-input" multiple
                        accept="image/*" style="display: none;">
                    <input type="file" name="video" id="video-input" multiple
                    accept="video/*" style="display: none;">
                    <input type="file" name="documents[]" id="doc-input" multiple
                    accept=".pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.txt,.pdf" style="display: none;">

                    <!-- Upload Photos Button -->
                    <label for="photo-input" type="button" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Photos</span>
                    </label>

                    <!-- Upload Videos Button -->
                    <label for="video-input" type="button" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Videos</span>
                    </label>

                    <!-- Upload Documents Button -->
                    <label for="doc-input" type="button" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Documents</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="button" id="uploadPostBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Upload Post
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Post Display Section -->
<div class="w-11/12 md:w-2/3 mx-auto">
    <div class="flex flex-col space-y-6">
        <?php
        $sql = "SELECT posts.*, user.name, user.profileImage 
                FROM posts 
                JOIN user ON posts.user_id = user.userId 
                ORDER BY posts.createdAt DESC";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) == 0) {
            echo "<p class='text-center text-gray-500 dark:text-gray-400'>No posts available.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['post_id'];
                $caption = $row['capation'];
                $createdAt = $row['createdAt'];
                // $photos_json = $row['photos'];

                $row['images'] = !empty($row['images']) ? explode(",", $row['images']) : [];
                $photos = $row['images'];
                $photoCount = count($photos);
        ?>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3">
                        <img src="../uploads/profiles/<?= htmlspecialchars($row['profileImage']) ?>" class="w-10 h-10 object-cover rounded-full" />
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['name']) ?></p>
                            <p class="text-sm text-gray-500 dark:text-gray-400"><?= $createdAt ?></p>
                        </div>
                    </div>

                    <!-- Caption -->
                    <p class="mt-3 text-gray-700 dark:text-gray-300">
                        <?= nl2br(htmlspecialchars($caption)) ?>
                    </p>

                    <!-- Photo Box -->
                    <?php if ($photoCount > 0): ?>
                        <div class="grid grid-cols-<?= min($photoCount, 2) ?> gap-1 mt-3 relative">
                            <?php foreach ($photos as $index => $photo): ?>
                                <?php if ($index < 4): ?>
                                    <a href="javascript:void(0);" onclick="openGallery(<?= htmlspecialchars(json_encode($photos)) ?>, <?= $index ?>)" class="relative">
                                        <img src="../posts/images/<?= htmlspecialchars($photo) ?>" class="w-full h-80  object-cover rounded-lg <?= ($index == 1 && $photoCount == 1) ? ' h-96' : '' ?> <?= ($index == 3 && $photoCount > 4) ? 'opacity-50' : '' ?>" />
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
                        <button class="flex items-center hover:text-blue-500 transition-colors">👍<span class="ml-1">Like</span></button>
                        <button class="flex items-center hover:text-green-500 transition-colors">💬 <span class="ml-1">Comment</span></button>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Fullscreen Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50">
    <button onclick="closeGallery()" class="absolute top-5 right-5 text-white text-2xl font-bold hover:text-gray-300 transition-colors">✕</button>
    <button onclick="prevImage()" class="absolute left-5 text-white text-3xl font-bold hover:text-gray-300 transition-colors">◀</button>
    <button onclick="nextImage()" class="absolute right-5 text-white text-3xl font-bold hover:text-gray-300 transition-colors">▶</button>
    <img id="galleryImage" class="max-w-full max-h-[80vh] rounded-lg" />
</div>

<script src="..\Posts\Js_Post\newFeeds.js"></script>