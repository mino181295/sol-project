$(function(){

    var monthNames = ['Gennaio', 'Febbrario', 'Marzo','Aprile', 'Maggio', 'Giugno', 'Luglio',
    'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    var dayNames = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Sabato', 'Domenica'];

    var seasonColor = ["#428bca", "#5cb85c", "#d9534f", "#f0ad4e"];

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
        $(".month-yearInfo").text(monthNames[currentMonth] + " - " + currentYear);
        $("#prevMonth").text(monthNames[getPrevMonth()]);
        $("#nextMonth").text(monthNames[getNextMonth()]);
        $("#topTable").css('background-color', seasonColor[Math.floor(((currentMonth+1)%12)/3)]);
    }

    function createCalendar() {
        var content = "";
        var firstDay = new Date(currentYear, currentMonth, 1).getDay(); // primo giorno del mese (0-dom, 1-lun, 2-mar, .. 6-sab)
        firstDay = firstDay == 0 ? 7 : firstDay;
        var daysNo = getDaysInMonth(currentYear, currentMonth);
        var cellsNo = daysNo + firstDay - 2; // tengo conto anche delle caselle dei giorni nello scorso mese ma nella prima settimana di quello attuale
        var rowsNo = Math.floor((cellsNo+6)/7); // per arrotondare in eccesso il numero di settimane
        for (var i = 1; i<=rowsNo; i++) {
            content += "<tr>";
            for (var j = 1; j <= 7 && cellsNo >= 0; j++, cellsNo--) {
                var val = (daysNo - cellsNo);
                content += "<td>" + (val > 0 ? val : " ")  + "</td>";
            }
            content += "</tr>";
        };

        $("tbody").html(content);

        updateTopBar();
    }

    $("#nextMonth").click(function() {
        currentMonth = getNextMonth();
        currentYear += currentMonth == 0 ? 1 : 0
        createCalendar();
    });

    $("#prevMonth").click(function() {
        currentMonth = getPrevMonth();
        currentYear -= currentMonth == 11 ? 1 : 0
        createCalendar();
    });

    $("#today").click(function(event) {
        
    });

    /*************************
    * MAIN 
    **************************/
    var d = new Date();
    var currentYear = d.getFullYear();
    var currentMonth = d.getMonth();
    createCalendar();
/*
    // media query event handler
    if (matchMedia) {
      var mq = window.matchMedia("(min-width: 500px)");
      mq.addListener(WidthChange);
      WidthChange(mq);
  }

  function WidthChange(mq) {
      if (mq.matches) {
        alert("ciao");
      } else {
      }

  }
  */
});
