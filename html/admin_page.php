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
    <link rel="stylesheet" href="../CSS/validate_card.css">

    <script src="../script/script.js"></script>


</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active h4">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item h4">
                    <a class="nav-link" href="#">Reservation <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown h4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inventory
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Room Rate</a>
                        <a class="dropdown-item" href="#">Insert Rate</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Reservation</a>
                    </div>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0" action="admin_page.php" method="GET">
                <input class="form-control mr-sm-2" name="resv_id" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div style="height: 10vh"></div>
    <div class="container-fluid p-5">
        <p class="display-3 text-primary font-weight-bold">Reservation Overview</p>
        <p class="display-4 text-primary font-weight-bold">Today</p>
        <div class="container">
            <div class="ui message">
                <div class="header">
                    <a href="admin_reservation.php" class="ui link btn-link">RESERVATION ID</a>
                </div>
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date in</th>
                            <th>Date out</th>
                            <th>Meal</th>
                            <th>Status</th>
                            <th>Room type</th>
                            <th>Card</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Name">James</td>
                            <td data-label="Age">24</td>
                            <td data-label="Job">Engineer</td>
                            <td data-label="Name">Jill</td>
                            <td data-label="Age">26</td>
                            <td data-label="Job">Engineer</td>
                            <td data-label="Name">Jill</td>
                            <td data-label="Age">26</td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</body>

</html>