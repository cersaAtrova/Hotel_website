<?php
require_once 'functions.php';
require_once 'countries.php';



session_start();

//get the country from user
$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . getRealIp());
echo $xml->geoplugin_countryName;
$country_name_by_ip;
foreach ($xml as $key => $value) {
	if ($key == 'geoplugin_countryName') {
		$country_name_by_ip = $value;
	}
}

//get name form the user if logged in
if (isset($_COOKIE['user'])) {
	$user_name = explode(' ', $_COOKIE['user']);
	$user_f_name = $user_f_name[0];
	$user_l_name = $user_name[1];
}

if (isset($_POST['submit'])) {
	if (verifyFormToken('form1')) {
		$confirm_message = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (is_valid_name($_POST['last_name']) == false || is_valid_name($_POST['last_name']) == false || is_valid_email($_POST['email']) == false || is_valid_comment($_POST['guest_message']) == false) {
				$confirm_message = 'Please fill out all the require fields';
			} else {
				if (empty($_POST['guest_title']) || empty($_POST['country'])) {
					$confirm_message = 'Please fill out all the require fields';
				} else {

					$body = send_guest_message(($_POST['first_name'] . ' ' . $_POST['last_name']), $_POST['email'], $_POST['country'], $_POST['subject'], $_POST['guest_message']);

					if (smtpmailer('soteris100@gmail.com',  $_POST['email'], 'New Message', $_POST['subject'], $body) == true) {
						$confirm_message = 'Message has send succesfully';
					} else {
						$confirm_message = "Fail - " . $mail->ErrorInfo;
					}
				}
			}
		}
	} else {

		$confirm_message = "Fail - " . $mail->ErrorInfo;
		writeLog('Formtoken');
	}
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact us - Vrissiana Beach Hotel Protaras, Cyprus</title>

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
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<link rel="stylesheet" href="/CSS/style.css">
	<link rel="stylesheet" href="/CSS/booking_style.css">
</head>

<body>
	<!-- navigation bar -->
	<?php navigation_bar(); ?>
	<!-- /BACKROUND IMAGE -->
	<section class="header">
		<div class="box-header" style="background-color: black">
			<img src="/images/VRIS27A - Front Sea View Room.jpg" alt="Rocks and the sea" class="back-img" style="opacity: 0.6">
		</div>
	</section>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Contact us</li>
		</ol>
	</nav>

	<!-- partial:index.partial.html -->
	<div class="fluid-container">
		<section class="overview">
			<div class="mx-auto text-center" style="width: 30%">
				<h3 class="text-center">Get in touch</h3>
				<h1>EMAIL US</h1>

			</div>
		</section>
		<div class="container-contact-form">
			<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" name="contact_form">
				<?php
				// generate a new token for the $_SESSION superglobal and put them in a hidden field
				$newToken = generateFormToken('form1');
				?>
				<input type="hidden" name="token" value="<?php echo $newToken; ?>">
				<div class="flex-box-form">
					<div class="col-4">
						<label for="guest_title"><span>&starf;</span> Title</label>
						<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
						<select name="guest_title" class="dropdown-select" required id="guest_title" aria-placeholder="Title">

							<option value="Mr">Mr</option>
							<option value="Ms">Ms</option>
							<option value="Sir">Sir</option>
							<option value="Madam">Sir</option>
							<option value="Dr">Dr</option>
							<option value="Master">Master</option>
							<option value="Don">Don</option>
							<?php
							//add all title
							echo $select_user_title; ?>
						</select>

					</div>
					<div class="col-4">
						<label for="first-name"><span>&starf;</span> First Name</label>
						<input type="text" class="form-control text-form-control" name="first_name" required placeholder="First name" value="<?php echo $user_f_name; ?>" id="first_name" pattern="^[A-Za-z]+$">

					</div>
					<div class="col-4">
						<label for="last-name"><span>&starf;</span> Last Name</label>

						<input type="text" class="form-control text-form-control" name="last_name" required placeholder="Last name" value="<?php echo $user_l_name; ?>" aria-describedby="basic-addon1" pattern="^[A-Za-z]+$">

					</div>

				</div>
				<div class="flex-box-form">

					<div class="col-6">
						<label for="first-name"><span>&starf;</span>Email</label>
						<input type="email" class="form-control text-form-control" name="email" placeholder="Email" value="<?php echo $user_email; ?>" required aria-describedby="emailHelp" pattern="[^@]+@[^\.]+\..+">

					</div>

					<div class="col-6">
						<label for="country"><span>&starf;</span> Country</label>
						<select name="country" class="dropdown-select" id="country" required>
							<?php
							//add all country
							asort($countries);
							foreach ($countries as $key => $value) {
								if ($country_name_by_ip == $value) {
									echo "<option selected>$value</option>";
								} else {
									echo "<option>$value</option>";
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="flex-box-form">
					<div class="col-12">
						<label for="subject"><span>&starf;</span> Subject</label>
						<select name="subject" class="dropdown-select" id="subject" required>
							<option value="">Select Subject</option>
							<option value="Reservation Enquiry">Reservation Enquiry</option>
							<option value="Wedding Enquiry">Wedding Enquiry</option>
							<option value="SPA Enquiry">SPA Enquiry</option>
							<option value="Conference Enquiry<">Conference Enquiry</option>
							<option value="Lost and Found Department">Lost and Found Department</option>
						</select>
					</div>
				</div>
				<div class="flex-box-form">
					<div class="col-12">
						<label for="guest_message"><span>&starf;</span> Message</label>
						<textarea class="form-control" name="guest_message" id="gust_message" cols="30" rows="10" maxlength="3000" minlength="15" required placeholder="Please enter your message (max length 15-3000)"></textarea>
					</div>
				</div>
				<!-- re-capture enable when have domain -->
				<!-- <div class="col-6">
					<div class="g-recaptcha" data-sitekey="6Ldbdg0TAAAAAI7KAf72Q6uagbWzWecTeBWmrCpJ"></div>
									</div> -->

				<div class="flex-box-form">
					<div class="col-12">
						<h2>Data Privacy & Mailing Permission</h2>
						<h5>I have read the privacy statement is in compliance with the Personal Data Protection Code and hereby agree that:</h5>

					</div>

					<div class="col-12">

						<label class="chk_container">I acknowledge that I have read and agree to the <a href="policy.php">Privacy Policy</a>
							<input type="checkbox" name="check_policy" required>
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="col-12">
						<button type="submit" name="submit" class="btn-nav btn-primary">SEND</button>
					</div>
				</div>


			</form>
			<div class="flex-box-form">
				<div class="col-12">
					<p><?php
						//display result on screen if the message has sended or not
						echo $confirm_message; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 20vh"></div>

	<!-- partial -->
	<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script src="./script.js"></script> -->
	<?php footer(); ?>

</body>

</html>