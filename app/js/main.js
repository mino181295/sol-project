$(document).ready(function () {

    var docHeight = $(document).height();
    var docWidth = $(document).width();
    //Controllo per la label brand
    if (docWidth < 768) {
        $("#sol-label").text("SOL");
        $("#school-information").hide();
    } else {
        $("#sol-label").text("Studenti Online");
    }
    //Controllo per il toggle

    if (!$("#wrapper").hasClass("toggled") && docWidth > 768) {
        $("#sidebar-btn").removeClass("fa-cogs");
        $("#sidebar-btn").addClass("fa-arrow-left");
    }
    //Controllo nel resize se c'è da cambiare la label brand
    $(window).resize(function () {
        docHeight = $(document).height();
        docWidth = $(document).width();

        if (!$("#wrapper").hasClass("toggled") && docWidth > 768) {
            $("#sidebar-btn").removeClass("fa-cogs");
            $("#sidebar-btn").addClass("fa-arrow-left");
        } else {
            $("#sidebar-btn").removeClass("fa-arrow-left");
            $("#sidebar-btn").addClass("fa-cogs");
        }

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
    var randomEffectVector = ["flipInX", "flipInY"];
    $('.btn-sq').hide().each(function () {
        $(this).delay(eT).fadeIn('fast').addClass("animated "+ randomEffectVector[Math.floor(Math.random()*2)]);
        eT += 350;
    });
    $('.btn-sq').click(function () {
        $('.btn-sq').stop(true, true).fadeIn();
    });
    //Cambio background dei bottoni
    $(".btn-sq *, .btn-sq").hover(function () {
        $(this).closest(".btn-sq").css("background-color", "#660000");
        $(this).closest(".btn-sq").children("i").addClass("animated pulse");

    }, function () {
        $(this).closest(".btn-sq").css("background-color", "#7f0000");
        $(this).closest(".btn-sq").children("i").removeClass("animated pulse");

    });
    //Shake delle notifiche
    $("#navbar-notification a, navbar-notification").hover(function () {
        $("#notification-label, #notification-number").addClass("animated shake");
    }, function () {
        $("#notification-label, #notification-number").removeClass("animated shake");

    });
    
    //Cambio al click della sidebar
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        $("#sidebar-btn").addClass("animated rotateIn");
        setTimeout(function () {
            $("#sidebar-btn").removeClass('animated rotateIn');
        }, 1300);

        console.log("Fade out");

        $("#sidebar-btn").toggleClass("fa-cogs fa-arrow-left");

    });

});