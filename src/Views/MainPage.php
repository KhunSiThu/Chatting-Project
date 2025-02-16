<?php require_once "../Components/header.php";

session_start();

$userId = $_SESSION['user_id'];

require_once "../Controller/dbConnect.php";

$sql = "SELECT * FROM user WHERE userId = '$userId'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

?>
    <main class="flex flex-col md:flex-row min-h-screen">

        <?php require_once "../Components/mobileSideBar.php" ?>

        <!-- Sidebar -->
        <div id="sidebar" class="relative flex md:flex h-screen md:w-auto bg-white dark:bg-gray-800 border-e border-gray-200 dark:border-gray-700 z-40">
            <nav class="md:relative fixed bottom-0 z-40 md:h-full w-full h-20 md:w-24 flex justify-between  items-center md:flex-col bg-gray-200/90 dark:bg-gray-900/90 rounded-t-xl md:rounded-none md:bg-white md:dark:bg-gray-800 md:border-e border-t-2 border-blue-400 md:border-gray-200 md:dark:border-gray-700 ">
                <div class="flex md:flex-col items-center justify-evenly md:justify-start gap-y-6 w-full h-full">
                    <div class="w-full md:block hidden">
                        <img class="p-2 mx-auto" src="https://static.vecteezy.com/system/resources/thumbnails/028/754/648/small_2x/3d-purple-online-chatting-bubble-icon-for-ui-ux-web-mobile-apps-social-media-ads-designs-png.png" alt="">
                    </div>

                    <!-- Sidebar Icons -->


                    <div id="chatBoxBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                                <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Chat Box
                            </span>
                        </a>
                    </div>

                    <div id="groupBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Group
                            </span>
                        </a>
                    </div>


                    <div id="newFeed" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 md:mb-0 border-4 border-white dark:border-gray-800 md:border md:border-transparent inline-flex justify-center items-center gap-x-2 text-sm font-semibold md:rounded-xl rounded-full  text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7 md:size-6">
                                <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                New Feed
                            </span>
                        </a>
                    </div>

                    <div id="requestBtn" class="relative hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                            </svg>
                            <div id="reqCount" class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500  rounded-full -top-1 -end-1 dark:border-gray-900">0</div>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Friends Request
                            </span>
                        </a>
                    </div>

                    <div id="followBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Follow
                            </span>
                        </a>
                    </div>

                    <div class=" hidden md:inline-block">
                        <button id="theme-toggle" class=" p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold md:rounded-full rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 md:hover:bg-gray-100 md:dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none">
                            <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                            </svg>
                            <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Toggle Dark Mode
                            </span>
                        </button>
                    </div>

                    <div class="hs-tooltip [--placement:right] hidden md:inline-block">
                        <button id="logoutBtn" class=" logoutBtn hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold md:rounded-full rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 md:hover:bg-gray-100 md:dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Logout
                            </span>
                        </button>
                    </div>


                    <!-- Repeat other sidebar icons here -->
                </div>

                <!-- Profile Icon -->
                <div id="userProfileBtn" class="hs-tooltip [--placement:right] md:inline-block mb-5 hidden">
                    <a class="hs-tooltip-toggle p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        <img class="w-10 h-10 object-cover rounded-full" src="../uploads/<?= $userData['profileImage'] ?>" alt="">
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                            Profile
                        </span>
                    </a>
                </div>
            </nav>

            <!-- Chat List -->
            <?php include_once("../Components/friendList.php") ?>

        </div>

        <?php require_once "../Components/chatRoom.php"; ?>

        <?php require_once '../Components/userProfile.php'; ?>

    </main>


    <!-- Add Member Modal -->
    <div id="addMemberModal" class="fixed  top-0 left-0 z-50 w-screen h-screen flex hidden justify-center items-center bg-black bg-opacity-50 bg-blur">
        <div class="bg-white relative dark:bg-gray-800 p-8 rounded-lg shadow-md w-full mx-2 max-w-md">

            <button class="absolute top-4 right-4 z-50 dark:text-gray-400" id="closeAddMember">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-gray-100">Add Members</h2>

            <form id="memberForm">
                <div>
                    <label for="memberName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Member Name</label>
                    <input type="text" id="memberName" name="memberName" placeholder="Enter member name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" required />
                </div>
                <hr class="my-6">
                <div id="forMemberList" class="w-full flex flex-col space-y-3  h-[360px] overflow-auto scroll-none">

                </div>
            </form>
            
        </div>
    </div>


<?php require_once '../Components/footer.php';
} else {
    header("location: ../../Public/index.php");
}
?>
<script>
    var userId = "<?php echo $_SESSION['user_id'] ?? ''; ?>";
</script>
<script src="../JS/selector.js"></script>
<script src="../JS/mainPage.js"></script>
<script src="../JS/function.js"></script>
<script src="../JS/functionCall.js"></script>
<script src="../JS/action.js"></script>
<script src="../JS/them.js"></script>