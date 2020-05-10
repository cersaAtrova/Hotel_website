<?php
session_start();
require_once('functions.php');
require_once('insert_functions.php');
if (isset($_POST['update_passwd'])) {
  update_member_password($_SESSION['member']['member_id'], $_POST['new_passwd']);
  $_SESSION = array();
  session_destroy();
  header('Location: login.php');
  die();
}
if (isset($_POST['verify'])) {

  if ($_SESSION['veryfing'] == $_POST['verify_code']) {
    unset($_SESSION['veryfing']);
  } else {
    $error = 'Wrong Code';
  }
}
if (isset($_POST['submit_email'])) {

  $email = is_email_exist($_POST['email']);
  if ($email) {
    $_SESSION['member'] = get_member($_POST['email']);
    $code = rand(100000, 999999);
    $body = <<<print
        <!DOCTYPE html>
        <html>
        <head>
        
          <meta charset="utf-8">
          <meta http-equiv="x-ua-compatible" content="ie=edge">
          <title>Password Reset</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
          /**
           * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
           */
          @media screen {
            @font-face {
              font-family: 'Source Sans Pro';
              font-style: normal;
              font-weight: 400;
              src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
        
            @font-face {
              font-family: 'Source Sans Pro';
              font-style: normal;
              font-weight: 700;
              src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
          }
        
          /**
           * Avoid browser level font resizing.
           * 1. Windows Mobile
           * 2. iOS / OSX
           */
          body,
          table,
          td,
          a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
          }
        
          /**
           * Remove extra space added to tables and cells in Outlook.
           */
          table,
          td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
          }
        
          /**
           * Better fluid images in Internet Explorer.
           */
          img {
            -ms-interpolation-mode: bicubic;
          }
        
          /**
           * Remove blue links for iOS devices.
           */
          a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
          }
        
          /**
           * Fix centering issues in Android 4.4.
           */
          div[style*="margin: 16px 0;"] {
            margin: 0 !important;
          }
        
          body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
          }
        
          /**
           * Collapse table borders to avoid space between cells.
           */
          table {
            border-collapse: collapse !important;
          }
        
          a {
            color: #1a82e2;
          }
        
          img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
          }
          </style>
        
        </head>
        <body style="background-color: #e9ecef;">
          <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
            A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
          </div>
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <!-- start logo -->
                <tr>
                  <td align="center"  style=" background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg'); background-repeat: repeat;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                      <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                          <a href="#" target="_blank" style="display: inline-block;">
                            <img src="https://res.cloudinary.com/sotiris/image/upload/c_scale,w_400/v1586610212/Vrissiana/logo_v8xjho.png" alt="Logo" border="0" width="100" style="display: block; width: 200px; max-width: 300px; min-width: 48px;">
                          </a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <!-- end logo -->
                </table>
              </td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                      <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Reset Your Password</h1>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      <p style="margin: 0;">Re-write the code below to reset your customer account password. If you didn't request a new password, you can safely delete this email.</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                            <table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                  <a style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">{$code}</a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                    <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                      <p style="margin: 0;">You received this email because we received a request for resend password for your account. If you didn't request resend password you can safely delete this email.</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>
print;

    if (smtpmailer($_POST['email'], 'noreply.info.testing@gmail.com', '', 'Reset Password', $body)) {
      $_SESSION['veryfing'] = $code;
      writeLog('Reset for guest ' . $_REQUEST['email']);
    } else {
      writeLog('Fatal to send Mail Reset for guest ' . $_REQUEST['email']);
    }
  } else {
    $error = 'Wrong Code';
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
  <link rel="stylesheet" href="../CSS/booking_style.css">


</head>

<body>

  <div style="height: 10vh"></div>
  <?php if (!isset($_SESSION['member'])) : ?>
    <div class="container text-center">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <p class="display-4">Enter Your Email</p>
        <div class="container w-50">
          <input type="email" class="text-form-control p-2 mb-3" placeholder="Enter Your Email    " name="email" required>
          <input type="submit" name="submit_email" class="ui btn btn-nav btn-primary" value="Submit">
        </div>
      </form>
      <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?resend=true" class="m-3 ui link btn-link h5 ">Resend Code</a>
    </div>
  <?php elseif (!empty($_SESSION['veryfing'])) : ?>
    <div class="container text-center">
      <p class="h3">Please check your email for the Verification code</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <p class="display-4">Enter Your Verification Code</p>
        <div class="container w-50">
          <input type="text" class="text-form-control p-2 mb-3" placeholder="Enter Verification Code" name="verify_code" maxlength="6" minlength="6" required>
          <input type="submit" name="verify" id="reserved" class="ui btn btn-nav btn-primary" value="Submit">
        </div>
      </form>
      <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?resend=true" class="m-3 ui link btn-link h5 ">Resend Code</a>
    </div>
  <?php else : ?>
    <?php require_once('update_password.php'); ?>
  <?php endif; ?>

</body>

</html>