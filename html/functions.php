<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../connect_dbase.php';
define('GUSER', 'noreply.info.testing@gmail.com'); // GMail username
define('GPWD', 'G^$&/v.6/no-reply'); // GMail password
function navigation_bar($str = 'HOME')
{
  $arr = array();

  switch ($str) {
    case 'HOME':
      $arr[0] = 'active';
      $arr[10] = '<span class="sr-only">(current)</span>';
      break;
    case 'ROOMS':
      $arr[1] = 'active';
      $arr[11] = '<span class="sr-only">(current)</span>';
      break;
    case 'DINING':
      $arr[2] = 'active';
      $arr[12] = '<span class="sr-only">(current)</span>';
      break;
    case 'SPA':
      $arr[3] = 'active';
      $arr[13] = '<span class="sr-only">(current)</span>';
      break;
    case 'WEDDING':
      $arr[4] = 'active';
      $arr[14] = '<span class="sr-only">(current)</span>';
      break;
    case 'GALLERY':
      $arr[6] = 'active';
      $arr[16] = '<span class="sr-only">(current)</span>';
      break;
    case 'OFFER':
      $arr[7] = 'active';
      $arr[17] = '<span class="sr-only">(current)</span>';
      break;
    case 'LOCATION':
      $arr[8] = 'active';
      $arr[18] = '<span class="sr-only">(current)</span>';
      break;
  }
  $nav = <<<print
<div class="font-roboto bg-light fixed-top">
<a class="nav-link" href="user_account.php">MY ACCOUNT</a>
</div>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top-30">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto  " style="line-height: 1.5rem; font-size: 1em; font-weight=500">
        <li class="nav-item">
          <a class="navbar-brand text-center logo_link" href="/html/homepage.php">
           <img id="logo_img" src="https://res.cloudinary.com/sotiris/image/upload/v1586610212/Vrissiana/logo-white_vkyh9m.png" alt="logo" width="40%" height="30%">
          </a>
        </li>
    
        <li class="nav-item {$arr[0]}">
            <a class="nav-link" href="/html/homepage.php">HOME {$arr[10]}</a>
        </li>
        <li class="nav-item {$arr[1]}">
            <a class="nav-link" href="accomodation_rooms.php">ROOMS{$arr[11]}</a>
        </li>
        <li class="nav-item {$arr[2]}">
            <a class="nav-link" href="/html/dine.php">DINING{$arr[12]}</a>
        </li>
        <li class="nav-item {$arr[3]}">
            <a class="nav-link" href="/html/spa.php">SPA{$arr[13]}</a>
        </li>
        <li class="nav-item {$arr[4]}">
            <a class="nav-link" href="/html/wedding.php">WEDDINGS{$arr[14]}</a>
        </li>
        <li class="nav-item {$arr[6]}">
            <a class="nav-link" href="/html/gallery.php">GALLERY{$arr[16]}</a>
        </li>
        <!--<li class="nav-item {$arr[7]}">
            <a class="nav-link" href="#">OFFER{$arr[17]}</a>
        </li>-->
        <li class="nav-item {$arr[8]}">
            <a class="nav-link" href="/html/location.php">LOCATION{$arr[18]}</a>
        </li>
    </ul>
</div>
<form class="form-inline my-2 my-lg-0" action="booking_calendar.php" method="GET">
    <button class="btn-nav btn-lg my-md-2 btn-primary" type="submit">BOOK</button>
</form>
</nav>
print;
  echo $nav;
}

function footer()
{
  $footer = <<<print
    <footer class="text-white bg-dark">

    <div style="background-color: #6351ce;">
      <div class="container">
    
        <!-- Grid row-->
        <div class="row py-4 d-flex align-items-center">
    
          <!-- Grid column -->
          <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
            <h6 class="mb-0">Get connected with us on social networks!</h6>
          </div>
          <!-- Grid column -->
    
          <!-- Grid column -->
          <div class="col-md-6 col-lg-7 text-center text-lg-right">
    
            <!-- Facebook -->
            <a class="link social_link" href="https://www.facebook.com/vrissiana/">
              <i class="fab fa-facebook-f white-text mr-4" style="font-size: 1.5rem"> </i>
            </a>
            <!-- Twitter -->
            <a class="link social_link" href="https://twitter.com/hashtag/VrissianaBeachHotel?src=hash">
              <i class="fab fa-twitter white-text mr-4" style="font-size: 1.5rem"> </i>
            </a>
            <!--Instagram-->
            <a class="link social_link" herf="https://www.instagram.com/explore/tags/vrissianabeachhotel/">
              <i class="fab fa-instagram white-text" style="font-size: 1.5rem"> </i>
            </a>
    
          </div>
          <!-- Grid column -->
    
        </div>
        <!-- Grid row-->
    
      </div>
    </div>
    
    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">
    
      <!-- Grid row -->
      <div class="row mt-3">
    
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
    
          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold"><img src="https://res.cloudinary.com/sotiris/image/upload/v1586610212/Vrissiana/logo-white_vkyh9m.png" alt="logo" srcset=""></h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p class="text-info" style="font-size: 1.2rem">A <span style="font-size: 1.5rem"><em> MEMBER </em></span> of <span style="font-size: 1.8rem; display: inline-block"> Tsokkos Hotels</span>.</p>
    
        </div>
        <!-- Grid column -->
    
        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
    
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">...</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="/html/policy.php">Policy</a>
          </p>
          <p>
            <a href="/html/terms_and_condition.php">Term &amp; Condition</a>
          </p>
          
        </div>
        <!-- Grid column -->
    
        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
    
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="/html/user_acount.php">Your Account</a>
          </p>
          <p>
            <a href="/html/contact_us.php">Contact Us</a>
          </p>
             <p>
            <a href="/html/faq.php">FAQ</a>
          </p>
    
        </div>
        <!-- Grid column -->
    
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
    
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Contact</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <i class="fas fa-home mr-3"></i> 33 Protaras Avenue, 5296 Protaras, Cyprus</p>
          <p>
            <i class="fas fa-envelope mr-3"></i> info@example.com</p>
          <p>
            <i class="fas fa-phone mr-3"></i> + 357 23 833 444</p>
          <p>
            <i class="fas fa-print mr-3"></i> + 357 23 831 221</p>
    
        </div>
        <!-- Grid column -->
    
      </div>
      <!-- Grid row -->
    
    </div>
    <!-- Footer Links -->
    
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright: All Right Reserved
    </div>
    <!-- Copyright -->
    
    </footer>

print;
  echo $footer;
}

function image_left_content_right(&$h2_title, &$h5_subtitle, &$img, &$desc)
{
  $image = <<<print
<div class="container-fluid" style="padding:10px 0; ">
  <div class="row">
      <div class="col-md-8" style="max-height: 60%">
          <img src="$img"  width="100%" height="100%" alt="background image">
      </div>
      <div class="col align-self-center">
          <div class="col box-content-image-right pad-25 text-white">
              <h5 class="pad-25">$h5_subtitle</h5>
              <h2 class="pad-20 text-uppercase">$h2_title</h2>
              <div class="text-justify pad-25" style="font-size: 1.2rem">
                  <p class="pad-20">$desc</p>
                
              </div>
          </div>
      </div>

  </div>
</div>
print;
  echo $image;
}
function image_right_content_left(&$h2_title, &$h5_subtitle, &$img, &$desc)
{
  $image = <<<print
<div class="container-fluid" style="padding:10px 0; ">
  <div class="row" style="flex-direction: row-reverse;">
     <div class="col-md-8" style="max-height: 60%; ">
          <img src="$img" width="100%" height="100%" alt="background image">
      </div>
      <div class="col align-self-center ">
        <div class="col box-content-image-left pad-25 text-white">
            <h5 class="pad-25">$h5_subtitle</h5>
            <h2 class="pad-20 text-uppercase">$h2_title</h2>
            <div class="text-justify pad-25" style="font-size: 1.2rem">
                <p class="pad-20">
                $desc
                </p>
            </div>
        </div>
    </div>

  </div>
</div>

print;
  echo $image;
}

function room_billining_information($check_in, $check_out, $rm_name, $adults, $kids, $infants, $num_room, $room_rate_selected, $rate_plan_selected, $meal_plan)
{
  $subtotal = 0;
  $begin = date('M-d-Y', strtotime($check_in));
  foreach ($room_rate_selected as $pr) {

    $subtotal += $pr[0];
    $ml_p = $pr[1] + $pr[2];
    $rr = $pr[0] - $ml_p;
    $str .= <<<pr
  <tr>
      <td class="border-top" data-label="Date">{$begin}</td>
      <td class="border-top" data-label="Meal Price"><i class="euro sign icon"></i>{$ml_p}</td>
      <td class="border-top" data-label="Room Rate"><i class="euro sign icon"></i>{$rr}</td>
      <td class="border-top" data-label="Total"><i class="euro sign icon"></i>{$pr[0]}</td>
  </tr>

pr;
    $repeat = strtotime("+1 day", strtotime($begin));
    $begin = date('M-d-Y', $repeat);
  }

  $rooms = <<<print
              <div class="ui segment border-bottom" style="background: transparent;">
                  <p class="h2 pb-5">Booking Summary</p>
                  <div class="ui two column very relaxed grid">
                      <div class="column">
                          <p class="h4 p-2 font-weight-bold">Room type selected: </p>
                          <p class="h4 p-2 font-weight-bold">Dates: </p></br>
                          <p class="h4 p-2 font-weight-bold">Rate plan selected: </p>
                          <p class="h4 p-2 font-weight-bold">Meal plan selected: </p>
                          <p class="h4 p-2 font-weight-bold">Terms and Condition</p>
                      </div>
                      <div class="column">
                          <p class="h4 p-2"> {$rm_name}</p>
                          <p class="h4 p-2"> {$check_in} - {$check_out}</p>
                          <p class="h4 p-2"> {$rate_plan_selected}</p>
                          <p class="h4 p-2"> {$meal_plan}</p>
                          
                          <p class="h4 p-2"></p>
                      </div>
                  </div>
                  <div class="ui vertical divider "></div>
              </div>
              <div class="ui segment pb-5 border-bottom" style="background: transparent ">
                  <p class="h4 font-weight-bold">Adults: {$adults}, Kids: {$kids} Infants: {$infants}</p>
                  <div class="ui fitted divider"></div>
                  <table class="ui celled table text-white font-weight-bold border border_cell_line p-3" style="background: transparent;  ">


                      <tr>
                          <th class="border-0">Date</th>
                          <th class="border-0">Meal Price</th>
                          <th class="border-0">Room Rate</th>
                          <th class="border-0">Total</th>
                      </tr>
                          {$str}
                  </table>
              </div>
              <div class="container rm_preferences pb-4 border-bottom">
                  <p class="h4 font-weight-bold mb-4">Room Preferences </p>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox ">
                              <input id="king_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="King size">
                              <label for="king_{$num_room}">King size</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="twin_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Twin Bed">
                              <label for="twin_{$num_room}">Twin Bed</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="concerning_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Concerning Room">
                              <label for="concerning_{$num_room}">Concerning Room</label>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="high_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="High Floor">
                              <label for="high_{$num_room}">High Floor</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="lower_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Lower Floor">
                              <label for="lower_{$num_room}">Lower Floor</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox ">
                              <input id="baby_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Baby Cot">
                              <label for="baby_{$num_room}">Baby cot</label>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="smoking_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="No Smoking">
                              <label for="smoking_{$num_room}">No smoking</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="far_lift_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Far lift">
                              <label for="far_lift_{$num_room}">Far lift</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox ">
                              <input id="near_lift_{$num_room}" type="checkbox" name="rm_preference_{$num_room}[]" value="Near Lift">
                              <label for="near_lift_{$num_room}">Near Lift</label>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="container rm_preferences pb-4 border-bottom chked">
                  <p class="h4 font-weight-bold mb-4 pt-3">Extra Room Facilities</p>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="chang_{$num_room}" class="fa_extra_{$num_room}" data-cost="25" type="checkbox" name="rm_extra_{$num_room}[]" value="chang_25">
                              <label for="chang_{$num_room}">Champagne <i class="euro sign icon"></i>25</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="flowers_25_{$num_room}" class="fa_extra_{$num_room}" data-cost="25" type="checkbox" name="rm_extra_{$num_room}[]" value="flowers_25">
                              <label for="flowers_25_{$num_room}">Small Bouquet <i class="euro sign icon"></i>25</label>
                          </div>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="flowers_50_{$num_room}" class="fa_extra_{$num_room}" type="checkbox" data-cost="50" name="rm_extra_{$num_room}[]" value="flowers_50">
                              <label for="flowers_50_{$num_room}">Normal Bouquet <i class="euro sign icon"></i>50</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="red_wine_{$num_room}" class="fa_extra_{$num_room}" type="checkbox" data-cost="30" name="rm_extra_{$num_room}[]" value="red_wine">
                              <label for="red_wine_{$num_room}">Red wine <i class="euro sign icon"></i>30</label>
                          </div>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="white_wine_{$num_room}" class="fa_extra_{$num_room}" type="checkbox" data-cost="30" name="rm_extra_{$num_room}[]" value="white_wine">
                              <label for="white_wine_{$num_room}">White wine <i class="euro sign icon"></i>30</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="choco_20_{$num_room}" class="fa_extra_{$num_room}" type="checkbox" data-cost="30" name="rm_extra_{$num_room}[]" value="choco_20">
                              <label for="choco_20_{$num_room}">Chocolate Cake <i class="euro sign icon"></i>30</label>
                          </div>
                      </div>
                  </div>
              </div>
            
              <div class="container rm_preferences pb-4 border-bottom">
                  <p class="h4 font-weight-bold mb-4 pt-3">Allergies</p>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox ">
                              <input id="gluten_free_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Gluten free">
                              <label for="gluten_free_{$num_room}">Gluten Free</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="wheat_free_{$num_room}" type="checkbox" name="rm_alegies_{$num_room}[]" value="Wheat">
                              <label for="wheat_free_{$num_room}">Wheat</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="Egg_{$num_room}" type="checkbox" name="rm_alegies_{$num_room}[]" value="Egg">
                              <label for="Egg_{$num_room}">Egg</label>
                          </div>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="dairy_free_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Dairy free">
                              <label for="dairy_free_{$num_room}">Dairy Free</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="peanats_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Peanats">
                              <label for="peanats_{$num_room}">Peanats</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="Soy_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Soy">
                              <label for="Soy_{$num_room}">Soy</label>
                          </div>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="vegan_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Vegan">
                              <label for="vegan_{$num_room}">Vegan</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="ui checkbox">
                              <input id="veggi_{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Vegeterian">
                              <label for="veggi_{$num_room}">Vegeterian</label>
                          </div>
                      </div>
                      <div class="col">
                      <div class="ui checkbox">
                          <input id="Shellfish{$num_room}" type="checkbox" name="rm_alergies_{$num_room}[]" value="Shellfish">
                          <label for="Shellfish{$num_room}">Shellfish</label>
                      </div>
                  </div>
              </div>
          </div>
          <div class="container rm_preferences pb-4 border-bottom">
              <div class="row font-weight-bold ">
                  <div class="col">
                      <p class="h3">Subtotal:  $subtotal </p>
                      <p class="h3">Extra: <span class="ext_fac_{$num_room}">0</span></p>
                      <p class="h3">Total: <span class="total_{$num_room}"> $subtotal</span></p>
                  </div>
              </div>
          </div>
        
print;
  echo $rooms;
}




//get the ip address from user

function getRealIp()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
function writeLog($where)
{

  $ip = getRealIp(); // Get the IP from superglobal
  $host = gethostbyaddr($ip);    // Try to locate the host of the attack
  $date = date("d M Y");

  // create a logging message with php heredoc syntax
  $logging = <<<LOG
    \n
    << Start of Message >>
    There was a hacking attempt on your form. \n 
    Date of Attack: {$date}
    IP-Adress: {$ip} \n
    Host of Attacker: {$host}
    Point of Attack: {$where}
    << End of Message >>
LOG;
  // Awkward but LOG must be flush left

  // open log file
  if ($handle = fopen('hacklog.log', 'a')) {

    fputs($handle, $logging);  // write the Data to file
    fclose($handle);           // close the file


  }
}

function verifyFormToken($form)
{

  // check if a session is started and a token is transmitted, if not return an error
  if (!isset($_SESSION[$form . '_token'])) {
    return false;
  }

  // check if the form is sent with token in it
  if (!isset($_POST['token'])) {
    return false;
  }

  // compare the tokens against each other if they are still the same
  if ($_SESSION[$form . '_token'] !== $_POST['token']) {
    return false;
  }

  return true;
}

function generateFormToken($form)
{

  // generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
  $token = md5(uniqid(microtime(), true));

  // Write the generated token to the session variable to check it against the hidden field when the form is sent
  $_SESSION[$form . '_token'] = $token;

  return $token;
}


//validation
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//check the name
function is_valid_name($name)
{
  if (empty($name) || strlen($name) > 30) {
    return false;
  } else {

    // check if name only contains letters and whitespace
    if (ctype_alpha($name)) {
      return true;
    }
    return false;
  }
}

//validate email
function is_valid_email($email)
{
  if (empty($email) || strlen($email) > 50) {
    return false;
  } else {
    $email = test_input($email);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    return true;
  }
}
function is_valid_comment($comment)
{
  if (empty($comment) || strlen($comment) < 15 || strlen($comment) > 3000) {
    return false;
  } else {
    return true;
  }
}

//sent email
function smtpmailer($to, $from, $from_name, $subject, $body)
{
  global $error;
  $mail = new PHPMailer();  // create a new object
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true;  // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->Username = GUSER;
  $mail->Password = GPWD;

  $mail->SetFrom($from, $from_name);
  $mail->Subject = $subject;
  $mail->addReplyTo($from);
  $mail->IsHTML(true);
  $mail->AddEmbeddedImage('https://res.cloudinary.com/sotiris/image/upload/v1586610215/Vrissiana/contact_mail_dwuuv2.jpg', 'img');
  $mail->Body = $body;
  $mail->AddAddress($to);
  if (!$mail->Send()) {
    $error = 'Mail error: ' . $mail->ErrorInfo;
    return false;
  } else {
    $error = 'Message sent!';
    return true;
  }
}

function send_guest_message($name, $email, $country, $subject, $message)
{

  $msg = <<<send
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-size: 16px;
            list-style: none;
            font-family: 'Raleway', sans-serif;
            text-decoration: none;
        }

        h2,
        h3,
        div,
        a,
        p {
            padding: 10px;
            line-height:1.5rem;
        }

        h2 {
            font-size: 2rem;
            text-align: center;
        }

        h3 {
            font-size: 1.2rem;
            text-align: center;
        }
        // h5{
        //   font-size: 0.8rem;
        //  font-weight:none;
        // }
        hr {
            color: rgba(73, 73, 73, 0.2);
            margin: 0;
            padding: 0;
        }

        .box-email {
            width: 100%;

        }

        .body-email {
            width: 80%;
            margin: auto;
            border: 1px solid rgba(23, 22, 73, 0.644);
        }

        .img {
    
            width: 100%;
            height: 25vh;
        }

        .button-reply {
            margin: 10px 0 25px;
            overflow: auto;
            color:white;
        }

        .reply {
            float: right;
            font-size: 1.5rem;
            text-transform: uppercase;
            color: white;
            border-radius: 10px;
            font-weight: 700;
            background-color: rgba(25, 25, 117, 0.89);
        }
    </style>



</head>

<body>
    <div class="box-email">
        <div class="body-email">
        <div class="img"><img src="cid:reply" width="100%" height="100%"></div>
            <div class="divider-line">
                <h2>Vrissiana Beach Hotel</h2>
                <h3>You receive Message from Guest</h3>

                <hr />
            </div>
            <div class="recieve_mail">
                <fieldset>
                    <legend>Guest Information</legend>
                    
                        <h5>Full name: $name </h5>
                        <h5>From: $country</h5>
                        <h5>Email: $email</h5>
                        <h5>Subject: $subject</h5>
                   
                </fieldset>
            </div>
            <div class="divider-line">
                <hr />
            </div>

            <div class="content-email">
                <fieldset>
                    <legend>Message</legend>
                    <p> $message</p>
                </fieldset>
            </div>

            <div class="divider-line">
                <hr />
            </div>
            <div class="button-reply">
                <a class="reply" href="mailto:$email">Reply</a>
            </div>

        </div>

    </div>
</body>

</html>
send;
  return $msg;
}


function display_available_room($count_room, $room_name, $daily_price_nfr, $daily_price_fr, $room_size, $max_guest, $img, $rm_type = null, $modify = 'NAN')
{
  $rm = explode(' ', $rm_type);
  $str = '';
  foreach ($img as $e) {
    if (empty($str)) {
      $str .= '<div class="carousel-item active "> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt="First slide"> </div>';
    } else {
      $str .= '<div class="carousel-item"> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt="First slide"> </div>';
    }
  }

  $msg = <<<rooms
  <div class="row mb-3">
      <div class="col-md-8" style="max-height: 60%">
          <div id="$room_name" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                  $str
              </div>
              <a class="carousel-control-prev" href="#$room_name" role="button" data-slide="prev">
                  <span aria-hidden="true"><i class="angle huge black left icon"></i></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next pr-5" href="#$room_name" role="button" data-slide="next">
                  <span aria-hidden="true"><i class="angle huge black right icon"></i></span>
                  <span class="sr-only ">Next</span>
              </a>
          </div>

      </div>

      <div class="col align-self-center">
          <div class="col box-content-image-right pad-25 text-white">
              <form class="ui" action="select_room.php" method="GET">

                  <p class="pad-25 h4">Select Room  $count_room </p>
                  <p class="pad-20 h2 text-uppercase"> $room_name</p>
                  <input type="hidden" name="room_name" value="$room_name">
                  <div class="ui inverted segment">
                      <div class="ui inverted divider"></div>
                      <div class="container">
                          <div class="row row-col-3">
                              <div class="col">
                                  <P class="h5 pb-2">Non-refundable</P>
                                 <a href="" class="text-white" data-toggle="modal" data-target="#{$rm[0]}"><u>View terms</u></a>
                              </div>
                              <div class="col text-center">
                                  <h3><i class="euro sign icon"></i> $daily_price_nfr</h3>
                                  <input type="hidden" name="price" value=" $daily_price_nfr">
                                  <p>Per night</p>
                              </div>
                              <div class="col">
                              <input type="hidden" name="$modify" value="true">
                                  <input type="submit" name="non_refandable" value="Reserve" class="btn-nav btn-xl my-md-2 btn-primary">
                              </div>
                          </div>
                      </div>
                      <div class="ui inverted divider"></div>
                      <div class="container">
                          <div class="row row-col-3">
                              <div class="col">
                                  <h3>Refuntable</h3>
                                  <a href="#" class="text-white" data-toggle="modal" data-target="#{$rm[0]}1"><u>View terms</u></a>
                              </div>
                              <div class="col text-center">
                                  <h3><i class="euro sign icon"></i>$daily_price_fr</h3>
                                  <input type="hidden" name="price" value=" $daily_price_fr">
                                  <p>Per night</p>
                              </div>
                              <div class="col">
                                  <input type="submit" name="flexible" value="Reserve" class="btn-nav btn-xl my-md-2 btn-primary">
                              </div>
                          </div>
                      </div>
                      <div class="ui inverted divider"> </div>
                      <p class="pl-2 pd-5 pt-2">Room size: $room_size m<sup>2</sup></p>
                      <p class="pl-2 pd-5 pt-2">Sleep up to $max_guest</p>
                  </div>
              </form>
          </div>

      </div>

  </div>

  <div class="modal fade" id="{$rm[0]}" tabindex="-1" role="dialog" aria-labelledby="room_name"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content   text-white" style="background-color: #424278;">
          <div class="modal-header">
              <h5 class="modal-title" id="room_name">$room_name</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          Policy
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
  </div>

  <div class="modal fade" id="{$rm[0]}1" tabindex="-1" role="dialog" aria-labelledby="room_name"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content   text-white" style="background-color: #424278;">
          <div class="modal-header">
              <h5 class="modal-title" id="room_name">$room_name</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          Policy
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
  </div>

rooms;
  echo $msg;
}

function print_room($rm_type, $room_name, $room_size, $max_guest, $img)
{
  $rm = explode(' ', $rm_type);
  if ($rm_type == 'Princess Suite') {
    $p = "<p class=\"pl-2\">Living room area</p><p class=\"pl-2\">40' Satelite TV</p>
    <p class=\"pl-2\">Direct Dial Telephone</p>
    <p class=\"pl-2\">Digital Safety box</p>
    <p class=\"pl-2\">Mini Fridge</p>
    <p class=\"pl-2\">Wifi</p>
    <p class=\"pl-2\">Air Conditioning - Individual</p>
    <p class=\"pl-2\">Hairdryer</p>
    <p class=\"pl-2\">Shaver Point</p>
    <p class=\"pl-2\">Electric Current 220/240 Volts</p>
    <p class=\"pl-2\">International Electric Sockets</p>
    <p class=\"pl-2\">Toiletries</p>
    <p class=\"pl-2\">Bathroom with Shower or Bathtub</p>";
  } elseif ($rm_type == 'Presidential Suite') {
    $p = "<p class=\"pl-2\">Satelite Flat Screen TV</p>
    <p class=\"pl-2\">Direct Dial Telephone</p>
    <p class=\"pl-2\">Digital Safety box</p>
    <p class=\"pl-2\">Mini Fridge</p>
    <p class=\"pl-2\">Wifi</p>
    <p class=\"pl-2\">Air Conditioning - Individual</p>
    <p class=\"pl-2\">Hairdryer</p>
    <p class=\"pl-2\">Shaver Point</p>
    <p class=\"pl-2\">Electric Current 220/240 Volts</p>
    <p class=\"pl-2\">International Electric Sockets</p>
    <p class=\"pl-2\">Toiletries</p>
    <p class=\"pl-2\">Bathroom with Shower or Bathtub</p>
    <p class=\"pl-2\">Outdoor Jacuzzi</p>";
  } else {
    $p = "<p class=\"pl-2\">Satelite Flat Screen TV</p>
    <p class=\"pl-2\">Direct Dial Telephone</p>
    <p class=\"pl-2\">Digital Safety box</p>
    <p class=\"pl-2\">Mini Fridge</p>
    <p class=\"pl-2\">Wifi</p>
    <p class=\"pl-2\">Air Conditioning - Individual</p>
    <p class=\"pl-2\">Hairdryer</p>
    <p class=\"pl-2\">Shaver Point</p>
    <p class=\"pl-2\">Electric Current 220/240 Volts</p>
    <p class=\"pl-2\">International Electric Sockets</p>
    <p class=\"pl-2\">Toiletries</p>
    <p class=\"pl-2\">Bathroom with Shower or Bathtub</p>";
  }
  $str = '';
  foreach ($img as $e) {
    if (empty($str)) {
      $str .= '<div class="carousel-item active "> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt="First slide"> </div>';
    } else {
      $str .= '<div class="carousel-item"> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt="First slide"> </div>';
    }
  }

  $msg = <<<rooms
  <div class="row mb-3">
  <div class="col-md-8" style="max-height: 60%">
      <div id="$room_name" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              $str
          </div>
          <a class="carousel-control-prev" href="#$room_name" role="button" data-slide="prev">
              <span aria-hidden="true"><i class="angle huge black left icon"></i></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next pr-5" href="#$room_name" role="button" data-slide="next">
              <span aria-hidden="true"><i class="angle huge black right icon"></i></span>
              <span class="sr-only ">Next</span>
          </a>
      </div>

  </div>

  <div class="col align-self-center">
      <div class="col box-content-image-right pad-25 text-white">
          <p class="pad-20 h3"><i>Room</i></p>
          <p class="pad-20 h2 text-uppercase"> {$room_name}</p>
          <input type="hidden" name="room_name" value="$room_name">
          <div class="ui inverted segment">
              <div class="ui inverted divider"></div>
              <div class="container">
                  <div class="row">
                      <div class="col">
                          <p class="pl-2 pd-5 pt-2">Room size: {$room_size} m<sup>2</sup></p>
                          <p class="pl-2 pd-5 pt-2">Sleep up to {$max_guest}</p>
                          <p class="pl-2 pd-5 pt-2">Suitable for: Couples, Family, Single travellers </p>
                      </div>
                  </div>
              </div>
              <div class="ui inverted divider"> </div>
              <a href="#" class="text-white" data-toggle="modal" data-target="#{$rm[0]}"><u>Room Facilities</u></a>
              <div class="ui inverted divider"> </div>
              <a href="booking_calendar.php" class="ui btn-nav btn-xl my-md-2 btn-primary w-100">Check Availabiity</a>

          </div>
      </div>

  </div>

</div>

<div class="modal fade" id="{$rm[0]}" tabindex="-1" role="dialog" aria-labelledby="room_name"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content   text-white" style="background-color: #424278;">
        <div class="modal-header">
            <h5 class="modal-title" id="room_name">$room_name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          {$p}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>

rooms;
  echo $msg;
}

function display_not_available_room($count_room, $room_name, $daily_price_nfr, $daily_price_fr, $room_size, $max_guest, $img, $min_stay, $rm_type = null)
{
  $rm = explode(' ', $rm_type);
  $str = '';
  foreach ($img as $e) {
    if (empty($str)) {
      $str .= '<div class="carousel-item active "> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt=""> </div>';
    } else {
      $str .= '<div class="carousel-item "> <img class="d-block w-100" src="' . $e[0] . '" width="100%" height="100%" alt=""> </div>';
    }
  }

  $msg = <<<rooms


  <div class="row mb-3">
    <div class="col-md-8" style="max-height: 60%">
        <div id="$room_name" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                $str
            </div>
            <a class="carousel-control-prev" href="#$room_name" role="button" data-slide="prev">
                <span aria-hidden="true"><i class="angle huge black left icon"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next pr-5" href="#$room_name" role="button" data-slide="next">
                <span aria-hidden="true"><i class="angle huge black right icon"></i></span>
                <span class="sr-only ">Next</span>
            </a>
        </div>
    </div>
    <div class="col align-self-center">
        <div class="col box-content-image-right pad-25 text-white">
                <p class="pad-25 h4">Select Room  $count_room </p>
                <p class="pad-20 h2 text-uppercase"> $room_name</p>
          
                <div class="ui inverted segment">
                    <div class="ui inverted divider"></div>
                    <div class="container">
                        <div class="row row-col-3">
                            <div class="col">
                                <P class="h5 pb-2">Non-refundable</P>
                               
                            </div>
                            <div class="col text-center">
                                <h3><i class="euro sign icon"></i> $daily_price_nfr</h3>
                                <p>Per night</p>
                            </div>
                            <div class="col">
                                <a aria-disabled="true" style=" pointer-events: none;"  class="btn-nav disabled btn-xl bg-secondary">Not available</a>
                                <p> $min_stay </p>
                            </div>
                        </div>
                    </div>
                    <div class="ui inverted divider"></div>
                    <div class="container">
                        <div class="row row-col-3">
                            <div class="col">
                                <h3>Refuntable</h3>
                                <a href="" class="text-white"><u>View terms</u></a>
                            </div>
                            <div class="col text-center">
                                <h3><i class="euro sign icon"></i>$daily_price_fr</h3>
                                <p>Per night</p>
                            </div>
                            <div class="col">
                            <a aria-disabled="true" style=" pointer-events: none;"  class="btn-nav disabled btn-lg bg-secondary">Not available</a>
                            <p> $min_stay </p>
                            </div>
                        </div>
                    </div>
                    <div class="ui inverted divider"> </div>
                    <p class="pl-2 pd-5 pt-2">Room size: $room_size m<sup>2</sup></p>
                    <p class="pl-2 pd-5 pt-2">Sleep up to $max_guest</p>
                    <a href="#" class="text-white" data-toggle="modal" data-target="#{$rm[0]}"><u>View terms</u></a> 
                </div>
          </div>
       </div>
   </div>
 

rooms;
  echo $msg;
}

function valid_rate($rate)
{

  if (is_numeric($rate)) {
    return true;
  }
  if (substr($rate, 0, 1) == '*' || substr($rate, 0, 1) == '+') {
    if (is_numeric(substr($rate, 1))) {
      return true;
    }
  }
  return false;
}


function is_room_available($rm_type, $check_in, $check_out)
{
  global $db;
  $query_ra = 'SELECT *
             From Room_availability
            
             WHERE ra_date >= ? AND ra_date < ?
             AND Room_availability.rm_type=? AND ra_status=\'Open\'AND Room_availability.ra_days >=1 ';

  $rm_availability = $db->prepare($query_ra);
  $rm_availability->bindValue(1, $check_in->format('Y/m/d'));
  $rm_availability->bindValue(2, $check_out->format('Y/m/d'));
  $rm_availability->bindValue(3, $rm_type);
  $rm_availability->execute();
  if ($rm_availability->rowCount() != 0) {
    $rm_availability->closeCursor();
    return true;
  } else {
    $rm_availability->closeCursor();
    return false;
  }
}
//retrive all rooms information
function prepare_all_rooms()
{
  global $db;
  $query_ra = 'SELECT Room_availability.ra_date,Room_availability.rm_type,Room_availability.ra_days,
                      Room.rm_name,Room.rm_price_diff,Room.rm_size,Room.rm_max_guest,
                      Room_rate.rr_price ,
                      Room_constraint.rc_days 
             From Room_availability
             JOIN Room_rate ON ra_date=  rr_date 
             JOIN Room_constraint   ON Room_availability.rm_type = Room_constraint.rm_type 
                                    AND Room_availability.ra_date = Room_constraint.rc_date
             JOIN Room ON Room.rm_type=Room_availability.rm_type
             WHERE ra_date >= ? AND ra_date < ?
             AND Room_availability.rm_type=? AND ra_status=\'Open\'AND Room_availability.ra_days >=? ';

  $rm_availability = $db->prepare($query_ra);
  return $rm_availability;
}
function get_all_available_rooms($check_in, $check_out, $rm_type, $total_room)
{
  $rm_availability = prepare_all_rooms();
  $rm_availability->bindValue(1, $check_in->format('Y/m/d'));
  $rm_availability->bindValue(2, $check_out->format('Y/m/d'));
  $rm_availability->bindValue(3, $rm_type);
  $rm_availability->bindValue(4, $total_room);
  $rm_availability->execute();


  return  $rm_availability;
}
function get_availability($check_in, $rm_type)
{
  global $db;
  $query  = 'SELECT * From Room_availability
             WHERE ra_date=:checkin  AND rm_type=:rm';
  $rm_availability = $db->prepare($query);
  $rm_availability->bindValue(':checkin', $check_in);

  $rm_availability->bindValue(':rm', $rm_type);

  $rm_availability->execute();
  $ave = $rm_availability->fetch();
  $rm_availability->closeCursor();

  return $ave;
}
function get_constraint($check_in, $rm_type)
{
  global $db;
  $query  = 'SELECT * From Room_constraint
             WHERE rc_date=:checkin  AND rm_type=:rm';
  $rm_availability = $db->prepare($query);
  $rm_availability->bindValue(':checkin', $check_in);

  $rm_availability->bindValue(':rm', $rm_type);

  $rm_availability->execute();
  $ave = $rm_availability->fetch();
  $rm_availability->closeCursor();

  return $ave;
}
function get_room_rate_by_date($check_in)
{
  global $db;
  $query  = 'SELECT * From Room_rate
             WHERE rr_date=:checkin';
  $rm_availability = $db->prepare($query);
  $rm_availability->bindValue(':checkin', $check_in);
  $rm_availability->execute();
  $ave = $rm_availability->fetch();
  $rm_availability->closeCursor();

  return $ave;
}
// retrive all room type
function get_room_type()
{
  global $db;
  $query  = 'SELECT rm_type From Room ORDER BY rm_price_diff';
  $rm = $db->prepare($query);
  $rm->execute();
  $rm_type = $rm->fetchAll();
  $rm->closeCursor();

  return $rm_type;
}
//get the type and the information about the room
function get_room_type_row($room_name)
{
  global $db;
  $query_rm = 'SELECT * From Room WHERE rm_name=?';
  $rm = $db->prepare($query_rm);
  $rm->bindValue(1, $room_name);
  $rm->execute();
  $row = $rm->fetch();
  $rm->closeCursor();
  return $row;
}
function get_room_by_rm_type($rm_type)
{
  global $db;
  $query_rm = 'SELECT * From Room WHERE rm_type=?';
  $rm = $db->prepare($query_rm);
  $rm->bindValue(1, $rm_type);
  $rm->execute();
  $row = $rm->fetch();
  $rm->closeCursor();
  return $row;
}
function get_room_image($rm_type)
{
  global $db;
  $query_img = 'SELECT img_rm_img
  From Room_image
  WHERE rm_type=?';
  $ri = $db->prepare($query_img);
  $ri->bindValue(1, $rm_type);
  $ri->execute();
  $rm_img = $ri->fetchAll();
  $ri->closeCursor();
  return $rm_img;
}
function get_reservation_daily_rate($resv_id)
{
  global $db;
  $query = 'SELECT *
             From Daily_rate
             WHERE resv_reference = ?';
  $rm_rr = $db->prepare($query);
  $rm_rr->bindValue(1, $resv_id);
  $rm_rr->execute();
  $rm_rate = $rm_rr->fetchAll();
  $rm_rr->closeCursor();
  return $rm_rate;
}



function get_daily_price($check_in, $check_out, $rm_type, $adults, $kids = null)
{
  global $db;
  $query = 'SELECT Room_availability.ra_date,Room_availability.rm_type,
                   Room.rm_price_diff,
                   Room_rate.rr_price,Room_rate.rr_extra_person,Room_rate.rr_kids
            From Room_availability
            JOIN Room_rate ON ra_date=  rr_date 
            JOIN Room USING(rm_type)
            WHERE ra_date >= ? AND ra_date < ? AND Room_availability.rm_type=?';
  $rm_rate = $db->prepare($query);
  $rm_rate->bindValue(1, $check_in->format('Y/m/d'));
  $rm_rate->bindValue(2, $check_out->format('Y/m/d'));
  $rm_rate->bindValue(3, $rm_type);
  $rm_rate->execute();
  $rate = $rm_rate->fetch();
  $rm_rate->closeCursor();


  // retrive all meal price
  $query_meal_plan = 'SELECT * FROM Room_meal_price
                      WHERE rm_meal IN ("FL",?)';
  $rm_m_p = $db->prepare($query_meal_plan);

  $rm_m_p->execute(array($_SESSION['room_info']['meal_plan']));
  $meal_pr = $rm_m_p->fetchAll();
  $rm_m_p->closeCursor();

  //get the different price of the meal
  foreach ($meal_pr as $e) {
    if ($e['rm_meal'] == 'FL') {
      $_SESSION['meal_price']['FL'] = $e['rm_price_diff'];
    } else {
      $_SESSION['meal_price']['OT'] = $e['rm_price_diff'];
      $meal_kids_rate = $e['rm_kids_price'];
    }
  }
  $room_price = $rate['rr_price'] + $rate['rm_price_diff'];
  //is standart price for the adults
  $meal_adults = ($_SESSION['meal_price']['OT'] / 2) * $adults;


  // get the price for the meal supliment if the first char is + or just the value just add the perice in the total amount if is * the is a percentage result
  if ($kids != null && is_numeric($kids) && substr($meal_kids_rate, 1) < $room_price) {
    //get the first character and calculate the result
    if (substr($meal_kids_rate, 0, 1) == '+') {
      if (is_numeric(substr($meal_kids_rate, 1)) && substr($meal_kids_rate, 1) > 0 && substr($meal_kids_rate, 1) < $room_price) {
        //if the price is on + then just get this price and multiply by addults . 
        $meal_kids = (substr($meal_kids_rate, 1) * $kids);
      }
      // * is describe the percentage
    } elseif (substr($meal_kids_rate, 0, 1) == '*') {
      if (is_numeric(substr($meal_kids_rate, 1)) && substr($meal_kids_rate, 1) > 0 && substr($meal_kids_rate, 1) <= 100) {
        // get the result and divaded by 100 to get the percentage. and added to the total cost
        $percentage = (100 - substr($meal_kids_rate, 1)) / 100;
        $meal_kids = ($_SESSION['meal_price']['OT'] / 2) * $percentage * $kids;
      }
    } elseif (is_numeric($meal_kids_rate)) {
      if ($meal_kids_rate >= 0 && substr($meal_kids_rate, 1) < $room_price) {
        $meal_kids = (substr($meal_kids_rate, 1) * $kids);
      }
    }
  }
  //count adults price after meal suppliment
  // get the price for the meal supliment if the first char is + or just the value just add the perice in the total amount if is * the is a percentage result

  if ($adults >= 3) {
    $adls = $adults - 2;
    //get the price for one person
    $extra_adl = $room_price / 2;
    //get the first character and calculate the result
    if (substr($rate['rr_extra_person'], 0, 1) == '+') {
      if (is_numeric(substr($rate['rr_extra_person'], 1)) && substr($rate['rr_extra_person'], 1) > 0 && substr($rate['rr_extra_person'], 1) < $room_price) {
        //if the price is on + then just get this price and multiply by addults . 
        $extra_adl = (substr($rate['rr_extra_person'], 1) * $adls);
      } else {
        return false;
      }
      // * is describe the percentage
    } elseif (substr($rate['rr_extra_person'], 0, 1) == '*') {
      if (is_numeric(substr($rate['rr_extra_person'], 1)) && substr($rate['rr_extra_person'], 1) > 0 && substr($rate['rr_extra_person'], 1) <= 100) {
        // get the result and divaded by 100 to get the percentage. and added to the total cost
        $percentage = (100 - substr($rate['rr_extra_person'], 1)) / 100;
        $extra_adl = $extra_adl * $percentage * $adls;
      } else {
        return false;
      }
    } elseif (is_numeric($rate['rr_extra_person'])) {
      if ($rate['rr_extra_person'] >= 0 && $rate['rr_extra_person'] < $room_price) {
        $extra_adl = $rate['rr_extra_person'] * $adls;
      }
    }
  }

  if ($kids != null && is_numeric($kids) && substr($rate['rr_kids'], 1) < $room_price) {
    //get the price for one person
    $extra = $room_price / 2;
    //get the first character and calculate the result
    if (substr($rate['rr_kids'], 0, 1) == '+') {
      if (is_numeric(substr($rate['rr_kids'], 1)) && substr($rate['rr_kids'], 1) > 0 && substr($rate['rr_kids'], 1) < $room_price) {
        //if the price is on + then just get this price and multiply by addults . 
        $extra = (substr($rate['rr_kids'], 1) * $kids);
      } else {
        return false;
      }
      // * is describe the percentage
    } elseif (substr($rate['rr_kids'], 0, 1) == '*') {
      if (is_numeric(substr($rate['rr_kids'], 1)) && substr($rate['rr_kids'], 1) > 0 && substr($rate['rr_kids'], 1) <= 100) {
        // get the result and divaded by 100 to get the percentage. and added to the total cost
        $percentage = (100 - substr($rate['rr_kids'], 1)) / 100;
        $extra = $extra * $percentage * $kids;
      } else {
        return false;
      }
    } elseif (is_numeric($rate['rr_kids'])) {
      if ($rate['rr_kids'] >= 0 && substr($rate['rr_kids'], 1) < $room_price) {
        $extra = $rate['rr_kids'] * $kids;
      } else {
        return false;
      }
    }
  }
  $room_price = $room_price + $extra_adl + $extra + $meal_kids + $meal_adults;
  return array(round($room_price, 2), round($room_price + $_SESSION['meal_price']['FL'], 2), $meal_adults, $meal_kids);
}
function luhn_check($number)
{
  // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
  $number = preg_replace('/\D/', '', $number);

  // Set the string length and parity
  $number_length = strlen($number);
  $parity = $number_length % 2;

  // Loop through each digit and do the maths
  $total = 0;
  for ($i = 0; $i < $number_length; $i++) {
    $digit = $number[$i];
    // Multiply alternate digits by two
    if ($i % 2 == $parity) {
      $digit *= 2;
      // If the sum is two digits, add them together (in effect)
      if ($digit > 9) {
        $digit -= 9;
      }
    }
    // Total up the digits
    $total += $digit;
  }
  // If the total mod 10 equals 0, the number is valid
  return ($total % 10 == 0) ? TRUE : FALSE;
}
function get_extra_price_and_name($fa_extra)
{

  $extra = array();
  foreach ($fa_extra as $e) {
    if ($e == 'chang_25') {
      $extra[] = array('price' => 25, 'name' => 'Chanpagne');
    } elseif ($e == 'flowers_25') {
      $extra[] = array('price' => 25, 'name' => 'Small Flowers');
    } elseif ($e == 'flowers_50') {
      $extra[] = array('price' => 50, 'name' => 'Normal Flowers');
    } elseif ($e == 'red_wine') {
      $extra[] = array('price' => 30, 'name' => 'Red Wine');
    } elseif ($e == 'white_wine') {
      $extra[] = array('price' => 30, 'name' => 'White wine');
    } elseif ($e == 'choco_20') {
      $extra[] = array('price' => 30, 'name' => 'Chocolate Cake');
    }
  }

  return $extra;
}
function is_email_exist($email)
{
  global $db;
  $query = 'SELECT *
              FROM Member WHERE member_email=?';
  $log = $db->prepare($query);
  $log->bindValue(1, $email);
  $log->execute();
  $login = $log->fetch();
  $log->closeCursor();
  if ($login == null) {
    return  false;
  } else {
    return $login;
  }
}

function is_telephone_exist($tel)
{
  global $db;
  $query = 'SELECT *
              FROM Member WHERE member_tel=?';
  $log = $db->prepare($query);
  $log->bindValue(1, $tel);
  $log->execute();
  $login = $log->fetch();
  $log->closeCursor();
  if ($login == null) {
    return  false;
  } else {
    return $login;
  }
}

function show_reservation_overview($Date)
{
  foreach ($Date as $e) {
    $card = get_credit_card_by_resv_id($e['resv_reference']);

    $resv_profile = get_reservation_guest_profile($e['resv_reference']);
    $resv_facility = get_reservation_facilities_price($e['resv_reference']);
    $resv_total = get_reservation_price($e['resv_reference']);
    if ($resv_facility[0] != null) {
      $resv_total[0] += $resv_facility[0];
    }
    if ($e['resv_status'] == 'Cancelled') {
      $color = 'text-danger';
    } else {
      $color = '';
    }
    $resv = <<<print
            <div class="ui message">
            <div class="header">
                <a href="admin_view_reservation.php?id={$e['resv_reference']}" class="ui link btn-link">{$e['resv_reference']}</a>
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
            <tr class="{$color}">
                <td data-label="Name">{$resv_profile['resv_name']} {$resv_profile['resv_last']}</td>
                <td data-label="Date in">{$e['resv_check_in']}</td>
                <td data-label="Date out">{$e['resv_check_out']}</td>
                <td data-label="meal">{$e['resv_meal_level']}</td>
                <td data-label="Status" class="{$color}">{$e['resv_status']}</td>
                <td data-label="Room type">{$e['rm_type']}</td>
                <td data-label="Card">{$card['cc_card_status']}</td>
                <td data-label="Price">{$resv_total[0]}</td>
            </tr>
            </tbody>
            </table>
            </div>
print;
    echo $resv;
  }
}
