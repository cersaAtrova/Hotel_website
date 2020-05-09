<?php
require_once('insert_functions.php');
require_once('functions.php');
session_start();

$today=new DateTime("");
$tommorow=new DateTime("+1 day");
$resv_tommorow = get_reservation_by_check_in($tommorow);
$resv_today = get_reservation_by_check_in($today);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Vrissiana Beach Hotel | Account</title>

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


</head>

<body class="bg-light">
   <?php include_once('admin_navigation_menu.php') ?>
    <div style="height: 10vh"></div>
    <div class="container-fluid p-5">
        <p class="display-3 text-primary font-weight-bold">Reservation Overview</p>
        <p class="display-4 text-primary font-weight-bold">Today <span class="h3">(<?php echo $today->format('d-M-Y') ?>)</span></p>
        <div class="container">
                    <?php
                 
                    if($resv_today!=null){
                        show_reservation_overview($resv_today);
                        }else{
                            echo '<p class="h4 p-3 border border-primary text-center">Nothing for Today</p>';
                        }
                   ?>
        </div>
        <p class="display-4 text-primary font-weight-bold mt-5">Tommorow <span class="h3"> (<?php echo $tommorow->format('d-M-Y') ?>)</span></p>
        <div class="container">
                    <?php
                  
                    if($resv_tommorow!=null){
                    show_reservation_overview($resv_tommorow);
                    }else{
                        echo '<p class="h4 p-3 border border-primary text-center">Nothing for tommorow</p>';
                    }
                   ?>
        </div>
    </div>

<div style="height: 10vh"></div>


</body>

</html>