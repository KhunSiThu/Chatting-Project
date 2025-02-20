<!-- Chat List -->
<div id="itemsContainer" class="md:w-96 w-full md:block hidden h-screen relative">
   <!-- Search box -->
   <div class="w-full absolute top-0 left-0 z-40 h-22 bg-slate-100 dark:bg-gray-700 p-5">
      <div class="flex justify-between items-center">
         <h3 id="mainTitle" class="py-5 text-xl font-bold text-black dark:text-white">Chat Box</h3>
         <button type="button" id="createGroupBtn" class="text-blue-700 flex hidden items-center justify-center hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
            <span>Create</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
         </button>
      </div>
   </div>

   <!-- Chat Items -->
   <div id="chatItems" class="pt-36 px-3 pb-5 overflow-auto  h-screen scroll-none">
      <ul class="friendList flex flex-col gap-y-3 ">

         <!-- Repeat the above <li> for each chat item -->
      </ul>
   </div>

   <!-- group Items -->
   <div id="groupItems" class="pt-36 px-3 pb-5 overflow-auto hidden h-screen scroll-none">
      <ul class="groupList flex flex-col gap-y-3 ">

         <!-- Repeat the above <li> for each chat item -->
      </ul>
   </div>

   <!-- Request Items -->
   <div id="requestItems" class="pt-36 px-3 pb-5 overflow-auto hidden h-screen scroll-none">
      <ul id="requestList" class=" flex flex-col gap-y-3 ">

         <!-- Repeat the above <li> for each chat item -->
      </ul>
   </div>

   <!-- follow Items -->
   <div id="followItems" class="pt-36 px-3 pb-5 overflow-auto hidden h-screen scroll-none">
      <ul id="followList" class=" flex flex-col gap-y-3 ">

         <!-- Repeat the above <li> for each chat item -->
      </ul>
   </div>

   <!-- Search Results -->
   <div id="searchItemsCon" class="pt-36 hidden px-3 overflow-auto h-screen scroll-none">
      <ul id="searchItems" class="flex flex-col gap-y-3 mb-80">
         <!-- Search results will be dynamically inserted here -->
      </ul>
   </div>
</div>

<!-- Group Creation Modal -->
<div id="groupModal" class="fixed top-0 left-0 z-50 w-screen flex h-screen hidden justify-center items-center bg-black bg-opacity-50 bg-blur">
   <div class="bg-gray-800 text-gray-200 p-6 rounded-lg shadow-lg w-96">
      <div class="flex justify-center relative">
         <!-- Profile Upload -->
         <label for="groupProfileUpload" class="cursor-pointer">
            <div class="bg-blue-500  flex items-center rounded-full  justify-center">
               <img id="groupProfileImage" src="https://png.pngtree.com/png-vector/20241101/ourmid/pngtree-simple-camera-icon-with-line-png-image_14216604.png"
                  alt="group-icon" class="p-1 object-cover rounded-full w-16 h-16 ">
            </div>
         </label>
         <input type="file" id="groupProfileUpload" accept="image/*" class="hidden">
      </div>
      <h2 class="text-center text-lg mt-4">Group Profile</h2>
      <input id="groupNameInput" type="text"
         class="w-full mt-2 p-2 border-b bg-transparent focus:outline-none focus:border-blue-500"
         placeholder="Enter group name">
      <div class="flex justify-between mt-4">
         <button id="cancelBtn" class="text-blue-400 hover:text-blue-300">Cancel</button>
         <button id="nextBtn" class="text-blue-400 hover:text-blue-300">Next</button>
      </div>
   </div>
</div>

