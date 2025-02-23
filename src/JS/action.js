// Event Listeners
photoInput.addEventListener('change', handlePhotoInputChange);
closeMenu.addEventListener("click", handleCloseMenu);
newFeedBtn.addEventListener("click", handleNewFeedBtnClick);
chatBoxBtn.addEventListener("click", handleChatBoxBtnClick);
groupBtn.addEventListener("click", handleGroupBtnClick);
userProfileBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        handleUserProfileClick();
    })
})
searchBox.addEventListener("keyup", handleSearchBoxKeyup);
searchItems.addEventListener("click", handleSearchItemsClick);
searchForm.addEventListener("submit", handleSearchFormSubmit);
createGroupBtn.addEventListener("click", handleCreateGroupBtnClick);
cancelBtn.addEventListener("click", handleCancelBtnClick);
nextBtn.addEventListener("click", handleNextBtnClick);
memberName.addEventListener("keyup", handleMemberNameKeyup);
forMemberList.addEventListener("click", handleForMemberListClick);
closeAddMember.addEventListener("click", handleCloseAddMemberClick);
groupProfileUpload.addEventListener("change", handleGroupProfileUploadChange);
groupList.addEventListener("click", handleGroupListClick);
groupSendBtn.addEventListener("click", handleGroupSendBtnClick);
sendFilesBtn.addEventListener("click", handleSendFilesBtnClick);
sendBtn.addEventListener("click", handleSendBtnClick);
friendList.addEventListener("click", handleFriendListClick);
uploadPostBtn.addEventListener('click', handleUploadPostBtnClick);

// Functions
function handlePhotoInputChange() {
    previewContainer.innerHTML = '';
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'preview-item relative';
            div.innerHTML = `
                <img src="${e.target.result}" class="preview-image">
                <button type="button" class='text-red-500 absolute top-1 right-1' onclick="this.parentElement.remove()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            previewContainer.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function handleCloseMenu() {
    
    document.querySelector('.sideMenu').classList.add("-translate-x-full");
}

function handleNewFeedBtnClick() {
    chatListContainer.classList.add("hidden");
    chatRoomCon.classList.add("hidden");
    userProfileShowCon.classList.add("hidden");
    document.querySelector("#noSelect").classList.remove("hidden");
    document.querySelector("#noSelect").classList.remove("md:hidden");
    getAllPosts(false)
}

function handleChatBoxBtnClick() {
    chatListContainer.classList.remove("hidden");

    chatItems.classList.remove("hidden");
    searchItemsCon.classList.add("hidden");
    groupItems.classList.add("hidden");
    mainTitle.textContent = "Chat Box";
    searchBox.value = "";

    document.querySelector("#noSelect").classList.add("hidden");
    document.querySelector("#createGroupBtn").classList.add("hidden");
}

function handleGroupBtnClick() {
    chatListContainer.classList.remove("hidden");

    chatItems.classList.add("hidden");
    searchItemsCon.classList.add("hidden");
    groupItems.classList.remove("hidden");
    mainTitle.textContent = "Your Group";
    searchBox.value = "";

    document.querySelector("#noSelect").classList.add("hidden");
    document.querySelector("#createGroupBtn").classList.remove("hidden");
}

function handleUserProfileClick() {
    chatRoomCon.classList.add("hidden");
    userProfileShowCon.classList.remove("hidden");
    document.querySelector("#noSelect").classList.remove("hidden");
    getAllPosts(true)
}


function handleSearchBoxKeyup() {
    const searchText = searchBox.value.trim();

    if (searchText) {
        chatItems.classList.add("hidden");
        requestItems.classList.add("hidden");
        followItems.classList.add("hidden");
        searchItemsCon.classList.remove("hidden");
        groupItems.classList.add("hidden");
        mainTitle.textContent = "Search Friends";

        if (intervalId) {
            clearInterval(intervalId);
        }

        intervalId = setInterval(() => {
            searchFriend(searchText);
        }, 1000);
    } else {
        chatItems.classList.remove("hidden");
        searchItemsCon.classList.add("hidden");
        mainTitle.textContent = "Chat Box";

        if (intervalId) {
            clearInterval(intervalId);
        }
    }
}

function handleSearchItemsClick(e) {
    if (e.target.matches(".requestBtn")) {
        const id = e.target.getAttribute("id");
        requestTest('../Controller/requestFri.php', id, e.target);
    }

    if (e.target.matches(".confirmBtn")) {
        const id = e.target.getAttribute("id");
        confirmTest('../Controller/comfirmFri.php', id, e.target);
    }
}

function handleSearchFormSubmit(e) {
    e.preventDefault();
}

function handleCreateGroupBtnClick() {
    groupModal.classList.remove("hidden");
}

function handleCancelBtnClick() {
    groupModal.classList.add("hidden");
    groupNameInput.value = "";
    groupProfileImage.src = "https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png";
}

function handleNextBtnClick() {
    const groupName = groupNameInput.value.trim();
    if (groupProfileUpload.value === "") {
        showCustomAlert("<div class=' p-2 rounded'>Upload group profile!</div>");
        return;
    }
    if (groupName === "") {
        groupNameInput.focus();
    } else {
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
            .catch((error) => {
                console.error("Error creating group:", error);
            });
    }
}

function handleMemberNameKeyup() {
    getFriendByName(memberName.value);
}

async function handleForMemberListClick(e) {
    if (e.target.matches(".addMemberBtn")) {
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

            parentLi.classList.add("hidden");
        } catch (error) {
            console.error("Error adding member:", error);
        }
    }
}

function handleCloseAddMemberClick() {
    addMemberModal.classList.add("hidden");
}

function handleGroupProfileUploadChange(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            groupProfileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        alert("Upload group profile!");
    }
}

async function handleGroupListClick(e) {
    if (e.target.matches(".groupItem")) {
        const id = e.target.getAttribute("id");
        await groupChat(id);
    }
}

function handleGroupSendBtnClick() {
    groupSendMessage();
}

function handleSendFilesBtnClick() {
    sendFiles.classList.toggle("hidden");
}

function handleSendBtnClick() {
    sendMessage();
}

async function handleFriendListClick(e) {
    if (e.target.matches(".chatItem")) {
        const id = e.target.getAttribute("id");
        await chatFriend(id);
    }
}

function handleUploadPostBtnClick() {
    uploadPost();
}

// Utility Functions
function showCustomAlert(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'custom-alert';
    alertDiv.innerHTML = message;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}

function clearPreview() {
    previewContainer.innerHTML = '';
    photoInput.value = '';
}

document.querySelector('body').addEventListener("click", (e) => {
    if (e.target.classList.contains("bg-blur")) {
        e.target.classList.add("hidden");
    }
});