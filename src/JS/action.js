
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
    requestItems.classList.remove("hidden");
    followItems.classList.add("hidden");
    groupItems.classList.add("hidden");
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
    modal.classList.remove("hidden");
});

// Close Modal
cancelBtn.addEventListener("click", function () {
    modal.classList.add("hidden");
    groupNameInput.value = "";
    groupProfileImage.src = "https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png";
});

// Confirm Group Creation
nextBtn.addEventListener("click", function () {
    const groupName = groupNameInput.value.trim();
    if (groupName === "") {
        alert("Please enter a group name");
    } else {
        console.log("Group Created:", groupName);
        modal.classList.add("hidden");
        groupNameInput.value = "";
        groupProfileImage.src = "https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png";
    }
});

// Profile Image Upload
groupProfileUpload.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            groupProfileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});