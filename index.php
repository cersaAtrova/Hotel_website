<?php require_once 'functions.php' ?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vrissiana Beach Hotel Protaras, Cyprus | Official Website </title>
    <meta name="description" content="Vrissiana Beach Hotel is a very popular recently renovated beach hotel in Protaras, Cyprus.
         It combines modern aesthetics, chic style and comfort for your beach holidays. 
         Enviably located on the golden sandy beach in the center of Protaras, makes it ideal for beach holidays in ...">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <?php navigation_bar('HOME') ?>
    <!-- carusell slideshow -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/lobby-1.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>sdf</h5>
                    <p>sdf</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/VRIS07B - Pool Area.JPG" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/VRIS05 - Pool Area.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="overview">
        <div class="mx-auto text-center w-50">
            <h1 class="display-4">Welcome</h1>
            <p class="text-lg-center">Vrissiana Beach Hotel is a very popular recently renovated beach hotel in Protaras, Cyprus. It combines modern aesthetics, chic style and comfort for your beach holidays. Enviably located on the golden sandy beach in the center of Protaras, makes it ideal for beach holidays in Cyprus. The 136 modern and spacious rooms and suites are equipped with the latest technology, facilities and amenities. The lobby is designed for very eclectic guests to enjoy their time in a relaxed and stylish environment. The C-view bar offers exotic cocktails, aromatic coffees and a breathtaking view of the Mediterranean Sea. The pool bar just by the beach is the perfect spot to have your refreshment while reading a book or even you can have a drink inside our outdoor Jacuzzi. The chef's expert meals are based on the Mediterranean cuisine that leaves you with an incredible after taste, which makes it an ideal choice for All Inclusive holidays in Cyprus.</p>
        </div>
    </div>
    <div style="padding: 50px 0" class="box-container">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-6 col-7">
                    <img src="images/Princess Suite1.jpg" height="100%" width="100%" alt="" srcset="">
                </div>
                <div class="col align-self-center ">
                    <div class="col box-content-image pad-25 text-white">
                        <h5 class="pad-25">4&star; Beach Hotel Protaras</h5>
                        <h2 class="pad-25">EXQUISITE ACCOMMODATION PROPOSAL</h2>
                        <p class="pad-25">When designing Vrissiana Beach Hotel, we kept one thing in mind; the need to create an exquisite accommodation proposal by the beach of Analipsi, an experience that puts the comfort and indulgence of each guest first</p>
                        <P class="pad-25">
                            Our spacious and bright guest rooms now offer the best of traditional comfort with contemporary style and modern smart room technology designed to further enhance your stay with us.
                        </P>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md">
                    One of three columns
                </div>
                <div class="col-md-2">
                    One of three columns
                </div>

            </div>
        </div>

    </div>


    <section style="height: 300vh;"></section>
</body>

</html>