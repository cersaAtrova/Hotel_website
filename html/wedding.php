<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrissiana Beach Hotel | Wedding</title>

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
</head>

<body>
    <!-- navigation bar -->
    <?php navigation_bar('WEDDING'); ?>
    <!-- /BACKROUND IMAGE -->
    <section class="box-header mb-5">
        <div class="box-header">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610233/Vrissiana/weddings_img_3_ftikpl.jpg" alt="groom and bride at the sea" class="back-img">
        </div>
    </section>

   
        <div class="overview mb-5" style="font-family: 'Raleway', sans-serif !important;">
            <div class="mx-auto text-center w-50">
                <div class="ui horizontal inverted divider"><span class="h5 text-dark">An unforgettable day</span></div>
                <p class="display-4 text-center">Experience Legendary Romance</p>
                <p style="font-size: 1.2rem">A doorway to a unique wedding experience...
                    For the perfect environment to suit this special occasion, put your trust in our experienced hands.
                    Whether you are in search of extravagance or romance, something delightfully unusual or comfortably
                    spacious for your wedding in Protaras, the variety and high standard of our food, service and accommodation
                    is bound to impress. </p>
            </div>
        </div>
  

    <div class="box-container">
        <?php
        $img = array();
        $img[0]['h2'] = 'WEDDING CEREMONY';
        $img[0]['h5'] = 'Crystal Palm Veranda';
        $img[0]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610232/Vrissiana/wedding_fyyylw.jpg';
        $img[0]['desc'] = 'Wedding Blessings or Ceremonies may be held at our Crystal Palm veranda located by the Onyx Lobby bar with stunning panoramic view of the palm trees combined with the Mediterranean azure sea.';
        image_left_content_right($img[0]['h2'], $img[0]['h5'], $img[0]['img'], $img[0]['desc']);

        $img[1]['h2'] = 'Wedding Venues';
        $img[1]['h5'] = 'Reception & Dinner';
        $img[1]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610231/Vrissiana/wed_l7wokw.jpg';
        $img[1]['desc'] = 'The civil wedding venue looks out across the clear Mediterranean Sea, bringing the inside and outside together. You will have breathtaking views while you exchange your vows, yet the coolness of the air conditioning within the hotel.';
        image_right_content_left($img[1]['h2'], $img[1]['h5'], $img[1]['img'], $img[1]['desc']);

        $img[2]['h2'] = 'RELAXING ATMOSPERE';
        $img[2]['h5'] = 'C-View cocktail';
        $img[2]['img'] = 'https://res.cloudinary.com/sotiris/image/upload/c_scale,h_380,w_800/v1586610225/Vrissiana/VRIS37_-_Weddings_qxfd2y.jpg';
        $img[2]['desc'] = 'The hotel has a C-View cocktail bar where the wedding party can enjoy cocktails before their wedding reception meal. With a relaxed atmosphere, the C-View bar is the perfect place for your wedding guests to relax, while the Bride & Groom have their personal photographs taken.';
        image_left_content_right($img[2]['h2'], $img[2]['h5'], $img[2]['img'], $img[2]['desc']);

        ?>

    </div>
  
        <div class="overview mb-5 mt-5">
            <div class="mx-auto text-center w-50">
            <div class="ui horizontal inverted divider"><span class="h5 text-dark">Wedding Enquiry</span></div>
                <h1 class="display-4 text-center">Request a quote</h1>
                <a href="contact_us.php" class="btn-nav btn-lg my-lg-3 btn-primary">Contact Us</a>
            </div>
        </div>
    
    <?php footer(); ?>
</body>

</html>