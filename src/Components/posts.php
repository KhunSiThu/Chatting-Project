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
    <form id="search-form" class="md:w-1/2 w-2/3 flex justify-between">
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
<div class="w-11/12 md:w-2/3 mx-auto p-6 my-10 bg-gray-100 shadow-lg rounded-lg dark:bg-gray-800" style="max-height:550px;">

        <form id="uploadPostForm" method="POST" enctype="multipart/form-data">
            <!-- Caption Textarea -->
            <div class="flex items-start w-full gap-x-3 justify-between">
                <div class="text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <img class="w-8 h-8 object-cover rounded-full" src="<?= !empty($userData['profileImage']) ? '../uploads/profiles/' . $userData['profileImage'] : 'https://t3.ftcdn.net/jpg/10/58/16/08/360_F_1058160846_MxdSa2GeeVAF5A7Zt9X7Bp0dq0mlzeDe.jpg' ?>" alt="Profile Image">
                </div>
                <div class="w-11/12 md:w-full">
                <textarea name="caption" id="caption" placeholder="What's on your mind?" rows="3" class=" p-3 w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
                </div>
            </div>

            <!-- Image Preview Container -->
            <div id="preview-container" class="grid grid-cols-3 gap-4 justify-between"></div>

            <!-- File Upload and Actions -->
            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">

                    <input type="file" name="photos[]" id="photo-input" multiple
                        accept="image/*" style="display: none;">
                    <input type="file" name="video" id="video-input"
                        accept="video/*" style="display: none;">
                    <input type="file" name="documents[]" id="doc-input" multiple
                        accept=".pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.txt,.pdf" style="display: none;">

                    <!-- Upload Photos Button -->
                    <label for="photo-input" type="button" class="md:py-2.5 md:px-5 p-2 me-2 mb-2 text-sm flex items-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-green-400">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 md:block hidden">Photos</span>
                    </label>

                    <!-- Upload Videos Button -->
                    <label for="video-input" type="button" class="md:py-2.5 md:px-5 p-2 me-2 mb-2 text-sm flex items-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-purple-400">
                            <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 md:block hidden">Videos</span>
                    </label>

                    <!-- Upload Documents Button -->
                    <label for="doc-input" type="button" class="md:py-2.5 md:px-5 p-2 me-2 mb-2 text-sm flex items-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-yellow-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span class="ml-2 md:block hidden">Documents</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="button" id="uploadPostBtn" class="md:px-4 md:py-2 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Upload Post
                </button>
            </div>
        </form>

</div>

<!-- Post Display Section -->
<div class="w-11/12 md:w-2/3 mx-auto">
<div id="postsContainer" class="flex flex-col space-y-10">

    </div>
</div>

<!-- Gallery Modal -->
<div id="galleryModal" class="hidden fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 bg-blur">
    <div class="relative w-full h-full flex items-center justify-center">
        <!-- Close Button -->
        <button type="button" onclick="closeGallery()" class="absolute top-4 right-4 text-white text-4xl transition-colors">
            &times;
        </button>

        <!-- Save Button -->
        <a id="saveImageButton" class="absolute bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition" download>
            Save Image
        </a>

        <!-- Previous Button -->
        <button type="button" onclick="prevImage()" class="absolute left-4 text-white text-2xl transition-colors">
            &#10094;
        </button>

        <!-- Gallery Image -->
        <img id="galleryImage" class="w-full h-full p-10 object-contain" src="" alt="Gallery Image" />

        <!-- Next Button -->
        <button type="button" onclick="nextImage()" class="absolute right-4 text-white text-2xl transition-colors">
            &#10095;
        </button>
    </div>
</div>

<script>
    let postsGalleryImages = [];
    let postsCurrentIndex = 0;

    function setupGalleryEventListeners() {
        document.querySelectorAll('.gallery-trigger').forEach(trigger => {
            trigger.addEventListener('click', function() {
                postsGalleryImages = JSON.parse(this.dataset.images);
                postsCurrentIndex = parseInt(this.dataset.index);
                document.getElementById("galleryModal").classList.remove("hidden");
                updateGalleryImage();
            });
        });

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeGallery();
            }
        });
    }

    function updateGalleryImage() {
        let imageUrl = "../posts/images/" + postsGalleryImages[postsCurrentIndex];
        document.getElementById("galleryImage").src = imageUrl;

        // Update Save Button
        let saveButton = document.getElementById("saveImageButton");
        saveButton.href = imageUrl;
        saveButton.download = "image-" + postsCurrentIndex + ".jpg"; // Default file name
    }

    function closeGallery() {
        document.getElementById("galleryModal").classList.add("hidden");
    }

    function prevImage() {
        if (postsCurrentIndex > 0) {
            postsCurrentIndex--;
            updateGalleryImage();
        }
    }

    function nextImage() {
        if (postsCurrentIndex < postsGalleryImages.length - 1) {
            postsCurrentIndex++;
            updateGalleryImage();
        }
    }
</script>