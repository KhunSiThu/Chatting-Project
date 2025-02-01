<!-- Chat Room -->
<div id="chatRoomCon" class="h-screen hidden w-full relative bg-white dark:bg-gray-900">

    <!-- Hero Section -->
    <section id="chatRoomHeader" class="p-4 bg-slate-100 dark:bg-gray-800 w-full h-20 absolute right-0 top-0 z-40">

    </section>

    <!-- Chat Messages -->
    <section id="messageShowCon" class="w-full md:w-3/4 mx-auto px-3 h-full overflow-auto scroll-none py-24 bg-white dark:bg-gray-900">

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
            <input id="sendMessage" type="text" class="w-full p-2 rounded-md bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600" placeholder="Type a message...">
        </div>

        <!-- Send Button -->
        <button id="sendBtn" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>
    </section>
</div>

<!-- not choose chat -->

<div id="noSelect" class="h-screen hidden w-full relative bg-white dark:bg-gray-900 md:flex justify-center items-center">
    <h3 class="dark:text-white">Select a chat to start messaging.</h3>
</div>

<script>
    const sideBar = document.querySelector("#sidebar");
    const friendList = document.querySelector(".friendList");
    const sendMessageInput = document.querySelector("#sendMessage");
    const sendBtn = document.querySelector("#sendBtn");
    const messageShowCon = document.querySelector("#messageShowCon");

    // Hero Section
    const chatFriend = async (chooseId) => {
        const chatRoomHeader = document.querySelector("#chatRoomHeader");

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
                    <button id="closeChat" class='mr-3 md:hidden text-gray-800 dark:text-gray-200 opacity-40 hover:opacity-100 '><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    </button>
                    <div class="relative">
                        <img class="md:w-14 md:h-14 w-10 h-10 rounded-full" src="../uploads/${friend.profileImage}" alt="${friend.name}'s profile image">
                        
                    </div>
                    <div class="ml-2">
                        <h4 class="font-bold dark:text-white">${friend.name}</h4>
                        <span class="text-xs text-green-400">${friend.status}</span>
                    </div>
                </div>
            `;

                // Function to display messages dynamically
                function displayMessage(message) {
                    var userId = "<?php echo $_SESSION['user_id'] ?? ''; ?>";
                    const isSentByMe = message.send_id == userId;
                    const messageElement = `
                        <div class="my-3 chat ${isSentByMe ? 'chat-end' : 'chat-start'}">
                            <div class="chat-image avatar">
                                <div class="w-6 md:w-10 rounded-full">
                                    <img alt="Profile image" src="../uploads/${message.profileImage}" />
                                </div>
                            </div>
                            <div class="chat-header dark:text-white">
                                ${isSentByMe ? 'You' : message.name}
                               <time class="text-xs opacity-50 dark:text-gray-300">
                                ${new Date(message.createdAt).toLocaleString('en-US', {
                                    month: 'short', // Short month name (e.g., "Oct")
                                    day: 'numeric', // Day of the month (e.g., "5")
                                    hour: 'numeric', // Hour (e.g., "3")
                                    minute: '2-digit', // Minute (e.g., "07")
                                    hour12: true // Use 12-hour format (e.g., "3:07 PM")
                                })}
                                </time>
                            </div>
                            <div class="chat-bubble ${isSentByMe ? 'bg-blue-500 text-white dark:bg-blue-600' : 'bg-gray-100 dark:bg-gray-700 dark:text-white'}">${message.message}</div>
                            <div class="chat-footer opacity-50 dark:text-gray-300">${isSentByMe ? 'Sent' : 'Received'}</div>
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
                        messages.forEach(displayMessage);

                        

                    } catch (error) {
                        console.error("Error fetching messages:", error);
                    }
                }, 10);

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



    friendList.addEventListener("click", (e) => {
        if (e.target.matches(".chatItem")) {
            const id = e.target.getAttribute("id");
            chatFriend(id) // Fetch messages after selecting a friend
        }
    });

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

    // Event listener for the send button
    sendBtn.addEventListener("click", () => {
        const message = sendMessageInput.value.trim();
        if (message) {
            sendMessage(message);
        } else {
            alert("Please enter a message.");
        }
    });
</script>