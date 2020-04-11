<?php
require_once 'functions.php';
require_once '../connect_dbase.php';
session_start();
$check_in='2020/08/10';
$check_out='2020/08/15';
$query_ra = 'SELECT *
FROM Room_availability
WHERE ra_date >= ? AND ra_date <= ?';

$rm_availability = $db->prepare($query_ra);
$rm_availability->execute(array($check_in,$check_out));
$sl = $rm_availability->fetchAll();

var_dump($sl);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Room</title>
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
            <p class="h3 text-dark"><?php echo "$check_in - $check_out"; ?></p>
            <p class="h3 text-dark"><?php echo "Room $total_room, Adults $total_adults, Kids $total_kids, Infants $total_infants" ?></p>
            <p class="h3 text-dark">Rates are per selected number of rooms per night.</p>
        </div>
    </div>
    <!-- add here the rooms -->


</body>

</html>