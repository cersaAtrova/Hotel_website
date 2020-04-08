var date=new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#rangestart').calendar({
    type: 'date',
    today: true,
    multiMonth: 2,
    firstDayOfWeek: 1,
    endCalendar: $('#rangeend'),
    minDate: date,
    onChange: function (date, text) {
        var newValue = text;
       $('#check_in').text(text);
       },
});

$('#rangeend').calendar({
    type: 'date',
    multiMonth: 2,
    firstDayOfWeek: 1,
    startCalendar: $('#rangestart'),
    onChange: function (date, text) {
        var newValue1 = text;
       $('#check_out').text(newValue1);
       },
});

