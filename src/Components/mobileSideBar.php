<aside id="default-sidebar" class="fixed sideMenu md:hidden flex top-0 left-0 z-50 w-full h-screen transition-transform -translate-x-full " aria-label="Sidebar">
   <div class="h-full px-3 w-4/6 py-4 overflow-y-auto bg-white dark:bg-gray-900">
      <!-- Profile Section -->
      <div class="p-2 mb-4 border rounded-lg dark:border-gray-700">
         <button class="flex items-center w-full text-left">
            <div class="p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
               <img class="w-8 h-8 object-cover rounded-full" src="../uploads/<?= $userData['groupProfileImage'] ?>" alt="Profile Image">
            </div>
            <div class="ml-3">
               <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?= $userData['name'] ?></h3>
               <span class="text-xs ntext-gray-500 dark:text-gray-400"><?= $userData['email'] ?></span>
            </div>
         </button>
      </div>

      <!-- Menu Items -->
      <ul class="space-y-2 font-medium">
         <!-- My Profile -->
         <li>
            <a href="#" class="flex items-center p-2 text-gray-700 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
               </svg>
               <span class="ml-3">My Profile</span>
            </a>
         </li>

         <!-- Log Out -->
         <li>
            <button id="" class="logoutBtn flex items-center w-full p-2 text-gray-700 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
               </svg>
               <span class="ml-3">Log Out</span>
            </button>
         </li>

         <!-- Theme Toggle -->
         <li class="flex items-center justify-between p-2 text-gray-700 dark:text-gray-200">
            <div class="flex items-center">
               <svg class="w-6 h-6 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
               </svg>
               <span class="ml-3">Night Mode</span>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
               <input type="checkbox" id="theme-switch" class="sr-only peer">
               <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-blue-600 transition duration-300">
                  <div class="absolute switch w-4 h-4 bg-white rounded-full left-1 top-0.5 transition-transform duration-300 peer-checked:translate-x-5"></div>
               </div>
            </label>
         </li>

      </ul>
   </div>
   <div id="closeMenu" class="bg-blur w-2/6 h-screen"></div>
</aside>