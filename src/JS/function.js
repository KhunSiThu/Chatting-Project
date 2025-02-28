function openMobileSideBar() {
    sideBarMenu.classList.remove("hidden");
    sideBarMenu.classList.add("flex");
}

function closeMobileSideBar() {
    sideBarMenu.classList.add("hidden");
    sideBarMenu.classList.remove("flex");
}

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
                        <img class="w-12 h-12 object-cover rounded-full border-2 border-white dark:border-gray-800 transition-transform duration-200 hover:scale-105" src="../uploads/profiles/${friend.profileImage}" alt="${friend.name}'s profile image">
                    </div>
                        <div class="ml-2">
                        <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                        <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.lastMessage}</span>
                    </div>
                </div>
                 <!-- Online Status Indicator -->
                <span class="w-4 h-4 border-2 border-white dark:border-gray-800 rounded-full transition-opacity duration-200 ${friend.status !== 'Online' ? 'bg-slate-400' : 'bg-green-400'}"></span>
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
                        <img class="w-12 h-12 object-cover rounded-full border-2 border-white dark:border-gray-800 transition-transform duration-200 hover:scale-105" src="../uploads/profiles/${friend.profileImage}" alt="${friend.name}'s profile image">

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

async function addFriend(friendId) {
    try {
        const response = await fetch("../Controller/addFriend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                friendId: friendId, // Ensure the key matches what the server expects
            }),
        });

        // Check if the response is OK (status code 200-299)
        if (!response.ok) {
            const errorData = await response.json(); // Parse error response if available
            throw new Error(errorData.error || "Network response was not ok");
        }

        // Parse the JSON response
        const data = await response.json();

        // Check if the response contains a valid friendId
        if (data.friendId) {
            chatFriend(data.friendId); // Call chatFriend with the friendId
        } else {
            throw new Error("Invalid response: friendId not found");
        }
    } catch (error) {
        console.error("Error adding friend:", error.message);
        // Handle the error (e.g., show a notification to the user)
        alert("Failed to add friend: " + error.message);
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
                             src="../uploads/profiles/${group.groupProfile}" 
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
                const li = document.createElement("li");
                li.className = "p-3 rounded-md bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-900 flex items-center justify-between";
                li.innerHTML = `
                    <div class="flex items-center">
                        <div class="relative">
                            <img class="w-12 h-12 object-cover rounded-full" src="../uploads/profiles/${friend.profileImage}" alt="${friend.name}">
                        </div>
                        <div class="ml-2">
                            <h4 class="font-bold text-black dark:text-white">${friend.name}</h4>
                            <span class="text-xs opacity-50 text-gray-700 dark:text-gray-300">${friend.status}</span>
                        </div>
                    </div>
                    <button type="button" id="${friend.userId}" class="chatBtn p-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:hover:bg-blue-900">
                        Chat Now
                    </button>
                `;
                searchItems.appendChild(li);
            });

            const chatBtn = document.querySelectorAll(".chatBtn");
            chatBtn.forEach((btn) => {
                btn.addEventListener('click', () => {
                    let id = btn.getAttribute('id');
                    addFriend(id);
                })
            })
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


const scrollToBottom = (element) => {
    if (element) {
        element.scrollTo({
            top: element.scrollHeight,
            behavior: "smooth"
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    scrollToBottom(messageShowCon);
});

// Hero Section
const chatFriend = async (chooseId) => {

    const chatRoomHeader = document.querySelector("#chatRoomHeader");

    addMemberModal.classList.add("hidden")

    groupSendBtn.classList.add("hidden");
    sendBtn.classList.remove("hidden");


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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </button>

                    <!-- Friend's Profile Image -->
                    <div class="relative">
                        <img class="md:w-14 md:h-14 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/profiles/${friend.profileImage}" alt="${friend.name}'s profile image">
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

                // Display images if they exist
                const imagesHTML = message.images && message.images.length > 0
                    ? `<div class="mt-2 grid gap-2 ${message.images.length === 1 ? 'grid-cols-1' : 'grid-cols-2'}">
                            ${message.images.map(image => `
                                <img src="../uploads/images/${image}" alt="Attached Image" 
                                    class="rounded-lg max-w-full h-auto cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                    onclick="openImageModal('${image}')">
                            `).join('')}
                        </div>`
                    : '';

                // Display documents if they exist
                const filesHTML = message.files && message.files.length > 0
                    ? `<div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Attachments</h3>
                            <div class="flex flex-col gap-3">
                                ${message.files.map(file => {
                        const ext = file.split('.').pop().toLowerCase();
                        const filePath = `../uploads/documents/${file}`;
                        const fileIcon = {
                            'doc': 'https://cdn-icons-png.flaticon.com/512/300/300213.png', 'docx': 'https://cdn-icons-png.flaticon.com/512/300/300213.png',
                            'xls': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png', 'xlsx': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png',
                            'ppt': 'https://cdn-icons-png.flaticon.com/256/888/888874.png', 'pptx': 'https://cdn-icons-png.flaticon.com/256/888/888874.png',
                            'txt': 'https://cdn-icons-png.flaticon.com/512/10260/10260761.png', 'pdf': 'https://cdn-icons-png.flaticon.com/512/4726/4726010.png'
                        }[ext] || 'https://cdn-icons-png.flaticon.com/512/6811/6811255.png';

                        return `
                                        <div class="flex items-center justify-between p-3 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                                            <div class="flex items-center gap-3">
                                                <img class="w-6" src="${fileIcon}" alt="">
                                                <a href="${filePath}" target="_blank" class="text-blue-600 dark:text-blue-400 font-medium hover:underline">${file}</a>
                                            </div>
                                            <div class="flex gap-2">
                                                <a href="${filePath}" download 
                                                    class="flex items-center gap-2 px-5 py-2 text-sm text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-transform transform hover:scale-105  active:scale-95">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>`;
                    }).join('')}
                            </div>
                        </div>`
                    : '';

                // Display videos if they exist
                const videosHTML = message.videos && message.videos.length > 0
                    ? `<div class="mt-2 bg-slate-50 rounded-md grid gap-2 ${message.videos.length === 1 ? 'grid-cols-1' : 'grid-cols-2'}">
                        ${message.videos.map(video => {
                        const videoPath = `../uploads/videos/${video}`;
                        return `
                                <img src="https://followgreg.com/gregoryng/wp-content/uploads/2012/05/defaultThumbnail-overlay.png" alt="Video Thumbnail" 
                                    class="rounded-lg max-w-full h-auto cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                    onclick="openVideoModal('${videoPath}')">
                            `;
                    }).join('')}
                    </div>`
                    : '';


                // Construct the message element
                const messageElement = `
                        <div class="relative my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
                            <!-- Profile Image -->
                            <div class="chat-image avatar">
                                <div class="w-6 md:w-10 rounded-full">
                                    <img alt="Profile image" src="../uploads/profiles/${message.profileImage}" />
                                </div>
                            </div>

                            <!-- Sender Name and Timestamp -->
                            <div class="chat-header dark:text-white">
                                ${isSentByMe ? 'You' : message.name}
                                <time class="text-xs opacity-50 text-gray-800 dark:text-gray-300">
                                    ${new Date(message.createdAt).toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                })}
                                </time>
                            </div>

                            <!-- Message Bubble -->
                            <div id=${message.message_id} class="relative ${isSentByMe ? 'yourMessage' : ""} chat-bubble text-justify p-3 rounded-lg shadow-lg max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl 
                                ${isSentByMe ? 'bg-blue-400 text-white dark:bg-blue-400 self-end' : 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white self-start'}">  
                                
                                <p>${message.message}</p>

                                ${imagesHTML}
                                ${filesHTML}
                                ${videosHTML}

                            </div>

                            <!-- Message Status -->
                            <div class="chat-footer text-gray-700 opacity-50 dark:text-gray-300">
                                ${isSentByMe ? 'Sent' : 'Received'}
                            </div>
                        </div>
                    `;

                // Append the message element to the container
                messageShowCon.insertAdjacentHTML('beforeend', messageElement);
            }


            // Function to fetch and display messages
            async function fetchAndDisplayMessages() {
                try {
                    const response = await fetch("../Controller/getMessage.php");
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }

                    const data = await response.json();

                    // Check if the response contains the expected data
                    if (!data.success || !Array.isArray(data.messages)) {
                        throw new Error("Invalid response format: Expected an array of messages.");
                    }


                    // Track the number of messages in session storage
                    let messLength = sessionStorage.getItem("messLength");

                    // Clear the message container
                    messageShowCon.innerHTML = "";

                    // Display each message
                    data.messages.forEach(displayMessage);

                    // Delete Message

                    const yourMessage = document.querySelectorAll(".yourMessage");

                    yourMessage.forEach(btn => {
                        btn.addEventListener("contextmenu", (e) => {
                            e.preventDefault();
                            let id = btn.getAttribute("id");
                            messDropdown.classList.remove("hidden");

                            deleteMessageBtn.addEventListener("click", async () => {
                                try {
                                    const res = await fetch("../Controller/deleteMessage.php", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({ id })
                                    });

                                    if (!res.ok) {
                                        throw new Error("Network response was not ok");
                                    }

                                    const data = await res.json();

                                    if (data.success) {
                                        messDropdown.classList.add("hidden");
                                        e.target.remove();
                                    }
                                } catch (error) {
                                    console.error("Error deleting message:", error);
                                }
                            })
                        });
                    });
                    // Scroll to the bottom if new messages are added
                    if (messLength != data.messages.length) {
                        scrollToBottom(messageShowCon);
                        sessionStorage.setItem("messLength", data.messages.length);
                    }

                } catch (error) {
                    console.error("Error fetching messages:", error);
                }
            }



            // Function to initialize polling
            function startPolling() {

                // Start polling every second
                const pollingInterval = setInterval(fetchAndDisplayMessages, 1000);

                // Optionally, stop polling when the user navigates away from the page
                window.addEventListener("beforeunload", () => {
                    clearInterval(pollingInterval);
                });
            }

            // Start polling when the script loads
            startPolling();


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
    document.querySelector("#noSelect").classList.add("hidden");


    document.querySelector("#closeChat").addEventListener("click", () => {
        sideBar.classList.remove("hidden");
        document.querySelector("#chatRoomCon").classList.add("hidden");
        document.querySelector("#noSelect").classList.add("md:flex");
    })

};

//group chat Hero Section
const groupChat = async (chooseId) => {
    const chatRoomHeader = document.querySelector("#chatRoomHeader");

    groupSendBtn.classList.remove("hidden");
    sendBtn.classList.add("hidden");

    chatRoomHeader.innerHTML = "";
    messageShowCon.innerHTML = "";


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
        if (data.success && data.group && data.members) {
            let membersHTML = '';

            data.members.forEach((member, index) => {
                const isAdmin = index === 0 ? 'Admin' : ''; // First member is admin
                membersHTML += `
                    <li>
                        <div class="flex pointer-events-auto items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="relative">
                                <!-- Profile Image -->
                               <img class="w-6 h-6 me-2 object-cover rounded-full" src="../uploads/profiles/${member.profileImage}" alt="${member.name} image">

                                <!-- Online Status Indicator -->
                                <span class="bottom-0 left-4 absolute w-2 h-2 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full transition-opacity duration-200 ${member.status !== 'Online' ? 'opacity-0' : 'opacity-100'}"></span>
                            </div>
                            
                            <div class="flex w-full ml-2 justify-between items-center">
                                <h2 class='text-sm'>${member.name}</h2> <span class="text-green-500  text-xs">${isAdmin}</span>
                            </div>
                        </div>
                    </li>
                `;
            });

            const group = data.group; // Assuming data.group contains the group details
            chatRoomHeader.innerHTML = `
                <div class="flex items-center">
                    <!-- Close Chat Button (Visible on Mobile) -->
                    <button id="closeChat" class="mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 transition-opacity duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </button>

                    <!-- group's Profile Image -->
                    <div class="relative">
                        <img class="md:w-12 md:h-12 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/profiles/${group.groupProfile}" alt="${group.groupName}'s profile image">
                    </div>

                    <!-- group's Name and Status -->
                    <div class="ml-2 flex justify-center flex-col">
                        <h4 class="font-bold text-gray-800 dark:text-gray-100">${group.groupName}</h4>
                        <div>

                            <button id="memberListShowBtn" class="text-black dark:text-white text-xs " type="button">
                            ${data.members.length} members
                            </button>

                            <!-- Dropdown menu -->
                            <div id="memberListCon" class="hidden w-full h-screen absolute top-0 left-0 flex justify-center items-center bg-blur">
                                <div  class="fixed flex flex-col items-end  mt-5 z-50 bg-gray-100 rounded-lg shadow-lg w-80 dark:bg-gray-700">
                                    <h3 class="text-center text-black dark:text-white my-5 w-full">Group Members</h3>
                                    <ul id="memberListShow" class="h-60 w-full py-3 overflow-y-auto border-b bg-gray-200 dark:bg-gray-800 dark:border-gray-500 text-gray-700 bg-blur dark:text-gray-200 pointer-events-none" >

                                    ${membersHTML}
                                        
                                    </ul>
                                    <button id='HAddMemberMenuBtn' class="flex items-center p-2 m-2 text-sm font-medium text-blue-600  rounded-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-blue-500 hover:underline">
                                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                        </svg>
                                        Add new user
                                    </button>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="dropdown dropdown-bottom dropdown-end">
                    <div tabindex="0" role="button" class="m-1 text-black dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                        </svg>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded z-[1] w-52 p-2 shadow dark:bg-gray-700 dark:text-white">
                        <li>
                            <button id='manageGroupMenu' class="hover:bg-gray-200 dark:hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>
                                <span>Manage Group</span>
                            </button>
                        </li>
                        <li>
                            <button id="showMemberMenu" class="hover:bg-gray-200 dark:hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <span>Group Members</span>
                            </button>
                        </li>
                        <li>
                            <button id="addGroupMemberMenu" class="hover:bg-gray-200 dark:hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                <span>Add Member</span>
                            </button>
                        </li>
                        <li>
                            <button id="openLeaveGroupModal" class="hover:bg-gray-200 dark:hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>
                                <span>Leave Group</span>
                            </button>
                        </li>
                    </ul>
                </div>
            `;

            memberListShowBtn.addEventListener("click", () => {
                memberListCon.classList.remove("hidden");
            });

            showMemberMenu.addEventListener("click", () => {
                memberListCon.classList.remove("hidden");
            });

            editGroupModal.innerHTML = `
                <div class="bg-gray-800 text-gray-200 p-6 rounded-lg shadow-lg w-96">
                    <h1 class="mb-5 text-lg text-center">Edit Group Profile</h1>
                    <div class="flex justify-center relative">
                        <!-- Profile Upload -->
                        <label for="groupProfileChange" class="cursor-pointer">
                            <div class="bg-blue-500  flex items-center rounded-full  justify-center">
                            <img id="changeGroupProfile" src="../uploads/profiles/${group.groupProfile}"
                                alt="group-icon" class="p-1 object-cover rounded-full w-16 h-16">
                            </div>
                        </label>
                        <input type="file" id="groupProfileChange" accept="image/*" class="hidden">
                    </div>
                    <h4 class="text-center  mt-4">Group Profile</h4>
                    <input id="changeGroupName" type="text"
                        class="w-full my-2 p-2 border-b bg-transparent focus:outline-none focus:border-blue-500" value="${group.groupName}"
                        placeholder="Enter group name">
                    <div class="flex justify-end mt-4">
                        <button id="${group.groupId}" class="saveEdifBtn text-blue-400 hover:text-blue-300">Save Edit</button>
                    </div>
                </div>
            `

            manageGroupMenu.addEventListener("click", () => {
                editGroupModal.classList.remove("hidden");
            })

            const changeGroupProfile = document.getElementById('changeGroupProfile');

            // Profile Image Upload
            groupProfileChange.addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        changeGroupProfile.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Upload group profile!")
                }
            });

            addGroupMemberMenu.addEventListener("click", () => {
                addMemberModal.classList.remove("hidden");
                getFriendByName("");
            });

            HAddMemberMenuBtn.addEventListener("click", () => {
                addMemberModal.classList.remove("hidden");
                getFriendByName("");
            });

            editGroupModal.addEventListener("click", (e) => {
                if (e.target.classList.contains("saveEdifBtn")) {
                    const groupId = e.target.getAttribute("id");
                    const groupName = document.getElementById("changeGroupName").value;
                    const groupProfileFile = document.getElementById("groupProfileChange").files[0];

                    const formData = new FormData();
                    formData.append("groupId", groupId);
                    formData.append("groupName", groupName);
                    if (groupProfileFile) {
                        formData.append("groupProfileImage", groupProfileFile);
                    }

                    fetch("../Controller/updateGroupProfile.php", {
                        method: "POST",
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {

                                editGroupModal.classList.add("hidden");
                                // You might want to reload the group details here
                                groupChat(groupId); // Reload the group chat with updated details
                            } else {
                                alert("Failed to update group: " + data.error);
                            }
                        })
                        .catch(error => {
                            console.error("Error updating group:", error);
                            alert("An error occurred while updating the group.");
                        });
                }
            });

            // Get the modal element
            const leaveGroupModal = document.getElementById('leaveGroupModal');

            // Get the buttons to open and close the modal
            const openModalButton = document.getElementById('openLeaveGroupModal'); // Add this button in your HTML
            const closeModalButton = leaveGroupModal.querySelector('#sureLeave');
            const cancelButton = leaveGroupModal.querySelector('#cancelLeave'); // "No, cancel" button
            const confirmButton = leaveGroupModal.querySelector('.bg-red-600'); // "Yes, I'm sure" button

            // Function to open the modal
            function openModal() {
                leaveGroupModal.classList.remove('hidden');
                leaveGroupModal.classList.add('flex');
            }

            // Function to close the modal
            function closeModal() {
                leaveGroupModal.classList.remove('flex');
                leaveGroupModal.classList.add('hidden');
            }

            // Event listener to open the modal
            if (openModalButton) {
                openModalButton.addEventListener('click', openModal);
            }

            // Event listener to close the modal when clicking the close button
            if (closeModalButton) {
                closeModalButton.addEventListener('click', closeModal);
            }

            if (cancelButton) {
                cancelButton.addEventListener('click', closeModal);
            }

            if (confirmButton) {
                confirmButton.addEventListener("click", () => {
                    fetch("../Controller/leaveGroup.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ action: "leave" }),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                showCustomAlert("You have left the group.");
                                closeModal(); // Close the modal after confirmation
                            } else {
                                alert("Failed to leave the group: " + data.error);
                            }
                        })
                        .catch((error) => {
                            console.error("Error leaving group:", error);
                            alert("An error occurred while leaving the group.");
                        });
                });
            }


            window.addEventListener('click', (event) => {
                if (event.target === leaveGroupModal) {
                    closeModal();
                }
            });

            const displayMessage = (message) => {
                const isSentByMe = message.sendId == userId;

                const imagesHTML = message.images && message.images.length > 0
                    ? `<div class="mt-2 grid gap-2 ${message.images.length === 1 ? 'grid-cols-1' : 'grid-cols-2'}">
                        ${message.images.map(image => `
                            <img src="../uploads/images/${image}" alt="Attached Image" 
                                class="rounded-lg max-w-full h-auto cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                onclick="openImageModal('${image}')">
                        `).join('')}
                      </div>`
                    : '';

                const filesHTML = message.files && message.files.length > 0
                    ? `<div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Attachments</h3>
                        <div class="flex flex-col gap-3">
                            ${message.files.map(file => {
                        const ext = file.split('.').pop().toLowerCase();
                        const filePath = `../uploads/documents/${file}`;
                        const fileIcon = {
                            'doc': 'https://cdn-icons-png.flaticon.com/512/300/300213.png',
                            'docx': 'https://cdn-icons-png.flaticon.com/512/300/300213.png',
                            'xls': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png',
                            'xlsx': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png',
                            'ppt': 'https://cdn-icons-png.flaticon.com/256/888/888874.png',
                            'pptx': 'https://cdn-icons-png.flaticon.com/256/888/888874.png',
                            'txt': 'https://cdn-icons-png.flaticon.com/512/10260/10260761.png',
                            'pdf': 'https://cdn-icons-png.flaticon.com/512/4726/4726010.png'
                        }[ext] || 'https://cdn-icons-png.flaticon.com/512/6811/6811255.png';

                        return `
                                    <div class="flex items-center justify-between p-3 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                                        <div class="flex items-center gap-3">
                                            <img class="w-6" src="${fileIcon}" alt="">
                                            <a href="${filePath}" target="_blank" class="text-blue-600 dark:text-blue-400 font-medium hover:underline">${file}</a>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="${filePath}" download 
                                                class="flex items-center gap-2 px-5 py-2 text-sm text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-transform transform hover:scale-105  active:scale-95">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>`;
                    }).join('')}
                        </div>
                      </div>`
                    : '';

                // Display videos if they exist
                const videosHTML = message.videos && message.videos.length > 0
                    ? `<div class="mt-2 bg-slate-50 rounded-md grid gap-2 ${message.videos.length === 1 ? 'grid-cols-1' : 'grid-cols-2'}">
                    ${message.videos.map(video => {
                        const videoPath = `../uploads/videos/${video}`;
                        return `
                            <img src="https://followgreg.com/gregoryng/wp-content/uploads/2012/05/defaultThumbnail-overlay.png" alt="Video Thumbnail" 
                                class="rounded-lg max-w-full h-auto cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                onclick="openVideoModal('${videoPath}')">
                        `;
                    }).join('')}
                </div>`
                    : '';

                const formattedTime = new Date(message.createdAt).toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });

                const messageElement = `
                    <div class="my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
                        <div class="chat-image avatar">
                            <div class="w-6 md:w-10 rounded-full">
                                <img alt="Profile image" src="../uploads/profiles/${message.profileImage}" />
                            </div>
                        </div>
                        <div class="chat-header dark:text-white">
                            ${isSentByMe ? 'You' : message.name}
                            <time class="text-xs opacity-50 text-gray-800 dark:text-gray-300">${formattedTime}</time>
                        </div>
                        <div id=${message.messageId} class="chat-bubble ${isSentByMe ? 'yourMessage' : ""} text-justify p-3 rounded-lg shadow-md max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl 
                            ${isSentByMe ? 'bg-blue-400 text-white dark:bg-blue-400 self-end' : 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white self-start'}">  
                            <p>${message.message}</p>
                            ${imagesHTML}
                            ${filesHTML}
                             ${videosHTML}
                        </div>
                        <div class="chat-footer text-gray-700 opacity-50 dark:text-gray-300">
                            ${isSentByMe ? 'Sent' : 'Received'}
                        </div>
                    </div>
                `;

                messageShowCon.insertAdjacentHTML('beforeend', messageElement);

            };

            // Function to fetch and display messages
            const fetchAndDisplayMessages = async () => {
                try {
                    const response = await fetch("../Controller/getGroupMessage.php");
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();
                    if (!data.success || !Array.isArray(data.messages)) {
                        throw new Error("Invalid response format");
                    }

                    // Track the number of messages in session storage
                    let messLength = sessionStorage.getItem("messLength");

                    // Clear the message container
                    messageShowCon.innerHTML = "";


                    // Delete Message

                    // Display each message
                    data.messages.forEach(displayMessage);

                    // Delete Message

                    const yourMessage = document.querySelectorAll(".yourMessage");

                    yourMessage.forEach(btn => {
                        btn.addEventListener("contextmenu", (e) => {
                            e.preventDefault();
                            let id = btn.getAttribute("id");
                            messDropdown.classList.remove("hidden");

                            deleteMessageBtn.addEventListener("click", async () => {
                                try {
                                    const res = await fetch("../Controller/deleteGroupMessage.php", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({ id })
                                    });

                                    if (!res.ok) {
                                        throw new Error("Network response was not ok");
                                    }

                                    const data = await res.json();

                                    if (data.success) {
                                        messDropdown.classList.add("hidden");
                                        e.target.remove();
                                    }
                                } catch (error) {
                                    console.error("Error deleting message:", error);
                                }
                            })
                        });
                    });

                    // Scroll to the bottom if new messages are added
                    if (messLength != data.messages.length) {
                        scrollToBottom(messageShowCon);
                        sessionStorage.setItem("messLength", data.messages.length);
                    }
                } catch (error) {
                    console.error("Error fetching messages:", error);
                }
            };

            const startPolling = () => {

                // Start polling every second
                const pollingInterval = setInterval(fetchAndDisplayMessages, 1000);

                // Optionally, stop polling when the user navigates away from the page
                window.addEventListener("beforeunload", () => {
                    clearInterval(pollingInterval);
                });
            };

            // Start polling when the script loads
            startPolling();




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
    document.querySelector("#noSelect").classList.add("hidden");

    document.querySelector("#closeChat").addEventListener("click", () => {
        sideBar.classList.remove("hidden");
        document.querySelector("#chatRoomCon").classList.add("hidden");
        document.querySelector("#noSelect").classList.add("flex");
    });
};

function openImageModal(imageSrc) {
    const modal = `
        <div id="openImageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-lg" onclick="closeImageModal()">
            <div class="relative w-full h-full flex items-center justify-center">
                <img src="../uploads/images/${imageSrc}" alt="Enlarged Image" class="max-w-full max-h-full object-contain p-3 md:p-10">
                <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-75 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button onclick="saveImage('${imageSrc}')" class="absolute bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Save Image
                </button>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modal);
}

function openVideoModal(videoSrc) {
    const modal = `
        <div id="openImageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-lg" onclick="closeImageModal()">
            <div class="relative w-full h-full flex items-center justify-center">
                <video controls class="max-w-full max-h-full object-contain p-3 md:p-10">
                    <source src="${videoSrc}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
               
                <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-75 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <a href="${videoSrc}" download class="absolute bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Save Video
                </a>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modal);
}

function closeImageModal() {
    const modal = document.getElementById('openImageModal');
    if (modal) {
        modal.remove();
    }
}

function saveImage(imageSrc) {
    const link = document.createElement('a');
    link.href = `../Controller/uploads/images/${imageSrc}`;
    link.download = 'downloaded_image.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

async function sendMessage() {
    const messageInput = document.getElementById("sendMessage");
    const fileInputs = {
        images: document.getElementById("sendImage"),
        documents: document.getElementById("sendFile"),
        videos: document.getElementById("sendVideo"),
    };
    const formData = new FormData();

    // File size limits (in bytes)
    const FILE_LIMITS = {
        images: { maxSize: 5 * 1024 * 1024, maxCount: 5, field: "image_files[]" },
        documents: { maxSize: 10 * 1024 * 1024, maxCount: 10, field: "document_files[]" },
        videos: { maxSize: 100 * 1024 * 1024, maxCount: 1, field: "video_files[]" },
    };

    if (messageInput.value.trim()) {
        formData.append("message", messageInput.value.trim());
    }

    // Validate and append files
    for (const [key, input] of Object.entries(fileInputs)) {
        if (input.files.length > 0) {
            if (input.files.length > FILE_LIMITS[key].maxCount) {
                alert(`You can upload a maximum of ${FILE_LIMITS[key].maxCount} ${key}.`);
                return;
            }

            for (const file of input.files) {
                if (file.size > FILE_LIMITS[key].maxSize) {
                    alert(`${key.charAt(0).toUpperCase() + key.slice(1)} ${file.name} exceeds the maximum size of ${FILE_LIMITS[key].maxSize / (1024 * 1024)}MB.`);
                    return;
                }
                formData.append(FILE_LIMITS[key].field, file);
            }
        }
    }

    // If no message and no files, return
    if (!formData.has("message") && !Object.values(FILE_LIMITS).some(limit => formData.has(limit.field))) {
        return;
    }

    try {
        const response = await fetch("../Controller/sendMessage.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error(`Network error: ${response.statusText}`);

        const data = await response.json();
        if (!data.success) throw new Error(data.error || "Failed to send message");

        console.log("Message sent successfully!");
        messageInput.value = "";
        Object.values(fileInputs).forEach(input => (input.value = ""));
    } catch (error) {
        console.error("Error sending message:", error);
        alert("Failed to send message. Please try again.");
    }
}

// Function to send a message
async function groupSendMessage() {
    const messageInput = document.getElementById("sendMessage");
    const fileInputs = {
        images: document.getElementById("sendImage"),
        documents: document.getElementById("sendFile"),
        videos: document.getElementById("sendVideo"),
    };
    const formData = new FormData();

    // File size limits (in bytes)
    const FILE_LIMITS = {
        images: { maxSize: 5 * 1024 * 1024, maxCount: 5, field: "image_files[]" },
        documents: { maxSize: 10 * 1024 * 1024, maxCount: 10, field: "document_files[]" },
        videos: { maxSize: 100 * 1024 * 1024, maxCount: 1, field: "video_files[]" },
    };

    if (messageInput.value.trim()) {
        formData.append("message", messageInput.value.trim());
    }

    // Validate and append files
    for (const [key, input] of Object.entries(fileInputs)) {
        if (input.files.length > 0) {
            if (input.files.length > FILE_LIMITS[key].maxCount) {
                alert(`You can upload a maximum of ${FILE_LIMITS[key].maxCount} ${key}.`);
                return;
            }

            for (const file of input.files) {
                if (file.size > FILE_LIMITS[key].maxSize) {
                    alert(`${key.charAt(0).toUpperCase() + key.slice(1)} ${file.name} exceeds the maximum size of ${FILE_LIMITS[key].maxSize / (1024 * 1024)}MB.`);
                    return;
                }
                formData.append(FILE_LIMITS[key].field, file);
            }
        }
    }

    // If no message and no files, return
    if (!formData.has("message") && !Object.values(FILE_LIMITS).some(limit => formData.has(limit.field))) {
        return;
    }

    try {
        const response = await fetch("../Controller/groupSendMessage.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error(`Network error: ${response.statusText}`);

        const data = await response.json();
        if (!data.success) throw new Error(data.error || "Failed to send message");

        console.log("Message sent successfully!");
        messageInput.value = "";
        Object.values(fileInputs).forEach(input => (input.value = ""));

    } catch (error) {
        console.error("Error sending message:", error);
        alert("Failed to send message. Please try again.");
    }
}

// ======================== UPLOAD POST ========================
// Function to upload a post
async function uploadPost() {
    let type = sessionStorage.getItem("type");
    const fileInputs = {
        images: document.getElementById("photo-input"),
        documents: document.getElementById("doc-input"),
        videos: document.getElementById("video-input"),
    };

    const formData = new FormData();
    const caption = document.getElementById("caption");

    const FILE_LIMITS = {
        images: { maxSize: 5 * 1024 * 1024, maxCount: 10, field: "image_files[]" },
        documents: { maxSize: 10 * 1024 * 1024, maxCount: 10, field: "document_files[]" },
        videos: { maxSize: 100 * 1024 * 1024, maxCount: 1, field: "video_files[]" },
    };

    if (caption && caption.value.trim()) {
        formData.append("caption", caption.value.trim());
    }

    if (type) {
        formData.append("type", type);
    } else {
        formData.append("type", "post");
    }

    for (const [key, input] of Object.entries(fileInputs)) {
        if (!input || !input.files || input.files.length === 0) continue;

        if (input.files.length > FILE_LIMITS[key].maxCount) {
            alert(`You can upload a maximum of ${FILE_LIMITS[key].maxCount} ${key}.`);
            return;
        }

        for (const file of input.files) {
            if (file.size > FILE_LIMITS[key].maxSize) {
                alert(`${key.charAt(0).toUpperCase() + key.slice(1)} ${file.name} exceeds the maximum size of ${FILE_LIMITS[key].maxSize / (1024 * 1024)}MB.`);
                return;
            }
            formData.append(FILE_LIMITS[key].field, file);
        }
    }

    if (!formData.has("caption") && !Object.values(FILE_LIMITS).some(limit => formData.has(limit.field))) {
        alert("Please provide a caption or upload at least one file.");
        return;
    }

    try {
        const response = await fetch("../Controller/uploadPost.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error(`Network error: ${response.statusText}`);

        const data = await response.json();

        if (data.success) {
            sessionStorage.removeItem("type");
            sessionStorage.setItem("filterType", 'all');
            location.reload();

        } else {
            throw new Error(data.error || "Failed to upload post.");
        }
    } catch (error) {
        console.error("Error uploading post:", error);
        alert("Failed to upload post. Please try again.");
    }
}

// Function to create an image gallery
function createImageGallery(images) {
    return `
        <div class="grid grid-cols-${Math.min(images.length, 2)} gap-1 mt-3 relative">
            ${images.slice(0, 4).map((photo, index) => `
                <a href="javascript:void(0);" data-images='${JSON.stringify(images)}' data-index='${index}' class="gallery-trigger relative">
                    <img src="../posts/images/${photo}" class="w-full object-cover rounded-lg ${images.length === 1 ? 'md:h-[600px] h-[220px]' : 'md:h-80 h-32 '} ${index === 3 && images.length > 4 ? 'opacity-50' : ''}" />
                    ${index === 3 && images.length > 4 ? `
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-2xl font-bold">
                            +${images.length - 4}
                        </div>
                    ` : ''}
                </a>
            `).join('')}
        </div>
    `;
}

// Function to setup gallery event listeners
function setupGalleryEventListeners() {
    document.querySelectorAll('.gallery-trigger').forEach(trigger => {
        trigger.addEventListener('click', function () {
            const images = JSON.parse(this.dataset.images);
            const currentIndex = parseInt(this.dataset.index);
            openGallery(images, currentIndex);
        });
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") closeGallery();
    });

    document.getElementById("prevImageButton")?.addEventListener("click", prevImage);
    document.getElementById("nextImageButton")?.addEventListener("click", nextImage);
    document.getElementById("closeGalleryButton")?.addEventListener("click", closeGallery);
}

let galleryImages = [];
let currentImageIndex = 0;

function openGallery(images, index) {
    galleryImages = images;
    currentImageIndex = index;
    document.getElementById("galleryModal").classList.remove("hidden");
    updateGalleryImage();
}

function closeGallery() {
    document.getElementById("galleryModal").classList.add("hidden");
}

function updateGalleryImage() {
    const imageUrl = `../posts/images/${galleryImages[currentImageIndex]}`;
    document.getElementById("galleryImage").src = imageUrl;

    const saveButton = document.getElementById("saveImageButton");
    saveButton.href = imageUrl;
    saveButton.download = `image-${currentImageIndex}.jpg`;
}

function prevImage() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
        updateGalleryImage();
    }
}

function nextImage() {
    if (currentImageIndex < galleryImages.length - 1) {
        currentImageIndex++;
        updateGalleryImage();
    }
}

// Function to create a video element
function createVideoElement(video) {
    return `
        <div class="grid grid-cols-1 gap-1 mt-3 relative">
            <a href="javascript:void(0);" data-videos='${JSON.stringify([video])}' data-index='0' class="gallery-trigger relative">
                <video class="w-full object-cover rounded-lg">
                    <source src="../posts/videos/${video}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
        </div>
    `;
}

function openPostMenu(id) {
    const postMenu = document.getElementById("postMenu" + id);
    if (postMenu.classList.contains("hidden")) {
        postMenu.classList.remove("hidden");
    } else {
        postMenu.classList.add("hidden");
    }
}

function openEditPostModal(postId) {
    const modal = document.getElementById("editPostModal");
    const modalContent = document.getElementById("editPostContent");
    const saveButton = document.getElementById("saveEditPost");

    // Store post ID in modal's dataset
    modal.dataset.postId = postId;

    // Show modal
    modal.classList.remove("hidden");
    setTimeout(() => modal.classList.add("opacity-100"), 10);

    // Fetch post details
    fetch(`../Controller/getPost.php?post_id=${postId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalContent.value = data.caption;
            } else {
                alert("Error fetching post details.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to fetch post details.");
        });

    // Close modal when clicking outside
    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeEditPostModal();
    });

    // Close modal with Esc key
    document.addEventListener("keydown", handleEscapeKey);
}

function closeEditPostModal() {
    const modal = document.getElementById("editPostModal");

    // Hide modal with animation
    modal.classList.remove("opacity-100");
    setTimeout(() => modal.classList.add("hidden"), 200);

    // Remove Esc key event listener
    document.removeEventListener("keydown", handleEscapeKey);
}

function handleEscapeKey(e) {
    if (e.key === "Escape") {
        closeEditPostModal();
    }
}

function saveEditedPost() {
    const modal = document.getElementById("editPostModal");
    const postId = modal.dataset.postId; // Get post ID from modal's data attribute
    const updatedCaption = document.getElementById("editPostContent").value.trim();

    if (!updatedCaption) {
        alert("Caption cannot be empty.");
        return;
    }

    fetch("../Controller/updatePost.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            post_id: postId,
            caption: updatedCaption
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditPostModal();
                sessionStorage.setItem("saveEdit", postId);
                location.reload();
            } else {
                alert("Error updating post: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to update post. Please try again.");
        });
}

// Delete Post //

function openDeletePostModal(postId) {
    const modal = document.getElementById("deletePostModal");
    modal.classList.remove("hidden");

    // Set event listener for delete confirmation button
    document.getElementById("confirmDeletePost").onclick = function () {
        deletePost(postId);
    };

    // Listen for Escape key
    document.addEventListener("keydown", handleDeleteModalEscape);
}

function closeDeletePostModal() {
    document.getElementById("deletePostModal").classList.add("hidden");
    document.removeEventListener("keydown", handleDeleteModalEscape);
}

// Close modal with Esc key
function handleDeleteModalEscape(event) {
    if (event.key === "Escape") {
        closeDeletePostModal();
    }
}

// Function to send delete request
function deletePost(postId) {
    fetch("../Controller/deletePost.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ post_id: postId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                sessionStorage.setItem("saveEdit",postId-1)
                closeDeletePostModal();
                location.reload(); // Reload to reflect changes
            } else {
                alert("Error deleting post: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to delete post. Please try again.");
        });
}


// Function to create a post element//
function createPostElement(post) {
    const postElement = document.createElement('a');
    postElement.id = "Post" + post.post_id;
    postElement.className = 'bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow';

    let display = userId === post.user_id ? "block" : "hidden";


    const userInfo = `
        <div class="flex justify-between items-center relative">
            <div class="flex items-center md:space-x-3 space-x-1">
                <img src="../uploads/profiles/${post.profileImage}" class="w-8 h-8 object-cover rounded-full" />
                <div>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">${post.name}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">${post.createdAt}</p>
                </div>
            </div>
            <button onclick="openPostMenu(${post.post_id})" class='focus:outline-none'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div  id="postMenu${post.post_id}" class="z-20 postMenu absolute right-0 top-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm  dark:bg-gray-700 dark:divide-gray-600">
                <ul class="p-2 text-sm text-gray-700 dark:text-gray-200" >
                    <li class="">
                        <button class="flex items-center w-full  p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span>Save Post</span>
                        </button>
                    </li>
                    <li class="${display}">
                        <button onclick="openEditPostModal(${post.post_id})" class="flex items-center w-full  p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span>Edit Caption</span>
                        </button>
                    </li>
                    <li class="${display}">
                        <button onclick="openDeletePostModal(${post.post_id})" class="flex items-center w-full  p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Delete Post</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
            `;

    const caption = `
        <p class="my-5 text-gray-800 dark:text-gray-200">
            ${post.caption.replace(/\n/g, '<br>')}
        </p>
    `;

    let mediaContent = '';
    if (post.images.length > 0) {
        mediaContent = createImageGallery(post.images);
    } else if (post.videos.length > 0) {
        mediaContent = createVideoElement(post.videos[0]); // Use the createVideoElement function here
    } else if (post.files.length > 0) {
        mediaContent = createFileElements(post.files);
    }

    const likeCommentSection = createLikeCommentSection(post.post_id, post.profileImage);

    postElement.innerHTML = userInfo + caption + mediaContent + likeCommentSection;
    return postElement;
}

// Function to create file elements
function createFileElements(files) {
    return `
        <div class="grid md:grid-cols-2 gap-3 h-full">
            ${files.map(file => {
        const ext = file.split('.').pop().toLowerCase();
        const filePath = `../posts/documents/${file}`;
        const fileIcon = {
            'doc': 'https://cdn-icons-png.flaticon.com/512/300/300213.png',
            'docx': 'https://cdn-icons-png.flaticon.com/512/300/300213.png',
            'xls': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png',
            'xlsx': 'https://cdn-icons-png.flaticon.com/256/3699/3699883.png',
            'ppt': 'https://cdn-icons-png.flaticon.com/256/888/888874.png',
            'pptx': 'https://cdn-icons-png.flaticon.com/256/888/888874.png',
            'txt': 'https://cdn-icons-png.flaticon.com/512/10260/10260761.png',
            'pdf': 'https://cdn-icons-png.flaticon.com/512/4726/4726010.png'
        }[ext] || 'https://cdn-icons-png.flaticon.com/512/6811/6811255.png';

        return `
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg shadow">
                        <div class="flex items-center gap-3">
                            <img class="md:w-20 w-8" src="${fileIcon}" alt="">
                            <a href="${filePath}" target="_blank" class="text-blue-600 dark:text-blue-400 font-medium hover:underline">${file}</a>
                        </div>
                        <div class="flex gap-2">
                            <a href="${filePath}" download 
                                class="flex items-center gap-2 px-5 py-2 text-sm text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-transform transform hover:scale-105  active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                        </div>
                    </div>`;
    }).join('')}
        </div>
    `;
}


// Function to add a like
async function addLike(id) {
    try {
        const response = await fetch('../Controller/addLike.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id }),
        });

        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const data = await response.json();
        console.log('Server response:', data);

        if (data.success) {
            fetchLikeCounts();
        } else {
            alert('Failed to update like: ' + data.error);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while updating the like.');
    }
}

// Function to get all posts
async function getAllPosts(check, filter, search) {
    try {
        const postContainer = document.querySelector('#postsContainer');
        postContainer.innerHTML = '';

        const response = check
            ? await fetch('../Controller/getUserPosts.php')
            : await fetch('../Controller/getAllPosts.php');

        const posts = await response.json();

        if (!posts.length) {
            postContainer.innerHTML = '<p class="text-center text-gray-500 dark:text-gray-400">No posts available.</p>';
            return;
        }

        // Convert search query to lowercase if provided
        const searchQuery = search ? search.toLowerCase() : null;

        // Filtering logic
        let filteredPosts = posts;

        if (filter) {
            filteredPosts = filteredPosts.filter(post => post.type === filter);
        }

        if (searchQuery) {
            filteredPosts = filteredPosts.filter(post =>
                post.caption.toLowerCase().includes(searchQuery) ||
                post.name.toLowerCase().includes(searchQuery)
            );
        }

        // Display filtered posts
        if (filteredPosts.length) {
            filteredPosts.forEach(post => {
                const postElement = createPostElement(post);
                postContainer.appendChild(postElement);
            });

            setupEventListeners(); // Only setup if there are valid posts

            const saveEdit = sessionStorage.getItem("saveEdit");

            if (saveEdit) {
                setTimeout(() => {
                    const targetPost = document.getElementById("Post" + saveEdit);
                    
                    if (targetPost) {
                        targetPost.scrollIntoView({ behavior: "smooth", block: "center" });
                        sessionStorage.removeItem("saveEdit"); // Remove after scrolling
                    } else {
                        console.warn("Target post not found: Post" + saveEdit);
                    }
                }, 200); // Delay to ensure the element is available
            }
            

        } else {
            postContainer.innerHTML = '<p class="text-center text-gray-500 dark:text-gray-400">No matching posts found.</p>';
        }
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
}

// Function to create like and comment section
function createLikeCommentSection(postId, profile) {
    return `
        <div class="flex items-center mt-8 mb-3 text-gray-500 dark:text-gray-400">
            <button type="button" onclick="addLike(${postId})" id="like-btn-${postId}" class="like-btn focus:outline-none flex items-center transition-colors" data-post-id="${postId}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                </svg>
                <span id="like-count-${postId}" class="ml-1"></span>
            </button>
            <button class="comment-btn ml-5 flex focus:outline-none items-center transition-colors" data-post-id="${postId}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                </svg>
                <span class="ml-1 pointer-events-none">Comments</span>
            </button>
        </div>

        <div id="commentContainer${postId}" class="w-full hidden pt-5 relative border-t border-gray-500">
            <form class="py-5">
                <label for="comment" class="sr-only">Your comment</label>
                <div class="flex items-center p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <div class="w-8 h-8 rounded-full overflow-hidden">
                            <img alt="User profile" class="object-cover w-full h-full" src="../uploads/profiles/${profile}" />
                        </div>
                    </button>

                    <textarea id="comment${postId}" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                    <button type="button" post-id=${postId} class="sendCommentBtn inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg class="w-5 pointer-events-none h-5 rotate-45 rtl:-rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                        </svg>
                        <span class="sr-only pointer-events-none">Send</span>
                    </button>
                </div>
            </form>

            <div id="comments${postId}" class="flex flex-col rounded gap-3 max-h-[600px] overflow-auto">
            </div>
        </div>
    `;
}

// Function to get comments
async function getComment(postId) {
    try {
        const response = await fetch('../Controller/getComment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: postId }),
        });

        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const data = await response.json();

        if (data.success) {
            const comments = document.getElementById(`comments${postId}`);
            comments.innerHTML = "";
            data.comments.forEach(comment => {
                comments.innerHTML += createCommentElement(comment);
            });
        } else {
            console.error("Error fetching comments:", data.error);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Failed to fetch comments. Please try again.");
    }
}

// Function to create a comment element
function createCommentElement(comment) {
    return `
        <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-8 rounded-full">
                            <img alt="User profile" src="../uploads/profiles/${comment.profileImage}" />
                        </div>
                    </div>
                    <div class="chat-bubble">${comment.comment}</div>
                    <div class="chat-footer flex items-center gap-2">
                        <span>${comment.name}</span>
                        <time class="text-xs opacity-50">
                            ${new Date(comment.createdAt).toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    })}
                        </time>
                    </div>
                </div>
                <button class="reply-btn focus:outline-none text-blue-500" id=${comment.comment_id}><span class="pointer-events-none">Reply</span></button>
            </div>
        
            <div id="replyContainer${comment.comment_id}" class="replies hidden px-5 mx-4 border-l border-gray-300 ">
                <div id="replyComments${comment.comment_id}" class="w-4/5 max-h-[300px] overflow-auto mx-auto mb-5">
                </div>
                <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-2 rounded-lg shadow">
                    <div class="w-8 h-8 rounded-full overflow-hidden mr-5">
                        <img alt="User profile" class="object-cover w-full h-full" src="../uploads/profiles/${comment.profileImage}" />
                    </div>
                    <input type="text" class="reply-input w-full p-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400" placeholder="Write a reply..." />
                    <button class="submit-reply-btn bg-blue-500 dark:bg-blue-600 text-white p-2 rounded-lg ml-5 hover:bg-blue-600 dark:hover:bg-blue-700">Reply</button>
                </div>
          
            </div>
        </div>`;
}

// Function to send a comment
async function sendComment(postId, comment) {
    try {
        const response = await fetch("../Controller/sendComment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: postId, comment: comment })
        });

        const data = await response.json();

        if (data.success) {
            return true;
        } else {
            throw new Error(data.error || "Failed to send comment.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Failed to send comment. Please try again.");
        return false;
    }
}

// Function to send a reply
async function sendReply(commentId, replyText) {
    try {
        const response = await fetch("../Controller/replyComment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id: commentId, comment: replyText }),
        });

        if (!response.ok) throw new Error("Network response was not ok");

        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error sending reply:", error);
        throw error;
    }
}

// Function to get reply comments
async function getReplyComments(commentId) {
    try {
        const response = await fetch('../Controller/getReplyComment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: commentId }),
        });

        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const data = await response.json();

        if (data.success) {
            const replyComments = document.getElementById(`replyComments${commentId}`);
            replyComments.innerHTML = "";
            data.comments.forEach(reply => {
                replyComments.innerHTML += `
                    <div class="chat ${reply.userId === userId ? "chat-end" : "chat-start"}">
                        <div class="chat-image avatar">
                            <div class="w-8 rounded-full">
                                <img alt="User profile" src="../uploads/profiles/${reply.profileImage}" />
                            </div>
                        </div>
                        
                        <div class="chat-bubble">${reply.comment}</div>
                        
                        <div class="chat-footer">
                            ${reply.name}
                            <time class="text-xs opacity-50">
                                ${new Date(reply.createdAt).toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                })}
                            </time>
                        </div>
                    </div>`;
            });
        }
    } catch (error) {
        console.error("Error fetching replies:", error);
    }
}

// Function to setup event listeners
function setupEventListeners() {
    document.querySelectorAll('.comment-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const postId = button.dataset.postId;
            const commentContainer = document.getElementById(`commentContainer${postId}`);
            commentContainer.classList.toggle('hidden');

            if (!commentContainer.classList.contains('hidden')) {
                await getComment(postId);
            }
        });
    });

    document.querySelectorAll('.sendCommentBtn').forEach(button => {
        button.addEventListener('click', async () => {
            const postId = button.getAttribute('post-id');
            const commentInput = document.getElementById(`comment${postId}`);
            const comment = commentInput.value.trim();

            if (comment === "") {
                alert("Comment cannot be empty!");
                return;
            }

            const success = await sendComment(postId, comment);

            if (success) {
                commentInput.value = "";
                await getComment(postId);
            }
        });
    });

    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('reply-btn')) {
            const commentId = e.target.getAttribute('id');
            const replyContainer = document.getElementById(`replyContainer${commentId}`);
            replyContainer.classList.toggle('hidden');

            if (!replyContainer.classList.contains('hidden')) {
                await getReplyComments(commentId);
            }
        }

        if (e.target.classList.contains('submit-reply-btn')) {
            const replyContainer = e.target.closest('.replies');
            const commentId = replyContainer.id.replace('replyContainer', '');
            const replyInput = replyContainer.querySelector('.reply-input');
            const replyText = replyInput.value.trim();

            if (replyText === "") {
                alert("Reply cannot be empty!");
                return;
            }

            const success = await sendReply(commentId, replyText);

            if (success) {
                replyInput.value = "";
                await getReplyComments(commentId);
            }
        }
    });

    setupGalleryEventListeners();
}

// Function to fetch like counts
async function fetchLikeCounts() {
    try {
        const response = await fetch('../Controller/getLikeCounts.php');
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const data = await response.json();

        Object.entries(data.likes).forEach(([postId, likeData]) => {
            const likeCountElement = document.getElementById(`like-count-${postId}`);
            const likeButtonElement = document.getElementById(`like-btn-${postId}`);

            if (likeCountElement) {
                likeCountElement.innerHTML = likeData.like_count;
            }

            if (likeButtonElement) {
                if (likeData.user_liked) {
                    likeButtonElement.classList.add("text-blue-500");
                } else {
                    likeButtonElement.classList.remove("text-blue-500");
                }
            }
        });
    } catch (error) {
        console.error('Error fetching like counts:', error);
    }
}

const profile = sessionStorage.getItem("profile");
const filterType = sessionStorage.getItem("filterType");
const searchPost = sessionStorage.getItem("searchPost");


if (!profile && !filterType && !searchPost) {
    getAllPosts(false);
}

else if (profile && !filterType && !searchPost) {
    getAllPosts(true);
    chatRoomCon.classList.add("hidden");
    document.querySelector("#noSelect").classList.remove("hidden");
    userProfileShowCon.classList.remove("hidden");

}

else if (filterType && !searchPost && !profile) {
    const filterBtn1 = document.getElementById('1filterBtn' + filterType);
    const filterBtn2 = document.getElementById('2filterBtn' + filterType);
    if (filterBtn1) {
        filterBtn1.classList.add("font-bold", "text-blue-500");
        filterBtn2.classList.add("font-bold", "text-blue-500");
    }

    if (filterType !== "all") {
        getAllPosts(false, filterType);
    } else {
        getAllPosts(false);
    }
}

else if (searchPost && !profile && !filterType) {
    getAllPosts(false, null, searchPost);
}


// Initialize

fetchLikeCounts();


// User Profile

function showCoverImageChangeModal() {
    updateCoverImageModal.classList.remove("hidden");
}

function showProfileImageChangeModal() {
    updateProfileImageModal.classList.remove("hidden");
}

function handleCoverImageChange(event) {
    const file = event.target.files[0];
    const coverImage = document.getElementById('coverImage');
    const placeholder = document.getElementById('placeholder');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            coverImage.src = e.target.result;
            coverImage.classList.remove('hidden');
            placeholder.classList.add('hidden');
            coverSubmitButton.classList.remove('cursor-not-allowed', 'opacity-50');
            coverSubmitButton.disabled = false;
        };
        reader.readAsDataURL(file);
    }
}

function resetCoverImage() {
    const fileInput = document.getElementById('fileInput');
    const coverImage = document.getElementById('coverImage');
    const placeholder = document.getElementById('placeholder');

    fileInput.value = "";
    coverImage.src = "";
    coverImage.classList.add('hidden');
    placeholder.classList.remove('hidden');
    coverSubmitButton.classList.add('cursor-not-allowed', 'opacity-50');
    coverSubmitButton.disabled = true;
}

function closeCoverChangeModal() {
    document.getElementById('updateCoverImageModal').classList.add('hidden');
}

function handleProfileImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        const imageUrl = URL.createObjectURL(file);
        document.getElementById('profileImage').src = imageUrl;
        document.getElementById('profileImage').classList.remove('hidden');
        profileSubmitButton.classList.remove('cursor-not-allowed', 'opacity-50');
        profileSubmitButton.disabled = false;
    }
}

profileSubmitButton.addEventListener("click", () => {
    const profileFileInput = document.getElementById("profileFileInput");

    const file = profileFileInput.files[0];

    const formData = new FormData();
    formData.append("profileImage", file);

    fetch("../Controller/uploadProfile.php", {
        method: "POST",
        body: formData,
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                window.location.href = "./MainPage.php"
                // alert("Profile image uploaded successfully!");
            } else {
                alert("Upload failed: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred: " + error.message);
        });
})

coverSubmitButton.addEventListener("click", () => {
    const coverFileInput = document.getElementById("coverFileInput");

    const file = coverFileInput.files[0];

    const formData = new FormData();
    formData.append("coverImage", file);

    fetch("../Controller/uploadCover.php", {
        method: "POST",
        body: formData,
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                window.location.href = "./MainPage.php"
                // alert("cover image uploaded successfully!");
            } else {
                alert("Upload failed: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred: " + error.message);
        });
})

function resetCoverImage() {
    const fileInput = document.getElementById('coverFileInput');
    const coverImage = document.getElementById('coverImage');
    const placeholder = document.getElementById('placeholder');

    fileInput.value = "";
    coverImage.src = "";
    coverImage.classList.add('hidden');
    placeholder.classList.remove('hidden');
    coverSubmitButton.classList.add('cursor-not-allowed', 'opacity-50');
    coverSubmitButton.disabled = true;
}

function handleProfileImageChange(event) {
    const file = event.target.files[0];
    const profileImage = document.getElementById('profileImage');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profileImage.src = e.target.result;
            profileImage.classList.remove('hidden');
            profileSubmitButton.classList.remove('cursor-not-allowed', 'opacity-50');
            profileSubmitButton.disabled = false;
        };
        reader.readAsDataURL(file);
    }
}

function resetProfileImage() {
    const fileInput = document.getElementById('profileFileInput');
    const profileImage = document.getElementById('profileImage');

    fileInput.value = "";
    profileImage.src = "";
    profileImage.classList.add('hidden');
    profileSubmitButton.classList.add('cursor-not-allowed', 'opacity-50');
    profileSubmitButton.disabled = true;
}

function closeProfileChangeModal() {
    document.getElementById('updateProfileImageModal').classList.add('hidden');
}

function showEditUserInfo() {
    document.getElementById('editProfileModal').classList.remove('hidden');
}

function closeEditUserInfoModal() {
    document.getElementById('editProfileModal').classList.add('hidden');
}

document.getElementById('editProfileForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Collect form data
    const formData = {
        username: document.getElementById('username').value,
        role: document.getElementById('role').value,
        address: document.getElementById('address').value,
        phone: document.getElementById('phone').value,
        year: document.getElementById('year').value,
        rollno: document.getElementById('rollno').value
    };

    // Send data to the server using fetch
    fetch('../Controller/userUpdateInfo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update user information: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating user information.');
        });
});