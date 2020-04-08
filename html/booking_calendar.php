<?php

require_once 'functions.php';
require_once '../connect_dbase.php';
session_start();


if (isset($_GET['sub'])) {
    var_dump($_GET['check_out']);
    $check_in_date = $_REQUEST['check_in'];
    $check_out_date = $_REQUEST['check_out'];
} else {
    $check_in_date = (new DateTime())->add(new DateInterval("P1D"))->format("M/d/Y");
    $check_out_date = Date("M/d/Y");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability</title>
    <!-- Bootstrap -->
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


    </style>

</head>

<body>

    <?php navigation_bar(); 
    ?>
    <div class="container-calendar-form">
        <form id="date-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">
            <div class="flex-box-form">
                <div class="col-6">
                    <label for="guest_title"><span>&starf;</span> Title</label>
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



                <div class="ui container">


                    <div class="col-6">

                    </div>

                </div>


            </div>

            <input type="submit" value="" name="sub">
        </form>
    </div>
    <script src="/script/script.js"></script>
</body>

</html>