<?php
require_once 'functions.php';
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPA - Vrissiana Beach Hotel Protaras, Cyprus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- partial -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Raleway|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/slideShowStyle.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navigation bar -->
    <?php navigation_bar('SPA'); ?>
<!-- /BACKROUND IMAGE -->
    <section id="header"><div class="box-header"></div></section>

    <section class="overview">
    <div class="overview">
        <div class="mx-auto text-center w-50">
            <h5>Revitalize your Body & Mind</h5>
            <h1 class="display-4 text-center">Spa &amp; Wellness</h1>
            <p style="font-size: 1.2rem">Welcome to our exclusive The Spa, at the Vrissiana hotel in Protaras, Cyprus. From the moment you walk through our door as our honored guest our aim is to take you on a journey of tranquility whilst increasing the well-being of your body, soul and mind. </p>
        </div>
    </div>
    </section>

    <div class="box-container">
    <?php
        $img=array();
        $img[0]['h2']='SAFE AND NATURAL TREATMENT OF THE NATURE';
        $img[0]['h5']='Spa &amp; Wellness';
        $img[0]['img']='images/VRIS19 - Sauna.JPG';
        $img[0]['desc']='We would like to introduce you to one of the best ways of safe and natural treatments the nature ever gave to the making – Sauna therapy. Also known as Halotherapy, is a Natural & Alternative treatment for people with a lot of discomforts';
        image_left_content_right($img[0]['h2'],$img[0]['h5'], $img[0]['img'],$img[0]['desc']);
     
        $img[1]['h2']='A WIDE RANGE OF WELLNESS TREATMENT';
        $img[1]['h5']='Relaxing Room';
        $img[1]['img']='images/VRIS13 - Spa.JPG';
        $img[1]['desc']='We complement our spa menu with a wide range of wellness treatments, including face and body care and massage therapies, relaxing room etc. ';
        image_right_content_left($img[1]['h2'],$img[1]['h5'],$img[1]['img'],$img[1]['desc']);

        $img=array();
        $img[2]['h2']='SAFE AND NATURAL TREATMENT OF THE NATURE';
        $img[2]['h5']='Spa &amp; Wellness';
        $img[2]['img']='images/VRIS14 - Spa.JPG';
        $img[2]['desc']='We would like to introduce you to one of the best ways of safe and natural treatments the nature ever gave to the making – Sauna therapy. Also known as Halotherapy, is a Natural & Alternative treatment for people with a lot of discomforts';
        image_left_content_right($img[2]['h2'],$img[2]['h5'],$img[2]['img'],$img[2]['desc']);
     
        $img[3]['h2']='A WIDE RANGE OF WELLNESS TREATMENT';
        $img[3]['h5']='Relaxing Room';
        $img[3]['img']='images/VRIS18 - Spa.JPG';
        $img[3]['desc']='We complement our spa menu with a wide range of wellness treatments, including face and body care and massage therapies, relaxing room etc. ';
        image_right_content_left($img[3]['h2'],$img[3]['h5'],$img[3]['img'],$img[3]['desc']);

        ?>     
        
    </div>
    <section class="overview">
    <div class="overview">
        <div class="mx-auto text-center w-50">
            <h5>Need some Help?</h5>
            <h1 class="display-4 text-center">Get in touch</h1>
            <a href="contact_us.php" class="btn-nav btn-lg my-lg-3 btn-primary">Contact Us</a>
        </div>
    </div>
    </section>
    <?php footer();?>
</body>

</html>