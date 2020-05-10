<?php
session_start();

function guest_email($id)
{
  $resv = get_reservation_by_resv_id($id);
  $allergies = get_allergies($id);
  $preferences = get_preferences($id);
  $facilities = get_facilities($id);
  $daily_rate = get_reservation_daily_rate($id);

  $member = get_member_by_id($resv['member_id']);
  $resv_guest_capacity = get_total_guest($id);
  $resv_profile = get_reservation_guest_profile($id);

  $room = get_room_by_rm_type($resv['rm_type']);

  //get total price
  $resv_facility = get_reservation_facilities_price($id);
  $resv_total = get_reservation_price($id);
  if ($resv_facility[0] != null) {
    $resv_total[0] += $resv_facility[0];
  }
  if (isset($_SESSION['modification'])) {
    $status = 'yellow';
    $status_booking = 'Modification';
  } else {
    if ($resv['resv_status'] == 'Cancelled') {
      $status = 'red';
      $status_booking = 'Cancelation';
    } else {
      $status = 'white';
      $status_booking = 'Confirmation';
    }
  }
  foreach ($allergies as $e) {
    $ale .= " {$e['allergy_name']}<br/>";
  }
  foreach ($preferences as $e) {
    $pre .= " {$e['pre_name']}<br/>";
  }
  foreach ($facilities as $e) {
    $fa .= "{$e['fa_name']}  <i class='euro icon'></i>{$e['fa_price']}<br/>";
  }
  foreach ($resv_guest_capacity as $e) {
    $person .= "{$e[0]},  {$e[1]}<br/>";
  }
  $date = date('d-M-Y', strtotime($resv['resv_check_in'])) . ' - ' . date('d-M-Y', strtotime($resv['resv_check_out']));

  $email = <<<print

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Receipt</title>
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
  
    body,
    table,
    td,
    a {
      -ms-text-size-adjust: 100%; /* 1 */
      -webkit-text-size-adjust: 100%; /* 2 */
    }
  
  
    table,
    td {
      mso-table-rspace: 0pt;
      mso-table-lspace: 0pt;
    }
    img {
      -ms-interpolation-mode: bicubic;
    }
  
    a[x-apple-data-detectors] {
      font-family: inherit !important;
      font-size: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
      color: inherit !important;
      text-decoration: none !important;
    }
  
    div[style*="margin: 16px 0;"] {
      margin: 0 !important;
    }
  
    body {
      width: 100% !important;
      height: 100% !important;
      padding: 0 !important;
      margin: 0 !important;
      background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg');
      background-repeat: repeat;
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
  <body>
  
    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%"  >
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
      <!-- start hero -->
      <tr>
        <td align="center" style=" background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg'); background-repeat: repeat;" >
  
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Thank you for your Choosing our hotel for your reservation!</h1>
              </td>
            </tr>
          </table>
  
        </td>
      </tr>
      <!-- end hero -->
  
      <!-- start copy block -->
      <tr>
        <td align="center" style=" background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg'); background-repeat: repeat;" >
          
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
  
            <!-- start copy -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <p style="margin: 0;">Here is a summary of your $status_booking Booking. If you have any questions or concerns about your booking, please <a href="#">contact us</a>.</p>
              </td>
            </tr>
            <!-- end copy -->
    <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Reference <br/>{$resv['resv_reference']}</strong></td>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:{$status};"><strong>Status<br/>{$resv['resv_status']}</strong></td>
        <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Price<br/>{$resv_total[0]}</strong></td>
                  </tr>
                </table>
              </td>
            </tr>
        <!-- start receipt table -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a" width="75%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Room Information</strong></td>
                    <td align="left" bgcolor="##43437a" width="25%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>#</strong></td>
                  </tr>
                  <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Roon Type</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$room['rm_name']}</td>
                  </tr>
     <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Room Meal type</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv['resv_meal_level']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Room Plan</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv['resv_type']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Check in/Check out</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$date}</td>
                  </tr>
                  <tr>
                  <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Guest</td>
                  <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$person}</td>
                </tr>
                </table>
              </td>
            </tr>
            <!-- start receipt table -->
              <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a" width="75%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Guest Information</strong></td>
                    <td align="left" bgcolor="##43437a" width="25%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>#</strong></td>
                  </tr>
                  <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Name</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_name']}</td>
                  </tr>
     <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Surname</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_last']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Email</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$member['member_email']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Telephone</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_tel']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Country</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_country']}</td>
                  </tr>
  
                </table>
              </td>
            </tr>
   <!-- start receipt table -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Allergies</strong></td>
                    <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Preference</strong></td>
                    <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Extra Facilities</strong></td>
                  </tr>
                  <tr>
                    <td align="left"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$ale}</td>
                    <td align="center"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$pre}</td>
         <td align="center"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$fa}</td>
                  </tr>
                </table>
              </td>
            </tr>
   <!-- end copy block -->
          </table>
  
        </td>
      </tr>
      <!-- end copy block -->
  
      <!-- start receipt address block -->
      <tr>
        <td align="center" bgcolor="##43437a" style="padding: 24px;">
  
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
  
            <!-- start permission -->
            <tr>
              <td align="center" bgcolor="##43437a" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                <p style="margin: 0;">You received this email because we received a request for [type_of_action] for your account. If you didn't request [type_of_action] you can safely delete this email.</p>
              </td>
            </tr>
            <!-- end permission -->
  
            <!-- start unsubscribe -->
            <tr>
              <td align="center" bgcolor="##43437a" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                <p style="margin: 0;">To stop receiving these emails, you can <a href="https://sendgrid.com" target="_blank">unsubscribe</a> at any time.</p>
                <p style="margin: 0;">Paste 1234 S. Broadway St. City, State 12345</p>
              </td>
            </tr>
          </table>
  
        </td>
      </tr>
  
    </table>
  </body>
  </html>
  
print;
  return $email;
}


function admin_email($id)
{
  $resv = get_reservation_by_resv_id($id);
  $allergies = get_allergies($id);
  $preferences = get_preferences($id);
  $facilities = get_facilities($id);
  $daily_rate = get_reservation_daily_rate($id);

  $member = get_member_by_id($resv['member_id']);
  $resv_guest_capacity = get_total_guest($id);
  $resv_profile = get_reservation_guest_profile($id);

  $room = get_room_by_rm_type($resv['rm_type']);

  //get total price
  $resv_facility = get_reservation_facilities_price($id);
  $resv_total = get_reservation_price($id);
  if ($resv_facility[0] != null) {
    $resv_total[0] += $resv_facility[0];
  }
  if ($resv['resv_status'] == 'Cancelled') {
    $status = 'red';
  } else {
    $status = 'white';
  }

  foreach ($allergies as $e) {
    $ale .= " {$e['allergy_name']}<br/>";
  }
  foreach ($preferences as $e) {
    $pre .= " {$e['pre_name']}<br/>";
  }
  foreach ($facilities as $e) {
    $fa .= "{$e['fa_name']}  <i class='euro icon'></i>{$e['fa_price']}<br/>";
  }
  foreach ($resv_guest_capacity as $e) {
    $person .= "{$e[0]},  {$e[1]}<br/>";
  }
  foreach ($daily_rate as $pr) {

    $dt .= date('d-M-Y', strtotime($pr['dr_date'])) . '<br/>';
    $price .= $pr['dr_price'] . '<br/>';
  }
  $date = date('d-M-Y', strtotime($resv['resv_check_in'])) . ' - ' . date('d-M-Y', strtotime($resv['resv_check_out']));

  $email = <<<print

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Receipt</title>
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
  
    body,
    table,
    td,
    a {
      -ms-text-size-adjust: 100%; /* 1 */
      -webkit-text-size-adjust: 100%; /* 2 */
    }
  
  
    table,
    td {
      mso-table-rspace: 0pt;
      mso-table-lspace: 0pt;
    }
    img {
      -ms-interpolation-mode: bicubic;
    }
  
    a[x-apple-data-detectors] {
      font-family: inherit !important;
      font-size: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
      color: inherit !important;
      text-decoration: none !important;
    }
  
    div[style*="margin: 16px 0;"] {
      margin: 0 !important;
    }
  
    body {
      width: 100% !important;
      height: 100% !important;
      padding: 0 !important;
      margin: 0 !important;
      background-image: url('https://res.cloudinary.com/sotiris/image/upload/v1586610225/Vrissiana/water_vteo2m.jpg');
      background-repeat: repeat;
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
  <body>
  
    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%"  >
    <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#797169;"><strong>Reference <br/>{$resv['resv_reference']}</strong></td>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:{$status};"><strong>Status<br/>{$resv['resv_status']}</strong></td>
        <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#797169;"><strong>Price<br/>{$resv_total[0]}</strong></td>
                  </tr>
                </table>
              </td>
            </tr>
        <!-- start receipt table -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a" width="75%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Room Information</strong></td>
                    <td align="left" bgcolor="##43437a" width="25%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>#</strong></td>
                  </tr>
                  <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Roon Type</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$room['rm_name']}</td>
                  </tr>
     <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Room Meal type</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv['resv_meal_level']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Room Plan</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv['resv_type']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Check in/Check out</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$date}</td>
                  </tr>
                  <tr>
                  <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Guest</td>
                  <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$person}</td>
                </tr>
                </table>
              </td>
            </tr>
            <!-- start receipt table -->
              <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a" width="75%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Guest Information</strong></td>
                    <td align="left" bgcolor="##43437a" width="25%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>#</strong></td>
                  </tr>
                  <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Name</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_name']}</td>
                  </tr>
     <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Surname</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_last']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Email</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$member['member_email']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Telephone</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_tel']}</td>
                  </tr>
         <tr>
                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Country</td>
                    <td align="left" width="25%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$resv_profile['resv_country']}</td>
                  </tr>
  
                </table>
              </td>
            </tr>
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" width="30%" bgcolor="##43437a"   style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Date</strong></td>
                    <td align="right" width="30%" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Price</strong></td>
                    <td align="right" width="40%" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong></strong> </td>
                  </tr>
                  <tr>
                    <td align="left" width="30%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$dt}</td>
                    <td align="right" width="30%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$price}</td>
                    <td align="right" width="40%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>
                  </tr>
                </table>
              </td>
            </tr>
   <!-- start receipt table -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td align="left" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Allergies</strong></td>
                    <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Preference</strong></td>
                    <td align="center" bgcolor="##43437a"  style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color:#fff;"><strong>Extra Facilities</strong></td>
                  </tr>
                  <tr>
                    <td align="left"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$ale}</td>
                    <td align="center"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$pre}</td>
         <td align="center"  style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{$fa}</td>
                  </tr>
                </table>
              </td>
            </tr>
   <!-- end copy block -->
          </table>
  
        </td>
      </tr>
      <!-- end copy block -->
  
      <!-- start receipt address block -->
      <tr>
        <td align="center" bgcolor="##43437a" style="padding: 24px;">
  
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
  
            <!-- start permission -->
            <tr>
              <td align="center" bgcolor="##43437a" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                <p style="margin: 0;">You received this email because we received a request for [type_of_action] for your account. If you didn't request [type_of_action] you can safely delete this email.</p>
              </td>
            </tr>
            <!-- end permission -->
  
            <!-- start unsubscribe -->
            <tr>
              <td align="center" bgcolor="##43437a" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                <p style="margin: 0;">To stop receiving these emails, you can <a href="#" target="_blank">unsubscribe</a> at any time.</p>
                <p style="margin: 0;">Paste 1234 S. Broadway St. City, State 12345</p>
              </td>
            </tr>
          </table>
  
        </td>
      </tr>
  
    </table>
  </body>
  </html>
  
print;
  return $email;
}
