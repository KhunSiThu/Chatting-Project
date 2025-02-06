let intervalId; // Variable to store the interval ID

setInterval(async () => {
    await getFriendList();
    let length = await friendRequests();
    await followFriend();
    await getUserGroup();
    document.querySelector("#reqCount").textContent = length;
}, 1000)