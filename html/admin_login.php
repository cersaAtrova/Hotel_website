<?php
require_once '../connect_dbase.php';
session_start();
//========\\
//user login\\
//============\\
if (isset($_POST['submit'])) {
    $query = 'SELECT * 
              FROM Sysadmin
              WHERE sys_username=? AND sys_password=?';
    $log = $db->prepare($query);
    $log->bindValue(1, $_POST['username']);
    $log->bindValue(2, $_POST['passwd']);

    $log->execute();
    if ($log->rowCount() == 1) {
        header('Location: admin_page.php');
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://res.cloudinary.com/sotiris/image/upload/c_scale,w_50/v1587840916/Vrissiana/kb6QbnwXswcsbkcKtiCbwPXaln9XYAMhbOFW0dPaJm33Dt2A1qwwhMw8FZLmfO5q2so8Hfl5gy41VxgxbBnte0RCEVoKSEr8vr2wzgH4DCTyVNR4NkvcqOWClzW0_dko7d7.ico" type="image/x-icon" />

    <title>Vrissiana Beach Hotel | Account</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/booking_style.css">
</head>

<body>
    <div style="height: 20vh"></div>

    <div class="container-fluid">
        <div class="container text-center">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <p class="display-3">Admin Login</p>

                <div class="container w-50 pt-5 mt-5">
                    <input type="text" name="username" id="username" placeholder="Username" require_once class="text-form-control p-2 mb-3">
                    <input type="password" class="text-form-control p-2 mb-3" placeholder="Enter your password" name="passwd" id="passwd" require>
                    <input type="submit" name="submit" id="reserved" class="ui btn btn-nav btn-primary" value="Login">
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