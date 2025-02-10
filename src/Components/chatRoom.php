<!-- Chat Room -->
<div id="chatRoomCon" class="h-screen hidden w-full relative bg-white dark:bg-gray-900">

    <!-- Hero Section -->
    <section id="chatRoomHeader" class="p-4 bg-slate-100 dark:bg-gray-800 w-full h-20 absolute right-0 top-0 z-40 flex items-center justify-between">

    </section>

    <!-- Chat Messages -->
    <section id="messageShowCon" class="w-full md:w-3/4 mx-auto px-3 h-full overflow-auto scroll-none py-24 bg-white dark:bg-gray-900">

        <!-- Repeat the above chat bubbles as needed -->
    </section>

    <!-- Input Section -->
    <section class="p-4 bg-slate-100 dark:bg-gray-800 w-full h-20 absolute bottom-0 z-20 right-0 flex justify-center items-center gap-x-5">
        <!-- Image Attachment Button -->
        <label for="sendImage" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </label>
        <input id="sendImage" class="hidden" type="file" name="images[]" multiple accept="image/*">

        <!-- File Attachment Button (Documents) -->
        <label for="sendFile" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            📂
        </label>
        <input id="sendFile" class="hidden" type="file" name="documents[]" accept=".pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.txt,.pdf">

        <!-- Message Input -->
        <div class="w-2/3">
            <input id="sendMessage" type="text" class="w-full p-2 rounded-md bg-white text-black dark:bg-gray-700 dark:text-white dark:border-gray-600 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 transition-colors duration-200" placeholder="Type a message...">
        </div>

        <!-- Send Button -->
        <button id="sendBtn" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-800 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>

        <!-- Group Send Button -->
        <button id="groupSendBtn" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-800 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>
    </section>


    <img src="" alt="">


    <!-- Modal -->

    <!-- Custom Alert Box -->
    <div id="customAlertBox" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 bg-blur">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center">
            <div id="alertMessage" class="text-blue-600 dark:text-blue-400 mb-4">Upload group profile!</div>
            <button id="closeAlertBtn" class="bg-blue-500 dark:bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-blue-500">
                OK
            </button>
        </div>
    </div>




    <!-- Leave Group Modal -->
    <div id="leaveGroupModal" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex hidden justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-blur">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Close button -->
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <!-- Modal content -->
                <div class="p-4 md:p-5 text-center">
                    <!-- Warning icon -->
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <!-- Modal title -->
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to leave this group?</h3>
                    <!-- Confirmation buttons -->
                    <button id="sureLeave" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button id="cancelLeave" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Group Modal -->
    <div id="editGroupModal" class="fixed top-0 left-0 z-50 w-screen flex h-screen hidden justify-center items-center bg-black bg-opacity-50 bg-blur">

    </div>

</div>

<div id="noSelect" class="h-screen hidden md:flex w-full overflow-auto relative bg-white text-gray-900 dark:bg-gray-900 dark:text-white scroll-none">

    <h1>Hello</h1>

</div>