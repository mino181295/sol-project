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
        $(".month-yearInfo").text(monthNames[currentMonth] + " - " + currentYear); // aggiorno anche la caption della table
        $("#prevMonth").text(monthNames[getPrevMonth()]);
        $("#nextMonth").text(monthNames[getNextMonth()]);
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
        currState = state.monthly;
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
            for (var j = 1; j <= 7 && cellsNo >= 0; j++, cellsNo--) {
                var val = (daysNo - cellsNo);
                var cell = $("<td></td>").text(val > 0 ? val : "");
                if (val > 0) {
                    cell.attr('id', "day-" + val);    
                }
                row.append(cell);
            }
            tBody.append(row);
        };

        $("tbody").remove();
        $("thead").after(tBody);
        $("[id^=day-").click(showWeek);
    }

    function showWeek(event) {
        currState = state.weekly;
        createTHead();
        var content = "";
        //event.target.id
        // RICHIESTA TRAMITE AJAX DEL TBODY RELATIVO ALLA SETTIMANA RICHIESTA
       
        $("tbody").html(content);
    }

    function goToday() {
        currentYear = date.getFullYear();
        currentMonth = date.getMonth();
        currentDay = date.getDate();
        updateTopBar();
        showMonth();
        pickToday();
    }

    function pickToday() {
        $("#day-" + currentDay).css("background-color", "#EEEEEE");
    }



    /************************************
    *            CALLS BACK
    ************************************/
    $("#nextMonth").click(function() {
        currentMonth = getNextMonth();
        currentYear += currentMonth == 0 ? 1 : 0
        showMonth();
        if (currentMonth == date.getMonth()) {
            pickToday();
        }
    });

    $("#prevMonth").click(function() {
        currentMonth = getPrevMonth();
        currentYear -= currentMonth == 11 ? 1 : 0
        showMonth();
        if (currentMonth == date.getMonth()) {
            pickToday();
        }
    });

    $("#today").click(function(event) {
        goToday();
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
    }



    /************************************
    *             MAIN
    ************************************/
    var date = new Date();
    var currState = state.monthly;
    goToday();

});
