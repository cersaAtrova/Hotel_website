<?php
require_once('functions.php')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrissiana Beach Hotel | Select Room</title>

    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

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



    <link rel="stylesheet" href="/CSS/style.css">
    <style>
        .segment {
            background: transparent !important;
        }
    </style>

</head>

<body>
    <?php navigation_bar('ROOMS'); ?>
    <section class="">
        <div class="box-header">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610230/Vrissiana/VRIS27A_-_Front_Sea_View_Room_xzvnud.jpg" alt="" class="back-img">
        </div>
    </section>

    <div class="overview" style="font-family: 'Raleway', sans-serif !important;">
        <div class="mx-auto text-center w-50 " style="font-family: 'Raleway', sans-serif !important;">
            <h5>Accomodation at Vrissiana Beach Hotel</h5>
            <h1 class="display-4 text-center" style="font-family: 'Raleway', sans-serif !important;">GUESTROOM</h1>
            <p style="font-size: 1.2rem" style="font-family: 'Raleway', sans-serif !important;">
                The elegant and spacious rooms offer stunning panoramic views of the crystal clear Mediterranean Sea,
                tempting you to enjoy a relaxing morning or an afternoon on the room's balcony.
            </p>
            <p style="font-size: 1.2rem" style="font-family: 'Raleway', sans-serif !important;">
                The practical use of space and technology supported by our friendly and attentive staff,
                will ensure that your stay at our hotel in Protaras is more enjoyable than ever.
            </p>
        </div>
    </div>

    <div class="container-fluid box-container" style="padding:10px; margin: auto ">
        <?php
        $rm_type = get_room_type();
        foreach ($rm_type as $e) {
            $img =  get_room_image($e[0]);
            $rm = get_room_by_rm_type($e[0]);
            print_room($rm[0], $rm[1], $rm[2], $rm[4], $img);
        }
        ?>
    </div>
</body>

</html>