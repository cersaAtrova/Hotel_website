<?php require_once 'functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrissiana Beach Hotel | Dining</title>

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
    <?php navigation_bar('DINING'); ?>
    <!-- /BACKROUND IMAGE -->
    <section class="">
        <div class="box-header mb-5">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610220/Vrissiana/thalassa-restaurant--v4619901_tlfcdt.jpg" alt="" class="back-img">
        </div>
    </section>

    <div class="overview mb-5" style="font-family: 'Raleway', sans-serif !important;">
        <div class="mx-auto text-center w-50">
        <div class="ui horizontal inverted divider"><span class="h5 text-dark">Dining at Vrissiana Beach Hotel</span></div>
            <p class="display-4 text-center ">Exceptional Cusine for all the Family</>
            <p style="font-size: 1.2rem">A treat for all foodies, there's no shortage of dining options at Vrissiana Beach Hotel.
                Whether you fancy indulging range from our magnificent buffet breakfast to the amazing evening buffets
                or treating yourself to a celebration of the finest Mexican cuisine at Los Amigos Mexican A La Carte Restaurant.
            </p>
            <p style="font-size: 1.2rem">
                A lobby bar and an exceptional pool bar for all kinds of drinks, desserts, coffees, exotic coktails and delectable drinks, supplement this contemporary hotel.
            </p>
        </div>
    </div>

    <div class="box-container">
        <?php
        $img = array();
        $img[0]['h2'] = 'Restaurant';
        $img[0]['h5'] = 'Thalassa Restaurant - Buffet ';
        $img[0]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610215/Vrissiana/RESTAURANT_tc4rsz.jpg';
        $img[0]['desc'] = 'Rich International Buffet Breakfast to Buffet Dinner which is different theme every night.<br/>Kids corner available in every meal. Beverages for all meals are waiter service';
        image_left_content_right($img[0]['h2'], $img[0]['h5'], $img[0]['img'], $img[0]['desc']);

        $img[1]['h2'] = 'Mexican Restaurant';
        $img[1]['h5'] = 'Los Amigos Restaurant - A La Carte';
        $img[1]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610213/Vrissiana/losamigos_ysused.jpg';
        $img[1]['desc'] = 'This spectacular beachfront summer time restaurant serves exceptional Mexican delicacies that are guaranteed to please.';
        image_right_content_left($img[1]['h2'], $img[1]['h5'], $img[1]['img'], $img[1]['desc']);
        ?>

    </div>

    <div class="overview mb-5 mt-5">
        <div class="mx-auto text-center w-50">
        <div class="ui horizontal inverted divider"><span class="h5 text-dark">Cocktails &amp; Drinks</span></div>
            <h1 class="display-4 text-center">Bars</h1>
            <p style="font-size: 1.2rem">A treat for all foodies, there's no shortage of dining options at Vrissiana Beach Hotel.
                Whether you fancy indulging range from our magnificent buffet breakfast to the amazing evening buffets
                or treating yourself to a celebration of the finest Mexican cuisine at Los Amigos Mexican A La Carte Restaurant.
            </p>
        </div>
    </div>
    <div class="box-container">
        <?php
        $img = array();
        $img[0]['h2'] = 'Bars';
        $img[0]['h5'] = 'C-View Bars ' . htmlspecialchars('&') . ' Teracce';
        $img[0]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610212/Vrissiana/bar_w2jjjf.jpg';
        $img[0]['desc'] = 'A casual place to relax and admire the panoramic view of the blue Mediterranean Sea whilst enjoying a long cool drink and conversation with friends. ';
        image_left_content_right($img[0]['h2'], $img[0]['h5'], $img[0]['img'], $img[0]['desc']);

        $img[1]['h2'] = 'Pool Bar';
        $img[1]['h5'] = 'Paradise Pool Bar';
        $img[1]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610215/Vrissiana/poolbar_i6aamm.jpg';
        $img[1]['desc'] = 'Sit in the shade of a tree and enjoy a cool drink, delicious ice cream at our Paradise Pool Bar. A quiet oasis overlooking the pool, the beach and Mediterranean Sea.';
        image_right_content_left($img[1]['h2'], $img[1]['h5'], $img[1]['img'], $img[1]['desc']);
        ?>

    </div>
    <div style="height: 5vh"></div>
    <?php footer(); ?>
</body>

</html>