<?php
require_once 'functions.php';
require_once 'insert_functions.php';
session_start();

//========\\
//user login\\
//============\\
$submit = 'submit';
$btn_login = 'Check your email';
$error_email = '';
if (isset($_POST['submit'])) {
    $user_email = $_POST['email'];
    $_SESSION['user'] = get_member($user_email);
    if ($_SESSION['user'] == null) {
        $error_email = 'Email is not valid';
        $email_accepted = false;
    } else {
        $email_accepted = true;
        $btn_login = 'Login';
        $submit = 'login';
    }
} elseif (isset($_POST['login'])) {

    $email_accepted = true;
    $user_email = $_POST['email'];
    $btn_login = 'Login';
    $submit = 'login';

    // (password_verify($_POST['passwd'], $member['member_password']));

    if ($_POST['passwd'] == $_SESSION['user']['member_password']) {
        $_SESSION['user_login'] = $_SESSION['user'];
        $_SESSION['user_passwd'] = $_POST['passwd'];

        $cookie_name = "name";
        $cookie_value = $_SESSION['user_login']['member_name'];
        setcookie($cookie_name, $cookie_value, time() + (86400) * 60 * 12, "/"); //valid for one year
    
        $cookie_name = "surname";
        $cookie_value = $_SESSION['user_login']['member_last'];
        setcookie($cookie_name, $cookie_value, time() + (86400) * 60 * 12, "/"); //valid for one year

        $cookie_name = "email";
        $cookie_value = $_SESSION['user_login']['member_email'];
        setcookie($cookie_name, $cookie_value, time() + (86400) * 60 * 12, "/"); //valid for one year

        $cookie_name = "country";
        $cookie_value = $_SESSION['user_login']['member_country'];;
        setcookie($cookie_name, $cookie_value, time() + (86400) * 60 * 12, "/"); //valid for one year

        $cookie_name = "tel";
        $cookie_value = $_SESSION['user_login']['member_tel'];
        setcookie($cookie_name, $cookie_value, time() + (86400) * 60 * 12, "/"); //valid for one year
        unset($_SESSION['user']);
        header("Location: user_account.php");
        die();
    } else {
        $error_email = 'Invalid password';
        $reset_passwd = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/v1586712186/Vrissiana/vrissiana_lwdd9y.ico" type="image/x-icon" />

    <title>Vrissiana Beach Hotel | Account</title>
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
    <link rel="stylesheet" href="../CSS/validate_card.css">

    <script src="../script/script.js"></script>

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">
</head>

<body>
    <div style="height: 20vh"></div>
    <?php
    navigation_bar();
    ?>
    <div class="container-fluid">
        <div class="container text-center">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p class="display-3"> Account Information</p>
                <p class="h3">Login here using your email address to get access to your existing reservations or to update your account.</p>

                <div class="container w-50 pt-5 mt-5">
                    <input type="email" name="email" id="email" placeholder="Email.." value="<?php echo $user_email ?>" require_once class="text-form-control p-2 mb-3" pattern="[^@]+@[^\.]+\..+">
                    <?php if ($email_accepted == true) {
                        echo '<input type="password" class="text-form-control p-2 mb-3" placeholder="Enter your password" name="passwd" id="passwd" require> ';
                    }
                    ?>
                    <input type="submit" name="<?php echo $submit ?>" id="reserved" class="ui btn btn-nav btn-primary" value="<?php echo $btn_login ?>">
                    <p class="text-danger"><?php echo $error_email ?></p>
                    <?php if ($reset_passwd == true) {
                        echo '<a href="#" class="ui btn btn-link btn-primary">Forgot Password?</a>';
                    } ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>