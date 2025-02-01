<!-- Chat List -->
<div class="w-96 h-screen relative">
    <!-- Search box -->
    <div class="w-full absolute top-0 z-50 h-32 bg-slate-100 dark:bg-gray-700 p-5">
        <form id="search-form" class="w-full">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input name="searchText" type="search" id="default-search" class="searchBox block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search friends ... " required />
            </div>
        </form>
        <h3 id="mainTitle" class="py-5 text-xl font-bold dark:text-white">Chat Box</h3>
    </div>

    <!-- Chat Items -->
    <div id="chatItems" class="pt-36 px-3 overflow-auto h-screen scroll-none">
        <ul class="friendList flex flex-col gap-y-3">
            <li class="p-3 rounded-md bg-slate-50 dark:bg-gray-700 hover:bg-slate-200 dark:hover:bg-gray-600 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="relative">
                        <img class="w-12 h-12 rounded-full" src="../uploads/profile_679c5b919ed9f8.93970041.jpg" alt="">
                        <span class="bottom-0 left-7 absolute w-4 h-4 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                    </div>
                    <div class="ml-2">
                        <h4 class="font-bold dark:text-white">Khun Si Thu</h4>
                        <span class="text-xs opacity-50 dark:text-gray-300">You : Hello</span>
                    </div>
                </div>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </button>
            </li>
            <!-- Repeat the above <li> for each chat item -->
        </ul>
    </div>

    <!-- Search Results -->
    <div id="searchItemsCon" class="pt-36 hidden px-3 overflow-auto h-screen scroll-none">
        <ul id="searchItems" class="flex flex-col gap-y-3">
            <!-- Search results will be dynamically inserted here -->
        </ul>
    </div>
</div>
