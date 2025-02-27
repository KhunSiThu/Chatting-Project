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
        <div id="sidebar" class="flex  md:h-screen w-screen md:w-auto bg-white dark:bg-gray-800 border-e border-gray-200 dark:border-gray-700">

            <nav id="sideBarMenu" class=" fixed md:relative hidden  z-50 h-screen w-screen md:w-24 md:flex justify-between  md:items-center md:flex-col md:bg-gray-200 dark:md:bg-gray-900  md:rounded-none ">
                <div class="flex flex-col md:w-full w-2/3 items-center p-5 md:p-0 bg-gray-200 dark:bg-gray-900 md:bg-none justify-evenly md:justify-start gap-y-6 h-full">
                    <div class="md:w-full w-24">
                        <img class="p-2 mx-auto" src="https://static.vecteezy.com/system/resources/thumbnails/028/754/648/small_2x/3d-purple-online-chatting-bubble-icon-for-ui-ux-web-mobile-apps-social-media-ads-designs-png.png" alt="">
                    </div>

                    <!-- Profile Icon -->
                    <div id="" class="userProfileBtn md:hidden w-full md:w-auto hs-tooltip [--placement:right] ">
                        <a class="hs-tooltip-toggle w-full md:w-auto p-2 inline-flex justify-start items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 " href="#">
                            <img class="w-8" src="../images/profile.png" alt="">
                            <span class="md:hidden">
                                Profile
                            </span>
                        </a>
                    </div>

                    <div id="chatBoxBtn" class="hs-tooltip w-full md:w-auto [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle w-full md:w-auto p-3 inline-flex justify-start items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 " href="#">
                            <img class="w-8" src="../images/chat.png" alt="">
                            <span class="md:hidden">
                                Chat Box
                            </span>
                        </a>
                    </div>

                    <div id="groupBtn" class="hs-tooltip w-full md:w-auto [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 w-full md:w-auto inline-flex justify-start items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 " href="#">
                            <img class="w-8" src="../images/group.png" alt="">
                            <span class="md:hidden">
                                Group Chat
                            </span>
                        </a>
                    </div>


                    <div id="newFeedBtn" class="hs-tooltip w-full md:w-auto [--placement:right] hidden md:inline-block">
                        <a href="#" class="hs-tooltip-toggle w-full md:w-auto p-3 inline-flex justify-start items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 ">
                            <img class="w-8" src="../images/content.png" alt="">
                            <span class="md:hidden">
                                New Feed
                            </span>
                        </a>
                    </div>

                    <div id="requestBtn" class="relative w-full md:w-auto hs-tooltip [--placement:right] hidden md:inline-block">
                        <a class="hs-tooltip-toggle p-3 w-full md:w-auto inline-flex justify-start items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 " href="#">
                            <img class="w-8" src="../images/bell.png" alt="">
                            <div id="reqCount" class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500  rounded-full -top-1 -end-1 dark:border-gray-900">0</div>
                            <span class="md:hidden">
                                Friends Request
                            </span>
                        </a>
                    </div>

                    <div class="md:inline-block hidden">
                        <button id="theme-toggle" class=" p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold md:rounded-full rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 md:hover:bg-gray-100 md:dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 ">
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

                    <div class="hs-tooltip [--placement:right] w-full md:w-auto inline-block">
                        <button id="logoutBtn" class=" logoutBtn w-full md:w-auto hs-tooltip-toggle p-3 inline-flex justify-start items-center gap-x-2 text-sm font-semibold md:rounded-full rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 md:hover:bg-gray-100 md:dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 " href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span class="md:hidden">
                                Logout
                            </span>
                        </button>
                    </div>

                    <hr class="w-full md:hidden">

                    <div class="flex w-full md:hidden items-center justify-between p-2 text-gray-700 dark:text-gray-200">
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
                    </div>


                    <!-- Repeat other sidebar icons here -->
                </div>

                <div onclick="closeMobileSideBar()" class="w-1/3 h-full block bg-black/90 md:hidden">
                </div>

                <!-- Profile Icon -->
                <div id="userProfileBtn" class=" userProfileBtn hs-tooltip [--placement:right] md:inline-block mb-5 hidden">
                    <a class="hs-tooltip-toggle p-1 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 " href="#">
                        <img class="w-10 h-10 object-cover rounded-full" src="<?= !empty($userData['profileImage']) ? '../uploads/profiles/' . $userData['profileImage'] : 'https://t3.ftcdn.net/jpg/10/58/16/08/360_F_1058160846_MxdSa2GeeVAF5A7Zt9X7Bp0dq0mlzeDe.jpg' ?>" alt="">

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