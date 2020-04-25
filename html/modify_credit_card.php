<?php
require_once 'functions.php';
require_once 'insert_functions.php';
if (isset($_POST['submit'])) {
    if (luhn_check($_POST['card_number'])== false) {
        //check the card if is valid
        $error_card_selected = 'Please enter a valid credit card';
    } else {
        //check the expired day if is valid
        $expires = DateTime::createFromFormat('my', $_POST['month_expired'] . $_POST['year_expired']);
        $now = new DateTime();
        if ($expires < $now) {
            $error_card_selected = 'Please enter a valid expired day';
        } else {
            $owner = explode(' ', $_POST['owner']);
            if (is_valid_name($owner[0]) == false || is_valid_name($owner[1]) == false) {
                $error_card_selected = 'Please enter a valid Name and Surname for credit card';
            } else {

                if (update_credit_card($_POST['id'], $_POST['owner'], $_POST['card_number'], $_POST['moth_expired'], $_POST['year_expired'], $_POST['cvv'])) {
                    header('Location: user_account.php');
                    die();
                } else {
                    $error_card_selected = 'Something went wrong. Please try again';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Vrissiana Beach Hotel | Reservation Result</title>
    <!-- Bootstrap -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script> -->

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

    <script src="../script/script.js"></script>

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">
    <link rel="stylesheet" href="../CSS/validate_card.css">

</head>

<body>
    <div class="container">
        <form action="modify_credit_card.php" method="post">
            <div class="creditCardForm">
                <div class="heading text-center">
                    <h1>Update credit card</h1>
                    <h3 class="error text-danger"><?php echo $error_card_selected ?></h3>
                </div>
                <div class="payment">
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" name="owner" id="owner" required title="Please enter the card owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv" required id="cvv" title="Please enter the cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" name="card_number" required class="form-control" id="cardNumber" title="Please enter the card number">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select required name="moth_expired" class="moth_expired">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $begin = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $moth .= "<option value='{$begin}'>{$begin}</option>";
                            }
                            echo $moth;
                            ?>
                        </select>
                        <select name="year_expired" class="year_expired mt-3" required>
                            <?php
                            $begin = date('Y');
                            for ($i = 1; $i < 8; $i++) {
                                $year .= "<option value='{$begin}'>{$begin}</option>";
                                $repeat = strtotime("+{$i} Year", strtotime($begin));
                                $begin = date('Y', $repeat);
                            }
                            echo $year;
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="../images/visa.jpg" id="visa">
                        <img src="../images/mastercard.jpg" id="mastercard">
                        <img src="../images/amex.jpg" id="amex">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
                    <input type="submit" name="submit" id="reserved" class="ui button btn btn-nav btn-primary" value="UPDATE">
                </div>
                <div class="text-center">
                    <a href="user_account.php" class="h4">Go back to account</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
    </div>
    <script>
        $(function() {
            var valid_card = false;
            var valid_ccv = false;
            var owner = $('#owner');
            var cardNumber = $('#cardNumber');
            var cardNumberField = $('#card-number-field');
            var CVV = $("#cvv");
            var mastercard = $("#mastercard");
            var visa = $("#visa");
            var amex = $("#amex");

            // Use the payform library to format and validate
            // the payment fields.
            cardNumber.payform('formatCardNumber');
            CVV.payform('formatCardCVC');


            cardNumber.keyup(function() {

                amex.removeClass('transparent');
                visa.removeClass('transparent');
                mastercard.removeClass('transparent');

                if ($.payform.validateCardNumber(cardNumber.val()) == false) {
                    cardNumberField.addClass('has-error');
                } else {
                    cardNumberField.removeClass('has-error');
                    cardNumberField.addClass('has-success');
                }
                if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
                    mastercard.addClass('transparent');
                    amex.addClass('transparent');
                } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
                    mastercard.addClass('transparent');
                    visa.addClass('transparent');
                } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
                    amex.addClass('transparent');
                    visa.addClass('transparent');
                }
            });
            $('#cardNumber').change(function() {
                var isCardValid = $.payform.validateCardNumber(cardNumber.val());
                if (!isCardValid) {
                    $('#cardNumber').addClass('border-danger');
                    valid_card = false;
                } else {
                    $('#cardNumber').removeClass('border-danger');
                    valid_card = true;
                }
            });
            $('#cvv').change(function() {
                var isCvvValid = $.payform.validateCardCVC(CVV.val());
                if (!isCvvValid) {
                    $('#cvv').addClass('border-danger');
                    valid_ccv = false;
                } else {
                    $('#cvv').removeClass('border-danger');
                    valid_ccv = true;
                }
            });
            $('#reserved').click(function(e) {
                if (valid_ccv != true) {
                    $('#cvv').addClass('border-danger');
                    $('.error').text('Please enter correct details');
                    return false;
                }
                if (valid_card != true) {
                    $('#cardNumber').addClass('border-danger');
                    $('.error').text('Please enter correct details');
                    return false;
                }
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../script/jquery.payform.min.js"></script>

    <div style=" height: 10vh"></div>
</body>

</html>