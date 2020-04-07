<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/PHPMailer.php';
define('GUSER', 'noreply.info.testing@gmail.com'); // GMail username
define('GPWD', 'LKJPOI123!!'); // GMail password
function navigation_bar($str = 'HOME')
{
  $arr = array();

  switch ($str) {
    case 'HOME':
      $arr[0] = 'active';
      $arr[10] = '<span class="sr-only">(current)</span>';
      break;
    case 'ACCOMODATION':
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
  }
  $nav = <<<print
<div class="font-roboto bg-light fixed-top">
<a class="nav-link" href="#">MY ACCOUNT</a>
</div>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top-30">

<a class="navbar-brand text-center" href="/html/homepage.php">
    <img src="/images/logo-white.png" alt="logo" width="60%" height="500%">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto  " style="line-height: 2rem; font-size: 1.2em; font-weight=500">
        <li class="nav-item {$arr[0]}">
            <a class="nav-link" href="/html/homepage.php">HOME {$arr[10]}</a>
        </li>
        <li class="nav-item {$arr[1]}">
            <a class="nav-link" href="#">ACCOMODATION{$arr[11]}</a>
        </li>
        <li class="nav-item {$arr[2]}">
            <a class="nav-link" href="/html/dine.php">DINING{$arr[12]}</a>
        </li>
        <li class="nav-item {$arr[3]}">
            <a class="nav-link" href="/html/spa.php">SPA{$arr[13]}</a>
        </li>
        <li class="nav-item {$arr[4]}">
            <a class="nav-link" href="/html/wedding.php">WEDDING{$arr[14]}</a>
        </li>
        <li class="nav-item {$arr[6]}">
            <a class="nav-link" href="/html/gallery.php">GALLERY{$arr[16]}</a>
        </li>
        <li class="nav-item {$arr[7]}">
            <a class="nav-link" href="#">OFFER{$arr[17]}</a>
        </li>
    </ul>
</div>
<form class="form-inline my-2 my-lg-0" action="reservation_calendar.php" method="GET">
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
            <a class="link" href="#">
              <i class="fab fa-facebook-f white-text mr-4" style="font-size: 1.5rem"> </i>
            </a>
            <!-- Twitter -->
            <a class="link" href="#">
              <i class="fab fa-twitter white-text mr-4" style="font-size: 1.5rem"> </i>
            </a>
            <!-- Google +-->
            <a class="link">
              <i class="fab fa-google-plus-g white-text mr-4" style="font-size: 1.5rem"> </i>
            </a>
            <!--Instagram-->
            <a class="link" herf="https://www.instagram.com/explore/tags/vrissianabeachhotel/">
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
          <h6 class="text-uppercase font-weight-bold"><img src="/images/logo-white.png" alt="" srcset=""></h6>
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
          <p>
            <a href="/html/sitemap.php">Sitemap</a>
          </p>
          
        </div>
        <!-- Grid column -->
    
        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
    
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="/html/guest_acount.php">Your Account</a>
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

//get the ip address from user
function getRealIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
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
  if (empty($name)) {
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
  if (empty($email)) {
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
