<?php

require_once 'functions.php';
require_once '../connect_dbase.php';
session_start();


if (isset($_GET['submit'])) {
    $check_in_date = $_REQUEST['check_in'];
    $check_out_date = $_REQUEST['check_out'];
    $room_select = $_REQUEST['room'];
    //check the dates
    if ($check_in_date < $check_out_date) {
        if ($room_select == 1) {
            $guest_select = array($_REQUEST['adults'], $_REQUEST['kids'], $_REQUEST['infats']);
            //check the guest if is correct
            if ($guest_select[0] + $guest_select[1] > 4) {
                $error_details = 'Please provide correct information';
            } else {
                if (!isset($_REQUEST['meal_plan'])) {
                }
                    //room 1
                    $_SESSION['room_1_guest']['adults']=$guest_select[0];
                    $_SESSION['room_1_guest']['kids']=$guest_select[1];
                    $_SESSION['room_1_guest']['infants']=$guest_select[2];
                    //general details
                    $_SESSION['room_info']['mael_plan']=$_REQUEST['meal_plan'];
                    $_SESSION['room_info']['check_in']=$_REQUEST['check_in'];
                    $_SESSION['room_info']['check_out']=$_REQUEST['check_out'];
                    header('Location: select_room.php?total_room=1');
                    die();
                    
            }
        }else if($room_select==2){
            $guest_select = array($_REQUEST['adults'], $_REQUEST['kids'], $_REQUEST['infats']);
            $guest_select2 = array($_REQUEST['adults2'], $_REQUEST['kids2'], $_REQUEST['infats2']);
            //check the guest if is correct
            if ($guest_select[0] + $guest_select[1] > 4 ||$guest_select2[1] + $guest_select2[1] > 4 ) {
                $error_details = 'Please provide correct information';
            } else {
                if (!isset($_REQUEST['meal_plan'])) {
                }
                    //room 1
                    $_SESSION['room_1_guest']['adults']=$guest_select[0];
                    $_SESSION['room_1_guest']['kids']=$guest_select[1];
                    $_SESSION['room_1_guest']['infants']=$guest_select[2];
                    //room 2
                    $_SESSION['room_2_guest']['adults']=$guest_select[0];
                    $_SESSION['room_2_guest']['kids']=$guest_select[1];
                    $_SESSION['room_2_guest']['infants']=$guest_select[2];
                    //general details
                    $_SESSION['room_info']['mael_plan']=$_REQUEST['meal_plan'];
                    $_SESSION['room_info']['check_in']=$_REQUEST['check_in'];
                    $_SESSION['room_info']['check_out']=$_REQUEST['check_out'];
                    header('Location: select_room.php?total_room=2');
                    die();
                    
            }
        }else if($room_select==3){
            $guest_select = array($_REQUEST['adults'], $_REQUEST['kids'], $_REQUEST['infats']);
            $guest_select2 = array($_REQUEST['adults2'], $_REQUEST['kids2'], $_REQUEST['infats2']);
            $guest_select3 = array($_REQUEST['adults3'], $_REQUEST['kids3'], $_REQUEST['infats3']);
            //check the guest if is correct
            if ($guest_select[0] + $guest_select[1] > 4 ||$guest_select2[1] + $guest_select3[1] > 4
            ||$guest_select3[1] + $guest_select3[1] > 4 ) {
                $error_details = 'Please provide correct information';
            } else {
                if (!isset($_REQUEST['meal_plan'])) {
                }
                    $_SESSION['room_1_guest']['adults']=$guest_select[0];
                    $_SESSION['room_1_guest']['kids']=$guest_select[1];
                    $_SESSION['room_1_guest']['infants']=$guest_select[2];
                    
                    $_SESSION['room_2_guest']['adults']=$guest_select2[0];
                    $_SESSION['room_2_guest']['kids']=$guest_select2[1];
                    $_SESSION['room_2_guest']['infants']=$guest_select2[2];

                    $_SESSION['room_3_guest']['adults']=$guest_select3[0];
                    $_SESSION['room_3_guest']['kids']=$guest_select3[1];
                    $_SESSION['room_3_guest']['infants']=$guest_select3[2];

                    $_SESSION['room_info']['mael_plan']=$_REQUEST['meal_plan'];
                    $_SESSION['room_info']['check_in']=$_REQUEST['check_in'];
                    $_SESSION['room_info']['check_out']=$_REQUEST['check_out'];
                    
                    header('Location: select_room.php?total_room=3');
                    die();
                    
            }
        }else{
            $error_details = 'Please select Rooms between 1 and 3';
        }
    }else{
        $error_details = 'Please provide correct Dates';
    }
} else {
    //start up the page
    $check_in_date = (new DateTime())->add(new DateInterval("P1D"))->format("M/d/Y");
    $check_out_date = (new DateTime())->add(new DateInterval("P2D"))->format("M/d/Y");
    $error_details = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability</title>
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

        thead {
            font-size: 1.2em;
            font-family: 'Raleway';
        }
    </style>

</head>

<body>

    <?php navigation_bar();
    ?>
    <div style="height: 20vh"></div>

    <div class="ui placeholder segment">
        <form id="date-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">

            <div class="ui two column very relaxed  stackable grid">
                <div class="column ">
                    <div class="container-calendar-form w-75">
                        <div class="flex-box-form">
                            <div class="col-12">
                                <!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
                                <h3>Select Dates</h3>
                                <div class="ui form">
                                    <div class="two fields">
                                        <div class="field">
                                            <label>Check in</label>
                                            <div class="ui calendar" id="rangestart">
                                                <div class="ui input right icon">
                                                    <i class="calendar icon"></i>
                                                    <input id="check_in" type="text" name="check_in" placeholder="Check In" value="<?php echo $check_in_date; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label>Check out</label>
                                            <div class="ui calendar" id="rangeend">
                                                <div class="ui input right icon">
                                                    <i class="calendar icon"></i>
                                                    <input id="check_out" type="text" name="check_out" placeholder="Check Out" value="<?php echo $check_out_date ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-box-form">
                            <div class="col-12">
                                <hr style="background-color:black">
                                <h3>Select Guest</h3>
                            </div>
                        </div>

                        <div class="flex-box-form">
                            <div class=" col-4  ">
                                <label for="adults"><span>&starf;</span> Adults (13+)</label>
                                <!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
                                <div class="ui ">
                                    <div class="field ">
                                        <select name="adults" id="adults" class="dropdown-select adults" required>

                                            <option value="1">1</option>
                                            <option selected value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="kids"><span>&starf;</span> Kids (2-12)</label>
                                <div class="ui ">
                                    <div class="field">
                                        <select name="kids" id="kids" class="dropdown-select kids" required>

                                            <option selected value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option disabled value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="last-name"><span>&starf;</span> Infants (0-2)</label>

                                <div class="ui ">
                                    <div class="field">
                                        <select name="infants" class="dropdown-select infants" required id="infants" aria-placeholder="Infant">

                                            <option selected value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="flex-box-form" id="room2"></div>
                        <div class="flex-box-form" id="room3"></div>
                        <div class="flex-box-form">
                            <div class="col-12">
                                <label for="room"><span>&starf;</span> Select Room</label>
                                <select name="room" id="room" class="dropdown-select room" required>
                                    <option selected value="1">Room 1</option>
                                    <option value="2">Room 2</option>
                                    <option value="3">Room 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex-box-form">
                            <div class="col-12">
                                <hr style="background-color:black">
                                <h3>Select Meal</h3>
                            </div>
                        </div>
                        <div class="flex-box-form">
                            <div class="col-12">
                                <select name="meal_plan" class="dropdown-select " id="subject" required>
                                    <option selected value="BB">Bed &amp; Breakfast</option>
                                    <option value="HF">Half Board</option>
                                    <option value="FB">Full Board</option>
                                    <option selected value="AL">Premium All Inclusive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="middle aligned column">
                    <div class="ui calendarc h-100 w-75" id="inline_calendar"></div>
                    <div class="flex-box-form">
                        <div class=" w-75 " style="font-size: 1.2rem">
                            <input type="submit" class="btn-nav btn-lg my-md-2 btn-primary h-100 mt-3 p-4 text-uppercase font-weight-bold " value="Check Availability" name="submit">
                        </div>
                    </div>
                    <p class="ui"><?php echo $error_details ?></p>
                </div>
            </div>
            <div class="ui vertical divider"></div>
        </form>
    </div>

    <script src="/script/script.js"></script>
</body>

</html>