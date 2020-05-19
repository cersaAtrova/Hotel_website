<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />
    <title>Vrissiana Beach Hotel | Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="/script/light_gallery.js"></script>
    <link rel="stylesheet" href="/CSS/light_gallery.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    
</head>

<body>
    <?php navigation_bar('GALLERY') ?>
    <section class="box-header mb-5">
        <div class="box-header" style="background-color: black">
            <img src="https://res.cloudinary.com/sotiris/image/upload/v1586610228/Vrissiana/vrissiana_yh99oc.jpg" alt="Rocks and the sea" class="back-img" style="opacity: 0.6">
        </div>
    </section>
    <section class="overview mb-5"  style="font-family: 'Raleway', sans-serif !important;">
        <div class="mx-auto text-center" style="width: 30%">
            <h1>Take a Look</h1>
            <H3>Photo Gallery</H3>
        </div>
    </section>

    <div class="container" style="max-width: 100%">
        <div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">

                <?php
                $rm_type = get_room_type();
                foreach ($rm_type as $e) {

                    $img = get_room_image($e[0]);

                    foreach ($img as $i) {
                        $print = <<<pr
                     <li class="col-xs-6 col-sm-4 col-md-2 col-lg-2" data-responsive="{$i[0]}" data-src="{$i[0]}"><a href="#"><img class="img-responsive" src="{$i[0]}"></a></li>
pr;
                        echo $print;
                    }
                }
                ?>
                  </ul>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });
    </script>
    <?php footer(); ?>
</body>

</html>