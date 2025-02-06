// Get references to the custom alert box and its elements
const customAlertBox = document.getElementById('customAlertBox');
const alertMessage = document.getElementById('alertMessage');
const closeAlertBtn = document.getElementById('closeAlertBtn');

// Function to show the custom alert box
function showCustomAlert(message) {
    alertMessage.innerHTML = message; // Set the message
    customAlertBox.classList.remove('hidden'); // Show the alert box
}

// Function to hide the custom alert box
function hideCustomAlert() {
    customAlertBox.classList.add('hidden'); // Hide the alert box
}

// Event listener for the close button
closeAlertBtn.addEventListener('click', hideCustomAlert);


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
        groupList.innerHTML = `
            <li class="flex items-center justify-center w-full h-96">
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                    <p>An error occurred. Please try again later.</p>
                </div>
            </li>
        `;
    }
}

// for group member
async function getFriendByName(name) {
    try {
        const response = await fetch("../Controller/forMemberGroupList.php");
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }
        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }


        let filterData = data.filter((friend) => {
            return friend.name.toLowerCase().includes(name.toLowerCase());
        });
        
        

        // Render filtered friends list
        forMemberList.innerHTML = filterData.length > 0 ? filterData.map(friend => `
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
                <button type="button" id="${friend.userId}" class="addMemberBtn p-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                    Add
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
        forMemberList.innerHTML = `
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

// User Group 
async function getUserGroup() {
    try {
        const response = await fetch("../Controller/getUserGroup.php");
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }
        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        // Check if groups exist
        groupList.innerHTML = data.groups.length > 0 ? data.groups.map(group => `
            <li id="${group.groupId}" class="p-3 groupItem cursor-pointer rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-gray-900 flex items-center justify-between">
                <div class="flex items-center pointer-events-none">
                    <div class="relative">
                        <!-- Profile Image -->
                        <img class="w-12 h-12 object-cover rounded-full border-2 border-white dark:border-gray-800 transition-transform duration-200 hover:scale-105" 
                             src="../uploads/${group.groupProfile}" 
                             alt="${group.groupName}'s profile image">
                        
                        <!-- Online Status Indicator -->
                        <span class="bottom-0 left-7 absolute w-4 h-4 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full transition-opacity duration-200"></span>
                    </div>
                    <div class="ml-2">
                        <h4 class="font-bold text-black dark:text-white">${group.groupName}</h4>
                    </div>
                </div>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-black dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>
            </li>
        `).join('') : `
            <li class="flex items-center justify-center w-full h-96">
                <div class="flex flex-col justify-center items-center text-slate-500 dark:text-slate-300">
                    <i class="fa-solid fa-exclamation-triangle text-4xl mb-5"></i>
                    <p>Create New Group.</p>
                </div>
            </li>
        `;

    } catch (error) {
        console.error("Error fetching group list:", error);
        groupList.innerHTML = `
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

// Hero Section
const chatFriend = async (chooseId) => {
    const chatRoomHeader = document.querySelector("#chatRoomHeader");

    groupSendBtn.classList.add("hidden");
    sendBtn.classList.remove("hidden");

    sessionStorage.removeItem("messLength");

    try {
        const response = await fetch("../Controller/getFriendById.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                chooseId
            }), // Send the selected friend's ID
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }

        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        // Update the chat room header with the friend's details
        if (data.length > 0) {
            const friend = data[0]; // Assuming the first result is the friend
            chatRoomHeader.innerHTML = `
                <div class="flex items-center">
                    <!-- Close Chat Button (Visible on Mobile) -->
                    <button id="closeChat" class="mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 transition-opacity duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>

                    <!-- Friend's Profile Image -->
                    <div class="relative">
                        <img class="md:w-14 md:h-14 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/${friend.profileImage}" alt="${friend.name}'s profile image">
                    </div>

                    <!-- Friend's Name and Status -->
                    <div class="ml-2">
                        <h4 class="font-bold text-gray-800 dark:text-gray-100">${friend.name}</h4>
                        <span class="text-xs ${friend.status === 'Online' ? 'text-green-400' : 'text-gray-500 dark:text-gray-400'}">${friend.status}</span>
                    </div>
                </div>
            `;

            // Function to display messages dynamically
            function displayMessage(message) {

                const isSentByMe = message.send_id == userId;
                const messageElement = `
                    <div class="my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
                        <!-- Profile Image -->
                        <div class="chat-image avatar">
                            <div class="w-6 md:w-10 rounded-full">
                                <img alt="Profile image" src="../uploads/${message.profileImage}" />
                            </div>
                        </div>

                        <!-- Sender Name and Timestamp -->
                        <div class="chat-header dark:text-white">
                            ${isSentByMe ? 'You' : message.name}
                            <time class="text-xs opacity-50 text-gray-800 dark:text-gray-300">
                                ${new Date(message.createdAt).toLocaleString('en-US', {
                    month: 'short', // Short month name (e.g., "Oct")
                    day: 'numeric', // Day of the month (e.g., "5")
                    hour: 'numeric', // Hour (e.g., "3")
                    minute: '2-digit', // Minute (e.g., "07")
                    hour12: true // Use 12-hour format (e.g., "3:07 PM")
                })}
                            </time>
                        </div>

                        <!-- Message Bubble -->
                        <div class="chat-bubble  text-justify ${isSentByMe
                        ? 'bg-blue-500 text-white dark:bg-blue-600' // Sent message style
                        : 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' // Received message style
                    }">
                            ${message.message}
                        </div>

                        <!-- Message Status (Sent/Received) -->
                        <div class="chat-footer text-gray-700 opacity-50 dark:text-gray-300">
                            ${isSentByMe ? 'Sent' : 'Received'}
                        </div>
                    </div>
                `;

                messageShowCon.insertAdjacentHTML('beforeend', messageElement);

            }

            // Polling (alternative to WebSocket)
            setInterval(async () => {
                try {
                    const response = await fetch("../Controller/getMessage.php");
                    const messages = await response.json();
                    messageShowCon.innerHTML = "";

                    let messLength = sessionStorage.getItem("messLength");

                    await messages.forEach(displayMessage);

                    if (messLength != messages.length) {
                        messageShowCon.scrollTo({
                            top: messageShowCon.scrollHeight,
                            behavior: "smooth"
                        });
                        sessionStorage.setItem("messLength", messages.length)
                    }

                } catch (error) {
                    console.error("Error fetching messages:", error);
                }
            }, 1000);



        } else {
            chatRoomHeader.innerHTML = `<p class="text-gray-500 dark:text-gray-300">No friend found.</p>`;
        }
    } catch (error) {
        console.error("Error fetching friend details:", error);
        chatRoomHeader.innerHTML = `<p class="text-red-500 dark:text-red-300">Error loading friend details. Please try again.</p>`;
    }

    // Controll
    sideBar.classList.add("hidden");
    document.querySelector("#chatRoomCon").classList.remove("hidden");
    document.querySelector("#noSelect").classList.add("md:hidden");


    document.querySelector("#closeChat").addEventListener("click", () => {
        sideBar.classList.remove("hidden");
        document.querySelector("#chatRoomCon").classList.add("hidden");
        document.querySelector("#noSelect").classList.add("md:flex");
    })

};

// Function to send a message
async function sendMessage(message) {
    try {
        const response = await fetch("../Controller/sendMessage.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                message
            }),
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }

        const data = await response.json();
        if (data.success) {
            console.log("Message sent successfully!");
            sendMessageInput.value = ""; // Clear the input field
        } else {
            throw new Error(data.error || "Failed to send message");
        }
    } catch (error) {
        console.error("Error sending message:", error);
        alert("Failed to send message. Please try again.");
    }
}

//group chat Hero Section
const groupChat = async (chooseId) => {
    const chatRoomHeader = document.querySelector("#chatRoomHeader");

    groupSendBtn.classList.remove("hidden");
    sendBtn.classList.add("hidden");

    sessionStorage.removeItem("messLength");

    try {
        const response = await fetch("../Controller/getGroupById.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                chooseId
            }), // Send the selected group ID
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }

        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        // Update the chat room header with the group's details
        if (data.success && data.group) {
            const group = data.group; // Assuming data.group contains the group details
            chatRoomHeader.innerHTML = `
                <div class="flex items-center">
                    <!-- Close Chat Button (Visible on Mobile) -->
                    <button id="closeChat" class="mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 transition-opacity duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>

                    <!-- group's Profile Image -->
                    <div class="relative">
                        <img class="md:w-14 md:h-14 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/${group.groupProfile}" alt="${group.groupName}'s profile image">
                    </div>

                    <!-- group's Name and Status -->
                    <div class="ml-2">
                        <h4 class="font-bold text-gray-800 dark:text-gray-100">${group.groupName}</h4>
                        
                    </div>
                </div>
            `;

                        // Function to display messages dynamically
                        function displayMessage(message) {

                            const isSentByMe = message.sendId == userId;
                            const messageElement = `
                                <div class="my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
                                    <!-- Profile Image -->
                                    <div class="chat-image avatar">
                                        <div class="w-6 md:w-10 rounded-full">
                                            <img alt="Profile image" src="../uploads/${message.profileImage}" />
                                        </div>
                                    </div>
            
                                    <!-- Sender Name and Timestamp -->
                                    <div class="chat-header dark:text-white">
                                        ${isSentByMe ? 'You' : message.name}
                                        <time class="text-xs opacity-50 text-gray-800 dark:text-gray-300">
                                            ${new Date(message.createdAt).toLocaleString('en-US', {
                                month: 'short', // Short month name (e.g., "Oct")
                                day: 'numeric', // Day of the month (e.g., "5")
                                hour: 'numeric', // Hour (e.g., "3")
                                minute: '2-digit', // Minute (e.g., "07")
                                hour12: true // Use 12-hour format (e.g., "3:07 PM")
                            })}
                                        </time>
                                    </div>
            
                                    <!-- Message Bubble -->
                                    <div class="chat-bubble  text-justify ${isSentByMe
                                    ? 'bg-blue-500 text-white dark:bg-blue-600' // Sent message style
                                    : 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' // Received message style
                                }">
                                        ${message.message}
                                    </div>
            
                                    <!-- Message Status (Sent/Received) -->
                                    <div class="chat-footer text-gray-700 opacity-50 dark:text-gray-300">
                                        ${isSentByMe ? 'Sent' : 'Received'}
                                    </div>
                                </div>
                            `;
            
                            messageShowCon.insertAdjacentHTML('beforeend', messageElement);
            
                        }
            
                        // Polling (alternative to WebSocket)
                        setInterval(async () => {
                            try {
                                const response = await fetch("../Controller/getGroupMessage.php");
                                const messages = await response.json();
                                messageShowCon.innerHTML = "";
            
                                let messLength = sessionStorage.getItem("messLength");
            
                                await messages.forEach(displayMessage);
            
                                if (messLength != messages.length) {
                                    messageShowCon.scrollTo({
                                        top: messageShowCon.scrollHeight,
                                        behavior: "smooth"
                                    });
                                    sessionStorage.setItem("messLength", messages.length)
                                }
            
                            } catch (error) {
                                console.error("Error fetching messages:", error);
                            }
                        }, 1000);
        } else {
            chatRoomHeader.innerHTML = `<p class="text-gray-500 dark:text-gray-300">Group not found.</p>`;
        }
    } catch (error) {
        console.error("Error fetching group details:", error);
        chatRoomHeader.innerHTML = `<p class="text-red-500 dark:text-red-300">Error loading group details. Please try again.</p>`;
    }

    // Control visibility of chat elements
    sideBar.classList.add("hidden");
    document.querySelector("#chatRoomCon").classList.remove("hidden");
    document.querySelector("#noSelect").classList.add("md:hidden");

    document.querySelector("#closeChat").addEventListener("click", () => {
        sideBar.classList.remove("hidden");
        document.querySelector("#chatRoomCon").classList.add("hidden");
        document.querySelector("#noSelect").classList.add("md:flex");
    });
};

// Function to send a message
async function groupSendMessage(message) {
    try {
        const response = await fetch("../Controller/groupSendMessage.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                message
            }),
        });

        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }

        const data = await response.json();
        if (data.success) {
            console.log("Message sent successfully!");
            sendMessageInput.value = ""; // Clear the input field
        } else {
            throw new Error(data.error || "Failed to send message");
        }
    } catch (error) {
        console.error("Error sending message:", error);
        alert("Failed to send message. Please try again.");
    }
}

