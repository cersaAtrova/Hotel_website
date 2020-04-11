$('#rangestart').calendar({
    type: 'date',
    today: true,
    multiMonth: 1,
    firstDayOfWeek: 1,
    endCalendar: $('#rangeend'),
    minDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
    onChange: function (date, text) {
     
    },
});

$('#rangeend').calendar({
    type: 'date',
    
    multiMonth: 1,
    firstDayOfWeek: 1,
    startCalendar: $('#rangestart'),
    onChange: function (date, text) {
        $('#check_out').text(text);
       
    },
});

$('#inline_calendar')
.calendar({
    type: 'date',
});


$(document).ready(function () {
    $('.flex-box-form').on('change', '#adults', function() {
        validAdults('#kids','#adults');
    });
    $('.flex-box-form').on('change', '#adults2', function() {
        validAdults('#kids2','#adults2');
    });

    $('.flex-box-form').on('change', '#adults3', function() {
        validAdults('#kids3','#adults3');
    });
   
    $('.flex-box-form').on('change', '#kids', function() {
        validKids('#kids','#adults');
    });
    $('.flex-box-form').on('change', '#kids2', function() {
        validKids('#kids2','#adults2');
    });

    $('.flex-box-form').on('change', '#kids3', function() {
        validKids('#kids3','#adults3');
    });
  
 
    $('#room').change(function () {
        var room = $('.dropdown-select#room').val();

        if(room==1){
            $("#room2>div" ).remove();
            $("#room3>div" ).remove();
        }
        if(room==2){
            $("#room2>div" ).remove();
            $("#room3>div" ).remove();
            addSelectBox(2);
         
            
        }
        if(room==3){
            $("#room2>div" ).remove();
            addSelectBox(2);
            addSelectBox(3);
        }
     
    });
    function validAdults(kids,adults){
       
        var adls = $(adults).val();

        for (i = 0; i < $('.dropdown-select'+adults+' > option').length; i++) {
            if (i <=  4 - adls) {
                $(kids+" option[value=" + i + "]").prop("disabled", false);
            } else {
                $(kids+" option[value=" + i + "]").prop("disabled", true);
            }
        }
     }

    function validKids(kids,adults){
     
        var child = $(kids).val();
        for (i = 1; i <= $('.dropdown-select'+adults+' > option').length; i++) {
            if (i <=  4 - child) {
                $(adults+" option[value=" + i + "]").prop("disabled", false);
            } else {
                $(adults+" option[value=" + i + "]").prop("disabled", true);
            }
        }
    }
    function addSelectBox(i) {
        $("#room" + i).append('<div class=" col-4  "><label for="adults"><span>&starf;</span> Adults (13+)</label><div class="ui "><div class="field "><select name="adults' + i + '" id="adults' + i + '" class="dropdown-select adults' + i + '" required  ><option value="1">1</option><option selected value="2">2</option><option value="3">3</option><option value="4">4</option></select></div></div></div><div class="col-4"><label for="kids"><span>&starf;</span> Kids (2-12)</label><div class="ui "><div class="field"><select name="kids' + i + '" id="kids' + i + '" class="dropdown-select kids' + i + '" required  ><option selected value="0">0</option><option  value="1">1</option><option value="2">2</option><option disabled value="3">3</option></select></div></div></div><div class="col-4"><label for="last-name"><span>&starf;</span> Infants (0-2)</label><div class="ui "><div class="field"><select name="infants' + i + '" class="dropdown-select infants' + i + '" required id="infants' + i + '" aria-placeholder="Infant"><option selected value="0">0</option><option value="1">1</option><option value="2">2</option></select></div></div></div>');
    }
});