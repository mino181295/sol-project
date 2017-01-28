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

    function goToday() {
        currentYear = date.getFullYear();
        currentMonth = date.getMonth();
        currentDay = date.getDate(); // RIMANE FISSO INDIPENDENTEMENTE DAL MESE-ANNO!
        createMonthBody(true); // rigenero il calendario mensile del giorno corrente (lo rigenero sempre in quando quello settimanale SI BASA su quello mensile)
        if (currState == state.weekly) {
            showWeek();  // rigenero il calendario settimanale del giorno corrente.
        } else {
            showMonth();
        }
    }

    function pickToday() {
        $(".currDay").css("background-color", "#EEEEEE"); // va bene sia per mensile che settimanale.
    }

    function removeDefaultOptions() {
        if (fistTime) {
            fistTime = false;
            $('.weekView option[selected="true"]').remove();
        }
    }

    

    /************************************
    *            MONTH-VIEW
    ************************************/
    function createMonthHead() {
        var row = $("<tr></tr>"); // creo la riga
        var length = dayNames.length;

        // creo le colonne di intestazione con i nomi dei giorni
        for (i=0; i<length; i++) {
            var dayName = dayNames[i];
            var id = dayName;
            var cell = $("<th></th>");
            var content = dayName.substring(0, (tinyScreen ? 3 : dayName.length)); // uso abbreviazioni per schermi piccoli

            row.append(cell.text(content).attr('id', id));
        }

        // aggiorno la caption della table con indicazione del mese, dell'anno e dell'eventuale settimana
        var caption = "Calendario mensile " + monthNames[currentMonth] + " " + currentYear;
        $("#monthly-table caption").text(caption);
        $("#monthly-table thead").html(row);
    }

    // updateWeekNo==true -> setto il numero di settimana SOLO quando scorro i mesi e quando tornon al giorno corrente.
    function createMonthBody(updateWeekNo) {
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
                var cell = $("<td></td>").attr('headers', dayNames[j-1]);

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

    // Prima occorre creare il lBody e poi chiamare show
    function showMonth() {
        createMonthHead();
        updateTopBar();
        $(".weekView").fadeOut("fast", function() {
            $(".monthView").fadeIn();
        });
        
    }



    /************************************
    *            WEEK-VIEW
    ************************************/
    function createWeekHead() {
        var row = $("<tr></tr>"); // creo la riga
        var length = dayNames.length-2; //escludo il sabato e la domenica
        var daysInWeek = new Array();

        // prendo gli estremi della settimana corrente
        week = $("#monthly-table tbody tr").eq(currentWeek-1);
        fDay = week.children().first().text();
        lDay = week.children().last().text(); // considero tutta la settimana anche se poi mostro da lunedì-venerdì
        
        // se devo creare calendario settimanale
        row.append($("<th></th>").text("Ora").addClass('hour').attr('id', 'hour'));
        table = "weekly-table";

        // recupero i numeri dei giorni della settimana corrente NB: siccome li recupero dal calendario mensile si presuppone che questo sia stato prima aggiornato.
        var week = $("#monthly-table tbody tr").eq(currentWeek-1);
        $.each(week.children(), function() {
            daysInWeek.push($(this).text());
        });


        // creo le colonne di intestazione con i nomi dei giorni
        for (i=0; i<length; i++) {
            var dayName = dayNames[i];
            var id = dayName;
            var cell = $("<th></th>");
            var content = dayName.substring(0, (tinyScreen ? 3 : dayName.length)); // uso abbreviazioni per schermi piccoli

            // nel calendario settimanale
            if (currState == state.weekly) {
                var dayNum = daysInWeek[i];
                content += " " + dayNum;            // aggiungo il numero del giorno nell'intestazione
                id += "-" + dayNum;
                if(daysInWeek[i] == currentDay)      // evidenzio la cella di intestazione del giorno corrente
                    cell.addClass('currDay');
            }

            row.append(cell.text(content).attr('id', id));
        }

        // aggiorno la caption della table con indicazione del mese, dell'anno e dell'eventuale settimana
        var caption = "Calendario settimanale " + monthNames[currentMonth] + " " + currentYear +
                                ": settimana da lunedì " + fDay + " a venerdì " + lDay + ".";
        $("#" + table + " caption").text(caption);

        $("#" + table + " thead").html(row);
    }

    function createWeekBody() {
        // creo la struttura del calendario settimanale
        var tBody = $("<tbody></tbody>");
        var fHour = 8; // ipotizzo che le lezioni inizino alle 8 (minimo) e ad ore "spaccate" i.e. (HH:00)
        for (var i = 0; i < 10; i++) { // ipotizzo 10 ore di scuola
            var hour = fHour + i;
            var th = $("<th></th>").addClass('hour').attr('id', hour).attr({
                id: ("ore-" + hour),
                headers: 'hour'
            }).text(hour + ":00");
            var row = $("<tr></tr>").append(th);
            for (var j=0; j < 5; j++) {  //Ipotizzo scuola dal lunedì al venerdì
                var header = $("#weekly-table thead th").eq(j+1).attr('id');
                row.append($("<td></td>").addClass(hour).attr('headers', "ore-" + hour + " " + header));
            }
            tBody.append(row);
        }
        $("#weekly-table tbody").remove();
        $("#weekly-table thead").after(tBody);

        fillWeeklyCal();

        pickToday();
    }

    function fillWeeklyCal() {
        var session = currentMonth <=6 ? 1 : 2;
        var fDate = JSON.stringify(new Date(currentYear, currentMonth, fDay)).replace(/[T,Z]/g, " ");
        var lDate = JSON.stringify(new Date(currentYear, currentMonth, lDay)).replace(/[T,Z]/g, " ");
        var data = {type: "getHours", idCorso: idCorso, year: selectedYear, session: session, fDate: fDate, lDate: lDate};

        // RICHIESTA TRAMITE AJAX
        $.getJSON('queries.php', data, function(json) {
            var result = json.result;       // Mappa dei risultati nel formato numeroGiorno-ora: denomCorso-aula

            // Riempio il calendario settimanale con i valori della query.
            $("#weekly-table td").each(function(index, el) {
                var headers = $(el).attr('headers').split(/[ -]+/); // Mi servono i valori agli indici 1 e 3 corrispondenti ad ora-giorno.
                var field = headers[3] + "-" + headers[1];          // Prendo la materia-aula da result se li colloco nel td corrispettivo.
                $(el).text(""); // "pulisco la cella".
                $(el).text(result[field]);
            });
        }); 
    }

    /* A differenza del calendario mensile, il settimanale lo genero contestualmente alla "visione",
    quello mensile separatamente poiché la creazione di questo potrebbe essere solo per fare da
    supporto alla creazione del settimanale */
    function showWeek() {
        createWeekHead();
        createWeekBody();
        updateTopBar();   
        $(".monthView").fadeOut("fast", function() {
            $(".weekView").fadeIn();   
        });
    }

    function updateCaption(selector, content, override = false) {
        var text = override ? permContent = content : permContent + content; // se override = false: appendo il contenuto attuale a quello passato come argomento.
        $(sele1ctor).text(text);                                             // se = true: sovrascrivo il testo e lo salvo per eventuali successivi append;
    }

    function updateWeekCapiton(content = null) {
        if (content != null) {
            permContent = content; // Sovrascrivo il valore della caption.
        } 
        var year = selectedYear == null ? "" : selectedYear;
        var course = $("#sel-corsostudi").val();
        $("#weekly-table caption").text(permContent + " " + year + "o anno " + course == null ? "" : course);
    }


/*
    // Creo il thead della table interessata ed aggiorno la caption
    function createTHead() {
        var row = $("<tr></tr>"); // creo la riga
        var length = dayNames.length;
        var table = "monthly-table";
        var caption = "Calendario mensile ";
        var daysInWeek = new Array();
        
        // se devo creare calendario settimanale
        if (currState == state.weekly) {
            row.append($("<th></th>").text("Ora").addClass('hour').attr('id', 'hour'));
            length -= 2; //escludo il sabato e la domenica
            table = "weekly-table";
            caption = "Calendario settimanale ";
            id = ""

            // recupero i numeri dei giorni della settimana corrente
            var week = $("#monthly-table tbody tr").eq(currentWeek-1);
            $.each(week.children(), function() {
                daysInWeek.push($(this).text());
            });
        }

        // creo le colonne di intestazione con i nomi dei giorni
        for (i=0; i<length; i++) {
            var dayName = dayNames[i];
            var id = dayName;
            var cell = $("<th></th>");
            var content = dayName.substring(0, (tinyScreen ? 3 : dayName.length)); // uso abbreviazioni per schermi piccoli

            // nel calendario settimanale
            if (currState == state.weekly) {
                var dayNum = daysInWeek[i];
                content += " " + dayNum;            // aggiungo il numero del giorno nell'intestazione
                id += "-" + dayNum;
                if(daysInWeek[i] == currentDay)      // evidenzio la cella di intestazione del giorno corrente
                    cell.addClass('currDay');
            }

            row.append(cell.text(content).attr('id', id));
        }

        // aggiorno la caption della table con indicazione del mese, dell'anno e dell'eventuale settimana
        var info = monthNames[currentMonth] + " " + currentYear;
        info += currState == state.weekly ? ": settimana da lunedì " + fDay + " a venerdì " + lDay + "." : "";
        $("#" + table + " caption").text(info);
        $("#" + table + " thead").html(row);
    }
*/




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
            createMonthBody(monthly); // creo solo
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
            createMonthBody(monthly); // creo solo
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
        createMonthBody(true);
        showMonth();
    });
    
    $("#weekMode").click(function() {
        currState = state.weekly;
        showWeek(); // sfrutto il calendario mensile già creato.
    });


    // Filtri per orario settimanale OCCORRE AGGIORNARE LA CAPTION!
    $("#sel-corsostudi").change(function() { //Usato dai professori
        removeDefaultOptions();
        idCorso = $(this).val().split("-")[1];
        
        // fillo il select dell'anno tramite ajax
        $.getJSON('queries.php', {type: "getYears", idCorso: idCorso}, function(json) {
            $("#sel-anno").empty();
            var years = json.result[0];
            for(var i=1; i<=years; i++) {
                $("#sel-anno").append($("<option></option>").attr('value', i).text(i));
            }
            // aggiorno la vista degli orari
            $("#sel-anno").trigger('change');
        }); 
    });

    // Usato sia da professori che studenti
    $("#sel-anno").change(function(event) {
        removeDefaultOptions();
        selectedYear = $(this).val(); 
        fillWeeklyCal();
     //   updateWeekCaption();
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
        tinyScreen = mq.matches;
        if (currState == state.monthly)
            createMonthHead();
        else
            createWeekHead();
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
    var idCorso = null;
    var selectedYear;
    var fistTime = true; //Flag usato per rimuovere le option vuote di default nei select.

    goToday();

});