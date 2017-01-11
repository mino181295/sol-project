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
        var info = monthNames[currentMonth] + " " + currentYear;
        $("#topTable h1").text(info);        
        $("#topTable").css('background-color', seasonColor[Math.floor(((currentMonth+1)%12)/3)]);
    }

    // Creo il thead della table interessata ed aggiorno la caption
    function createTHead() {
        var row = $("<tr></tr>"); // creo la riga
        var length = dayNames.length;
        var table = "#monthly-table ";
        var caption = "Calendario mensile ";

        if (currState == state.weekly) {
            row.append($("<th></th>").text("Ora"));
            length -= 2; //escludo il sabato e la domenica
            table = "#weekly-table ";
            caption = "Calendario settimanale ";
        }
        
        // recupero i numeri dei giorni della settimana corrente
        var days = new Array();
        if (currState == state.weekly) {
            var week = $("#monthly-table tbody tr").eq(currentWeek-1);
            $.each(week.children(), function() {
                days.push($(this).text());
            });
        }

        // creo le colonne di intestazione con i nomi dei giorni
        for (i=0; i<length; i++) {
            var cell = $("<th></th>");

            var day = dayNames[i];
            var dayNum = days.length == 0 ? "" : " " + days[i]; // recupero il numero del giorno
            if (dayNum == currentDay)
                cell.addClass('currDay');

            var content = day.substring(0, (tinyScreen ? 3 : day.length)) + dayNum; // uso abbreviazioni per schermi piccoli
            row.append(cell.text(content));
        }

        // aggiorno la caption della table con indicazione del mese, dell'anno e dell'eventuale settimana
        var info = monthNames[currentMonth] + " " + currentYear;
        info += currState == state.weekly ? ": settimana da lunedì " + fDay + " a venerdì " + lDay + "." : "";
        $(table + "caption").text(info);

        $(table + "thead").html(row);
    }

    // updateWeekNo==true -> setto il numero di settimana SOLO quando scorro i mesi e quando tornon al giorno corrente.
    function createMonth(updateWeekNo) {
        createTHead();
        updateTopBar();
        
        //setto di default la settimana iniziale a 1 poi la imposterò eventualmente a quella del giorno corrente
        if (updateWeekNo)
            currentWeek = 1; 

        // di default considero il mese "completo" i.e. terminante di domenica.
        monthComplete = true;

        var firstDay = new Date(currentYear, currentMonth, 1).getDay(); // primo giorno del mese (0-dom, 1-lun, 2-mar, .. 6-sab)
        firstDay = firstDay == 0 ? 7 : firstDay;
        var daysNo = getDaysInMonth(currentYear, currentMonth);
        var cellsNo = daysNo + firstDay - 2; // tengo conto anche delle caselle dei giorni nello scorso mese ma nella prima settimana di quello attuale
        var rowsNo = Math.floor((cellsNo+6)/7); // per arrotondare in eccesso il numero di settimane
        
        weeksNo = rowsNo;

        var tBody = $("<tbody></tbody>");
        for (var i = 1; i<=rowsNo; i++) {
            var row = $("<tr></tr>");
            for (var j = 1; j <= 7; j++, cellsNo--) {
                var cell = $("<td></td>");

                if (cellsNo < 0) { // giorno del mese successivo ma nella stessa settimana di giorni di questo mese
                    cell.addClass('notCurrMonth');
                    cell.text(-cellsNo);
                    monthComplete = false;
                } else {
                    var diff = daysNo - cellsNo;   
                    if (diff <= 0) { // giorno del mese precedente ma nella stessa settimana di giorni di questo mese
                        cell.addClass('notCurrMonth');
                        var prevMonth = getPrevMonth();
                        var year = currentYear - (prevMonth == 11 ? 1 : 0);
                        cell.text(getDaysInMonth(year, prevMonth) + diff);
                    } else { // giorno di questo mese
                        cell.text(diff);
                        if (diff == currentDay && currentMonth == date.getMonth() && currentYear == date.getFullYear()) {
                            cell.addClass("currDay");
                            if (updateWeekNo) 
                                currentWeek = i;
                        }

                    }
                }
                row.append(cell);
            }
            tBody.append(row);
        };
        $("#monthly-table tbody").remove();
        $("#monthly-table thead").after(tBody);
        pickToday();
    }

    function showMonth() {
        $("#weekly-table").fadeOut();
        $("#monthly-table").fadeIn();
    }

    function showWeek() {
        var content = "";

        // prendo gli estremi della settimana corrente
        week = $("#monthly-table tbody tr").eq(currentWeek-1);
        fDay = week.children().first().text();
        lDay = week.children().last().text();

        console.log("week-" + currentWeek + "; fDay: " + fDay + "; fDay: " + lDay);

        // RICHIESTA TRAMITE AJAX: mando giorni estremi della settimana interessata
        $.getJSON('weekGen.php', {'fDay': fDay, 'lDay': lDay}, function(json) {
          //  alert(json.result);
      });        

        $("#weekly-table tbody").html(content);

        createTHead();
        updateTopBar();

        $("#monthly-table").fadeOut();
        $("#weekly-table").fadeIn();
        pickToday();
    }

    function goToday() {
        currentYear = date.getFullYear();
        currentMonth = date.getMonth();
        currentDay = date.getDate(); // RIMANE FISSO INDIPENDENTEMENTE DAL MESE-ANNO!
        createMonth(true); // rigenero il calendario mensile del giorno corrente (lo rigenero sempre in quando quello settimanale SI BASA su quello mensile)
        if (currState == state.weekly) {
            showWeek();  // rigenero il calendario settimanale del giorno corrente.
        } else {
            showMonth();
        }
    }

    function pickToday() {
        $(".currDay").css("background-color", "#EEEEEE"); // va bene sia per mensile che settimanale.
    }



    /************************************
    *            CALLS BACK
    ************************************/
    $("#next").click(function() {
        var nextM = false;
        
        if (currState == state.weekly) {
            currentWeek = currentWeek % weeksNo + 1; 
            if (currentWeek == 1) {
                nextM = true; 
                // prendo la seconda settimana del mese corrente (evito di prendere la prima 2 volte) se il mese precedente non finiva di domenica
                currentWeek += monthComplete ? 0 : 1; 
            }
        }
        
        // devo scorrere di un mese
        var monthly = currState == state.monthly
        if (nextM || monthly) {
            currentMonth = getNextMonth();
            currentYear += currentMonth == 0 ? 1 : 0
            createMonth(monthly); // creo solo
        }

        if (currState == state.weekly)
            showWeek(); // creo+mostro
        else
            showMonth();
    });

    $("#prev").click(function() {
        var prevM = false;
        
        if (currState == state.weekly) {
            currentWeek--; 
            prevM = currentWeek == 0; 
        }
        
        // devo scorrere di un mese
        var monthly = currState == state.monthly
        if (prevM || monthly) {
            currentMonth = getPrevMonth();
            currentYear -= currentMonth == 11 ? 1 : 0
            createMonth(monthly); // creo solo
        }

        if (currState == state.weekly) {
            if (prevM) 
                currentWeek = weeksNo - (monthComplete ? 0 : 1); // prendo la penultima settimana del mese corrente (evito di prendere l'ultima 2 volte) se il mese non finisce di domenica
            showWeek(); // creo+mostro
        }
        else
            showMonth();
    });

    $("#today").click(goToday);

    $("#monthMode").click(function() {
        currState = state.monthly;
        createMonth(true);
        showMonth();
    });
    
    $("#weekMode").click(function() {
        currState = state.weekly;
        showWeek(); // sfrutto il calendario mensile già creato.
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
    var currentYear;
    var currentMonth;
    var currentWeek;
    var currentDay; 
    var currState = state.monthly;
    var fDay;
    var lDay;
    goToday();

});
