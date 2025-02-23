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
    <div class=" userProfileBtn flex justify-between items-center">
        <div class="p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all cursor-pointer">
            <img class="w-8 h-8 object-cover rounded-full" src="<?= !empty($userData['profileImage']) ? '../uploads/profiles/' . $userData['profileImage'] : 'https://t3.ftcdn.net/jpg/10/58/16/08/360_F_1058160846_MxdSa2GeeVAF5A7Zt9X7Bp0dq0mlzeDe.jpg' ?>" alt="Profile Image">
        </div>
    </div>
</div>

<div id="userProfileShowCon" class="hidden w-full overflow-auto relative bg-white text-gray-900 dark:bg-gray-900 dark:text-white scroll-none">


    <!-- Banner Section -->
    <section class="relative block h-48 sm:h-64 md:h-80 lg:h-96">
        <img src="https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2710&q=80" class="w-full h-full bg-center bg-cover" alt="">
    </section>

    <!-- Profile Info Section -->
    <div class="relative md:flex-row flex flex-col items-center bg-white dark:bg-gray-800 w-full">
        <div class="px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between w-full items-center">
            <!-- Profile Picture and Details -->
            <div class="flex flex-col sm:flex-row items-center justify-center ">
                <div class="relative -top-14 md:-top-20">
                    <img alt="Profile" src="../uploads/profiles/<?= $userData['profileImage'] ?>" class="border-2 p-1 border-blue-400 bg-black/40  h-36 w-36 md:h-48 md:w-48 rounded-full object-cover">
                </div>
                <div class="ml-1 sm:ml-6 lg:ml-10  flex flex-col justify-center">
                    <h3 class="text-xl sm:text-2xl text-center md:text-start  lg:text-3xl font-semibold text-gray-700 dark:text-gray-300">
                        <?= $userData['name'] ?> <small class="text-xs opacity-80">( Student )</small>
                    </h3>
                    <span class="text-xs text-center md:text-start opacity-40"><?= $userData['email'] ?></span>
                    <ul class="text-sm mt-3 opacity-90">
                        <li class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                            <span>University Of Computer Studies ( Hpa-An )</span>
                        </li>
                        <li class="flex items-center space-x-1 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Kayin State, Hpa-An City</span>
                        </li>
                        <li class="flex items-center space-x-1 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span>+959944074981</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="flex justify-between items-center mt-6 sm:mt-0">
                <div class="flex justify-center space-x-4 sm:space-x-6">
                    <div class="p-2 sm:p-3 text-center">
                        <span class="text-lg sm:text-xl font-bold block text-gray-600 dark:text-gray-300">89</span>
                        <span class="text-sm text-gray-400 dark:text-gray-500">Posts</span>
                    </div>
                    <div class="p-2 sm:p-3 text-center">
                        <span class="text-lg sm:text-xl font-bold block text-gray-600 dark:text-gray-300">22</span>
                        <span class="text-sm text-gray-400 dark:text-gray-500">Friends</span>
                    </div>
                    <div class="p-2 sm:p-3 text-center">
                        <span class="text-lg sm:text-xl font-bold block text-gray-600 dark:text-gray-300">10</span>
                        <span class="text-sm text-gray-400 dark:text-gray-500">Request</span>
                    </div>
                    <div class="p-2 sm:p-3 text-center">
                        <span class="text-lg sm:text-xl font-bold block text-gray-600 dark:text-gray-300">89</span>
                        <span class="text-sm text-gray-400 dark:text-gray-500">Follower</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <button id="editProfileBtn" class="flex items-center justify-center bg-blue-500 absolute top-5 md:-top-12 right-3 uppercase text-white font-bold hover:shadow-md shadow text-xs md:px-4 px-2 py-2 rounded outline-none focus:outline-none mb-1 ease-linear transition-all duration-150" type="button">
            Edit <span class="md:inline hidden"> Profile</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </button>
    </div>


</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed  inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-50 transition-opacity bg-blur">
    <div class="relative w-full max-w-lg p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg transform transition-all">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Edit Profile</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form class="space-y-6">
            <div class="flex flex-col items-center">
                <label for="profileImage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Image</label>
                <div class="relative w-28 h-28 rounded-full overflow-hidden border border-gray-300 dark:border-gray-600 shadow-md">
                    <img id="profilePreview" src="../uploads/<?= $userData['profileImage'] ?>" alt="Profile Image" class="w-full h-full object-cover">
                </div>
                <label class="mt-2 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Upload Image
                    <input type="file" id="profileImage" name="profileImage" class="hidden" onchange="previewImage(event)">
                </label>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="<?= $userData['name'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="<?= $userData['email'] ?>" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="university" class="block text-sm font-medium text-gray-700 dark:text-gray-300">University</label>
                    <input type="text" id="university" name="university" value="University Of Computer Studies ( Hpa-An )" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" id="location" name="location" value="Kayin State, Hpa-An City" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                    <input type="text" id="phone" name="phone" value="+959944074981" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Save Changes</button>
            </div>
        </form>
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



