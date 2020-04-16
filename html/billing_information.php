<?php
require_once 'functions.php';
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
                                <input type="text" class="form-control text-form-control" name="first_name" required placeholder="First name" value="<?php echo $user_f_name; ?>" id="first_name" pattern="^[A-Za-z]+$">
                            </div>

                            <div class="col-md">
                                <label for="last-name"><span>&starf;</span> Last Name</label>
                                <input type="text" class="form-control text-form-control" name="last_name" required placeholder="Last name" value="<?php echo $user_l_name; ?>" aria-describedby="basic-addon1" pattern="^[A-Za-z]+$">
                            </div>
                            <div class="col-12">
                                <label for="email"><span>&starf;</span>Email</label>
                                <input id="email" type="email" class="form-control text-form-control" name="email" placeholder="Email" value="<?php echo $user_email; ?>" required aria-describedby="emailHelp" pattern="[^@]+@[^\.]+\..+">
                            </div>

                            <div class="col-12">
                                <label for="tel"><span>&starf;</span>Telephone</label>
                                <input id="tel" type="tel" class="form-control text-form-control" name="tel" placeholder="Telephone" value="<?php echo $user_tel; ?>" required aria-describedby="telephone" pattern="^[0-9]+$">
                            </div>
                            <div class="col-12">
                                <label for="country"><span>&starf;</span> Country</label>
                                <select name="country" class="dropdown-select text-form-control" id="country" required>
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
                            <div class="title active text-white ">

                                <p class="h1"> <i class="dropdown icon"></i>Room 1</p>
                            </div>
                            <div class="content active">
                                <p class="transition visible " style="display: block !important; ">
                                    <div class="ui segment" style="background: transparent; border-bottom: 2px solid white ">
                                        <p class="h2 pb-5">Booking Summary</p>
                                        <div class="ui two column very relaxed grid">
                                            <div class="column">
                                                <p class="h4 p-2 font-weight-bold">Room type selected: </p>
                                                <p class="h4 p-2 font-weight-bold">Dates: </p>
                                                <p class="h4 p-2 font-weight-bold">Rate plan selected: </p>
                                                <p class="h4 p-2 font-weight-bold">Terms and Condition</p>
                                            </div>
                                            <div class="column">
                                                <p class="h4 p-2"> <?php echo $_SESSION['room_1_selected']['rm_name'] ?></p>
                                                <p class="h4 p-2"> <?php echo "{$_SESSION['room_info']['check_in']} - {$_SESSION['room_info']['check_out']} "; ?></p>
                                                <p class="h4 p-2"> <?php echo $_SESSION['room_1_selected']['rate_plan_selected'] ?></p>
                                                <p class="h4 p-2"></p>
                                            </div>
                                        </div>
                                        <div class="ui vertical divider "></div>
                                    </div>
                                    <div class="ui segment" style="background: transparent ">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                                        <div class="ui fitted divider"></div>
                                        <table class="ui celled table text-white" style="background: transparent;  ">

                                            <tr>
                                                <th>Date</th>
                                                <th>Meal Price</th>
                                                <th>Room Rate</th>
                                                <th>Total</th>
                                            </tr>
                                            <?php


                                            foreach ($_SESSION['room_1_selected']['room_daily_rate_selected'] as $pr) {
                                                $ml_p = $pr[1] + $pr[2];
                                                $rr = $pr[0] - $ml_p;
                                                $row = <<<print
                                            <tr>
                                                <td data-label="Date">$begin</td>
                                                <td data-label="Meal Price">{$ml_p}</td>
                                                <td data-label="Room Rate">{$rr}</td>
                                                <td data-label="Total">{$pr[0]}</td>
                                            </tr>

print;

                                                echo $row;
                                            }

                                            ?>
                                        </table>
                                    </div>
                                </p>
                            </div>
                            <div class="title text-white ">
                                <p class="h1"> <i class="dropdown icon"></i>Room 1</p>
                            </div>
                            <div class="content">
                                <p class="transition hidden">There are many breeds of dogs. Each breed varies in size and temperament. Owners often select a breed of dog that they find to be compatible with their own lifestyle and desires from a companion.</p>
                            </div>
                            <div class="title text-white ">
                                <p class="h1"> <i class="dropdown icon"></i>Room 1</p>
                            </div>
                            <div class="content">
                                <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
                                <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
                            </div>
                        </div>
                        <script>
                            $('.ui.accordion').accordion();
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div style=" height: 20vh"></div>
</body>

</html>