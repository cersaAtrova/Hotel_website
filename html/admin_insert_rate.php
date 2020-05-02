<?php
require_once('functions.php');
require_once('insert_functions.php');

//update RATE PLAN 
if (isset($_REQUEST['rate_plan'])) {
    $rm_price = $_REQUEST['room_price'];
    $date_from = new DateTime($_REQUEST['date_from']);
    $date_to =  new DateTime($_REQUEST['date_to']);
    $extra_person = $_REQUEST['adults_price'];
    $kids_price = $_REQUEST['kids_price'];
    $interval = $date_from->diff($date_to)->format('%a');
    if (valid_rate($rm_price) == false || valid_rate($kids_price) == false || valid_rate($extra_person) == false) {
        $error = 'Field correct the fields';
    } else {
        $begin = date('Y-m-d', strtotime($_REQUEST['date_from']));
        for ($i = 0; $i <= $interval; $i++) {
       
            $a = insert_room_rate($begin, $rm_price, $extra_person, $kids_price);
            if ($a == false) {
                $error .= 'Cant insert new Rate';
            }
            $rm_type = get_room_type();
            foreach ($rm_type as $e) {
                $a=insert_room_constraint($e['rm_type'],$begin);
                if($a==false){
                    $error .= '===Cant insert new Consraint for Room='.$e['rm_type'];
                }
                $a=insert_room_availability($begin,$e['rm_type']);
                if($a==false){
                    $error .= '===Cant insert new Availability for Room='.$e['rm_type'];
                }
            }
            $repeat = strtotime("+1 day", strtotime($begin));
            $begin = date('Y-m-d', $repeat);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Insert Rate</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

    <link rel="stylesheet" href="/CSS/style.css">

</head>

<body>
    <?php include_once('admin_navigation_menu.php') ?>
    <div style="height: 10vh"></div>
    <p class="h4"><?php echo $error ?></p>
    <div class="container">
        <div class="ui top attached tabular menu bg-light">
            <a class="active item h4" data-tab="first">Insert new Room Rate</a>
            <a class="item h4" data-tab="second">Insert new Meal</a>
            <a class="item h4" data-tab="third">Insert new Policy</a>

        </div>
        <div class="ui bottom attached active tab segment" data-tab="first">
            <form action="admin_insert_rate.php" method="GET" class="admin_insert_rate">
                <fieldset class="p-3">
                    <p class="h3">Insert Rate Plan</p>
                    <span class="text-danger"><?php echo $error ?></span>
                    <div class="row">
                        <div class="col">
                            <div class="ui calendar " id="date_calendar1">
                                <p>Date from</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date From" name="date_from" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ui calendar " id="date_calendar_to1">
                                <p>Date to</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date To" name="date_to" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p>Selected Price for <b>B/B and NR</b></p>
                            <div class="ui input focus">
                                <input type="text" class="form-control" placeholder="Price" name="room_price" required pattern="^\d*(\.\d{0,2})?$">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <p>Selected Price for <b>Extra Person</b></p>
                            <div class="ui input focus">
                                <input type="text" placeholder="Price" name="adults_price" value="*25" required>
                            </div>
                        </div>
                        <div class="col">
                            <p>Selected Price for <b>Kids</b></p>
                            <div class="ui input focus">
                                <input type="text" placeholder="Price" name="kids_price" value="*50" required>
                            </div>
                        </div>
                        <div class="col">
                            <P>Insert</P>
                            <button class="ui primary input  button click_submit" type="submit" name="rate_plan">Insert</button>
                            <span class="press"></span>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </form>
        </div>
    </div>

    <script>
        $('.click_submit').click(function(){
            $('.press').append('<i class="ui small active inline loader"></i>');
        });
        $('.ui.dropdown')
            .dropdown();
        $('#date_calendar1')
            .calendar({
                type: 'date',
                endCalendar: $('#date_calendar_to1'),
            });
        $('#date_calendar_to1')
            .calendar({
                type: 'date',
                startCalendar: $('#date_calendar1'),
            });

        $('.ui.radio.checkbox')
            .checkbox();
        $('.menu .item')
            .tab();
    </script>
</body>

</html>