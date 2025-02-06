// Fetch Friend List
async function getFriendList() {
    try {
        const response = await fetch("../Controller/getFriends.php");
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }
        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }



        friendList.innerHTML = data.length > 0 ? data.map(friend => `
            <li id="${friend.userId}" class="p-3 chatItem cursor-pointer rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-gray-900 flex items-center justify-between">
                <div class="flex items-center pointer-events-none">
                    <div class="relative">
                        <!-- Profile Image -->
                        <img class="w-12 h-12 object-cover rounded-full border-2 border-white dark:border-gray-800 transition-transform duration-200 hover:scale-105" src="../uploads/${friend.profileImage}" alt="${friend.name}'s profile image">

                        <!-- Online Status Indicator -->
                        <span class="bottom-0 left-7 absolute w-4 h-4 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full transition-opacity duration-200 ${friend.status !== 'Online' ? 'opacity-0' : 'opacity-100'}"></span>
                    </div>
                        <div class="ml-2">
                        <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                        <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.lastMessage}</span>
                    </div>
                </div>
                <button class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-black dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>
            </li>
        `).join('') : `
            <li class="flex items-center justify-center w-full h-96">
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                    <p>No friends found.</p>
                </div>
            </li>
        `;
    } catch (error) {
        console.error("Error fetching friend list:", error);
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

// Friend Requests
async function friendRequests() {
    try {
        const response = await fetch("../Controller/getFriendRequests.php");

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();
        requestList.innerHTML = ""; // Clear previous results

        if (data.length > 0) {
            data.forEach((friend) => {
                const li = document.createElement("li");
                li.className = "p-3 rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-900 flex items-center justify-between";
                li.innerHTML = `
                    <div class="flex items-center">
                        <div class="relative">
                            <img class="w-12 h-12 object-cover rounded-full" src="../uploads/${friend.profileImage}" alt="${friend.name}">
                        </div>
                        <div class="ml-2">
                            <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                            <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.status}</span>
                        </div>
                    </div>
                    <button type="button" id="${friend.userId}" class="confirmBtn p-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                        Confirm Request
                    </button>
                `;
                requestList.appendChild(li);
            });
        } else {
            const li = document.createElement("li");
            li.className = "flex items-center justify-center w-full h-96";
            li.innerHTML = `
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-magnifying-glass text-4xl mb-5"></i>
                    <p>No friend requests found.</p>
                </div>
            `;
            requestList.appendChild(li);
        }

        return data.length;

    } catch (error) {
        console.error("Error fetching friend requests:", error);
        requestList.innerHTML = `
            <li class="flex items-center justify-center w-full h-96">
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                    <p>An error occurred. Please try again later.</p>
                </div>
            </li>
        `;
    }
}

// Friend RequestsFollow Friend
async function followFriend() {
    try {
        const response = await fetch("../Controller/getFollowFriend.php");

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();
        followList.innerHTML = ""; // Clear previous results

        if (data.length > 0) {
            data.forEach((friend) => {
                const li = document.createElement("li");
                li.className = "p-3 rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-900 flex items-center justify-between";
                li.innerHTML = `
                    <div class="flex items-center">
                        <div class="relative">
                            <img class="w-12 h-12 object-cover rounded-full" src="../uploads/${friend.profileImage}" alt="${friend.name}">
                        </div>
                        <div class="ml-2">
                            <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                            <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.status}</span>
                        </div>
                    </div>
                    <button type="button" id="${friend.userId}" class="requestBtn p-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                        Friend Request
                    </button>
                `;
                followList.appendChild(li);
            });
        } else {
            const li = document.createElement("li");
            li.className = "flex items-center justify-center w-full h-96";
            li.innerHTML = `
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-magnifying-glass text-4xl mb-5"></i>
                    <p>Search Your Friends!</p>
                </div>
            `;
            followList.appendChild(li);
        }

        return data.length;
    } catch (error) {
        console.error("Error fetching friend requests:", error);
        followList.innerHTML = `
            <li class="flex items-center justify-center w-full h-96">
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                    <p>An error occurred. Please try again later.</p>
                </div>
            </li>
        `;
    }
}

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
        searchItems.innerHTML = ""; // Clear previous results

        if (data.length > 0) {
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
                li.className = "p-3 rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-900 flex items-center justify-between";
                li.innerHTML = `
                    <div class="flex items-center">
                        <div class="relative">
                            <img class="w-12 h-12 object-cover rounded-full" src="../uploads/${friend.profileImage}" alt="${friend.name}">
                        </div>
                        <div class="ml-2">
                            <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                            <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.status}</span>
                        </div>
                    </div>
                    <button type="button" id="${friend.userId}" class="p-2 ${controllBtn} inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                        ${actionBtn}
                    </button>
                `;
                searchItems.appendChild(li);
            });
        } else {
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