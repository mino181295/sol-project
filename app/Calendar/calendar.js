$(function(){

    var monthNames = ['Gennaio', 'Febbrario', 'Marzo','Aprile', 'Maggio', 'Giugno', 'Luglio',
                       'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    var dayNames = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Sabato', 'Domenica'];

    function showDate() {
        $(".month-yearInfo").text(monthNames[currentMonth] + " - " + currentYear);
    }

    function getDaysInMonth(year, month) {
        return new Date(year, month+1, 0).getDate();
    }

    $("#nextMonth").click(function() {
        currentMonth = (currentMonth+1)%12;
        currentYear += currentMonth == 0 ? 1 : 0
        showDate();
    });

    $("#prevMonth").click(function() {
        currentMonth = (currentMonth-1+12)%12;
        currentYear -= currentMonth == 11 ? 1 : 0
        showDate();
    });

    /*************************
    * MAIN 
    **************************/
    var d = new Date();
    var currentYear = d.getFullYear();
    var currentMonth = d.getMonth();
    showDate();
});
