<?php
require_once 'functions.php';
require_once 'insert_functions.php';
require_once 'countries.php';
session_start();
if (isset($_REQUEST['logout'])) {
    $_SESSION = array();
}


if (!isset($_SESSION['user_login'])) {
    header('Location: login.php');
    die();
}
if (isset($_POST['update'])) {

    if (is_valid_name($_POST['first_name']) == false || is_valid_name($_POST['last_name']) == false || is_valid_email($_POST['email']) == false || !is_numeric($_POST['tel'])) {
        $error_update = 'Please enter correct information';
    } else {
        if (isset($_POST['current_passwd'])) {
            if (strlen($_POST['new_passwd']) < 6) {
                $error_update = 'Your Password is to short';
            } else {
                update_member($_SESSION['user_login']['member_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['country'], $_POST['new_passwd'], $_POST['tel']);
            }
        } else {
            update_member($_SESSION['user_login']['member_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['country'], $_SESSION['user_passwd'], $_POST['tel']);
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

    <title>Vrissiana Beach Hotel | Account</title>
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
    <div style="height: 20vh"></div>
    <?php
    navigation_bar();

    ?>

    <!-- <div class="btn-group-vertical">
            <button type="button" class="btn btn-secondary">Left</button>
            <button type="button" class="btn btn-secondary">Middle</button>
            <button type="button" class="btn btn-secondary">Right</button>
        </div> -->
    <div class="container-fluid w-75">
        <div class="row">
            <div class="col-xs">
                <div class="ui tabular vertical pointing menu">
                    <a class="item active bg-white welcome border-bottom text-form-control" data-tab="tab-name">
                        Welcome
                    </a>

                    <a class="item bg-white border-bottom text-form-control" data-tab="tab-name2">
                        Profile
                    </a>

                    <a class="item  bg-white border-bottom text-form-control" data-tab="tab-name3">
                        Reservation
                    </a>
                    <a href="user_account.php?logout='true" class="item  bg-white border-bottom text-form-control logout">
                        Logout
                    </a>
                </div>

            </div>
            <div class="col">
                <div class="ui tab p-4 bg-white" data-tab="tab-name">
                    <p class="h2 pb-4"> Dear Mr./Mrs. <?php echo $_SESSION['user_login']['member_name'] ?> </p>
                    <p class="h5 pb-3">Welcome to your personal Vrissiana account.</p>

                    <p class="h5 pb-3">We are honoured that you have chosen to book a stay with us, entrusting us with your priceless holiday time.
                        Hoping to be able to immerse our guests in the world of the Vrissiana prior to even arriving, your account has been developed to allow you to view, modify, and cancel your reservation if need be, as well as update your personal information.
                    </p>
                    <p class="h5 pb-3">We look forward to welcoming you,</p>

                    <p class="h5">General Manager</p>
                </div>
                <div class="ui tab" data-tab="tab-name2">
                    <div class="container-fluid">
                        <div class="">
                            <form action="user_account.php" method="POST" name="contact_form">
                                <div class="flex-box-form">
                                    <div class="col">
                                        <label for="first-name"><span>&starf;</span> First Name</label>
                                        <input type="text" class="form-control text-form-control" name="first_name" required placeholder="First name" value="<?php echo $_SESSION['user_login']['member_name']; ?>" id="first_name" pattern="^[A-Za-z]+$">
                                    </div>
                                    <div class="col">
                                        <label for="last-name"><span>&starf;</span> Last Name</label>
                                        <input type="text" class="form-control text-form-control" name="last_name" required placeholder="Last name" value="<?php echo $_SESSION['user_login']['member_last']; ?>" aria-describedby="basic-addon1" pattern="^[A-Za-z]+$">
                                    </div>
                                </div>
                                <div class="flex-box-form">
                                    <div class="col">
                                        <label for="email"><span>&starf;</span>Email</label>
                                        <input type="email" class="form-control text-form-control" name="email" placeholder="Email" value="<?php echo $_SESSION['user_login']['member_email']; ?>" required aria-describedby="emailHelp" pattern="[^@]+@[^\.]+\..+">
                                    </div>
                                    <div class="col">
                                        <label for="tel"><span>&starf;</span>Telephone</label>
                                        <input type="tel" class="form-control text-form-control" name="tel" placeholder="Email" value="<?php echo $_SESSION['user_login']['member_tel']; ?>" required aria-describedby="tel-help" maxlength="15" pattern="[0-9]+">
                                    </div>
                                </div>

                                <div class="flex-box-form">
                                    <div class="col">
                                        <label for="country"><span>&starf;</span> Country</label>
                                        <select name="country" class="dropdown-select" id="country" required>
                                            <?php
                                            //add all country
                                            asort($countries);
                                            foreach ($countries as $key => $value) {
                                                if ($_SESSION['user_login']['member_country'] == $value) {
                                                    echo "<option selected>$value</option>";
                                                } else {
                                                    echo "<option>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="passwd"></div>
                                <div class="flex-box-form">
                                    <hr>
                                    <div class="col">
                                        <input type="button" class="ui red btn-nav btn-danger w-100 p-3 btn_cancel" value="Cancel">
                                    </div>
                                    <div class="col">
                                        <input type="button" id="reset_passwd" name="reset_passwd" class="ui red btn-nav btn-secondary w-100 p-3" value="Change Password">
                                    </div>
                                    <div class="col">
                                        <input type="submit" name="update" class="ui red btn-nav btn-primary w-100 p-3" value="Update">
                                    </div>
                                </div>
                                <p> <?php echo $error_update ?></p>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="ui tab" data-tab="tab-name3">
                    <p class="h2 pb-3 mb-5">Reservation</p>
                    <table class="ui very basic collapsing celled table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Reservation Status</th>
                                <th>Price</th>
                                <th>Reservation action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //===================================
                            //dispaly all reservation on a screen
                            //===================================
                            $resv = get_reservation_by_member_id($_SESSION['user_login']['member_id']);
                            foreach ($resv as $r) {
                                if ($r['resv_status'] == 'Confirm') {
                                    $color = 'text-success';
                                    $btn = "<td><div class='content'><a href='view_reservation.php?id={$r["resv_reference"]}' class='ui btn-nav btn-primary ''>Edit/View</a></div></td>";
                                } elseif ($r['resv_status'] == 'Cancelled') {
                                    $color = 'text-danger';
                                    $btn = '<td><div class="content h5"><a class="ui button disabled">N/A</a></div></td>';
                                } elseif ($r['resv_status'] == 'No show') {
                                    $color = 'text-warning';
                                }elseif ($r['resv_status'] == 'Ok') {
                                    $color = 'text-primary';
                                }
                                //get the total price
                                $resv_facility=get_reservation_facilities_price($r['resv_reference']);
                                $resv_total = get_reservation_price($r['resv_reference']);
                                if($resv_facility[0]!=null){
                                    $resv_total[0]+=$resv_facility[0];
                                }
                                $tb = <<<print
                                <tr class="text-center"><td><div class="content h5">{$r['resv_reference']}</div></td>
                                <td><div class="content h5">{$r['resv_check_in']}</div></td>
                                <td><div class="content h5">{$r['resv_check_out']}</div></td>
                                <td><div class="content h5 {$color}">{$r['resv_status']} </div></td>
                                <td><div class="content h5">{$resv_total[0]}</div></td>
                                {$btn}
                                </tr>
                                
                                
                                
print;
                                echo $tb;
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.tabular.menu .item').tab();
        $('.welcome').click();

        function show_new_password() {
            var x = document.getElementById("n_passwd");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function show_old_password() {
            var y = document.getElementById("c_passwd");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
        $('#reset_passwd').click(function() {
            $('.passwd').append('<div class="flex-box-form"><div class="col passwd"><label><span>&starf;</span>Current password</label><div class="ui icon input form-control"><input id="c_passwd" type="password" minlength="6" name="current_passwd" placeholder="Current password" required><i class="eye big link icon" onclick="show_old_password()"></i></div></div></div><div class="flex-box-form"><div class="col passwd"><label><span>&starf;</span>New _password</label><div class="ui icon input form-control"><input id="n_passwd" type="password" name="new_passwd" minlength="6" placeholder="Current password" value="" required><i class="eye  big link icon" onclick="show_new_password()"></i></div></div></div>');
            $('.passwd').removeClass('passwd');
        });
    
    </script>
</body>

</html>