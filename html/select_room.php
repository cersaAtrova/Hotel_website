<?php
require_once 'functions.php';
require_once '../connect_dbase.php';
session_start();
if (isset($_GET['non_refandable']) || isset($_GET['flexible'])) {
} else {

    $check_in = new DateTime($_SESSION['room_info']['check_in']);
    $check_out = new DateTime($_SESSION['room_info']['check_out']);

    // find the difference of the days
    $interval = $check_in->diff($check_out)->format('%a');


    $total_adults = $_SESSION['room_1_guest']['adults'] + $_SESSION['room_2_guest']['adults'] + $_SESSION['room_3_guest']['adults'];
    $total_kids = $_SESSION['room_1_guest']['kids'] + $_SESSION['room_2_guest']['kids'] + $_SESSION['room_3_guest']['kids'];
    $total_infants = $_SESSION['room_1_guest']['infants'] + $_SESSION['room_2_guest']['infants'] + $_SESSION['room_3_guest']['infants'];
    $total_room = $_REQUEST['total_room'];

    // retrive all images
    $query_rm = 'SELECT rm_type From Room';
    $rm = $db->prepare($query_rm);
    $rm->execute();
    $rm_type = $rm->fetchAll();

    //retrive all rooms information
    $query_ra = 'SELECT Room_availability.ra_date,Room_availability.rm_type,Room_availability.ra_days,
     Room_rate.rr_price ,Room_constraint.rc_days ,Room.rm_price_diff,Room.rm_size,Room.rm_max_guest,Room.rm_name
                From Room_availability
                JOIN Room_rate ON ra_date=  rr_date 
                JOIN Room_constraint   ON Room_availability.rm_type = Room_constraint.rm_type 
                AND Room_availability.ra_date = Room_constraint.rc_date
                JOIN Room ON Room.rm_type=Room_availability.rm_type
                WHERE ra_date >= ? AND ra_date < ?
                AND Room_availability.rm_type=? AND ra_status=\'Open\'AND Room_availability.ra_days >=? ';

    $rm_availability = $db->prepare($query_ra);
    //retrive all available rooms
    //searching for date of check in and check out
    //searching in all type of rooms
    //searching for available rooms . 
    foreach ($rm_type as $e) {
        $rm_availability->execute(array($check_in->format('Y/m/d'), $check_out->format('Y/m/d'), $e[0], $_REQUEST['total_room']));
        if ($rm_availability->rowCount() == $interval) {
            var_dump($rm_availability->rowCount());
            $rm_ave[] = $rm_availability->fetchAll();
        }
    }
    // retrive all images
    $query_img = 'SELECT img_rm_img
                  From Room_image
                  WHERE rm_type=?';
    $ri = $db->prepare($query_img);

    // retrive all meal price
    $query_meal_plan = 'SELECT * FROM Room_meal_price
                        WHERE rm_meal IN ("FL",?)';
    $rm_m_p = $db->prepare($query_meal_plan);

    $rm_m_p->execute(array($_SESSION['room_info']['meal_plan']));
    $meal_pr = $rm_m_p->fetchAll();
    $rm_meal_price = array();
    foreach ($meal_pr as $e) {
        if ($e['rm_meal'] == 'FL') {
            $rm_meal_price['FL'] = $e['rm_price_diff'];
        } else {
            $rm_meal_price['OT'] = $e['rm_price_diff'];
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
    <title> Select Room</title>
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
                $ri->execute(array($e[0]['rm_type']));
                $rm_img = $ri->fetchAll();

                if ($e[0]['rc_days'] > $interval) {

                    display_not_available_room(
                        $_GET['total_room'],
                        $e[0]['rm_name'],
                        ($e[0]['rr_price'] + $e[0]['rm_price_diff'] + $rm_meal_price['OT']),
                        ($e[0]['rr_price'] + $e[0]['rm_price_diff'] + $rm_meal_price["OT"] + $rm_meal_price['FL']),
                        $e[0]['rm_size'],
                        $e[0]['rm_max_guest'],
                        $rm_img,
                        $e[0]['rc_days']
                    );
                } else {
                    display_available_room(
                        $_GET['total_room'],
                        $e[0]['rm_name'],
                        ($e[0]['rr_price'] + $e[0]['rm_price_diff'] + $rm_meal_price['OT']),
                        ($e[0]['rr_price'] + $e[0]['rm_price_diff'] + $rm_meal_price["OT"] + $rm_meal_price['FL']),
                        $e[0]['rm_size'],
                        $e[0]['rm_max_guest'],
                        $rm_img
                    );
                }
            }

            ?>

        </div>
    <?php endif ?>
    

</body>

</html>