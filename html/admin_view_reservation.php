<?php
require_once 'functions.php';
require_once 'insert_functions.php';
require_once 'countries.php';
session_start();


$resv = get_reservation_by_resv_id($_REQUEST['id']);
$allergies = get_allergies($_REQUEST['id']);
$preferences = get_preferences($_REQUEST['id']);
$facilities = get_facilities($_REQUEST['id']);
$daily_rate = get_reservation_daily_rate($resv['resv_reference']);

$member = get_member_by_id($resv['member_id']);
$resv_guest_capacity = get_total_guest($_REQUEST['id']);
$resv_profile = get_reservation_guest_profile($_REQUEST['id']);

$room = get_room_by_rm_type($resv['rm_type']);

//get total price
$resv_facility = get_reservation_facilities_price($_REQUEST['id']);
$resv_total = get_reservation_price($_REQUEST['id']);
if ($resv_facility[0] != null) {
    $resv_total[0] += $resv_facility[0];
}
if ($resv['resv_status'] == 'Cancelled') {
    $status = 'text-danger';
    $card = 'Not available';
} else {
    $card = get_credit_card_by_resv_id($resv['resv_reference']);
}


foreach ($daily_rate as $pr) {

    $dt = date('d-M-Y', strtotime($pr['dr_date']));
    $str .= <<<pr
<tr>
    <td class="border-top" data-label="Date">{$dt}</td>
    <td class="border-top" data-label="Total"><i class="euro sign icon"></i>{$pr['dr_price']}</td>
</tr>

pr;
}


if (isset($_GET['card'])) {
    if ($card != 'Not available') {
        if (update_credit_card($resv['resv_reference'], $card['cc_full_name'], $card['cc_card_number'], $card['cc_exp_moth'], $card['cc_exp_year'], $card['cc_card_cvv'], 'Invalid')) {
            $card = get_credit_card_by_resv_id($resv['resv_reference']);
        }

        //=============================
        //----------NOTE---------------
        //ADD TO SEND EMAIL TO CUSTOMER
        //-----------------------------
        //=============================
    }
}

if (isset($_REQUEST['cancel'])) {
    $resv = get_reservation_by_resv_id($resv['resv_reference']);
    $cnx = update_status_reservation($resv['resv_reference'], 'Cancelled');



    $check_in = new DateTime($resv['resv_check_in']);
    $check_out = new DateTime($resv['resv_check_out']);
    // find the difference of the days
    $interval = $check_in->diff($check_out)->format('%a');
    $begin = date('Y-m-d', strtotime($resv['resv_check_in']));

    for ($i = 0; $i < $interval; $i++) {
        $ave = get_availability($begin, $resv['rm_type']);

        $day = $ave['ra_days'];
        $day++;
        $availability = update_availability($resv['rm_type'],   $ave['ra_date'], $day);
        $repeat = strtotime("+1 day", strtotime($begin));
        $begin = date('Y-m-d', $repeat);
    }
    if ($cnx) {
        header("Location: admin_view_reservation.php?id={$resv['resv_reference']}");
        die();
    }

    //=============================
    //----------NOTE---------------
    //ADD TO SEND EMAIL TO CUSTOMER
    //AND TO Reservation DEPartment
    //-----------------------------
    //=============================
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Reservation View</title>

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
    <link rel="stylesheet" href="../CSS/validate_card.css">



    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">

</head>


<body>
    <?php include_once('admin_navigation_menu.php') ?>
    <div style="height: 5vh"></div>

    <div class="containeri-fluid">
        <div class="row m-auto w-75">
            <div class="col">
                <div class="container  mb-5">
                    <P class="h2 mt-5">Accomodation Summary</P>
                    <div class="container p-2 bg-white box_shadow">
                        <div class="row p-2">
                            <div class="col h3 border-right text-center">
                                <label> Reference</label>
                                <p class="mb-1"><?php echo $resv['resv_reference'] ?></p>

                            </div>
                            <div class="col h3 border-right text-center">
                                <label> Status</label>
                                <p class="mb-1 <?php echo $status ?>"><?php echo $resv['resv_status'] ?></p>

                            </div>
                            <div class="col h3 border-right text-center">
                                <label>Price</label>
                                <p><i class="euro icon"></i><?php echo $resv_total[0] ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row p-2">
                            <div class="col border-right">
                                <label> Name</label>
                                <p class="mb-1"><?php echo $resv_profile['resv_name'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col">
                                <label>Last Name</label>
                                <p class="mb-1"><?php echo $resv_profile['resv_last'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label>Email</label>
                                <p class="mb-1"><?php echo $member['member_email'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col">
                                <label>Telephone</label>
                                <p class="mb-1"><?php echo $resv_profile['resv_tel'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label>Country</label>
                                <p class="mb-1"><?php echo $resv_profile['resv_country'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col"></div>
                        </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label class="font-weight-bold"> Check in - Check out</label>
                                <p class="mb-1 h4"><?php echo date('d-M-Y', strtotime($resv['resv_check_in'])) . ' - ' . date('d-M-Y', strtotime($resv['resv_check_out'])) ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col border-right">
                                <label class="font-weight-bold"> Booked on</label>
                                <p class="mb-1"><?php echo date('d-M-Y H:i:s', strtotime($resv['resv_booked'])) ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col border-right">
                                <table class="ui celled table font-weight-bold p-3 ">
                                    <tr>
                                        <th class="border-0">Date</th>
                                        <th class="border-0">Price</th>
                                    </tr>
                                    <?php echo $str ?>

                                </table>
                            </div>
                            <div class="col border-right">
                                <p>Card details</p>
                                <p><?php echo $card['cc_full_name'] ?></p>
                                <p><?php echo $card['cc_card_number'] ?></p>
                                <p><?php echo "{$card['cc_exp_moth']}/{$card['cc_exp_year']} - cvv {$card['cc_card_cvv']}  " ?></p>
                                <p>Card is <?php echo $card['cc_card_status'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label> Room</label>
                                <p class="mb-1"><?php echo $room['rm_name'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col">
                                <label>Guest</label>
                                <p class="mb-1">
                                    <?php
                                    foreach ($resv_guest_capacity as $e) {
                                        echo "{$e[0]},  {$e[1]}<br/>";
                                    }
                                    ?>
                                </p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label>Meal Plan</label>
                                <p class="mb-1"><?php echo $resv['resv_meal_level'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col">
                                <label>Room Rate</label>
                                <p class="mb-1"><?php echo $resv['resv_type'] ?></p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col border-right">
                                <label>Allergy</label>
                                <p class="mb-1">
                                    <?php
                                    foreach ($allergies as $e) {
                                        echo ++$a . " {$e['allergy_name']}<br/>";
                                    }
                                    ?>
                                </p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col border-right">
                                <label>Preferences</label>
                                <p class="mb-1">
                                    <?php
                                    foreach ($preferences as $e) {
                                        echo ++$i . " {$e['pre_name']}<br/>";
                                    }
                                    ?>
                                </p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                            <div class="col border-right">
                                <label>Facility</label>
                                <p class="mb-1">
                                    <?php
                                    foreach ($facilities as $e) {
                                        echo ++$f . " {$e['fa_name']}  <i class='euro icon'></i>{$e['fa_price']}<br/>";
                                    }
                                    ?>
                                </p>
                                <p class="w-50 border-bottom"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col"></div>
                            <div class="col"></div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs">
                <div class="btn-group-vertical  mt-5 pt-5 text-white">
                    <a href="admin_reservation.php" class="btn-group btn-group-lg p-3 btn-nav btn-primary btn-go-back" role="group" aria-label="Button">Go back to My account</a>

                    <a href="admin_view_reservation.php?id=<?php echo $resv['resv_reference'] ?>&card=invalid" class="btn-group p-3 btn-group-lg btn-nav btn-warning btn-credit-card" role="group " aria-label="Invalid Card">Invalid Credit Card</a>
                    <a href="admin_view_reservation.php?id=<?php echo $resv['resv_reference'] ?>&cancel=cancelled" class="btn-group btn-group-lg p-3 btn-nav btn-danger btn-cancel" role="group" aria-label="Cancel Reservation"> Cancel Reservation</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.btn-cancel').click(function() {
            var answer = confirm('Are you sure you want to Cancel this Reservation?');
            if (answer) {
                return true;
            } else {
                return false;
            }
        });
    </script>
</body>

</html>