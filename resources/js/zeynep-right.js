$(function () {
    // init zeynepjs side menu
    var zeynep = $(".zeynep").zeynep({
        opened: function () {
            // log
            console.log("the side menu opened");
        },
        closed: function () {
            // log
            console.log("the side menu closed");
        },
    });

    // dynamically bind 'closing' event
    zeynep.on("closing", function () {
        // log
        console.log("this event is dynamically binded");
    });

    // toggle button element
    let toggleButton = document.getElementById("toggleMenu");

    // handle zeynepjs overlay click
    $(".zeynep-overlay").on("click", function () {
        toggleButton.classList.remove("opened");
        toggleButton.setAttribute(
            "aria-expanded",
            toggleButton.classList.contains("opened")
        );

        zeynep.close();
    });

    // open zeynepjs side menu
    $(".btn-open").on("click", function () {
        toggleButton.classList.add("opened");
        toggleButton.setAttribute(
            "aria-expanded",
            toggleButton.classList.contains("opened")
        );

        zeynep.open();
    });
});
