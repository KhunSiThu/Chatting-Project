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
        <button class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-800 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </button>

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

        <!--Group Send Button -->
        <button id="groupSendBtn" class="p-2 bg-slate-200 dark:bg-gray-700 rounded-md hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-800 dark:text-white">
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
    



</script>