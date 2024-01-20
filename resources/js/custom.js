// Display time with interval update
function showTime() {
    var date = new Date(),
        phTime = new Date(
            date.toLocaleString("en-US", {
                timeZone: "Asia/Manila",
            })
        );

    var timeOptions = {
        timeZone: "Asia/Manila",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        hour12: false,
    };

    var timeFormatter = new Intl.DateTimeFormat("en-US", timeOptions);
    var formattedTime = timeFormatter.format(phTime);

    document.getElementById("timeManila").textContent = formattedTime;
}

setInterval(showTime, 1000);
