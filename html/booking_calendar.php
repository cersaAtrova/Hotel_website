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
        table>td {
            font-size: 3rem ! important;
        }

        .segment {
            background: transparent !important;
        }
    </style>

</head>

<body>

    <?php navigation_bar();
    ?>
    <div style="height: 20vh"></div>

    <div class="ui placeholder segment">
        <div class="ui two column very relaxed  stackable grid">
            <div class="column ">
                <div class="container-calendar-form w-75">
                    <form id="date-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">
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
                                        <select name="adults" class="dropdown-select" required id="adults" aria-placeholder="Adults">
                                            <option value="0">0</option>
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
                                        <select name="kids" class="dropdown-select" required id="kids" aria-placeholder="Kids">

                                            <option selected value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="last-name"><span>&starf;</span> Infants (0-2)</label>

                                <div class="ui ">
                                    <div class="field">
                                        <select name="guest_title" class="dropdown-select" required id="guest_title" aria-placeholder="Title">

                                            <option selected value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex-box-form">
                            <div class="col-12">
                                <label for="subject"><span>&starf;</span> Select Room</label>
                                <select name="subject" class="dropdown-select" id="subject" required>
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
                                <select name="meal_plan" class="dropdown-select" id="subject" required>
                                    <option selected value="BB">Bed &amp; Breakfast</option>
                                    <option value="HF">Half Board</option>
                                    <option value="FB">Full Board</option>
                                    <option selected value="PAL">Premium All Inclusive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="middle aligned column">
                <div class="ui calendarc h-100 w-75" id="inline_calendar"></div>
                <div class="flex-box-form">
                    <div class=" w-75 " style="font-size: 1.2rem">
                        <input type="submit"  class="btn-nav btn-lg my-md-2 btn-primary h-100 mt-3 p-4 text-uppercase font-weight-bold " value="Check Availability" name="submit" >
                    </div>
                </div>

            </div>
        </div>
        <div class="ui vertical divider"></div>
    </div>

    <script src="/script/script.js"></script>
</body>

</html>