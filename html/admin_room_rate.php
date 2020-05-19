<?php
session_start();
require_once('insert_functions.php');
require_once('functions.php');



if (isset($_REQUEST['show_date'])) {
    $_SESSION['show_date'] = $_REQUEST['show_date'];
    $date = date('Y-m-d', strtotime($_REQUEST['show_date']));
} else {
    $show_date = date('M d,Y');
}
if (isset($_SESSION['show_date'])) {
    $show_date = $_SESSION['show_date'];
}
if (isset($_REQUEST['update_availability'])) {
    $rm_type = $_REQUEST['type_search'];
    $date_from = new DateTime($_REQUEST['date_from']);
    $date_to =  new DateTime($_REQUEST['date_to']);
    $status = $_REQUEST['status'];
    $days = $_REQUEST['days'];
    if($_REQUEST['days']==null){
        $day=0;
    }
    $interval = $date_from->diff($date_to)->format('%a');

    if ($rm_type != null) {
        $begin = date('Y-m-d', strtotime($_REQUEST['date_from']));
        for ($i = 0; $i <= $interval; $i++) {

            $r=update_availability($rm_type, $begin, $days, $status);
            $repeat = strtotime("+1 day", strtotime($begin));
            $begin = date('Y-m-d', $repeat);
        }
    }
}

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
            update_room_rate($begin, $rm_price, $extra_person, $kids_price);
            $repeat = strtotime("+1 day", strtotime($begin));
            $begin = date('Y-m-d', $repeat);
        }
    }
}
//update Room Constraint. Minimum Stay
if (isset($_REQUEST['update_constraint'])) {
    $rm_type = $_REQUEST['type_search'];
    $date_from = new DateTime($_REQUEST['date_from']);
    $date_to =  new DateTime($_REQUEST['date_to']);
    $status = $_REQUEST['status'];
    $days = $_REQUEST['min_stay'];
    $interval = $date_from->diff($date_to)->format('%a');

    if ($rm_type != null) {
        if ($rm_type == 'All') {
            $room_type = get_room_type();
            foreach ($room_type as $e) {
                $begin = date('Y-m-d', strtotime($_REQUEST['date_from']));
                for ($i = 0; $i <= $interval; $i++) {
                    $a = update_room_constraint($e['rm_type'], $begin, $days);
                    $repeat = strtotime("+1 day", strtotime($begin));
                    $begin = date('Y-m-d', $repeat);
                }
            }
        } else {
            $begin = date('Y-m-d', strtotime($_REQUEST['date_from']));
            for ($i = 0; $i <= $interval; $i++) {
                $a = update_room_constraint($rm_type, $begin, $days);
                $repeat = strtotime("+1 day", strtotime($begin));
                $begin = date('Y-m-d', $repeat);
            }
        }
    }
}
//update Meal Plan
if (isset($_REQUEST['update_meal_price'])) {
    $meal_plan = $_REQUEST['type_search'];
    $price = $_REQUEST['price'];
    $kids_price = $_REQUEST['meal_kids'];

    if ($meal_plan != null) {
        update_meal_price($meal_plan, $price, $kids_price);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Room Rate</title>

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
    <style>

    </style>
</head>

<body>
    <?php include_once('admin_navigation_menu.php') ?>
    <div style="height: 10vh"></div>
    <div class="container">


        <div class="ui top attached tabular menu bg-light">
            <a class=" item h4" data-tab="first">Availability</a>
            <a class="item h4" data-tab="second">Room Rate</a>
            <a class="item h4" data-tab="third">Status</a>
            <a class="active item h4" data-tab="fourth">Meal Plan</a>
        </div>
        <div class="ui bottom attached  tab segment" data-tab="first">
            <form action="admin_room_rate.php" method="GET" class="admin_room_rate">
                <fieldset class="p-3">
                    <p class="h3">Update Availability</p>
                    <span class="text-danger"><?php echo $error ?></span>
                    <div class="row">
                        <div class="col">
                            <p>Select type</p>
                            <div class="ui selection dropdown  border border-primary ">
                                <input type="hidden" name="type_search" required value="LV">
                                <i class="dropdown icon big"></i>
                                <div class="default text">Select Room type</div>
                                <div class="menu">
                                    <?php
                                    $rm_type = get_room_type();
                                    foreach ($rm_type as $e) {
                                        echo "<div class=\"item\" data-value=\"{$e[0]}\">{$e[0]}</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ui calendar " id="date_calendar">
                                <p>Date from</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date From" name="date_from" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ui calendar " id="date_calendar_to">
                                <p>Date to</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date To" name="date_to" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <p>Selected Status</p>
                            <div class="ui selection dropdown  border border-primary ">
                                <input type="hidden" class="stop_sales" name="status" required value="Open">
                                <i class="dropdown icon big"></i>
                                <div class="default text">Select Status</div>
                                <div class="menu">
                                    <div class="item" data-value="Open">Open</div>
                                    <div class="item " data-value="Stop Sales">Stop Sales</div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('.stop_sales').change(function(){
                                stop=$('.stop_sales').val();
                                if(stop=='Stop Sales'){
                                    $('.add_days').val(0);
                                }

                            });
                        </script>
                        <div class="col">
                            <p>Add days</p>
                            <div class="ui input focus">
                                <input type="text" class="add_days"  placeholder="Add Days" required name="days" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="col">
                            <P>Update</P>
                            <button class="ui primary input  button click_submit" type="submit" name="update_availability">Update</button>
                            <span class="press"></span>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </form>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">
            <form action="admin_room_rate.php" method="GET" class="admin_room_rate">
                <fieldset class="p-3">
                    <p class="h3">Update Rate Plan</p>
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
                            <P>Update</P>
                            <button class="ui primary input  button click_submit" type="submit" name="rate_plan">Update</button>
                            <span class="press"></span>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </form>
        </div>
        <div class="ui bottom attached tab segment" data-tab="third">
            <form action="admin_room_rate.php" method="GET" class="admin_room_rate">
                <fieldset class="p-3">
                    <p class="h3">Update Room Constraint</p>
                    <span class="text-danger"><?php echo $error ?></span>
                    <div class="row">
                        <div class="col">
                            <p>Select type</p>
                            <div class="ui selection dropdown  border border-primary ">
                                <input type="hidden" name="type_search" required value="LV">
                                <i class="dropdown icon big"></i>
                                <div class="default text">Select Room type</div>
                                <div class="menu">
                                    <?php
                                    $rm_type = get_room_type();
                                    foreach ($rm_type as $e) {
                                        echo "<div class=\"item\" data-value=\"{$e[0]}\">{$e[0]}</div>";
                                    }
                                    ?>
                                    <div class="item" data-value="All">All</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ui calendar " id="date_calendar2">
                                <p>Date from</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date From" name="date_from" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ui calendar " id="date_calendar_to2">
                                <p>Date to</p>
                                <div class="ui input left icon border border-primary">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Date To" name="date_to" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col"></div>
                        <div class="col">
                            <p>Min Stay</p>
                            <div class="ui input focus">
                                <input type="text" placeholder="Min Stay" name="min_stay" required pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="col">
                            <P>Update</P>
                            <button class="ui primary input  button click_submit" type="submit" name="update_constraint">Update</button>
                            <span class="press"></span>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </form>
        </div>
        <div class="ui bottom attached tab segment active" data-tab="fourth">
            <form action="admin_room_rate.php" method="GET" class="admin_room_rate">
                <fieldset class="p-3">
                    <p class="h3">Update Meal Plan</p>
                    <span class="text-danger"><?php echo $error ?></span>
                    <div class="row">

                        <div class="col">
                            <p>Select Meal Type</p>
                            <div class="ui selection dropdown  border border-primary ">
                                <input type="hidden" name="type_search" required value="LV">
                                <i class="dropdown icon big"></i>
                                <div class="default text">Select Room type</div>
                                <div class="menu">
                                    <?php
                                    $meal = get_all_meal_price();
                                    foreach ($meal as $e) {
                                        echo "<div class=\"item\" data-value=\"{$e['rm_meal']}\">{$e['rm_meal']}</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p>Price dirived from <strong>LV</strong></p>
                            <div class="ui input focus">
                                <input type="text" placeholder="Meal Price" name="price" required pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="col">
                            <p>Price for Kids</p>
                            <div class="ui input focus">
                                <input type="text" placeholder="Price for Kids" name="meal_kids" value="*50" required>
                            </div>
                        </div>
                        <div class="col">
                            <P>Update</P>
                            <button class="ui primary input  button click_submit" type="submit" name="update_meal_price">Update</button>
                            <span class="press"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <table class="ui celled table">
                                <thead>
                                    <tr>
                                        <th>Meal</th>
                                        <th>Price</th>
                                        <th>Kids Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($meal as $e) {
                                        echo " <tr><td data-label='Meal'>{$e['rm_meal']}</td><td data-label='Price'>{$e['rm_price_diff']}</td><td data-label='Kids Price'>{$e['rm_kids_price']}</td> </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <SMall>FL: The price affects the difference between Flexible and Non Refundable </SMall>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <table class="ui unstackable table box_shadow">
            <thead class="table_header">
                <tr>
                    <th>Room</th>
                    <th>
                        <div class="ui calendar " id="rate_calendar">
                            <div class="ui input left icon border border-primary">
                                <i class="calendar icon"></i>
                                <input type="text" placeholder="Date From" name="date_from" value="<?php echo $show_date ?>" required>
                            </div>
                        </div>
                    </th>
                    <?php
                    $begin = date('d-M', strtotime($show_date));
                    for ($i = 0; $i < 14; $i++) {
                        echo "  <th class='center aligned'>{$begin}</th>";
                        $repeat = strtotime("+1 day", strtotime($begin));
                        $begin = date('d-M', $repeat);
                    }
                    ?>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($rm_type as $e) {
                    $rm[] = get_room_by_rm_type($e['rm_type']);
                }
                foreach ($rm as $e) {
                    echo '<tr class="bg-secondary"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                    $rate_table .= <<<print
                    <tr class="bg-info">
                    <td class="bg-white"><i class="bed icon"></i><strong> {$e['rm_type']}</strong></td>
                    <td class="right aligned bg-white">Availability</td>
print;
                    $begin = date('Y-m-d', strtotime($show_date));

                    for ($i = 0; $i < 14; $i++) {
                        $ave = get_availability($begin, $e['rm_type']);
                        if ($ave['ra_status'] == 'Open') {
                            $rate_table .= "  <td  class='center aligned' >{$ave['ra_days']}</td>";
                        } else {
                            $rate_table .= " <td class='bg-danger center aligned'>{$ave['ra_days']}</td>";
                        }
                        $repeat = strtotime("+1 day", strtotime($begin));
                        $begin = date('Y-m-d', $repeat);
                    }

                    $rate_table .= <<<print
                </tr>
                <tr class="bg-warning">
                    <td class="bg-white"></td>
                    <td class="right aligned bg-white">Minimum Stay</td>
print;
                    $begin = date('Y-m-d', strtotime($show_date));
                    for ($i = 0; $i < 14; $i++) {
                        $con =  get_constraint($begin, $e['rm_type']);
                        $rate_table .= "<td class='bg-warning center aligned'>{$con['rc_days']}</td>";
                        $repeat = strtotime("+1 day", strtotime($begin));
                        $begin = date('Y-m-d', $repeat);
                    }
                    $rate_table .= ' </tr>';


                    foreach ($meal as $m) {
                        if ($m['rm_meal'] != 'FL') {
                            $rate_table .= "<tr><td class=\"bg-white\">{$m['rm_meal']} <small> (Non Refundable)</small></td>";
                            $rate_table .= ' <td class="right aligned bg-white border-right">Rate</td>';
                            $begin = date('Y-m-d', strtotime($show_date));

                            for ($i = 0; $i < 14; $i++) {
                                $rate =   get_room_rate_by_date($begin);
                                if ($rate != null) {
                                    $price = $rate['rr_price'] + $m['rm_price_diff'] + $e['rm_price_diff'];
                                    $rate_table .= "  <th class=' center aligned border-right'>{$price}</th>";
                                    $repeat = strtotime("+1 day", strtotime($begin));
                                    $begin = date('Y-m-d', $repeat);
                                }
                            }
                            $rate_table .= '</tr>';
                        } else {
                            $flexible = $m['rm_price_diff'];
                        }
                    }
                    foreach ($meal as $m) {
                        if ($m['rm_meal']  != 'FL') {
                            $rate_table .= "<tr><td class=\"bg-white\">{$m['rm_meal']} </td>";
                            $rate_table .= ' <td class="right aligned bg-white border-right">Rate</td>';
                            $begin = date('Y-m-d', strtotime($show_date));
                            for ($i = 0; $i < 14; $i++) {
                                $rate =   get_room_rate_by_date($begin);
                                if ($rate != null) {
                                    $price = $rate['rr_price'] + $m['rm_price_diff'] + $flexible + $e['rm_price_diff'];
                                    $rate_table .=  "  <th class=' center aligned border-right'>{$price}</th>";
                                    $repeat = strtotime("+1 day", strtotime($begin));
                                    $begin = date('Y-m-d', $repeat);
                                }
                            }
                            $rate_table .=  '</tr>';
                        }
                    }
                    echo $rate_table;
                    $rate_table = '';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="height: 10vh"></div>
    <script>
        $('.click_submit').click(function() {
            $('.press').append('<i class="ui small active inline loader"></i>');
        });
        $('.ui.dropdown')
            .dropdown();

        $('#rate_calendar')
            .calendar({
                type: 'date',
                onChange: function(date, text) {
                    window.location = 'admin_room_rate.php?show_date=' + text;
                },
            });
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
        $('#date_calendar2')
            .calendar({
                type: 'date',
                endCalendar: $('#date_calendar_to2'),
            });
        $('#date_calendar_to2')
            .calendar({
                type: 'date',
                startCalendar: $('#date_calendar2'),
            });
        $('.ui.radio.checkbox')
            .checkbox();
        $('.menu .item')
            .tab();
    </script>
</body>

</html>