<?php
session_start();
require_once('functions.php');
require_once('insert_functions.php');
if (isset($_POST['update_passwd'])) {
    update_member_password($_SESSION['member']['member_id'], $_POST['new_passwd']);
    $_SESSION = array();
    session_destroy();
    header('Location: user_acount.php');
    die();
}
$print_resv = '';
foreach ($_SESSION['reservation_id'] as $e) {
    $resv = get_reservation_by_resv_id($e);
    $allergies = get_allergies($e);
    $preferences = get_preferences($e);
    $facilities = get_facilities($e);

    $resv_guest_capacity = get_total_guest($e);
    $resv_profile = get_reservation_guest_profile($e);
    $i = 1;
    $room = get_room_by_rm_type($_SESSION['room_' . $i . '_selected']['rm_type']);
    $i++;
    $resv_facility = get_reservation_facilities_price($e);
    $resv_total = get_reservation_price($e);
    if ($resv_facility[0] != null) {
        $resv_total[0] += $resv_facility[0];
    }
    $check_in = date('M-d-Y', strtotime($_SESSION['room_info']['check_in']));
    $check_out = date('M-d-Y', strtotime($_SESSION['room_info']['check_out']));
    $print_resv .= <<<print
    <div class="containeri-fluid">
    <div class="row m-auto w-75">
    <div class="col">
        <div class="container  mb-5">
            <P class="h2 mt-5">Accomodation Summary</P>
            <div class="container p-2 bg-white box_shadow">
                <div style="height: 30vh ">
                    <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610230/Vrissiana/VRIS27A_-_Front_Sea_View_Room_xzvnud.jpg" alt="Rocks and the sea" class="back-img" style="opacity: 0.6">
                </div>
                <div class="row p-2">
                    <div class="col border-right">
                        <label> Name</label>
                        <p class="mb-1">{$resv_profile['resv_name']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                    <div class="col">
                        <label>Last Name</label>
                        <p class="mb-1">{$resv_profile['resv_last']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col border-right">
                        <label>Email</label>
                        <p class="mb-1">{$_SESSION['member']['member_email']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                    <div class="col">
                        <label>Telephone</label>
                        <p class="mb-1">{$resv_profile['resv_tel']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col border-right">
                        <label>Country</label>
                        <p class="mb-1">{$resv_profile['resv_country']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                    <div class="col">
                    <label>Check in - Check out</label>
                        <p class="mb-1">{$check_in} - {$check_out}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                </div>
                <hr>
                <div class="row p-2">
                    <div class="col border-right">
                        <label> Room</label>
                        <p class="mb-1">{$room['rm_name']}</p>
                        <p class="w-50 border-bottom"></p>
                    </div>
                    <div class="col">
                        <label>Guest</label>
                        <p class="mb-1">
print;
    foreach ($resv_guest_capacity as $e) {
        $print_resv .= "{$e[0]},  {$e[1]}<br/>";
    }

    $print_resv .= <<<print
</p>
<p class="w-50 border-bottom"></p>
</div>
</div>
<div class="row p-2">
    <div class="col border-right">
        <label>Meal Plan</label>
        <p class="mb-1">{$resv['resv_meal_level']}</p>
        <p class="w-50 border-bottom"></p>
    </div>
    <div class="col">
        <label>Room Rate</label>
        <p class="mb-1">{$resv['resv_type']}</p>
        <p class="w-50 border-bottom"></p>
    </div>
</div>
<hr>
<div class="row p-2">
    <div class="col border-right">
        <label>Allergy</label>
        <p class="mb-1">
print;

    foreach ($allergies as $e) {
        $print_resv .= ++$a . " {$e['allergy_name']}<br/>";
    }
    $print_resv .= '</p><p class="w-50 border-bottom"></p></div><div class="col border-right"><label>Preferences</label><p class="mb-1">';
    foreach ($preferences as $e) {
        $print_resv .= ++$i . " {$e['pre_name']}<br/>";
    }
    $print_resv .= ' <p class="w-50 border-bottom"></p></div><div class="col border-right"><label>Facility</label><p class="mb-1">';
    foreach ($facilities as $e) {
        $print_resv .= ++$f . " {$e['fa_name']}<br/>";
    }
    $print_resv .= '</p><p class="w-50 border-bottom"></p></div></div><hr><div class="row p-2"><div class="col"></div><div class="col"></div><div class="col"><label>Price</label>';
    $print_resv .= " <p class=\"w-50 h5 border-bottom mb-3\"><i class=\"euro icon\"></i>{$resv_total[0]}</p></div></div></div></div></div></div>";
}

// }
require_once('email.php');
if (isset($_REQUEST['modify'])) {
    foreach ($_SESSION['reservation_id'] as $e) {
        $body =  guest_email($e);
        if (smtpmailer($_SESSION['member']['member_email'], 'noreply.info.testing@gmail.com', '', 'Vrissiana - Booking Modification', $body)) {
            writeLog('Confirmation mail has send to guest ' . $_SESSION['member']['member_email']);
        } else {
            $confirm_message = "Fail - " . $mail->ErrorInfo;
            writeLog('Fatal: Modification Mail Not Sent to guest->' . $_SESSION['member']['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
        }
        $body_admin = admin_email($e);
        if (smtpmailer('soteris100@gmail.com', 'noreply.info.testing@gmail.com', 'MODIFICATION ', 'MODIFICATION', $body_admin)) {
            writeLog('Modification  mail has send to admin');
        } else {
            $confirm_message = "Fail - " . $mail->ErrorInfo;
            writeLog('Fatal: Modification Mail Not Receive to Reservation Department FROM->' . $_SESSION['member']['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
        }
    }
}

foreach ($_SESSION['reservation_id'] as $e) {
    $body =  guest_email($e);
    if (smtpmailer($_SESSION['member']['member_email'], 'noreply.info.testing@gmail.com', '', 'Vrissiana - Booking Confirmation', $body)) {
        writeLog('Confirmation mail has send to guest ' . $_SESSION['member']['member_email']);
    } else {
        $confirm_message = "Fail - " . $mail->ErrorInfo;
        writeLog('Fatal: Confirmation Mail NOT Sent to guest->' . $_SESSION['member']['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
    }
    $body_admin = admin_email($e);
    if (smtpmailer('soteris100@gmail.com', 'noreply.info.testing@gmail.com', 'New Reservation', 'New Reservation', $body_admin)) {
        writeLog('Confirmation mail has send to admin');
    } else {
        $confirm_message = "Fail - " . $mail->ErrorInfo;
        writeLog('Fatal: Confirmation Mail NOT Receive to Reservation Department FROM->' . $_SESSION['member']['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
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

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="../CSS/booking_style.css">


</head>


<body>
    <?php navigation_bar(); ?>
    <div style="height: 25vh"></div>
    <div class="container text-center">
        <i class="check green massive icon"></i>
        <h1 class="display-3">Thank You!</h1>
        <?php if (isset($_REQUEST['modify'])) {
            echo '<p class="lead">Your Reservation is Modified.</p>';
        } else {
            echo '<p class="lead">Your Reservation is confirmed.</p>';
        } ?>

        <p class="lead"><strong>Please check your email</strong> for the voucher.</p>
        <?php include_once('update_password.php'); ?>
        <hr>
    </div>
    <?php if (!isset($_REQUEST['modify'])) {
        echo $print_resv;
    } ?>
    <div style='height: 30vh'></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../script/jquery.payform.min.js"></script>

</body>

</html>