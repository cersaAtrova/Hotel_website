<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrissiana Beach Hotel | SPA</title>

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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
    <!-- navigation bar -->
    <?php navigation_bar('SPA'); ?>
    <!-- /BACKROUND IMAGE -->
    <section class="box-header mb-5">
        <div class="box-header">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610217/Vrissiana/spa_bed_rnkkh2.jpg" alt="" class="back-img">
        </div>
    </section>


    <div class="overview mb-5">
        <div class="mx-auto text-center w-50">
        <div class="ui horizontal inverted divider"><span class="h5 text-dark">Revitalize your Body & Mind</span></div>
            <p class="display-4 text-center">Spa &amp; Wellness</p>
            <p style="font-size: 1.2rem">Welcome to our exclusive The Spa, at the Vrissiana hotel in Protaras, Cyprus offers a rich variety of spa treatments for guests wishing to discover the art of relaxation and peace. Embrace a true sanctuary of luxury a heaven of peace, a highly pleasurable area that blends the love of the aesthetics reaching well into the best beauty solutions.</p>
        </div>
    </div>


    <div class="box-container">
        <?php
        $img = array();
        $img[0]['h2'] = 'SAFE AND NATURAL TREATMENT OF THE NATURE';
        $img[0]['h5'] = 'Spa &amp; Wellness';
        $img[0]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610224/Vrissiana/VRIS19_-_Sauna_tlo2z1.jpg';
        $img[0]['desc'] = 'We would like to introduce you to one of the best ways of safe and natural treatments the nature ever gave to the making – Sauna therapy. Also known as Halotherapy, is a Natural & Alternative treatment for people with a lot of discomforts';
        image_left_content_right($img[0]['h2'], $img[0]['h5'], $img[0]['img'], $img[0]['desc']);

        $img[1]['h2'] = 'A WIDE RANGE OF WELLNESS TREATMENT';
        $img[1]['h5'] = 'Relaxing Room';
        $img[1]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610221/Vrissiana/VRIS13_-_Spa_yolfwf.jpg';
        $img[1]['desc'] = 'We complement our spa menu with a wide range of wellness treatments, including face and body care and massage therapies, relaxing room etc. ';
        image_right_content_left($img[1]['h2'], $img[1]['h5'], $img[1]['img'], $img[1]['desc']);

        $img = array();
        $img[2]['h2'] = 'UNFORGETTABLE SPA DAYS';
        $img[2]['h5'] = 'SPA Relaxing';
        $img[2]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610222/Vrissiana/VRIS14_-_Spa_azws2k.jpg';
        $img[2]['desc'] = 'Treat yourself when needed most,The Spa offers a variety of spa days carefully selected to suit your every purpose. The Spa days are personalised for men and woman looking to experience relaxation, preserve the youth and enjoy the spa facilities.';
        image_left_content_right($img[2]['h2'], $img[2]['h5'], $img[2]['img'], $img[2]['desc']);

        $img[3]['h2'] = 'Manicure & Pedicure';
        $img[3]['h5'] = 'Beauty Sallon';
        $img[3]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610223/Vrissiana/VRIS18_-_Spa_yum1jg.jpg';
        $img[3]['desc'] = 'A full manicure treatment including exfoliation, hand mask and a soothing hand massage, followed by an application of nail varnish of your choice.';
        image_right_content_left($img[3]['h2'], $img[3]['h5'], $img[3]['img'], $img[3]['desc']);

        ?>

    </div>

    <div class="overview mb-5 mt-5">
        <div class="mx-auto text-center w-50">
        <div class="ui horizontal inverted divider"><span class="h5 text-dark">Need some Help?</span></div>
            <h1 class="display-4 text-center">Get in touch</h1>
            <a href="/html/contact_us.php" class="btn-nav btn-lg my-lg-3 btn-primary">Contact Us</a>
        </div>
    </div>

    <?php footer(); ?>
</body>

</html>