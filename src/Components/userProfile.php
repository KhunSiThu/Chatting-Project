<section id="userProfile" class="w-screen h-screen fixed hidden top-0 left-0 justify-center items-center bg-blur dark:bg-gray-900/90">
    <div class="bg-white dark:bg-gray-800 p-10 rounded-xl shadow-xl md:w-1/4 space-y-6 relative">
        <button class="absolute top-4 right-4 text-gray-700 dark:text-gray-300" onclick="closeProfile()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Profile Section -->
        <form class="w-full text-center">
            <div class="relative w-32 h-32 mx-auto">
                <img id="profileImage" src="../uploads/<?= $userData['profileImage'] ?>" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-400 dark:border-gray-600">
                <button onclick="editProfileImage()" class="absolute bottom-1 right-1 bg-blue-500 text-white p-1 rounded-full text-xs">
                    <i class="fas fa-edit"></i>
                </button>
                <div id="profileImageLoading" class="absolute inset-0 bg-black bg-opacity-50 rounded-full hidden justify-center items-center">
                    <span class="text-white text-sm">Uploading...</span>
                </div>
            </div>
            <div class=" flex flex-col mt-5 space-y-2">
                <div>
                    <input id="name" name="name"  class="text-xl w-2/4 mx-auto text-center font-semibold focus:border-b border-blue-500 text-gray-800 dark:text-gray-200  outline-none bg-transparent" value="<?= $userData['name'] ?>"></input>
                    <label for="name" class="text-blue-400">Edit</label>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?= $userData['email'] ?></p>
            </div>
            <button onclick="saveName()" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hidden mt-5">Save</button>

        </form>



        <!-- Stats Section -->
        <div class="border-t pt-4 border-gray-200 dark:border-gray-700">
            <div class="flex justify-between text-gray-700 dark:text-gray-300">
                <p>Blocks</p>
                <button onclick="toggleBlockList()" class="text-blue-500 text-sm">Show</button>
            </div>
            <ul id="blockList" class="hidden mt-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 p-2 rounded">
                <li class="flex justify-between items-center">User 1 <button onclick="confirmUnblock(this)" class="text-red-500 text-sm">Unblock</button></li>
                <li class="flex justify-between items-center">User 2 <button onclick="confirmUnblock(this)" class="text-red-500 text-sm">Unblock</button></li>
                <li class="flex justify-between items-center">User 3 <button onclick="confirmUnblock(this)" class="text-red-500 text-sm">Unblock</button></li>
            </ul>
            <div class="flex justify-between text-gray-700 dark:text-gray-300 mt-2">
                <p>Friends</p>
                <p>50</p>
            </div>
            <div class="flex justify-between text-gray-700 dark:text-gray-300 mt-2">
                <p>Follower</p>
                <p>100</p>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleEditName() {
        document.getElementById('profileNameDisplay').classList.toggle('hidden');
        document.getElementById('editNameButton').classList.toggle('hidden');
        document.getElementById('editNameContainer').classList.toggle('hidden');
    }

    function saveName() {
        const nameInput = document.getElementById('profileNameInput').value;
        document.getElementById('profileNameDisplay').textContent = nameInput;
        toggleEditName();
    }

    function editProfileImage() {
        const profileImage = document.getElementById('profileImage');
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.onchange = function() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onloadstart = function() {
                    document.getElementById('profileImageLoading').classList.remove('hidden');
                };
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                    document.getElementById('profileImageLoading').classList.add('hidden');
                    // Here you can add an AJAX call to upload the image to the server
                };
                reader.onerror = function() {
                    document.getElementById('profileImageLoading').classList.add('hidden');
                    alert('Error uploading image. Please try again.');
                };
                reader.readAsDataURL(file);
            }
        };
        fileInput.click();
    }

    function toggleBlockList() {
        document.getElementById('blockList').classList.toggle('hidden');
    }

    function confirmUnblock(button) {
        if (confirm('Are you sure you want to unblock this user?')) {
            unblockUser(button);
        }
    }

    function unblockUser(button) {
        button.parentElement.remove();
        // Here you can add an AJAX call to unblock the user on the server
    }

    function closeProfile() {
        document.getElementById('userProfile').classList.add('md:hidden');
    }
</script>