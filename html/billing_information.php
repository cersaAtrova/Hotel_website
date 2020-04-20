<?php
require_once 'functions.php';
require_once 'insert_functions.php';
require_once 'countries.php';
session_start();
if (isset($_REQUEST['total_room'])) {
    if ($_REQUEST['total_room'] > 3) {
        header('Location: booking_calendar.php');
        die();
    } elseif ($_REQUEST['total_room'] < 1) {
        header('Location: booking_calendar.php');
        die();
    } else {

        $total_room = $_SESSION['total_room'] = $_REQUEST['total_room'];
    }
}

if ($_REQUEST['total_room'] == 1) {
    $room_name_selected = 'Room 1 ' . $_SESSION['room_1_selected']['rm_name'];
} elseif ($_REQUEST['total_room'] == 2) {
    $room_name_selected = 'Room 1 ' . $_SESSION['room_1_selected']['rm_name'] . ', Room 2 ' . $_SESSION['room_2_selected']['rm_name'];
} elseif ($_REQUEST['total_room'] == 3) {
    $room_name_selected = 'Room 1 ' . $_SESSION['room_1_selected']['rm_name'] . ', Room 2 ' . $_SESSION['room_2_selected']['rm_name'] . ', Room 3' . $_SESSION['room_3_selected']['rm_name'];
}
$check_in = date('M-d-Y', strtotime($_SESSION['room_info']['check_in']));
$check_ = date('M-d-Y', strtotime($_SESSION['room_info']['check_in']));

if (isset($_POST['submit'])) {
    $user_f_name = $_POST['first_name'];
    $user_l_name = $_POST['last_name'];
    $user_email = $_POST['email'];
    $user_tel = $_POST['tel'];

    if (luhn_check($_POST['card_number']) == false) {

        //check the card if is valid
        $error_room_selected = 'Please enter a valid credit card';
    } else {
        //check the expired day if is valid
        $expires = DateTime::createFromFormat('my', $_POST['month_expired'] . $_POST['year_expired']);
        $now = new DateTime();
        if ($expires < $now) {
            $error_room_selected = 'Please enter a valid expired day';
        } else {
            $owner = explode(' ', $_POST['owner']);

            if (is_valid_name($owner[0]) == false || is_valid_name($owner[1]) == false) {
                $error_room_selected = 'Please enter a valid Name and Surname for credit card';
            } else {
                if (is_valid_name($user_f_name) == false || is_valid_name($user_l_name) == false || is_valid_email($user_email) == false || !is_numeric($user_tel) || strlen($user_tel) > 15) {
                    $error_room_selected = 'Please enter a correct guest information';
                } else {

                    $member = is_email_exist($user_email);
                    $existing_guest = false;
                    $not_valid_email = false;
                    if ($member != false) {
                        if ($_POST['first_name'] != $member['member_name']) {
                            $error_room_selected = 'Email address is not accepted! Please enter a different email address';
                            $not_valid_email = true;
                        } else {
                            $existing_guest = true;
                        }
                    }
                    if ($not_valid_email == false) {
                        if ($_SESSION['total_room'] == 1) {
                            if ($_POST['fa_extra_Room_1'] = !null) {
                                //get the extra facilities that user select
                                $extra_room_1 = get_extra_price_and_name($_POST['fa_extra_Room_1']);
                            }
                            //create new reservation for new Member
                            if ($existing_guest == false) {
                                //insert new member and guest the id
                                $member_id = insert_new_member($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['country'], $_POST['tel']);
                                if ($member_id == false) {
                                    $error_room_selected = 'We cause some errors. Your Reservation is not accepted. Please try again letter';
                                } else {
                                    // get reservation reference (id)
                                    $resv_id = random_reservation_id() . '/1';
                                    $resv = insert_new_reservation($resv_id, $_SESSION['room_info']['meal_plan'], $_SESSION['room_1_selected']['rate_plan_selected'], $member_id, $_SESSION['room_1_selected']['rm_type']);
                                    if ($resv == false) {
                                        $error_room_selected = 'We cause some errors Your Reservation is not accepted. Please try again letter';
                                    } else {
                                        // add all allergy into database
                              
                                        if (isset($_POST['rm_alergies_Room_1'])) {
                                            foreach ($_POST['rm_alergies_Room_1'] as $e) {
                                                insert_new_allergies($resv_id, $e);
                                            }
                                        }
                                        if (isset($_POST['rm_preference_Room_1'])) {
                                            foreach ($_POST['rm_preference_Room_1'] as $e) {
                                                insert_new_preference($resv_id, $e);
                                            }
                                        }
                                        if (isset($_POST['rm_extra__Room_1'])) {
                                            foreach ($_POST['rm_extra__Room_1'] as $e) {
                                                $arr = get_extra_price_and_name($e);
                                                insert_new_facilities($resv_id, $arr[0], $arr[1]);
                                            }
                                        }
                                        //Save credit card into database(DANGEROUS)
                                        //save here temporary for testing. 
                                        //Will change this with STRIPE or JCC
                                      $cc=  insert_credit_card($resv_id, $_POST['owner'],$_POST['card_number'],$_POST['moth_expired'],$_POST['year_expired'],$_POST['cvv']);
                                      
                                    }
                                }
                            }
                        }
                    }
                }
            }
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

    <title>Vrissiana Beach Hotel | Reservation Result</title>
    <!-- Bootstrap -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script> -->

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
    <script src="../script/script.js"></script>

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">


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
            <p class="h1">Confirm Your Stay</p>
            <p class="h3 text-dark"><?php echo "{$_SESSION['room_info']['check_in']} - {$_SESSION['room_info']['check_out']} "; ?></p>
            <p class="h3 text-dark"><?php echo "Room $total_room, Adults $total_adults, Kids $total_kids, Infants $total_infants" ?></p>
            <p class="h3 text-dark">Rates are per selected number of rooms per night.</p>
            <p class="h3 text-dark">Room selected: <?php echo $room_name_selected ?></p>
            <p class="text-danger"><?php echo $error_room_selected ?></p>
        </div>
    </div>
    <div class="container-fluid">
        <form action="" method="post">
            <div class="m-auto" style="width: 80%">
                <div class="row ui text-white" style="background-color: rgba(29, 29, 92, 0.8);">
                    <div class="col-sm p-5">
                        <p class="h1 pt-5 pb-3 ">Guest Profile</p>
                        <div class="row ">
                            <div class="col-md">
                                <label for="first-name"><span>&starf;</span> First Name</label>
                                <input type="text" class="form-control text-form-control" name="first_name" required placeholder="First name" maxlength="30" value="<?php echo $user_f_name; ?>" id="first_name" pattern="^[A-Za-z]+$">
                            </div>

                            <div class="col-md">
                                <label for="last-name"><span>&starf;</span> Last Name</label>
                                <input type="text" class="form-control text-form-control" name="last_name" required placeholder="Last name" maxlength="30" value="<?php echo $user_l_name; ?>" aria-describedby="basic-addon1" pattern="^[A-Za-z]+$">
                            </div>
                            <div class="col-12">
                                <label for="email"><span>&starf;</span>Email</label>
                                <input id="email" type="email" class="form-control text-form-control" name="email" maxlength="50" placeholder="Email" value="<?php echo $user_email; ?>" required aria-describedby="emailHelp" pattern="[^@]+@[^\.]+\..+">
                            </div>

                            <div class="col-12">
                                <label for="tel"><span>&starf;</span>Telephone</label>
                                <input id="tel" type="tel" class="form-control text-form-control" name="tel" placeholder="Telephone" value="<?php echo $user_tel; ?>" required aria-describedby="telephone" pattern="^[0-9]+$">
                            </div>
                            <div class="col-12">
                                <label for="country"><span>&starf;</span> Country</label>
                                <select name="country" class="dropdown-select text-form-control text-dark" id="country" required>
                                    <?php
                                    //add all country
                                    asort($countries);
                                    foreach ($countries as $key => $value) {
                                        if ($country_name_by_ip == $value) {
                                            echo "<option selected>$value</option>";
                                        } else {
                                            echo "<option>$value</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm box-container text-white p-5" style="opacity: 0.8;">
                        <div class="ui styled fluid accordion" style="background: transparent ">
                            <div class="title text-white first_room_active">
                                <p class="h1"> <i class="dropdown icon"></i>Room 1</p>
                            </div>
                            <div class="content">
                                <?php room_billining_information($_SESSION['room_info']['check_in'], $_SESSION['room_info']['check_out'],  $_SESSION['room_1_selected']['rm_name'], $_SESSION['room_1_guest']['adults'], $_SESSION['room_1_guest']['kids'], $_SESSION['room_1_guest']['infants'], 'Room_1', $_SESSION['room_1_selected']['room_daily_rate_selected'],    $_SESSION['room_1_selected']['rate_plan_selected'])
                                ?>
                            </div>
                            <?php if ($total_room == 2) : ?>
                                <div class="title text-white ">
                                    <p class="h1"> <i class="dropdown icon"></i>Room 2</p>
                                </div>
                                <div class="content">
                                    <?php room_billining_information($_SESSION['room_info']['check_in'], $_SESSION['room_info']['check_out'],  $_SESSION['room_2_selected']['rm_name'], $_SESSION['room_2_guest']['adults'], $_SESSION['room_2_guest']['kids'], $_SESSION['room_2_guest']['infants'], 'Room_2', $_SESSION['room_2_selected']['room_daily_rate_selected'],   $_SESSION['room_2_selected']['rate_plan_selected']) ?>
                                </div>
                            <?php endif;
                            if ($total_room == 3) : ?>
                                <div class="title text-white ">
                                    <p class="h1"> <i class="dropdown icon"></i>Room 3</p>
                                </div>
                                <div class="content">
                                    <?php room_billining_information($_SESSION['room_info']['check_in'], $_SESSION['room_info']['check_out'],  $_SESSION['room_3_selected']['rm_name'], $_SESSION['room_3_guest']['adults'], $_SESSION['room_3_guest']['kids'], $_SESSION['room_3_guest']['infants'], 'Room_3', $_SESSION['room_3_selected']['room_daily_rate_selected'],    $_SESSION['room_3_selected']['rate_plan_selected']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--  -->
                        <div class="creditCardForm">
                            <div class="heading">
                                <h1>Confirm Booking</h1>
                            </div>
                            <div class="payment">
                                <div class="form-group owner">
                                    <label for="owner">Owner</label>
                                    <input type="text" class="form-control" name="owner" id="owner" required title="Please enter the card owner">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" name="cvv" required id="cvv" title="Please enter the cvv">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" name="card_number" required class="form-control" id="cardNumber" title="Please enter the card number">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select required name="moth_expired" class="moth_expired">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $begin = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            $moth .= "<option value='{$begin}'>{$begin}</option>";
                                        }
                                        echo $moth;
                                        ?>
                                    </select>

                                    <select name="year_expired" class="year_expired mt-3" required>
                                        <?php
                                        $begin = date('Y');
                                        for ($i = 1; $i < 8; $i++) {
                                            $year .= "<option value='{$begin}'>{$begin}</option>";
                                            $repeat = strtotime("+{$i} Year", strtotime($begin));
                                            $begin = date('Y', $repeat);
                                        }
                                        echo $year;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="credit_cards">
                                    <img src="../images/visa.jpg" id="visa">
                                    <img src="../images/mastercard.jpg" id="mastercard">
                                    <img src="../images/amex.jpg" id="amex">
                                </div>

                                <input type="submit" name="submit" id="reserved" class="ui button btn btn-nav btn-primary" value="Reserved">



                            </div>
                        </div>
                    </div>
                    <script>
                        $(function() {
                            var valid_card = false;
                            var valid_ccv = false;
                            var owner = $('#owner');
                            var cardNumber = $('#cardNumber');
                            var cardNumberField = $('#card-number-field');
                            var CVV = $("#cvv");
                            var mastercard = $("#mastercard");
                            var visa = $("#visa");
                            var amex = $("#amex");

                            // Use the payform library to format and validate
                            // the payment fields.

                            cardNumber.payform('formatCardNumber');
                            CVV.payform('formatCardCVC');


                            cardNumber.keyup(function() {

                                amex.removeClass('transparent');
                                visa.removeClass('transparent');
                                mastercard.removeClass('transparent');

                                if ($.payform.validateCardNumber(cardNumber.val()) == false) {
                                    cardNumberField.addClass('has-error');
                                } else {
                                    cardNumberField.removeClass('has-error');
                                    cardNumberField.addClass('has-success');
                                }

                                if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
                                    mastercard.addClass('transparent');
                                    amex.addClass('transparent');
                                } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
                                    mastercard.addClass('transparent');
                                    visa.addClass('transparent');
                                } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
                                    amex.addClass('transparent');
                                    visa.addClass('transparent');
                                }
                            });
                            $('#cardNumber').change(function() {
                                var isCardValid = $.payform.validateCardNumber(cardNumber.val());
                                if (!isCardValid) {
                                    $('#cardNumber').addClass('border-danger');
                                    valid_card = false;
                                } else {
                                    $('#cardNumber').removeClass('border-danger');
                                    valid_card = true;
                                }
                            });
                            $('#cvv').change(function() {
                                var isCvvValid = $.payform.validateCardCVC(CVV.val());
                                if (!isCvvValid) {
                                    $('#cvv').addClass('border-danger');
                                    valid_ccv = false;
                                } else {
                                    $('#cvv').removeClass('border-danger');
                                    valid_ccv = true;
                                }
                            });
                            $('#reserved').click(function(e) {

                                if (valid_ccv != true) {
                                    $('#cvv').addClass('border-danger');
                                    return false;
                                }
                                if (valid_card != true) {
                                    $('#cardNumber').addClass('border-danger');
                                    return false;
                                }
                            });
                        });
                    </script>
                    <script>
                        $('.ui.accordion').accordion();

                        $console = $('.callback .console');
                        $('.callback.example .checkbox')
                            .checkbox()
                            .first().checkbox({
                                onChecked: function() {
                                    $console.append('onChecked called<br>');
                                },
                                onUnchecked: function() {
                                    $console.append('onUnchecked called<br>');
                                },
                                onEnable: function() {
                                    $console.append('onEnable called<br>');
                                },
                                onDisable: function() {
                                    $console.append('onDisable called<br>');
                                },
                                onDeterminate: function() {
                                    $console.append('onDeterminate called<br>');
                                },
                                onIndeterminate: function() {
                                    $console.append('onIndeterminate called<br>');
                                },
                                onChange: function() {
                                    $console.append('onChange called<br>');
                                }
                            });
                        // bind events to buttons
                        $('.callback.example .button')
                            .on('click', function() {
                                $('.callback .checkbox').checkbox($(this).data('method'));
                            });
                    </script>

                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../script/jquery.payform.min.js"></script>

    <div style=" height: 10vh"></div>
</body>

</html>