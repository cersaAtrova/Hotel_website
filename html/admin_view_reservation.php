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
            require_once('email.php');
            $body = <<<print
            <!DOCTYPE html>
            <html>
            <head>
            
              <meta charset="utf-8">
              <meta http-equiv="x-ua-compatible" content="ie=edge">
              <title>Password Reset</title>
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <style type="text/css">
              /**
               * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
               */
              @media screen {
                @font-face {
                  font-family: 'Source Sans Pro';
                  font-style: normal;
                  font-weight: 400;
                  src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                }
            
                @font-face {
                  font-family: 'Source Sans Pro';
                  font-style: normal;
                  font-weight: 700;
                  src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                }
              }
            
              /**
               * Avoid browser level font resizing.
               * 1. Windows Mobile
               * 2. iOS / OSX
               */
              body,
              table,
              td,
              a {
                -ms-text-size-adjust: 100%; /* 1 */
                -webkit-text-size-adjust: 100%; /* 2 */
              }
            
              /**
               * Remove extra space added to tables and cells in Outlook.
               */
              table,
              td {
                mso-table-rspace: 0pt;
                mso-table-lspace: 0pt;
              }
            
              /**
               * Better fluid images in Internet Explorer.
               */
              img {
                -ms-interpolation-mode: bicubic;
              }
            
              /**
               * Remove blue links for iOS devices.
               */
              a[x-apple-data-detectors] {
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                color: inherit !important;
                text-decoration: none !important;
              }
            
              /**
               * Fix centering issues in Android 4.4.
               */
              div[style*="margin: 16px 0;"] {
                margin: 0 !important;
              }
            
              body {
                width: 100% !important;
                height: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
              }
            
              /**
               * Collapse table borders to avoid space between cells.
               */
              table {
                border-collapse: collapse !important;
              }
            
              a {
                color: #1a82e2;
              }
            
              img {
                height: auto;
                line-height: 100%;
                text-decoration: none;
                border: 0;
                outline: none;
              }
              </style>
            
            </head>
            <body style="background-color: #e9ecef;">
              <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
               Ivalid Credid Card Details
              </div>
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" bgcolor="#e9ecef">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <!-- start logo -->
                    <tr>
                      <td align="center"  style=" background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg'); background-repeat: repeat;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                          <tr>
                            <td align="center" valign="top" style="padding: 36px 24px;">
                              <a href="#" target="_blank" style="display: inline-block;">
                                <img src="https://res.cloudinary.com/sotiris/image/upload/c_scale,w_400/v1586610212/Vrissiana/logo_v8xjho.png" alt="Logo" border="0" width="100" style="display: block; width: 200px; max-width: 300px; min-width: 48px;">
                              </a>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <!-- end logo -->
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e9ecef">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                      <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                          <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Update your Credit Card Details</h1>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e9ecef">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                      <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                          <p style="margin: 0;">Payment was not succesful. Please arrange the payment through our website. In case payment is not made within 24hours, your booking will be cancelled.</p>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" bgcolor="#ffffff">
                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                              <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                      <a style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;" href="#">Click here to update</a>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                      <tr>
                        <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                          <p style="margin: 0;">You received this email because we do not accept your payment.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </body>
            </html>
print;

            //=============================
            //-----------------------------
            //SEND EMAIL TO CUSTOMER
            //-----------------------------
            //=============================
            if (smtpmailer($member['member_email'], 'noreply.info.testing@gmail.com', '', 'Vrissiana - Booking Cancelation', $body)) {
                writeLog('Cancelation mail has send to guest ' . $member['member_email']);
            } else {
                $confirm_message = "Fail - " . $mail->ErrorInfo;
                writeLog('Fatal: Mail Not Sent to guest->' . $member['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
            }
        }
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


        //=============================
        //-----------------------------
        //ADD TO SEND EMAIL TO CUSTOMER
        //AND TO Reservation DEPartment
        //-----------------------------
        //=============================
    }
    if ($cnx) {
        require_once('email.php');
        $body =  guest_email($resv['resv_reference']);
        if (smtpmailer($member['member_email'], 'noreply.info.testing@gmail.com', '', 'Vrissiana - Booking Cancelation', $body)) {
            writeLog('Cancelation mail has send to guest ' . $member['member_email']);
        } else {
            $confirm_message = "Fail - " . $mail->ErrorInfo;
            writeLog('Fatal: Mail Not Sent to guest->' . $member['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
        }
        $body_admin = admin_email($resv['resv_reference']);
        if (smtpmailer('soteris100@gmail.com', $member['member_email'], 'CANCELATION', 'CANCELATION', $body_admin)) {
            writeLog('Cancelation mail has send to admin');
        } else {
            $confirm_message = "Fail - " . $mail->ErrorInfo;
            writeLog('Fatal: Cancelation Mail Not Receive to Reservation Department FROM->' . $member['member_email'] . ' REFERENCE->' . $resv['resv_reference']);
        }
        header("Location: admin_view_reservation.php?id={$resv['resv_reference']}");
        die();
    }
    // display no show
    if (isset($_REQUEST['noshow'])) {
        update_status_reservation($resv['resv_reference'], 'No Show');
    }
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
                    <a href="admin_view_reservation.php?id=<?php echo $resv['resv_reference'] ?>&noshow=true" class="btn-group p-3 btn-group-lg btn-nav btn-warning btn-credit-card" role="group " aria-label="no-show">No Show</a>
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