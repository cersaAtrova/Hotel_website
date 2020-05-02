<?php 
if(isset($_REQUEST['search_top'])){
    if(get_reservation_by_resv_id($_REQUEST['search_id_top'])!=null){
        header("Location: admin_view_reservation.php?id={$_REQUEST['search_id_top']}");
        die();
    }
    
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item  h4 active">
                <a class="nav-link" href="admin_page.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item h4 active">
                <a class="nav-link" href="admin_reservation.php">Reservation <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown h4 active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Inventory
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admin_room_rate.php">Room Rate</a>
                    <a class="dropdown-item" href="admin_insert_rate.php">Insert Rate</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item disabled" href="#">History</a>
                </div>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
            <input class="form-control mr-sm-2" name="search_id_top" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search_top" type="submit">Search</button>
        </form>
        <a class="ui nav-link item link h4 text-white admin_logout" href="#">
            Log out
        </a>
    </div>
</nav>