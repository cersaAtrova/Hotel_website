<?php
require_once 'functions.php';
require_once 'insert_functions.php';
session_start();


//============\\
// Admin Login\\
//============\\
if (isset($_POST['submit'])) {
if($_POST['email']=='vrissiana@admin.account'){
    header("Location: admin_login.php");
    die();
}
}
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


    if (password_verify($_POST['passwd'], $_SESSION['user']['member_password'])) {
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
   

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <script src="../script/script.js"></script>

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">
</head>

<body>
    <div style="height: 25vh"></div>
    <?php
    navigation_bar();
    ?>
    <div class="container-fluid">
        <div class="container  text-center">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p class="display-4 "> Account Information</p>
                <p class="h4">Login here using your email address to get access to your existing reservations or to update your account.</p>

                <div class="container login-width pt-5 mt-5">
                    <input type="email" name="email" id="email" placeholder="Email.." required value="<?php echo $user_email ?>" require_once class="text-form-control p-2 mb-3" pattern="[^@]+@[^\.]+\..+">
                    <?php if ($email_accepted == true) {
                        echo '<input type="password" class="text-form-control p-2 mb-3" placeholder="Enter your password" name="passwd" id="passwd" require> ';
                    }
                    ?>
                    <input type="submit" name="<?php echo $submit ?>" id="reserved" class="ui btn btn-nav btn-primary" value="<?php echo $btn_login ?>">
                    <p class="text-danger"><?php echo $error_email ?></p>
                    <?php if ($reset_passwd == true) {
                        echo '<a href="forgot_passwd.php" class="ui btn btn-link btn-primary">Forgot Password?</a>';
                    } ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>