<?php
require_once 'functions.php';
// require_once '../connect_dbase.php';
session_start();
$check_in = new DateTime($_SESSION['room_info']['check_in']);
$check_out = new DateTime($_SESSION['room_info']['check_out']);

// find the difference of the days
$interval = $check_in->diff($check_out)->format('%a');

$adults = $_SESSION['room_1_guest']['adults'];
$kids = $_SESSION['room_1_guest']['kids'];

$total_adults = $_SESSION['room_1_guest']['adults'] + $_SESSION['room_2_guest']['adults'] + $_SESSION['room_3_guest']['adults'];
$total_kids = $_SESSION['room_1_guest']['kids'] + $_SESSION['room_2_guest']['kids'] + $_SESSION['room_3_guest']['kids'];
$total_infants = $_SESSION['room_1_guest']['infants'] + $_SESSION['room_2_guest']['infants'] + $_SESSION['room_3_guest']['infants'];
//double check if the room are selected correctly
$room_get_selected = 1;
if (isset($_GET['non_refandable']) || isset($_GET['flexible'])) {
    //=======================================================
    //get in when the total room are selected is equal to one
    //=======================================================
    if ($_SESSION['total_room'] == 1) {
        //get the type and the information about the room
        $_SESSION['room_1_selected'] = get_room_type_row($_REQUEST['room_name']);
        if (is_room_available($_SESSION['room_1_selected']['rm_type'], $check_in, $check_out) == false) {
            $error_room_selected = 'Something went wrong! Please try again';
        } else {
            $begin = new DateTime($_SESSION['room_info']['check_in']);
            $end =  new DateTime($_SESSION['room_info']['check_out']);

            $step = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $step, $end);
            foreach ($period as $dt) {
                $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_1_selected']['rm_type'], $_SESSION['room_1_guest']['adults'], $_SESSION['room_1_guest']['kids']);
            }
            if (isset($_GET['flexible'])) {
                $_SESSION['room_1_selected']['rate_plan_selected'] = 'Flexible';
                foreach ($arr as $r) {
                    $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                }
            } else {
                $_SESSION['room_1_selected']['rate_plan_selected'] = 'Non-Refundable';
                foreach ($arr as $r) {
                    $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                }
            }
            //change the price of per room selected and meal selected
            header('Location: billing_information.php?total_room=1');
            die();
        }

        //=======================================================
        //get in when the total room are selected is equal to Two
        //=======================================================
    } elseif ($_SESSION['total_room'] == 2) {

        //===========
        //1 0f 2 Room
        //===========
        $adults = $_SESSION['room_2_guest']['adults'];
        $kids = $_SESSION['room_2_guest']['kids'];
        $room_get_selected = $_SESSION['go_to_room'];
        $room_get_selected = 2;
        //get the type and the information about the room
        if ($_SESSION['go_to_room'] == 1) {
            $_SESSION['go_to_room'] = 2; //move to next room
            $_SESSION['room_1_selected'] = get_room_type_row($_REQUEST['room_name']);
            if (is_room_available($_SESSION['room_1_selected']['rm_type'], $check_in, $check_out) == false) {
                $error_room_selected = 'Something went wrong! Please try again';
            } else {
                $begin = new DateTime($_SESSION['room_info']['check_in']);
                $end =  new DateTime($_SESSION['room_info']['check_out']);

                $step = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $step, $end);
                foreach ($period as $dt) {
                    $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_1_selected']['rm_type'], $_SESSION['room_1_guest']['adults'], $_SESSION['room_1_guest']['kids']);
                }
                if (isset($_GET['flexible'])) {
                    $_SESSION['room_1_selected']['rate_plan_selected'] = 'Flexible';
                    foreach ($arr as $r) {
                        $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                    }
                } else {
                    $_SESSION['room_1_selected']['rate_plan_selected'] = 'Non-Refundable';
                    foreach ($arr as $r) {
                        $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                    }
                }

                //searching for new available rooms . 
                $rm_type = get_room_type();
                foreach ($rm_type as $e) {
                    $rm_availability = get_all_available_rooms($check_in, $check_out, $e[0], 1);
                    if ($rm_availability->rowCount() == $interval) {
                        $rm_ave[] = $rm_availability->fetchAll();
                        $rm_availability->closeCursor();
                    }
                }
            }
        } else {
            //===========
            //2 0f 2 Room
            //===========
            $_SESSION['room_2_selected'] = get_room_type_row($_REQUEST['room_name']);
            if (is_room_available($_SESSION['room_2_selected']['rm_type'], $check_in, $check_out) == false) {
                $error_room_selected = 'Something went wrong! Please try again';
            } else {
                $begin = new DateTime($_SESSION['room_info']['check_in']);
                $end =  new DateTime($_SESSION['room_info']['check_out']);

                $step = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $step, $end);
                foreach ($period as $dt) {
                    $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_2_selected']['rm_type'], $_SESSION['room_2_guest']['adults'], $_SESSION['room_2_guest']['kids']);
                }
                if (isset($_GET['flexible'])) {
                    $_SESSION['room_2_selected']['rate_plan_selected'] = 'Flexible';
                    foreach ($arr as $r) {
                        $_SESSION['room_2_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                    }
                } else {
                    $_SESSION['room_2_selected']['rate_plan_selected'] = 'Non-Refundable';
                    foreach ($arr as $r) {
                        $_SESSION['room_2_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                    }
                }
                unset($_SESSION['go_to_room']);
                //change the price of per room selected and meal selected
                header('Location: billing_information.php?total_room=2');
                die();
            }
        }
    } elseif ($_SESSION['total_room'] == 3) {
        //get the type and the information about the room
        //===========
        //1 0f 3 Room
        //===========
        if ($_SESSION['go_to_room'] == 1) {
            $_SESSION['go_to_room'] = 2; //move to next room
            $_SESSION['room_1_selected'] = get_room_type_row($_REQUEST['room_name']);
            if (is_room_available($_SESSION['room_1_selected']['rm_type'], $check_in, $check_out) == false) {
                $error_room_selected = 'Something went wrong! Please try again';
            } else {
                $begin = new DateTime($_SESSION['room_info']['check_in']);
                $end =  new DateTime($_SESSION['room_info']['check_out']);

                $step = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $step, $end);
                foreach ($period as $dt) {
                    $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_1_selected']['rm_type'], $_SESSION['room_1_guest']['adults'], $_SESSION['room_1_guest']['kids']);
                }
                if (isset($_GET['flexible'])) {
                    $_SESSION['room_1_selected']['rate_plan_selected'] = 'Flexible';
                    foreach ($arr as $r) {
                        $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                    }
                } else {
                    $_SESSION['room_1_selected']['rate_plan_selected'] = 'Non-Refundable';
                    foreach ($arr as $r) {
                        $_SESSION['room_1_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                    }
                }
                $adults = $_SESSION['room_2_guest']['adults'];
                $kids = $_SESSION['room_2_guest']['kids'];
                $room_get_selected = 2;

                //searching for available rooms . 
                $rm_type = get_room_type();
                foreach ($rm_type as $e) {
                    $rm_availability = get_all_available_rooms($check_in, $check_out, $e[0], 1);
                    if ($rm_availability->rowCount() == $interval) {
                        $rm_ave[] = $rm_availability->fetchAll();
                        $rm_availability->closeCursor();
                    }
                }
            }
        } elseif ($_SESSION['go_to_room'] == 2) {
            //===========
            //2 0f 3 Room
            //===========

            $_SESSION['room_2_selected'] = get_room_type_row($_REQUEST['room_name']);
            if (is_room_available($_SESSION['room_2_selected']['rm_type'], $check_in, $check_out) == false) {
                $error_room_selected = 'Something went wrong! Please try again';
            } else {
                $begin = new DateTime($_SESSION['room_info']['check_in']);
                $end =  new DateTime($_SESSION['room_info']['check_out']);

                $step = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $step, $end);
                foreach ($period as $dt) {
                    $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_2_selected']['rm_type'], $_SESSION['room_2_guest']['adults'], $_SESSION['room_2_guest']['kids']);
                }
                if (isset($_GET['flexible'])) {
                    $_SESSION['room_2_selected']['rate_plan_selected'] = 'Flexible';
                    foreach ($arr as $r) {
                        $_SESSION['room_2_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                    }
                } else {
                    $_SESSION['room_2_selected']['rate_plan_selected'] = 'Non-Refundable';
                    foreach ($arr as $r) {
                        $_SESSION['room_2_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                    }
                }
                $room_get_selected = 3;
                $_SESSION['go_to_room'] = 3; //move to next room
                //searching for available rooms . 
                $rm_type = get_room_type();
                foreach ($rm_type as $e) {
                    $rm_availability = get_all_available_rooms($check_in, $check_out, $e[0], 1);
                    if ($rm_availability->rowCount() == $interval) {
                        $rm_ave[] = $rm_availability->fetchAll();
                        $rm_availability->closeCursor();
                    }
                }
            }
        } else {
            //===========
            //3 0f 3 Room
            //===========
            $_SESSION['room_3_selected'] = get_room_type_row($_REQUEST['room_name']);
            if (is_room_available($_SESSION['room_3_selected']['rm_type'], $check_in, $check_out) == false) {
                $error_room_selected = 'Something went wrong! Please try again';
            } else {
                $begin = new DateTime($_SESSION['room_info']['check_in']);
                $end =  new DateTime($_SESSION['room_info']['check_out']);

                $step = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $step, $end);
                foreach ($period as $dt) {
                    $arr[] =   get_daily_price($dt, $check_out,  $_SESSION['room_3_selected']['rm_type'], $_SESSION['room_3_guest']['adults'], $_SESSION['room_3_guest']['kids']);
                }
                if (isset($_GET['flexible'])) {
                    $_SESSION['room_3_selected']['rate_plan_selected'] = 'Flexible';
                    foreach ($arr as $r) {
                        $_SESSION['room_3_selected']['room_daily_rate_selected'][] = array($r[1], $r[2], $r[3]);
                    }
                } else {
                    $_SESSION['room_3_selected']['rate_plan_selected'] = 'Non-Refundable';
                    foreach ($arr as $r) {
                        $_SESSION['room_3_selected']['room_daily_rate_selected'][] = array($r[0], $r[2], $r[3]);
                    }
                }
                unset($_SESSION['go_to_room']); //move to next room
                //change the price of per room selected and meal selected
                header('Location: billing_information.php?total_room=3');
                die();
            }
        }
    }
} else {
    if (isset($_REQUEST['total_room'])) {
        if ($_REQUEST['total_room'] > 3) {
            $total_room = $_SESSION['total_room'] = 3;
        } elseif ($_REQUEST['total_room'] < 1) {
            header('Location: booking_calendar.php');
            die();
        } else {
            $total_room = $_SESSION['total_room'] = $_REQUEST['total_room'];
        }
    } else {
        header('Location: booking_calendar.php');
        die();
    }
    $_SESSION['go_to_room'] = 1;
    //retrive all available rooms
    //searching for date of check in and check out
    //searching in all type of rooms
    //searching for available rooms . 

    $rm_type = get_room_type();
    foreach ($rm_type as $e) {
        $rm_availability = get_all_available_rooms($check_in, $check_out, $e[0], $total_room);
        if ($rm_availability->rowCount() == $interval) {
            $rm_ave[] = $rm_availability->fetchAll();
            $rm_availability->closeCursor();
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrissiana Beach Hotel | Select Room</title>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>



    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">
    <style>
        .segment {
            background: transparent !important;
        }
    </style>

</head>

<body>
    <?php navigation_bar() ?>

    <section class="header" style="height: auto">
        <div class="box-header" style="background-color: black">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610230/Vrissiana/VRIS27A_-_Front_Sea_View_Room_xzvnud.jpg" alt="Rocks and the sea" class="back-img" style="opacity: 0.6">
        </div>
    </section>
    <div class="overview">
        <div class="mx-auto text-center w-50">
            <div class="ui horizontal inverted divider"><span class="h3 text-dark">Available Rooms</span></div>
            <p class="h1">Choose Your Room</p>
            <p class="h3 text-dark"><?php echo "{$_SESSION['room_info']['check_in']} - {$_SESSION['room_info']['check_out']} "; ?></p>
            <p class="h3 text-dark"><?php echo "Room $total_room, Adults $total_adults, Kids $total_kids, Infants $total_infants" ?></p>
            <p class="h3 text-dark">Rates are per selected number of rooms per night.</p>
            <p class="text-danger"><?php echo $error_room_selected ?></p>
        </div>
    </div>
    <!-- add here the rooms -->
    <?php if (empty($rm_ave)) : ?>
        <div class="container-fluid box-container" style="padding:20px 0; margin: auto ">
            <div class=" align-self-center">
                <div class=" box-content   pad-25 text-white w-75 m-auto">
                    <div class="ui inverted segment">
                        <div class="ui inverted divider"></div>
                        <div class="container">
                            <p class="pad-20 h1 text-uppercase text-center"> There is no available Room for this dates</p>
                        </div>
                    </div>
                    <div class="ui inverted divider"></div>
                    <div class="container">
                        <p class="pad-20 h3 text-uppercase text-center">Please modify your dates and search again</p>
                    </div>
                    <div class="ui inverted divider "> </div>
                    <div class="container text-center">
                        <a href="booking_calendar.php" class="my-md-2 btn-primary btn-nav w-50  ">Modify</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container-fluid box-container" style="padding:10px; margin: auto ">
            <?php
            foreach ($rm_ave as $e) {
                // retrive all images
                $price = get_daily_price($check_in, $check_out, $e[0]['rm_type'], $adults, $kids);
                $rm_img =  get_room_image($e[0]['rm_type']);
                if ($e[0]['rm_max_guest'] < $adults + $kids) {
                    display_not_available_room(
                        $room_get_selected,
                        $e[0]['rm_name'],
                        $price[0],
                        $price[1],
                        $e[0]['rm_size'],
                        $e[0]['rm_max_guest'],
                        $rm_img,
                        'Max Guest ' . $e[0]['rm_max_guest']
                    );
                } else {
                    if ($e[0]['rc_days'] > $interval) {

                        display_not_available_room(
                            $room_get_selected,
                            $e[0]['rm_name'],
                            $price[0],
                            $price[1],
                            $e[0]['rm_size'],
                            $e[0]['rm_max_guest'],
                            $rm_img,
                            'Min stay ' . $e[0]['rc_days'] . ' days'
                        );
                    } else {
                        display_available_room(
                            $room_get_selected,
                            $e[0]['rm_name'],
                            $price[0],
                            $price[1],
                            $e[0]['rm_size'],
                            $e[0]['rm_max_guest'],
                            $rm_img
                        );
                    }
                }
            }
            ?>
        </div>
    <?php endif ?>


</body>

</html>