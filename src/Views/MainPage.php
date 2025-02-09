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
            <nav class="md:relative fixed bottom-0 z-40 md:h-full w-full h-20 md:w-24 flex justify-between  items-center md:flex-col bg-gray-200 dark:bg-gray-900 rounded-t-xl md:bg-white md:dark:bg-gray-800 md:border-e border-t-2 border-blue-400 md:border-gray-200 md:dark:border-gray-700">
                <div class="flex md:flex-col items-center justify-evenly md:justify-start gap-y-6 w-full h-full">
                    <div class="w-full md:block hidden">
                        <img class="p-2 mx-auto" src="https://static.vecteezy.com/system/resources/thumbnails/028/754/648/small_2x/3d-purple-online-chatting-bubble-icon-for-ui-ux-web-mobile-apps-social-media-ads-designs-png.png" alt="">
                    </div>

                    <!-- Sidebar Icons -->
                    <div id="chatBoxBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Chat Box
                            </span>
                        </a>
                    </div>

                    <div id="groupBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Group
                            </span>
                        </a>
                    </div>


                    <div id="requestBtn" class="relative hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <div id="reqCount" class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500  rounded-full -top-1 -end-1 dark:border-gray-900">0</div>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Friends Request
                            </span>
                        </a>
                    </div>

                    <div id="followBtn" class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 focus:outline-none focus:bg-blue-400 focus:text-white dark:focus:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-50 py-1.5 px-2.5 bg-gray-600  dark:bg-gray-700 text-xs text-white rounded-lg whitespace-nowrap" role="tooltip">
                                Follow
                            </span>
                        </a>
                    </div>

                    <div class=" hidden md:inline-block">
                        <button id="theme-toggle" class=" p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold md:rounded-full rounded-xl border border-transparent text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 md:hover:bg-gray-100 md:dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none">
                            <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                            <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
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
