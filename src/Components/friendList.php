<!-- Chat List -->
<div class="md:w-96 w-full h-screen relative">
    <!-- Search box -->
    <div class="w-full absolute top-0 z-40 h-32 bg-slate-100 dark:bg-gray-700 p-5">
        <form id="search-form" class="w-full flex justify-between">
            <button class="mr-3 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input name="searchText" type="search" id="default-search" class="searchBox block w-full p-3  ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search friends ... " required />
            </div>
        </form>
        <h3 id="mainTitle" class="py-5 text-xl font-bold dark:text-white">Chat Box</h3>
    </div>

    <!-- Chat Items -->
    <div id="chatItems" class="pt-36 px-3 overflow-auto  h-screen scroll-none">
        <ul class="friendList flex flex-col gap-y-3">

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