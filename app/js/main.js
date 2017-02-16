$(document).ready(function () {

    //Ottenimento dei valori dell'altezza
    var docHeight = $(document).height();
    var docWidth = $(document).width();

    //Carica dentro un selettore un certo html
    function loadContent(selector, path) {
        selector.html("").load(path);
    }
    //Rimpiazza per uno script
    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
    }
    //Controllo per la label brand
    if (docWidth < 769) {
        $("#sol-label").text("SOL");
        $("#school-information").hide();
    } else {
        $("#sol-label").text("Studenti Online");
    }
    //Controllo per il toggle
    if (!$("#wrapper").hasClass("toggled") && docWidth > 769) {
        $("#sidebar-btn").removeClass("fa-cogs");
        $("#sidebar-btn").addClass("fa-arrow-left");
    }
    //Carica il contenuto principale home inizialmente
    loadContent($('#page-container'), 'snippets/home-snippet.html');

    //bind del tasto home
    $('.home-link').click(function () {
        loadContent($('#page-container'), 'snippets/home-snippet.html');
    });

    //Click binding del servizio
    $(document).on("click", ".service-link, #back-to-service", function () {
        loadContent($('#page-container'), 'snippets/servizio-snippet.php');
    });

    $(document).on("click", ".calendar-service", function () {
        loadContent($('#page-container'), '../calendar/calendar-panel.php');
    });

    //Bind dei tasti di una materia 
    $(document).on("click", "#servizio-container .list-group-item", function () {
        loadContent($('#page-container'), 'snippets/materia-snippet.php?materia=' + replaceAll($(this).text(), " ", "%20"));
    });
    //Controllo nel resize se c'è da cambiare la label brand
    $(window).resize(function () {

        docHeight = $(document).height();
        docWidth = $(document).width();

        if (!$("#wrapper").hasClass("toggled") && docWidth > 769) {
            $("#sidebar-btn").removeClass("fa-cogs").addClass("fa-arrow-left");
        } else {
            $("#sidebar-btn").removeClass("fa-arrow-left").addClass("fa-cogs");
        }

        if (docWidth < 769) {
            $("#sol-label").text("SOL");
            $("#school-information").hide();

        } else {
            $("#sol-label").text("Studenti Online");
            $("#school-information").show();
        }
    });

    //Aggiunta redirection materia
    $(document).on('click', '#weekly-table td a', function(){
        var nomeMateria = $(this).text().split(" - ")[0].replace("/ /g", "+");
        // console.log(nomeMateria);
        loadContent($('#page-container'), 'php/materia-snippet.php?materia='+nomeMateria);       
    });

    //Fade in dei bottoni
    $(document).on('DOMNodeInserted', '#buttons-container', function () {
        var eT = 0;
        var randomEffectVector = ["flipInY", "flipInX"];
        $('.btn-sq i').css({
            opacity: '0'
        });
        $('.btn-sq').hide().each(function () {
            $(this).delay(eT).fadeIn('slow') /*.addClass("animated " + randomEffectVector[Math.floor(Math.random() * 2)])*/ ;
            eT += 250;
        });

        var eT2 = 300;
        $('.btn-sq i').each(function () {
            $(this).delay(eT2).fadeTo(0, 1, function () {
                $(this).addClass("animated " + randomEffectVector[Math.floor(Math.random() * 2)])
            });
            eT2 += 250;
        });

        $(document).on("click", ".btn-sq *, .btn-sq", function () {
            $('.btn-sq').stop(true, true).fadeIn();
        });
        //Cambio background dei bottoni
        $(".btn-sq *, .btn-sq").hover(function () {
            $(this).closest(".btn-sq").css("background-color", "#660000");
            $(this).closest(".btn-sq").children("i").removeClass("animated flipInX flipInY")
                .addClass("animated pulse");

        }, function () {
            $(this).closest(".btn-sq").css("background-color", "#7f0000");
            $(this).closest(".btn-sq").children("i").removeClass("animated pulse");

        });

    });
    var i = true;
    $(document).on('DOMNodeInserted', '#calendar-panel', function () {

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
        $("#sidebar-btn").toggleClass("fa-cogs fa-arrow-left");
    });
    //Calcolo notifiche
    $("#navbar-notification .dropdown").click(function () {
        $.get("../notification/notifications.php", function (data) {
            $("#notification-container").html(data);
        });
        $("#notification-number").replaceWith('<span id="notification-number" class="badge badge-notify">0</span>');
    });

});