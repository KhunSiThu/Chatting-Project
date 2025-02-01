<?php require_once "../Components/header.php"; ?>
<main class="flex flex-col md:flex-row min-h-screen">


    <!-- Sidebar -->
    <div id="sidebar" class="relative flex h-screen md:w-auto bg-white dark:bg-gray-800 border-e border-gray-200 dark:border-gray-700 z-40">
        <nav class="h-full w-24 flex justify-between items-center flex-col bg-white dark:bg-gray-800 border-e border-gray-200 dark:border-gray-700">
            <div class="flex flex-col items-center gap-y-6">
                <div class="w-full">
                    <img class="p-2 mx-auto" src="https://static.vecteezy.com/system/resources/thumbnails/028/754/648/small_2x/3d-purple-online-chatting-bubble-icon-for-ui-ux-web-mobile-apps-social-media-ads-designs-png.png" alt="">
                </div>

                <!-- Sidebar Icons -->
                <div id="chatBoxBtn" class="hs-tooltip [--placement:right] inline-block">
                    <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                            Chat Box
                        </span>
                    </a>
                </div>

                <div class="hs-tooltip [--placement:right] inline-block">
                    <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                            Group
                        </span>
                    </a>
                </div>


                <div class="hs-tooltip [--placement:right] inline-block">
                    <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                            Friends Request
                        </span>
                    </a>
                </div>

                <div class="hs-tooltip [--placement:right] inline-block">
                    <button id="theme-toggle" class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                        <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                            Toggle Dark Mode
                        </span>
                    </button>
                </div>


                <!-- Repeat other sidebar icons here -->
            </div>

            <!-- Profile Icon -->
            <div class="hs-tooltip [--placement:right] inline-block mb-5">
                <a class="hs-tooltip-toggle p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <img class="w-10 h-10 rounded-full" src="../uploads/profile_679c5b919ed9f8.93970041.jpg" alt="">
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                        Profile
                    </span>
                </a>
            </div>
        </nav>

        <!-- Chat List -->
        <?php include_once("../Components/chatList.php") ?>

    </div>

    <!-- Chat Room -->
    <div class="h-screen w-full relative bg-white dark:bg-gray-900">

        <!-- Hero Section -->
        <section class="p-4 bg-slate-100 dark:bg-gray-800 w-full h-20 absolute right-0 top-0 z-40">
            <div class="flex items-center">
                <div class="relative">
                    <img class="w-12 h-12 rounded-full" src="../uploads/profile_679c5b919ed9f8.93970041.jpg" alt="">
                </div>
                <div class="ml-2">
                    <h4 class="font-bold dark:text-white">Khun Si Thu</h4>
                    <span class="text-xs text-green-400">Active Now</span>
                </div>
            </div>
        </section>

        <!-- Chat Messages -->
        <section class="w-full md:w-3/4 mx-auto px-3 h-full overflow-auto scroll-none py-24 bg-white dark:bg-gray-900">
            <!-- Chat Start (Received Messages) -->
            <div class="chat chat-start">
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS chat bubble component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <div class="chat-header dark:text-white">
                    Obi-Wan Kenobi
                    <time class="text-xs opacity-50 dark:text-gray-300">12:45</time>
                </div>
                <div class="chat-bubble bg-gray-100 dark:bg-gray-700 dark:text-white">You were the Chosen One!</div>
                <div class="chat-footer opacity-50 dark:text-gray-300">Delivered</div>
            </div>

            <!-- Chat End (Sent Messages) -->
            <div class="chat chat-end">
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS chat bubble component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <div class="chat-header dark:text-white">
                    Anakin
                    <time class="text-xs opacity-50 dark:text-gray-300">12:46</time>
                </div>
                <div class="chat-bubble bg-blue-500 text-white dark:bg-blue-600">I hate you!</div>
                <div class="chat-footer opacity-50 dark:text-gray-300">Seen at 12:46</div>
            </div>

            <!-- Repeat the above chat bubbles as needed -->
        </section>

        <!-- Input Section -->
        <section class="p-4 bg-slate-100 dark:bg-gray-800 w-full h-20 absolute bottom-0 z-40 right-0 flex justify-center items-center gap-x-5">
            <!-- Attachment Button -->
            <button class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </button>

            <!-- Message Input -->
            <div class="w-2/3">
                <input type="text" class="w-full p-2 rounded-md bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600" placeholder="Type a message...">
            </div>

            <!-- Send Button -->
            <button class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </section>
    </div>

</main>

<?php require_once '../Components/footer.php'; ?>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleDarkIcon.classList.add('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        themeToggleLightIcon.classList.add('hidden');
        themeToggleDarkIcon.classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    });

    const friendList = document.querySelector(".friendList");

    const searchBox = document.querySelector(".searchBox");
    const chatItems = document.querySelector("#chatItems");
    const mainTitle = document.querySelector("#mainTitle");
    const searchForm = document.querySelector("#search-form");
    const searchItemsCon = document.querySelector("#searchItemsCon");
    const searchItems = document.querySelector("#searchItems");

    const chatBoxBtn = document.querySelector('#chatBoxBtn');

    async function getFriendList() {
        try {
            const response = await fetch("../Controller/getFriends.php");

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            // Clear previous search results
            searchItems.innerHTML = "";

            if (data.length > 0) {
                // Display search results
                data.forEach((friend) => {
                    friendList.innerHTML = `
                    <li class="p-3 rounded-md bg-slate-50 dark:bg-gray-700 hover:bg-slate-200 dark:hover:bg-gray-600 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="relative">
                                <img class="w-12 h-12 rounded-full" src="../uploads/${friend.profileImage}" alt="">
                                <span class="bottom-0 left-7 absolute w-4 h-4 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                            </div>
                            <div class="ml-2">
                                <h4 class="font-bold dark:text-white">${friend.name}</h4>
                                <span class="text-xs opacity-50 dark:text-gray-300">You : Hello</span>
                            </div>
                        </div>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                    </li>
                    `
                });
            } else {

            }


        } catch (error) {
            console.error("Error fetching search results:", error);
            friendList.innerHTML = `
                <li class="flex items-center justify-center w-full h-96">
                    <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                        <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                        <p>An error occurred. Please try again later.</p>
                    </div>
                </li>
            `;
        }
    }

    getFriendList();

    let intervalId; // Variable to store the interval ID

    chatBoxBtn.addEventListener("click", () => {
        chatItems.classList.remove("hidden");
        searchItemsCon.classList.add("hidden");
        mainTitle.textContent = "Chat Box";
        searchBox.value = "";
    })

    // Toggle visibility of search results
    searchBox.addEventListener("keyup", () => {
        const searchText = searchBox.value.trim();

        if (searchText) {
            chatItems.classList.add("hidden");
            searchItemsCon.classList.remove("hidden");
            mainTitle.textContent = "Search Friends";

            // Clear any existing interval to avoid multiple intervals running
            if (intervalId) {
                clearInterval(intervalId);
            }

            // Start a new interval to fetch real-time data every 2 seconds
            intervalId = setInterval(() => {
                searchFriend(searchText); // Call search function
            }, 500); // Fetch data every 2 seconds

            // Event delegation for dynamically added buttons
            searchItems.addEventListener("click", (e) => {
                if (e.target.matches(".requestBtn")) {
                    const id = e.target.getAttribute("id");
                    requestTest('../Controller/requestFri.php', id, e.target);
                }

                if (e.target.matches(".confirmBtn")) {
                    const id = e.target.getAttribute("id");
                    confirmTest('../Controller/comfirmFri.php', id, e.target);
                }
            });

        } else {
            chatItems.classList.remove("hidden");
            searchItemsCon.classList.add("hidden");
            mainTitle.textContent = "Chat Box";

            // Clear the interval when the search box is empty
            if (intervalId) {
                clearInterval(intervalId);
            }
        }
    });

    // Prevent form submission
    searchForm.addEventListener("submit", (e) => {
        e.preventDefault();
    });

    // Handle friend request action
    async function requestTest(action, id, button) {
        try {
            // button.innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse"></i>`;

            const response = await fetch(action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id
                }),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            // Update button state based on response
            if (data.success) {
                button.textContent = "Request Sent";
                button.classList.remove("bg-blue-100", "hover:bg-blue-200");
                button.classList.add("bg-green-100", "hover:bg-green-200", "text-green-800");
            } else {
                button.textContent = "Add Friend";
                alert(data.message || "Failed to send friend request.");
            }
        } catch (error) {
            console.error("Error sending friend request:", error);
            button.textContent = "Add Friend";
            alert("An error occurred. Please try again later.");
        }
    }

    async function confirmTest(action, id, button) {
        try {
            // button.innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse"></i>`;

            const response = await fetch(action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id
                }),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            // Update button state based on response
            if (data.success) {
                button.textContent = "Unfriend";
                button.classList.remove("bg-blue-100", "hover:bg-blue-200");
                button.classList.add("bg-green-100", "hover:bg-green-200", "text-green-800");
            } else {
                button.textContent = "Confirm";
                alert(data.message || "Failed to send friend confirm.");
            }
        } catch (error) {
            console.error("Error sending friend confirm:", error);
            button.textContent = "Confirm";
            alert("An error occurred. Please try again later.");
        }
    }

    // Function to search friends
    async function searchFriend(searchText) {
        try {
            const response = await fetch("../Controller/searchFriends.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    searchText
                }),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            // Clear previous search results
            searchItems.innerHTML = "";

            if (data.length > 0) {
                // Display search results
                data.forEach((friend) => {
                    let actionBtn = "Add Friend";
                    let controllBtn = "requestBtn";

                    if (friend.friend_status === "Friend") {
                        actionBtn = "Unfriends";
                        controllBtn = "confirmBtn";
                    } else if (friend.request_status === "Request") {
                        actionBtn = "Request Sent";
                        controllBtn = "requestBtn";
                    } else if (friend.confirm_status === "Confirm") {
                        actionBtn = "Confirm Request";
                        controllBtn = "confirmBtn";
                    }

                    const li = document.createElement("li");
                    li.className = "p-3 rounded-md bg-slate-50 dark:bg-gray-700 hover:bg-slate-200 dark:hover:bg-gray-600 flex items-center justify-between";
                    li.innerHTML = `
                        <div class="flex items-center">
                            <div class="relative">
                                <img class="w-12 h-12 rounded-full" src="../uploads/${friend.profileImage}" alt="${friend.name}">
                            </div>
                            <div class="ml-2">
                                <h4 class="font-bold dark:text-white">${friend.name}</h4>
                                <span class="text-xs opacity-50 dark:text-gray-300">${friend.status}</span>
                            </div>
                        </div>
                        <button type="button" id="${friend.userId}" class="p-2 ${controllBtn} inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                            ${actionBtn}
                        </button>
                    `;
                    searchItems.appendChild(li);
                });
            } else {
                // Display "No results found" message
                const li = document.createElement("li");
                li.className = "flex items-center justify-center w-full h-96";
                li.innerHTML = `
                    <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                        <i class="fa-solid fa-magnifying-glass text-4xl mb-5"></i>
                        <p>No results found.</p>
                    </div>
                `;
                searchItems.appendChild(li);
            }


        } catch (error) {
            console.error("Error fetching search results:", error);
            searchItems.innerHTML = `
                <li class="flex items-center justify-center w-full h-96">
                    <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                        <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                        <p>An error occurred. Please try again later.</p>
                    </div>
                </li>
            `;
        }
    }
</script>