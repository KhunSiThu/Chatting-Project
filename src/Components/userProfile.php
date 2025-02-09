<div id="userProfileShowCon" class="h-screen hidden w-full overflow-auto relative bg-white text-gray-900 dark:bg-gray-900 dark:text-white scroll-none">
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
                    <img alt="Profile" src="../uploads/<?= $userData['profileImage'] ?>" class="border-2 p-1 border-blue-400 bg-black/40  h-36 w-36 md:h-48 md:w-48 rounded-full object-cover">
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

    <!-- Post Input Section -->
    <div class="w-11/12 md:w-2/3 mx-auto">
        <h2 class="my-5">
            Your Posts
        </h2>
        <!-- Posts Section -->
        <div class="flex flex-col space-y-6 sm:space-y-10 mb-12">
            <!-- Repeat this block for each post -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex items-center space-x-3">
                    <img src="https://www.perfocal.com/blog/content/images/2021/01/Perfocal_17-11-2019_TYWFAQ_82_standard-3.jpg" class="w-10 h-10 object-cover rounded-full" />
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">Lori Ferguson</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Web Developer at Webestica · 2hr</p>
                    </div>
                    <button class="ml-auto text-gray-500 dark:text-gray-400">⋮</button>
                </div>
                <p class="mt-3 text-gray-700 dark:text-gray-300">
                    I'm thrilled to share that I've completed a graduate certificate course in project management with the president's honor roll.
                </p>
                <img src="https://www.perfocal.com/blog/content/images/2021/01/Perfocal_17-11-2019_TYWFAQ_82_standard-3.jpg" class="w-full object-cover rounded-lg mt-3" />
                <div class="flex justify-between items-center mt-3 text-gray-500 dark:text-gray-400">
                    <button class="flex items-center">
                        👍 <span class="ml-1">Like (56)</span>
                    </button>
                    <button class="flex items-center">
                        💬 <span class="ml-1">Comments (12)</span>
                    </button>
                </div>
            </div>
            <!-- End of post block -->
        </div>
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

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profilePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>



<script>
    // Get the modal and buttons
    const editProfileModal = document.getElementById('editProfileModal');
    const editProfileButton = document.querySelector('#editProfileBtn');
    const closeModalButton = document.getElementById('closeModal');

    // Function to open the modal
    editProfileButton.addEventListener('click', () => {
        editProfileModal.classList.remove('hidden');
    });

    // Function to close the modal
    closeModalButton.addEventListener('click', () => {
        editProfileModal.classList.add('hidden');
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === editProfileModal) {
            editProfileModal.classList.add('hidden');
        }
    });
</script>