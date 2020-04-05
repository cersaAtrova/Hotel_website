<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Vrissiana Beach Hotel Protaras, Cyprus</title>

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
    <link rel="stylesheet" href="/CSS/style.css">
</head>

<body>
    <!-- navigation bar -->
    <?php navigation_bar(); ?>
    <!-- /BACKROUND IMAGE -->
    <section class="header">
        <div class="box-header">
            <img src="https://www.tsokkos.com/images/details/others_banner.jpg" alt="Rocks and the sea" class="back-img">
        </div>
    </section>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/html/homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
    </nav>

    <div class="overview">
        <div class="mx-auto text-center w-50">
            <h5>Vrissiana Beach Hotel FAQs</h5>
            <h1 class="display-4 text-center">Your questions answered</h1>
            <p style="font-size: 1.2rem">​From room information to facilities for children, you can find the answers to some commonly asked questions below. If you have any further queries then please get in touch using the enquiry form and we will get back to you with the answers. </p>
        </div>
    </div>

    <div class="box-container-faq">
        <div class="container-faq">
            <div id="accordion ">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What time is check-in and check-out?
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            The check in time is at 14:00 and check out at 12:00.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can I have an early check-in?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            Early check-in is subject to availability. It can always be requested but is not guaranteed.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How can I secure my late check-out?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            Late check-out can only be arranged upon your arrival at the hotel under a small charge and is subject to availability.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Can I get trip Insurance?
                            </button>
                        </h5>
                    </div>

                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            By booking your holidays through our website <a href="#">Vrissiana Beach Hotel</a> the trip insurance must be obtained by yourself.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                What’s included with my reservation?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li>Shower/face towels</li>
                                <li>Use of the Gym.</li>
                                <li>Use of sauna (where available).</li>
                                <li>Use of pool, parasols and loungers.</li>
                                <li>Kids Facilities (where available)</li>
                                <li>Sport Facilities such as tennis, table tennis, basketball, volley ball etc. (where available)</li>
                                <li>Entertainment</li>
                                <li>Daily Pool / Beach towels</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                What’s NOT included?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li> Spa treatments.</li>
                                <li>Safety deposit boxes.</li>
                                <li>Water Sports.</li>
                                <li>Beach parasols and loungers.</li>
                                <li>Mini fridges.</li>
                                <li>Air-Conditioning in hotel apartments is payable locally.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                What do my Terms of Stay Include?
                            </button>
                        </h5>
                    </div>

                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body">
                            <p><strong> Bed & Breakfast:</strong> includes International Buffet Breakfast.</p>

                            <p><strong> Half Board:<strong> includes International Buffet Breakfast and Buffet Dinner. You may switch Dinner with Lunch if you wish by requesting it at the Reception of your hotel in advance.</p>

                            <p><strong> Full Board:<strong> includes International Buffet Breakfast, Buffet Lunch and Buffet Dinner.</p>

                            <p><strong> All Inclusive:<strong> includes International Buffet Breakfast, Buffet Lunch and Buffet Dinner as well as snacks in between, unlimited local alcoholic and non alcoholic drinks, ice cream, tea and coffee, beer, wine from 10.00 am until 12.00 midnight.</p>

                            <p><strong> Premium All Inclusive:<strong> includes International Buffet Breakfast, late Breakfast, Buffet Lunch and Buffet Dinner as well as snacks in between, unlimited local alcoholic and non alcoholic drinks, ice cream, tea and coffee, beer, wine from 10.00 am until 12.00 midnight. One time per week use of each a la carte restaurant, free safe box, free WiFi in public areas, limited mini bar fill up (soft drinks & water), 30 minutes use of Sauna and Steam room per week.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                How often shall I expect my room to be cleaned?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                        <div class="card-body">
                            The rooms are cleaned daily.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingNine">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                Is a visa required to travel to your resorts?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                        <div class="card-body">
                            Visa must be acquired for all non-EU residents.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTen">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#headingTen" aria-expanded="false" aria-controls="headingTen">
                                How can I get a travel visa?
                            </button>
                        </h5>
                    </div>

                    <div id="headingTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                        <div class="card-body">
                            You can find information regarding traveling visa at the following url: <a href="https://www.cyprusvisa.eu/"> Cyprus Visa</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEleven">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                Do I need to bring an electrical adapter?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                        <div class="card-body">
                            All of our hotels can provide you with an electrical adapter under a small refundable deposit.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwelve">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                Do I need to bring a pool/beach towel?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                        <div class="card-body">
                            Vrissiana will provide you with a beach/pool towel under a small refundable deposit. You can replace them with a fresh one daily from the reception of the hotel.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThirteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                What kind of clothes do I need to bring?
                            </button>
                        </h5>
                    </div>

                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                        <div class="card-body">
                            Cyprus has a warm climate, and in the summer (especially August) the temperatures can reach a high of 42° C. Make sure to pack loose fitting clothing and light colors not to attract the heat, and of course do not forget to pack your swim attire. If you are travelling in April, May, October then make sure to take a jacket because in the evening it gets a bit cooler. During the winter you might need to pack light winter clothes for the day time and warmer clothes for the night time.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFourteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                Is the water shortage in Cyprus a problem?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordion">
                        <div class="card-body">
                            <p> The water shortage in Cyprus does not affect any holiday resorts all over Cyprus.</p>
                            <p>Since 2007 Cyprus government started the desalination centers to eliminate the water shortage in Cyprus.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFifteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                Can I drink the water?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-parent="#accordion">
                        <div class="card-body">
                            Tap water is safe to drink but we do recommend the drinking of bottle water.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSixteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                                Do the hotels offer their own transfer from and to the airport?
                            </button>
                        </h5>
                    </div>

                    <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordion">
                        <div class="card-body">
                            The hotels do not provide their own airport transport but they can arrange your transfer from and to the airport by private taxis.
                            You can either email us at: <a href="mailto:customerservice@tsokkos.com">customerservice@tsokkos.com</a> .
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeventeen">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                                How can I arrange tours outside the resort?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSeventeen" class="collapse" aria-labelledby="headingSeventeen" data-parent="#accordion">
                        <div class="card-body">
                            There are many excursions and trips available; you can book them through a local tour shop, or at the hotel reception. Never book them through random people on the street.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEighteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
                                I am booking more than one room can I request adjoining rooms?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEighteen" class="collapse" aria-labelledby="headingEighteen" data-parent="#accordion">
                        <div class="card-body">
                            All requests are upon availability and are not guaranteed. We will do our best to fulfill all such requests.
                            In order for a request to be guaranteed a fee must be paid.
                        </div>
                    </div>
                </div>




                <div class="card">
                    <div class="card-header" id="headingNineteen">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">
                                What are interconnecting rooms?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseNineteen" class="collapse" aria-labelledby="headingNineteen" data-parent="#accordion">
                        <div class="card-body">
                            <p> Interconnecting rooms are two rooms connected between them through an internal door.</p>
                            <p> All interconnecting rooms are subject to availability. We will do our best to fulfill all such requests.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwenty">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">
                                Do you offer ironing facilities?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwenty" class="collapse" aria-labelledby="headingTwenty" data-parent="#accordion">
                        <div class="card-body">
                            All of our hotels can provide you with ironing facilities under a small refundable deposit.
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingTwentyone">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentyone" aria-expanded="false" aria-controls="collapseTwentyone">
                                Do you offer laundering facilities?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentyone" class="collapse" aria-labelledby="headingTwentyone" data-parent="#accordion">
                        <div class="card-body">
                            Yes this service is available with extra payment.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwentyThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentyThree" aria-expanded="false" aria-controls="collapseTwentyThree">
                                Can I exchange money at the hotel?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentyThree" class="collapse" aria-labelledby="headingTwentyThree" data-parent="#accordion">
                        <div class="card-body">
                            Yes, all hotels offer a money exchange service.
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingtWENTYfOUR">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsetWENTYfOUR" aria-expanded="false" aria-controls="collapsetWENTYfOUR">
                                Are the loungers and parasols at the beach owned by the hotel?
                            </button>
                        </h5>
                    </div>
                    <div id="collapsetWENTYfOUR" class="collapse" aria-labelledby="headingtWENTYfOUR" data-parent="#accordion">
                        <div class="card-body">
                            No, all beach equipment are owned and run by the relevant municipalities. Charges apply for loungers and parasols (€2.50 each per day). You may use the beach without any payment if you do not wish to hire any beach equipment.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwentyFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentyFive" aria-expanded="false" aria-controls="collapseTwentyFive">
                                Is there internet access at the hotels and if so what kind of connection must I be expecting?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentyFive" class="collapse" aria-labelledby="headingTwentyFive" data-parent="#accordion">
                        <div class="card-body">
                            Yes, there is Wi-Fi internet access under payment in all public areas and bedrooms in all of our hotels. Guests booked on Premium All Inclusive have free WiFi in all hotel public areas.
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingTwentySix">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentySix" aria-expanded="false" aria-controls="collapseTwentySix">
                                Do you provide baby cot?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentySix" class="collapse" aria-labelledby="headingTwentySix" data-parent="#accordion">
                        <div class="card-body">
                            Yes, please select on the booking form.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwentySeven">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentySeven" aria-expanded="false" aria-controls="collapseTwentySeven">
                                Are there any charges for baby cot?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentySeven" class="collapse" aria-labelledby="headingTwentySeven" data-parent="#accordion">
                        <div class="card-body">
                            No charges apply.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwentyEight">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentyEight" aria-expanded="false" aria-controls="collapseTwentyEight">
                                What credit cards do you accept?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentyEight" class="collapse" aria-labelledby="headingTwentyEight" data-parent="#accordion">
                        <div class="card-body">
                            Credit cards accepted - Visa, Visa Electron, Master Card, American Express, Dinner Club, Maestro and etc.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwentyNine">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwentyNine" aria-expanded="false" aria-controls="collapseTwentyNine">
                                What phone number should I leave with my family in case they need to contact me?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwentyNine" class="collapse" aria-labelledby="headingTwentyNine" data-parent="#accordion">
                        <div class="card-body">
                            Please refer to the requested hotel's contact details
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>
<?php footer();?>
</body>


</html>