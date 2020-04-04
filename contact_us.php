<?php
require_once 'functions.php';
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
	<link rel="stylesheet" href="/CSS/contat_style.css">
</head>

<body>
	<!-- navigation bar -->
	<?php navigation_bar(); ?>
	<!-- /BACKROUND IMAGE -->
	<section class="header">
		<div class="box-header" style="background-color: black">
			<img src="images/VRIS27A - Front Sea View Room.jpg" alt="Rocks and the sea" class="back-img" style="opacity: 0.6">
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
			<form action="#" method="post">
				<div class="flex-box-form">
					<div class="col-2">
						<label for="guest_title"><span>&starf;</span> Title</label>
						<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
						<select name="guest_title" class="dropdown-select" required id="guest_title">
							<option default value="">Select Title</option>
							<option value="">Mr.</option>
							<option value="">Ms.</option>
						</select>
					</div>
					<div class="col-5">
						<label for="first-name"><span>&starf;</span> Firt Name</label>
						<input type="text" class="form-control text-form-control" required placeholder="First name" name="first_name" id="first_name" pattern="^[A-Za-z]+$">

					</div>
					<div class="col-5">
						<label for="last-name"><span>&starf;</span> Last Name</label>

						<input type="text" class="form-control text-form-control" required placeholder="Last name" aria-describedby="basic-addon1" pattern="^[A-Za-z]+$">

					</div>

				</div>
				<div class="flex-box-form">

					<div class="col-6">
						<label for="first-name"><span>&starf;</span>Email</label>
						<input type="email" class="form-control text-form-control" placeholder="Email" required aria-describedby="emailHelp" pattern="[^@]+@[^\.]+\..+">

					</div>

					<div class="col-6">
						<label for="country"><span>&starf;</span> Country</label>
						<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
						<select name="country" class="dropdown-select" id="country" required>
							<option default value="">Select Country</option>
							<option value="">cy</option>
							<option value="">gr</option>
						</select>
					</div>
				</div>
				<div class="flex-box-form">

					<div class="col-12">
						<label for="subject"><span>&starf;</span> Subject</label>
						<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
						<select name="subject" class="dropdown-select" id="subject" required>
							<option default value="">Select Subject</option>
							<option value="">Reservation Enquiry</option>
							<option value="">Wedding Enquiry</option>
							<option value="">SPA Enquiry</option>
							<option value="">Conference Enquiry</option>
							<option value="">Lost and Found Department</option>
						</select>
					</div>
				</div>
				<div class="flex-box-form">
					<div class="col-12">
						<label for="gust_message"><span>&starf;</span> Message</label>
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
							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="col-12">
						<button type="submit" class="btn-nav btn-primary">SEND</button>
					</div>
				</div>



			</form>
		</div>
	</div>
	<div style="height: 20vh"></div>
	<!-- partial -->
	<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script src="./script.js"></script> -->
	<?php footer(); ?>	

</body>

</html>