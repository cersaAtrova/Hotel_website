    <?php

    require_once 'functions.php';
    require_once 'insert_functions.php';
    require_once 'countries.php';
    session_start();

    function email_preview($id)
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
            $status = 'black';
        }
        foreach ($daily_rate as $pr) {

            $dt = date('d-M-Y', strtotime($pr['dr_date']));
            $str .= <<<pr
<tr>
    <td class="border-top" data-label="Date">{$dt}</td>
    <td class="border-top" data-label="Total"><i class="euro sign icon"></i>{$pr['dr_price']}</td>
</tr>

pr;
        }
        $send_email = <<<print
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        /*!
* Bootstrap v4.0.0 (https://getbootstrap.com)
* Copyright 2011-2018 The Bootstrap Authors
* Copyright 2011-2018 Twitter, Inc.
* Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
*/
        *,
        ::after,
        ::before {
            box-sizing: border-box
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent
        }

        @-ms-viewport {
            width: device-width
        }


        body {
            margin: 0;
            font-family: Roboto;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff
        }

        [tabindex="-1"]:focus {
            outline: 0 !important
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 1rem
        }

        ol ol,
        ol ul,
        ul ol,
        ul ul {
            margin-bottom: 0
        }

        img {
            vertical-align: middle;
            border-style: none
        }

        table {
            border-collapse: collapse
        }

        th {
            text-align: inherit
        }

        late {
            display: none
        }

        [hidden] {
            display: none !important
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit
        }

        .h1,
        h1 {
            font-size: 2.5rem
        }

        .h2,
        h2 {
            font-size: 2rem
        }

        .h3,
        h3 {
            font-size: 1.75rem
        }

        .h4,
        h4 {
            font-size: 1.5rem
        }

        .h5,
        h5 {
            font-size: 1.25rem
        }

        .h6,
        h6 {
            font-size: 1rem
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1)
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none
        }

        .list-inline {
            padding-left: 0;
            list-style: none
        }

        .list-inline-item {
            display: inline-block
        }

        .list-inline-item:not(:last-child) {
            margin-right: .5rem
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .no-gutters {
            margin-right: 0;
            margin-left: 0
        }

        .no-gutters>.col,
        .no-gutters>[class*=col-] {
            padding-right: 0;
            padding-left: 0
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9 {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px
        }

        .col {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%
        }

        .col-auto {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: none
        }

        .col-1 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%
        }

        .col-2 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .col-3 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%
        }

        .col-4 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%
        }

        .col-5 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-6 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%
        }

        .col-7 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%
        }

        .col-8 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%
        }

        .col-9 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%
        }

        .col-10 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%
        }

        .col-11 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%
        }

        .col-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .border {
            border: 1px solid #dee2e6 !important
        }

        .border-top {
            border-top: 1px solid #dee2e6 !important
        }

        .border-right {
            border-right: 1px solid #dee2e6 !important
        }

        .border-bottom {
            border-bottom: 1px solid #dee2e6 !important
        }

        .border-left {
            border-left: 1px solid #dee2e6 !important
        }

        .w-25 {
            width: 25% !important
        }

        .w-50 {
            width: 50% !important
        }

        .w-75 {
            width: 75% !important
        }

        .w-100 {
            width: 100% !important
        }
        .mt-0,
        .my-0 {
            margin-top: 0 !important
        }
        .mr-0,
        .mx-0 {
            margin-right: 0 !important
        }
        .mb-0,
        .my-0 {
            margin-bottom: 0 !important
        }
        .ml-0,
        .mx-0 {
            margin-left: 0 !important
        }
        .m-1 {
            margin: .25rem !important
        }
        .mt-1,
        .my-1 {
            margin-top: .25rem !important
        }
        .mr-1,
        .mx-1 {
            margin-right: .25rem !important
        }
        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important
        }
        .ml-1,
        .mx-1 {
            margin-left: .25rem !important
        }
        .m-2 {
            margin: .5rem !important
        }
        .mt-2,
        .my-2 {
            margin-top: .5rem !important
        }
        .mr-2,
        .mx-2 {
            margin-right: .5rem !important
        }
        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important
        }
        .ml-2,
        .mx-2 {
            margin-left: .5rem !important
        }
        .m-3 {
            margin: 1rem !important
        }
        .mt-3,
        .my-3 {
            margin-top: 1rem !important
        }
        .mr-3,
        .mx-3 {
            margin-right: 1rem !important
        }
        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important
        }
        .ml-3,
        .mx-3 {
            margin-left: 1rem !important
        }
        .m-4 {
            margin: 1.5rem !important
        }
        .mt-4,
        .my-4 {
            margin-top: 1.5rem !important
        }
        .mr-4,
        .mx-4 {
            margin-right: 1.5rem !important
        }
        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important
        }
        .ml-4,
        .mx-4 {
            margin-left: 1.5rem !important
        }
        .m-5 {
            margin: 3rem !important
        }
        .mt-5,
        .my-5 {
            margin-top: 3rem !important
        }
        .mr-5,
        .mx-5 {
            margin-right: 3rem !important
        }
        .mb-5,
        .my-5 {
            margin-bottom: 3rem !important
        }
        .ml-5,
        .mx-5 {
            margin-left: 3rem !important
        }
        .p-0 {
            padding: 0 !important
        }
        .p-2 {
            padding: .5rem !important
        }
        .m-auto {
            margin: auto !important
        }
        /*# sourceMappingURL=bootstrap.min.css.map */
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row m-auto w-100">
        <div class="col">
            <div class="container-fluid  mb-5">
                <P class="h3 mt-5">Accomodation Summary</P>
                <div class="container-fluid p-2 bg-white box_shadow">
                    <div class="row p-2">
                        <div class="col h3 border-right text-center">
                            <label> Reference</label>
                            <p class="mb-1">{$resv['resv_reference']}</p>
                        </div>
                        <div class="col h3 border-right text-center">
                        <label> Status</label>
                        <p style="color: {$status}" class="mb-1">{$resv['resv_status']}</p>

                    </div>
                    <div class="col h3 border-right text-center">
                        <label>Price</label>
                        <p><i class="euro icon"></i>{$resv_total[0]}</p>
                    </div>
                </div>
                <hr>
                <div class="row p-2">
                <div class="col border-right">
                    <label> Name</label>
                    <p class="mb-1"> {$resv_profile['resv_name']}</p>
                    <p class="w-50 border-bottom"></p>
                </div>
                <div class="col">
                    <label>Last Name</label>
                    <p class="mb-1">{$resv_profile['resv_last']}</p>
                    <p class="w-50 border-bottom"></p>
                </div>
            </div>
            <div class="row p-2">
            <div class="col border-right">
                <label>Email</label>
                <p class="mb-1"> {$member['member_email']}</p>
                <p class="w-50 border-bottom"></p>
            </div>
            <div class="col">
                <label>Telephone</label>
                <p class="mb-1">{$resv_profile['resv_tel']}</p>
                <p class="w-50 border-bottom"></p>
            </div>
        </div>
        <div class="row p-2">
        <div class="col border-right">
            <label>Country</label>
            <p class="mb-1"> {$resv_profile['resv_country']}</p>
            <p class="w-50 border-bottom"></p>
        </div>
        <div class="col"></div>
    </div>
    <hr>
    <div class="row p-2">
        <div class="col border-right">
            <label class="font-weight-bold"> Check in - Check out</label>
            <p class="mb-1 h4">

print;
        $send_email .= date('d-M-Y', strtotime($resv['resv_check_in'])) . ' - ' . date('d-M-Y', strtotime($resv['resv_check_out']));
        $send_email .= '</p><p class="w-50 border-bottom"></p></div><div class="col border-right"><label class="font-weight-bold"> Booked on</label><p class="mb-1">';
        $send_email .= date('d-M-Y H:i:s', strtotime($resv['resv_booked']));
        $send_email .= <<<print
</p>
<p class="w-50 border-bottom"></p>
</div>
</div>
<div class="row p-2">
<div class="col border-right">
<table class="ui celled table font-weight-bold p-3 ">
    <tr>
        <th class="border-0">Date</th>
        <th class="border-0">Price</th>
    </tr>
    {$str}

</table>
</div>
</div>
<hr>
<div class="row p-2">
    <div class="col border-right">
        <label> Room</label>
        <p class="mb-1">{$room['rm_name']}</p>
        <p class="w-50 border-bottom"></p>
    </div>
    <div class="col">
        <label>Guest</label>
        <p class="mb-1">
print;
        foreach ($resv_guest_capacity as $e) {
            $send_email .= "{$e[0]},  {$e[1]}<br/>";
        }

        $a = $i = $f = 1;
        $send_email .= '</p></div></div><div class="row p-2"><div class="col border-right"><label>Allergy</label><p class="mb-1">';
        foreach ($allergies as $e) {
            $send_email .= ++$a . " {$e['allergy_name']}<br/>";
        }
        $send_email .= '  <p class="w-50 border-bottom"></p></div><div class="col border-right"><label>Preferences</label><p class="mb-1"></p>';
        foreach ($preferences as $e) {
            $send_email .= ++$i . " {$e['pre_name']}<br/>";
        }
        $send_email .= '</p><p class="w-50 border-bottom"></p></div><div class="col border-right"><label>Facility</label><p class="mb-1">';
        foreach ($facilities as $e) {
            $send_email .= ++$f . " {$e['fa_name']}  <i class='euro icon'></i>{$e['fa_price']}<br/>";
        }
        $send_email .= '</p><p class="w-50 border-bottom"></p></div></div><hr><div class="row p-2"><div class="col"></div><div class="col"></div></div></div></div></body></html>';
        
        return $send_email;
    }

    ?>

        