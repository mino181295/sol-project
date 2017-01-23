$(document).ready(function () {

    var docHeight = $(document).height();
    var docWidth = $(document).width();

    if (docWidth < 768) {
        $("#sol-label").text("SOL");
        $("#school-information").hide();
    } else {
        $("#sol-label").text("Studenti Online");
    }

    if ($("#wrapper").hasClass("toggled")) {
        $("#sidebar-btn").addClass("glyphicon-menu-right");
        $("#sidebar-btn").removeClass("glyphicon-menu-left");
    } else {

        $("#sidebar-btn").addClass("glyphicon-menu-left");
        $("#sidebar-btn").removeClass("glyphicon-menu-right");

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

    //Fade in dei bottoni
    var eT = 0;
    $('.btn-sq').hide().each(function () {
        $(this).delay(eT).fadeIn('slow').addClass("animated bounceIn");

        eT += 350;
    });
    $('.everything').click(function () {
        $('.everything').stop(true, true).fadeIn();
    });
    //
    $(".btn-sq *, .btn-sq").hover(function () {
        $(this).closest(".btn-sq").css("background-color", "#660000");
        $(this).closest(".btn-sq").children("i").addClass("animated pulse");

    }, function () {
        $(this).closest(".btn-sq").css("background-color", "#7f0000");
        $(this).closest(".btn-sq").children("i").removeClass("animated pulse");

    });
    
    $("#notification-button").hover(function () {
        $("#notification-label").addClass("animated shake");
    }, function () {
        $("#notification-label").removeClass("animated shake");

    });

    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        if ($("#wrapper").hasClass("toggled")) {
            $("#sidebar-btn").addClass("glyphicon-menu-right");
            $("#sidebar-btn").removeClass("glyphicon-menu-left");
        } else {

            $("#sidebar-btn").addClass("glyphicon-menu-left");
            $("#sidebar-btn").removeClass("glyphicon-menu-right");

        }
    });

});