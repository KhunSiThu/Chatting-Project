document.querySelector('body').addEventListener("click", (e) => {
    if (e.target.classList.contains("bg-blur")) {
        e.target.classList.add("hidden");
    }
});

closeMenu.addEventListener("click", () => {
    document.querySelector('.sideMenu').classList.add("-translate-x-full")
})

chatBoxBtn.addEventListener("click", () => {
    chatItems.classList.remove("hidden");
    searchItemsCon.classList.add("hidden");
    requestItems.classList.add("hidden");
    followItems.classList.add("hidden");
    groupItems.classList.add("hidden");
    mainTitle.textContent = "Chat Box";
    searchBox.value = "";
    document.querySelector("#createGroupBtn").classList.add("hidden")
});

requestBtn.addEventListener("click", () => {
    chatItems.classList.add("hidden");
    searchItemsCon.classList.add("hidden");
    requestItems.classList.remove("hidden");
    followItems.classList.add("hidden");
    groupItems.classList.add("hidden");
    mainTitle.textContent = "Friend Requests";
    searchBox.value = "";
    document.querySelector("#createGroupBtn").classList.add("hidden")
    const requestList = document.getElementById("requestList");
    // setInterval(() => {
    //     friendRequests();
    // }, 1500);
    requestList.addEventListener("click", (e) => {
        if (e.target.matches(".confirmBtn")) {
            const id = e.target.getAttribute("id");
            confirmTest('../Controller/comfirmFri.php', id, e.target);
        }
    })
});

groupBtn.addEventListener("click", () => {
    chatItems.classList.add("hidden");
    searchItemsCon.classList.add("hidden");
    requestItems.classList.add("hidden");
    followItems.classList.add("hidden");
    groupItems.classList.remove("hidden");
    mainTitle.textContent = "Your Group";
    searchBox.value = "";
    document.querySelector("#createGroupBtn").classList.remove("hidden")
});

followBtn.addEventListener("click", () => {
    chatItems.classList.add("hidden");
    searchItemsCon.classList.add("hidden");
    requestItems.classList.add("hidden");
    followItems.classList.remove("hidden");
    groupItems.classList.add("hidden");
    mainTitle.textContent = "Your Requests";
    searchBox.value = "";
    document.querySelector("#createGroupBtn").classList.add("hidden")
    const followList = document.getElementById("followList");
    // setInterval(() => {
    //     followFriend();
    // }, 1500);

    followList.addEventListener("click", (e) => {
        if (e.target.matches(".requestBtn")) {
            const id = e.target.getAttribute("id");
            requestTest('../Controller/requestFri.php', id, e.target);
        }
    })
});

userProfileBtn.addEventListener("click", () => {
    document.querySelector("#noSelect").classList.add("md:hidden");
    userProfileShowCon.classList.remove("hidden");
    chatRoomCon.classList.add("hidden");
})

mobileUserProfileBtn.addEventListener("click", () => {
    userProfileShowCon.classList.remove("hidden");
    sideBar.classList.add("hidden");
    document.querySelector('.sideMenu').classList.add("-translate-x-full");

})


// Toggle visibility of search results
searchBox.addEventListener("keyup", () => {
    const searchText = searchBox.value.trim();

    if (searchText) {

        chatItems.classList.add("hidden");
        requestItems.classList.add("hidden");
        followItems.classList.add("hidden");
        searchItemsCon.classList.remove("hidden");
        groupItems.classList.add("hidden");
        mainTitle.textContent = "Search Friends";

        // Clear any existing interval to avoid multiple intervals running
        if (intervalId) {
            clearInterval(intervalId);
        }

        // Start a new interval to fetch real-time data every 2 seconds
        intervalId = setInterval(() => {
            searchFriend(searchText); // Call search function
        }, 1000); // Fetch data every 2 seconds

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

// Prevent form submission
searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
});

// Group 

// Open Modal
createGroupBtn.addEventListener("click", function () {
    groupModal.classList.remove("hidden");
});

// Close Modal
cancelBtn.addEventListener("click", function () {
    groupModal.classList.add("hidden");
    groupNameInput.value = "";
    groupProfileImage.src = "https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png";
});

// Confirm Group Creation
nextBtn.addEventListener("click", function () {
    const groupName = groupNameInput.value.trim();
    // Your original code with the custom alert
    if (groupProfileUpload.value === "") {
        showCustomAlert("<div class=' p-2 rounded'>Upload group profile!</div>");
        return
    }
    if (groupName === "") {
        groupNameInput.focus()
    } else {
        console.log("Group Created:", groupName);

        const file = groupProfileUpload.files[0];
        if (!file) {
            alert("Please select an image to upload.");
            return;
        }

        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            alert("File size exceeds the limit of 5MB.");
            return;
        }

        const formData = new FormData();
        formData.append("groupProfileImage", file);
        formData.append("groupName", groupName);

        fetch("../Controller/createGroup.php", {
            method: 'POST',
            body: formData,
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    groupModal.classList.add("hidden");
                    groupNameInput.value = "";
                    groupProfileImage.src = "https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png";
                    addMemberModal.classList.remove("hidden");

                    getFriendByName("");
                }
            })


    }
});

memberName.addEventListener("keyup", () => {
    getFriendByName(memberName.value);
});

// Add Member
forMemberList.addEventListener("click", async (e) => {
    if (e.target.matches(".addMemberBtn")) {
        // Get the parent 'li' element of the clicked button
        const parentLi = e.target.closest('li');
        const addId = e.target.getAttribute("id");

        try {
            const response = await fetch("../Controller/addGroupMember.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ addId }),
            });

            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }

            const data = await response.json();
            console.log("Member added successfully:", data);

            parentLi.classList.add("hidden"); // Just an example class
        } catch (error) {
            console.error("Error adding member:", error);
        }
    }
});

closeAddMember.addEventListener("click", () => {
    addMemberModal.classList.add("hidden");
})

// Profile Image Upload
groupProfileUpload.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            groupProfileImage.src = e.target.result;        
        };
        reader.readAsDataURL(file);
    } else {
        alert("Upload group profile!")
    }
});

// Group Chat 
groupList.addEventListener("click", async (e) => {
    if (e.target.matches(".groupItem")) {
       
        const id = e.target.getAttribute("id");
        await groupChat(id) // Fetch messages after selecting a friend       
    }
});

groupSendBtn.addEventListener("click", () => {
    groupSendMessage();
});


// Chat Room
// Event listener for the send button
sendBtn.addEventListener("click", () => {
   
    sendMessage();
});

// Chat Friend
friendList.addEventListener("click", async (e) => {
    if (e.target.matches(".chatItem")) {
       
        const id = e.target.getAttribute("id");
        await chatFriend(id) // Fetch messages after selecting a friend
    }
});