var date = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#rangestart').calendar({
    type: 'date',
    today: true,
    multiMonth: 1,
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
    multiMonth: 1,
    firstDayOfWeek: 1,
    startCalendar: $('#rangestart'),
    onChange: function (date, text) {
        var newValue1 = text;
        $('#check_out').text(newValue1);
    },
});

$('#inline_calendar')
    .calendar({
        type: 'date',
    });
$(document).ready(function () {
    $("#adults").append(new Option('Foo', 'foo'));
    $("#adults option[value='3']").remove();
});