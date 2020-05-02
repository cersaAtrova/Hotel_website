<?php
require_once('insert_functions.php');
require_once('functions.php');
session_start();

if (isset($_REQUEST['resv_submit'])) {
    if (empty($_REQUEST['date_from']) || empty($_REQUEST['date_to']) || empty($_REQUEST['type_search']) || !isset($_REQUEST['rad_search'])) {
        $error = 'Please select all field';
    } else {
        if ($_REQUEST['rad_search'] == 'all') {
            $status = null;
        } else {
            $status = $_REQUEST['rad_search'];
        }
        $error = '';
        if ($_REQUEST['type_search'] == 'in') {
            $resv = get_reservation_by_check_in(new DateTime($_REQUEST['date_from']), new DateTime($_REQUEST['date_to']), $status);
        }
        if ($_REQUEST['type_search'] == 'out') {
            $resv = get_reservation_by_check_out(new DateTime($_REQUEST['date_from']), new DateTime($_REQUEST['date_to']), $status);
        }
        if ($_REQUEST['type_search'] == 'day') {
            $resv = get_reservation_by_day_booked(new DateTime($_REQUEST['date_from']), new DateTime($_REQUEST['date_from']), $status);
        }
    }
}
if (isset($_REQUEST['search_top'])) {
    $resv = get_reservation_by_resv_id($_REQUEST['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Reservation</title>

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
    <script src="../script/script.js"></script>


</head>

<body class="bg-light">
    <?php include_once('admin_navigation_menu.php') ?>
    <div style="height: 10vh"></div>
    <div class="container">
        <p class="display-3 text-primary font-weight-bold">Reservation</p>
        <form action="admin_reservation.php" method="GET">
            <fieldset class="p-3">
                <span class="text-danger"><?php echo $error ?></span>
                <div class="row">
                    <div class="col">
                        <span>Select type</span>
                        <div class="ui selection dropdown  border border-primary ">
                            <input type="hidden" name="type_search" required>
                            <i class="dropdown icon big"></i>
                            <div class="default text">Select_type</div>
                            <div class="menu">
                                <div class="item" data-value="in">Check in</div>
                                <div class="item" data-value="out">Check out</div>
                                <div class="item" data-value="day">Day Booked</div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="ui calendar " id="date_calendar">
                            <span>Date from</span>
                            <div class="ui input left icon border border-primary">
                                <i class="calendar icon"></i>
                                <input type="text" placeholder="Date From" name="date_from" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">


                        <div class="ui calendar " id="date_calendar_to">
                            <span>Date to</span>
                            <div class="ui input left icon border border-primary">
                                <i class="calendar icon"></i>
                                <input type="text" placeholder="Date To" name="date_to" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>Search</div>
                        <button class="ui primary input  button" type="submit" name="resv_submit">Search</button>
                    </div>
                </div>
                <div class="ui form p-3 ">
                    <div class="inline fields ">
                        <label for="fruit">Option:</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="rad_search" checked value="all" tabindex="0" class="hidden">
                                <label>All</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="rad_search" value="Confirm" tabindex="0" class="hidden">
                                <label>Confirm</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="rad_search" value="Cancelled" tabindex="0" class="hidden">
                                <label>Cancelled</label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="p-0 m-0">
            </fieldset>
        </form>

        <?php

        if ($resv != null) {
            show_reservation_overview($resv);
        } else {
            echo '<p class="h4 p-3 border border-primary text-center">Nothing for Today</p>';
        }
        ?>
    </div>

    <script>
        $('.ui.dropdown')
            .dropdown();
        $('#date_calendar')
            .calendar({
                type: 'date',
                endCalendar: $('#date_calendar_to'),
            });
        $('#date_calendar_to')
            .calendar({
                type: 'date',
                startCalendar: $('#date_calendar'),
            });
        $('.ui.radio.checkbox')
            .checkbox();
    </script>
</body>

</html>