// Constants
const chatRoomHeader = document.querySelector("#chatRoomHeader");
const messageShowCon = document.querySelector("#messageShowCon");
const sideBar = document.querySelector("#sideBar");
const groupSendBtn = document.querySelector("#groupSendBtn");
const sendBtn = document.querySelector("#sendBtn");
const editGroupModal = document.querySelector("#editGroupModal");
const addMemberModal = document.querySelector("#addMemberModal");
const leaveGroupModal = document.querySelector("#leaveGroupModal");

// Group Chat Function
const groupChat = async (chooseId) => {
    try {
        // Update UI
        groupSendBtn.classList.remove("hidden");
        sendBtn.classList.add("hidden");
        sessionStorage.removeItem("messLength");

        // Fetch group details
        const data = await fetchData("../Controller/getGroupById.php", { chooseId });

        if (data.success && data.group && data.members) {
            updateChatRoomHeader(data.group, data.members);
            setupEventListeners(data.group);
            startPolling();
        } else {
            chatRoomHeader.innerHTML = `<p class="text-gray-500 dark:text-gray-300">Group not found.</p>`;
        }
    } catch (error) {
        console.error("Error fetching group details:", error);
        chatRoomHeader.innerHTML = `<p class="text-red-500 dark:text-red-300">Error loading group details. Please try again.</p>`;
    }

    // Control visibility of chat elements
    toggleChatVisibility();
};

// Friend Chat Function
const chatFriend = async (chooseId) => {
    try {
        // Update UI
        addMemberModal.classList.add("hidden");
        groupSendBtn.classList.add("hidden");
        sendBtn.classList.remove("hidden");
        sessionStorage.removeItem("messLength");

        // Fetch friend details
        const data = await fetchData("../Controller/getFriendById.php", { chooseId });

        if (data.length > 0) {
            updateChatRoomHeader(data[0]);
            startPolling();
        } else {
            chatRoomHeader.innerHTML = `<p class="text-gray-500 dark:text-gray-300">No friend found.</p>`;
        }
    } catch (error) {
        console.error("Error fetching friend details:", error);
        chatRoomHeader.innerHTML = `<p class="text-red-500 dark:text-red-300">Error loading friend details. Please try again.</p>`;
    }

    // Control visibility of chat elements
    toggleChatVisibility();
};

// Fetch Data Function
const fetchData = async (url, body) => {
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(body),
    });

    if (!response.ok) {
        throw new Error(`Network response was not ok: ${response.statusText}`);
    }

    return await response.json();
};

// Update Chat Room Header
const updateChatRoomHeader = (entity, members = []) => {
    if (members.length > 0) {
        // Group chat header
        let membersHTML = members.map((member, index) => `
            <li>
                <div class="flex pointer-events-auto items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="relative">
                        <img class="w-6 h-6 me-2 rounded-full" src="../uploads/${member.profileImage}" alt="${member.name} image">
                        <span class="bottom-0 left-4 absolute w-2 h-2 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full transition-opacity duration-200 ${member.status !== 'Online' ? 'opacity-0' : 'opacity-100'}"></span>
                    </div>
                    <div class="flex w-full justify-between items-center">
                        <h2 class='text-sm'>${member.name}</h2> <span class="text-green-500 text-xs">${index === 0 ? 'Admin' : ''}</span>
                    </div>
                </div>
            </li>
        `).join('');

        chatRoomHeader.innerHTML = `
            <div class="flex items-center">
                <button id="closeChat" class="mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 transition-opacity duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
                <div class="relative">
                    <img class="md:w-12 md:h-12 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/${entity.groupProfile}" alt="${entity.groupName}'s profile image">
                </div>
                <div class="ml-2 flex justify-center flex-col">
                    <h4 class="font-bold text-gray-800 dark:text-gray-100">${entity.groupName}</h4>
                    <button id="memberListShowBtn" class="text-black dark:text-white text-xs">${members.length} members</button>
                    <div id="memberListCon" class="hidden w-full h-screen absolute top-0 left-0 flex justify-center items-center bg-blur">
                        <div class="fixed flex flex-col items-end mt-5 z-50 bg-slate-50 rounded-lg shadow-lg w-60 dark:bg-gray-700">
                            <h3 class="text-center my-5 w-full">Group Members</h3>
                            <ul id="memberListShow" class="h-48 w-full pb-3 overflow-y-auto border-b dark:border-gray-500 text-gray-700 bg-blur dark:text-gray-200 pointer-events-none">${membersHTML}</ul>
                            <button id='HAddMemberMenuBtn' class="flex items-center p-2 m-2 text-sm font-medium text-blue-600 rounded-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-blue-500 hover:underline">
                                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                </svg>
                                Add new user
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        // Friend chat header
        chatRoomHeader.innerHTML = `
            <div class="flex items-center">
                <button id="closeChat" class="mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 transition-opacity duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
                <div class="relative">
                    <img class="md:w-14 md:h-14 object-cover w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-600" src="../uploads/${entity.profileImage}" alt="${entity.name}'s profile image">
                </div>
                <div class="ml-2">
                    <h4 class="font-bold text-gray-800 dark:text-gray-100">${entity.name}</h4>
                    <span class="text-xs ${entity.status === 'Online' ? 'text-green-400' : 'text-gray-500 dark:text-gray-400'}">${entity.status}</span>
                </div>
            </div>
        `;
    }
};

// Setup Event Listeners
const setupEventListeners = (group) => {
    document.querySelector("#closeChat").addEventListener("click", () => {
        sideBar.classList.remove("hidden");
        document.querySelector("#chatRoomCon").classList.add("hidden");
        document.querySelector("#noSelect").classList.add("md:flex");
    });

    document.querySelector("#memberListShowBtn").addEventListener("click", () => {
        document.querySelector("#memberListCon").classList.remove("hidden");
    });

    document.querySelector("#showMemberMenu").addEventListener("click", () => {
        document.querySelector("#memberListCon").classList.remove("hidden");
    });

    document.querySelector("#manageGroupMenu").addEventListener("click", () => {
        editGroupModal.classList.remove("hidden");
    });

    document.querySelector("#addGroupMemberMenu").addEventListener("click", () => {
        addMemberModal.classList.remove("hidden");
        getFriendByName("");
    });

    document.querySelector("#HAddMemberMenuBtn").addEventListener("click", () => {
        addMemberModal.classList.remove("hidden");
        getFriendByName("");
    });

    document.querySelector("#openLeaveGroupModal").addEventListener("click", () => {
        leaveGroupModal.classList.remove("hidden");
        leaveGroupModal.classList.add("flex");
    });

    document.querySelector("#cancelLeave").addEventListener("click", () => {
        leaveGroupModal.classList.remove("flex");
        leaveGroupModal.classList.add("hidden");
    });

    document.querySelector("#sureLeave").addEventListener("click", () => {
        leaveGroup(group.groupId);
    });
};

// Toggle Chat Visibility
const toggleChatVisibility = () => {
    sideBar.classList.add("hidden");
    document.querySelector("#chatRoomCon").classList.remove("hidden");
    document.querySelector("#noSelect").classList.add("md:hidden");
    userProfileShowCon.classList.add("hidden");
};

// Start Polling
const startPolling = () => {
    fetchAndDisplayMessages();
    const pollingInterval = setInterval(fetchAndDisplayMessages, 1000);
    window.addEventListener("beforeunload", () => clearInterval(pollingInterval));
};

// Fetch and Display Messages
const fetchAndDisplayMessages = async () => {
    try {
        const response = await fetch("../Controller/getGroupMessage.php");
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const data = await response.json();
        if (!data.success || !Array.isArray(data.messages)) throw new Error("Invalid response format");

        const messLength = parseInt(sessionStorage.getItem("messLength")) || 0;
        if (data.messages.length > messLength) {
            data.messages.slice(messLength).forEach(displayMessage);
            messageShowCon.scrollTo({ top: messageShowCon.scrollHeight, behavior: "smooth" });
            sessionStorage.setItem("messLength", data.messages.length);
        }
    } catch (error) {
        console.error("Error fetching messages:", error);
    }
};

// Display Message
const displayMessage = (message) => {
    const isSentByMe = message.sendId == userId;
    const imagesHTML = message.images && message.images.length > 0 ? `
        <div class="mt-2 grid gap-2 ${message.images.length === 1 ? 'grid-cols-1' : 'grid-cols-2'}">
            ${message.images.map(image => `
                <img src="../Controller/uploads/images/${image}" alt="Attached Image" 
                    class="rounded-lg max-w-full h-auto cursor-pointer hover:opacity-80 transition-opacity duration-200"
                    onclick="openImageModal('${image}')">
            `).join('')}
        </div>
    ` : '';

    const filesHTML = message.files && message.files.length > 0 ? `
        <div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Attachments</h3>
            <div class="flex flex-col gap-3">
                ${message.files.map(file => {
        const ext = file.split('.').pop().toLowerCase();
        const filePath = `../Controller/uploads/documents/${file}`;
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
        </div>
    ` : '';

    const messageElement = `
        <div class="my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
            <div class="chat-image avatar">
                <div class="w-6 md:w-10 rounded-full">
                    <img alt="Profile image" src="../uploads/${message.profileImage}" />
                </div>
            </div>
            <div class="chat-header dark:text-white">
                ${isSentByMe ? 'You' : message.username}
                <time class="text-xs opacity-50 text-gray-800 dark:text-gray-300">${new Date(message.createdAt).toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    })}</time>
            </div>
            <div class="chat-bubble text-justify p-3 rounded-lg shadow-md max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl 
                ${isSentByMe ? 'bg-blue-400 text-white dark:bg-blue-400 self-end' : 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white self-start'}">  
                <p>${message.message}</p>
                ${imagesHTML}
                ${filesHTML}
            </div>
            <div class="chat-footer text-gray-700 opacity-50 dark:text-gray-300">
                ${isSentByMe ? 'Sent' : 'Received'}
            </div>
        </div>
    `;

    messageShowCon.insertAdjacentHTML('beforeend', messageElement);
};

// Leave Group
const leaveGroup = async (groupId) => {
    try {
        const response = await fetch("../Controller/leaveGroup.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ action: "leave", groupId }),
        });

        const data = await response.json();
        if (data.success) {
            showCustomAlert("You have left the group.");
            leaveGroupModal.classList.remove("flex");
            leaveGroupModal.classList.add("hidden");
        } else {
            alert("Failed to leave the group: " + data.error);
        }
    } catch (error) {
        console.error("Error leaving group:", error);
        alert("An error occurred while leaving the group.");
    }
};

// Show Custom Alert
const showCustomAlert = (message) => {
    alert(message); // Replace with a custom alert implementation if needed
};

// Open Image Modal
const openImageModal = (image) => {
    // Implement image modal opening logic
};

// Get Friend by Name
const getFriendByName = (name) => {
    // Implement friend search logic
};