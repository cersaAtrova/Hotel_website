<?php
function navigation_bar($str = 'HOME')
{
    $arr = array();
 
    switch ($str) {
        case 'HOME':
            $arr[0] = 'active';
            $arr[10]='<span class="sr-only">(current)</span>';
        break;
        case 'ACCOMODATION':
            $arr[1] = 'active';
            $arr[11]='<span class="sr-only">(current)</span>';
            break;
        case 'DINING':
            $arr[2] = 'active';
            $arr[12]='<span class="sr-only">(current)</span>';
            break;
        case 'SPA':
            $arr[3] = 'active';
            $arr[13]='<span class="sr-only">(current)</span>';
            break;
        case 'WEDDING':
            $arr[4] = 'active';
            $arr[14]='<span class="sr-only">(current)</span>';
            break;
        case 'CONFERENCE':
            $arr[5] = 'active';
            $arr[15]='<span class="sr-only">(current)</span>';
            break;
        case 'GALLERY':
            $arr[6] = 'active';
            $arr[16]='<span class="sr-only">(current)</span>';
            break;
        case 'OFFER':
            $arr[7] = 'active';
            $arr[17]='<span class="sr-only">(current)</span>';
            break;
    
    }
    var_dump($arr);

$nav=<<<print
<div class=" bg-white fixed-top" >
<a class="nav-link" href="#">MY ACCOUNT</a>
</div>
<nav class="navbar navbar-expand-xl navbar-dark bg-secondary fixed-top-30">

<a class="navbar-brand text-center" href="index.php">
    <img src="images/logo.png" alt="logo" width="70%" height="60%">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto font-weight-bold " style="line-height: 2rem; font-size: 1.2em;">
        <li class="nav-item {$arr[0]}">
            <a class="nav-link" href="index.php">HOME {$arr[10]}</a>
        </li>
        <li class="nav-item {$arr[1]}">
            <a class="nav-link" href="#">ACCOMODATION{$arr[11]}</a>
        </li>
        <li class="nav-item {$arr[2]}">
            <a class="nav-link" href="#">DINING{$arr[12]}</a>
        </li>
        <li class="nav-item{$arr[3]}">
            <a class="nav-link" href="#">SPA{$arr[13]}</a>
        </li>
        <li class="nav-item {$arr[4]}">
            <a class="nav-link" href="#">WEDDING{$arr[14]}</a>
        </li>
        <li class="nav-item {$arr[5]}">
            <a class="nav-link" href="#">CONFERENCE{$arr[15]}</a>
        </li>
        <li class="nav-item {$arr[6]}">
            <a class="nav-link" href="#">GALLERY{$arr[16]}</a>
        </li>
        <li class="nav-item {$arr[7]}">
            <a class="nav-link" href="#">OFFER{$arr[17]}</a>
        </li>
    </ul>
</div>
<form class="form-inline my-2 my-lg-0" action="reservation_calendar.php" method="GET">
    <button class="btn btn-info btn-lg my-lg-3"
        style="padding: 0.6rem 1.8rem; background-color: rgba(29, 29, 92, 0.918);" typ e="submit">BOOK</button>
</form>
</nav>


print;
echo $nav;
}
?>