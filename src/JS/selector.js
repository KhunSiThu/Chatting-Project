

const searchBox = document.querySelector(".searchBox");
const chatItems = document.querySelector("#chatItems");
const mainTitle = document.querySelector("#mainTitle");
const searchForm = document.querySelector("#search-form");

const searchItemsCon = document.querySelector("#searchItemsCon");
const searchItems = document.querySelector("#searchItems");
const requestItems = document.querySelector("#requestItems");
const followItems = document.querySelector("#followItems");
const groupItems = document.querySelector("#groupItems");

const groupList = document.querySelector(".groupList");

const chatBoxBtn = document.querySelector('#chatBoxBtn');
const requestBtn = document.querySelector('#requestBtn');
const followBtn = document.querySelector('#followBtn');
const groupBtn = document.querySelector('#groupBtn');

const userProfileBtn = document.querySelector("#userProfileBtn");
const userProfileShowCon = document.getElementById("userProfileShowCon");
const mobileUserProfileBtn = document.getElementById("mobileUserProfileBtn");
const closeMenu = document.querySelector("#closeMenu");

// Group 

const groupModal = document.getElementById("groupModal");
const createGroupBtn = document.getElementById("createGroupBtn");
const cancelBtn = document.getElementById("cancelBtn");
const nextBtn = document.getElementById("nextBtn");
const groupNameInput = document.getElementById("groupNameInput");
const groupProfileUpload = document.getElementById("groupProfileUpload");
const groupProfileImage = document.getElementById("groupProfileImage");
const addMemberModal = document.getElementById("addMemberModal");
const forMemberList = document.getElementById("forMemberList");
const memberName = document.getElementById("memberName");
const closeAddMember = document.getElementById("closeAddMember");
const groupSendBtn = document.getElementById('groupSendBtn');
const editGroupModal = document.getElementById('editGroupModal');
const changeGroupProfile = document.getElementById('changeGroupProfile');

// Chat Room
const sideBar = document.querySelector("#sidebar");
const friendList = document.querySelector(".friendList");
const sendMessageInput = document.querySelector("#sendMessage");
const sendBtn = document.querySelector("#sendBtn");
const messageShowCon = document.querySelector("#messageShowCon");
const chatRoomCon = document.querySelector('#chatRoomCon');
const messDropdown = document.getElementById("messDropdown");
const deleteMessageBtn = document.getElementById("deleteMessageBtn");

const sendFiles = document.getElementById("sendFiles");
const sendFilesBtn = document.getElementById("sendFilesBtn");


// Posts

const photoInput = document.getElementById('photo-input');
const capation = document.getElementById("capation");
const previewContainer = document.getElementById('preview-container');
const uploadPostBtn =document.getElementById('uploadPostBtn');

photoInput.addEventListener('change', function () {
    previewContainer.innerHTML = '';
    for (const file of this.files) {
        const reader = new FileReader();
        reader.onload = function (e) {
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
        }
        reader.readAsDataURL(file);
    }
});

function clearPreview() {
    previewContainer.innerHTML = '';
    photoInput.value = '';
}

