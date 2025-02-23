let intervalId; // Variable to store the interval ID

setInterval(async () => {
    await getFriendList();
    await getUserGroup();
    document.querySelector("#reqCount").textContent = length;
}, 1000)