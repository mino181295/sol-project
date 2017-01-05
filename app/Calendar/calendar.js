$(function(){

    var monthNames = ['Gennaio', 'Febbrario', 'Marzo','Aprile', 'Maggio', 'Giugno', 'Luglio',
    'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    var dayNames = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];

    var seasonColor = ["#428bca", "#5cb85c", "#d9534f", "#f0ad4e"];

    var state = {"monthly": 0, "weekly": 1, "daily": 2}; // calendar enum for month/week/day



    /************************************
    *            FUNCTIONS
    ************************************/
    function getDaysInMonth(year, month) {
        return new Date(year, month+1, 0).getDate();
    }

    function getNextMonth() {
        return (currentMonth+1)%12;
    }

    function getPrevMonth() {
        return (currentMonth-1+12)%12;
    }

    function updateTopBar() {
        var text = currState == state.monthly ? "Calendario mensile " : "Calendario settimanale ";
        var info = monthNames[currentMonth] + " " + currentYear;
        
        $("#topTable h1").text(info);
        $("caption").text(text + info); // aggiorno anche la caption della table
        
        $("#topTable").css('background-color', seasonColor[Math.floor(((currentMonth+1)%12)/3)]);
    }

    function createTHead() {
       var row = $("<tr></tr>"); // creo la riga
       var length = dayNames.length;

       if (currState == state.weekly) {
        row.append($("<th></th>").text("Ora"));
            length -= 2; //escludo il sabato e la domenica
        }
        
        for (i=0; i<length; i++) {
            var day = dayNames[i];
            var content = day.substring(0, (tinyScreen ? 3 : day.length));
            row.append($("<th></th>").text(content)); // creo le colonne
        }

        $("thead").html(row);
    }

    function showMonth() {
        createTHead();
        updateTopBar();

        var firstDay = new Date(currentYear, currentMonth, 1).getDay(); // primo giorno del mese (0-dom, 1-lun, 2-mar, .. 6-sab)
        firstDay = firstDay == 0 ? 7 : firstDay;
        var daysNo = getDaysInMonth(currentYear, currentMonth);
        var cellsNo = daysNo + firstDay - 2; // tengo conto anche delle caselle dei giorni nello scorso mese ma nella prima settimana di quello attuale
        var rowsNo = Math.floor((cellsNo+6)/7); // per arrotondare in eccesso il numero di settimane
        
        var tBody = $("<tbody></tbody>");
        for (var i = 1; i<=rowsNo; i++) {
            var row = $("<tr></tr>");
            for (var j = 1; j <= 7; j++, cellsNo--) {
                var cell = $("<td></td>");

                if (cellsNo < 0) { // giorno del mese successivo ma nella stessa settimana di giorni di questo mese
                    cell.addClass('notCurrMonth');
                    cell.text(-cellsNo);
                } else {
                    var diff = daysNo - cellsNo;   
                    if (diff <= 0) { // giorno del mese precedente ma nella stessa settimana di giorni di questo mese
                        cell.addClass('notCurrMonth');
                        var prevMonth = getPrevMonth();
                        var year = currentYear - (prevMonth == 11 ? 1 : 0);
                        cell.text(getDaysInMonth(year, prevMonth) + diff);
                    } else { // giorno di questo mese
                        cell.text(diff);
                        if (diff == currentDay && currentMonth == date.getMonth() &&
                                                currentYear == date.getFullYear() ) {
                            cell.attr('id', 'currDay');
                        }
                    }
                }
                row.append(cell);
            }
            tBody.append(row);
        };
        $("tbody").remove();
        $("thead").after(tBody);
        pickToday();
     //   $("td").not(".notCurrMonth").click(showWeek);
    }

    function showWeek() {
        updateTopBar();
        createTHead();
        var content = "";
        
        // ottengo i giorni estremi dei questa settimana
        //var currWeek = $("#day-" + currentDay).parent();
        var currWeek = $(this).parent();
        var fDay = currWeek.children().first().text();
        var lDay = currWeek.children().last().text();

        // RICHIESTA TRAMITE AJAX: mando giorni estremi della settimana interessata
        $.getJSON('weekGen.php', {'fDay': fDay, 'lDay': lDay}, function(json) {
            alert(json.result);
        });        

        $("tbody").html(content);
    }

    function goToday() {
        currentYear = date.getFullYear();
        currentMonth = date.getMonth();
        currentDay = date.getDate(); // RIMANE FISSO INDIPENDENTEMENTE DAL MESE-ANNO!
        updateTopBar();
        if (currState == state.monthly) {
            showMonth(); // rigenero il calendario mensile del giorno corrente.
        } else {
            showWeek();  // rigenero il calendario settimanale del giorno corrente.
        }
    }

    function pickToday() {
        $("#currDay").css("background-color", "#EEEEEE"); // va bene sia per mensile che settimanale.
    }



    /************************************
    *            CALLS BACK
    ************************************/
    $("#next").click(function() {
        if (currState == state.monthly) {
            currentMonth = getNextMonth();
            currentYear += currentMonth == 0 ? 1 : 0
            showMonth();
        }
    });

    $("#prev").click(function() {
        if (currState == state.monthly) {
            currentMonth = getPrevMonth();
            currentYear -= currentMonth == 11 ? 1 : 0
            showMonth();
        }
    });

    $("#today").click(goToday);

    $("#monthMode").click(function() {
        currState = state.monthly;
        showMonth();
    });
    
    $("#weekMode").click(function() {
        currState = state.weekly;
        showWeek();
    });



    /************************************
    *   MEDIA QUERY EVENT HANDLER
    ************************************/
    if (matchMedia) {
        var mq = window.matchMedia("(max-width: 768px)");
        mq.addListener(WidthChange);
        WidthChange(mq);
    }

    function WidthChange(mq) {
        tinyScreen = mq.matches; // variabile globale di default
        createTHead();
        $("#weekMode").text(tinyScreen ? "Sett." : "Settimana");
    }



    /************************************
    *             MAIN
    ************************************/
    var date = new Date();
    var currState = state.monthly;
    goToday();

});
