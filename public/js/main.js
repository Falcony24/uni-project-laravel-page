$(document).ready(function () {
    let hideTimeout;

    $(".cursor-pointer, #dropdown-menu").hover(
        function () {
            clearTimeout(hideTimeout);
            $("#dropdown-menu").stop(true, true).removeClass("hidden").fadeIn(300);
        },
        function () {
            hideTimeout = setTimeout(function () {
                $("#dropdown-menu").fadeOut(300, function () {
                    $(this).addClass("hidden");
                });
            }, 2500);
        }
    );
});
