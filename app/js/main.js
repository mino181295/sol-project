$(document).ready(function () {

    var docHeight = $(document).height();
    var docWidth = $(document).width();

    if (docWidth < 768) {
        $("#sol-label").text("SOL");
        $("#school-information").hide();
    } else {
        $("#sol-label").text("Studenti Online");
    }

    $(window).resize(function () {

        docHeight = $(document).height();
        docWidth = $(document).width();

        if (docWidth < 768) {
            $("#sol-label").text("SOL");
            $("#school-information").hide();

        } else {
            $("#sol-label").text("Studenti Online");
            $("#school-information").show();
        }

    });

    $("#menu-toggle").click(function (e) {
        alert("Tggoled");
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

});