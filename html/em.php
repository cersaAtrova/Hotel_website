<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            margin: 1px;
            padding: 1px;

        }
        td >p{
            border-right: 0.7px solid grey
        }
    </style>
</head>

<body>

    <div style="width: 100%">
        <div style="width:70%; margin:auto">
            <table align="center">
                <caption>Accomodation Summary</caption>
                <tr align="center">
                    <td>
                        <h2>Booking Reference<br />{$resv['resv_refence']}</h2>
                    </td>
                    <td>
                        <h2>Status<br />{$resv['resv_status']}</h2>
                    </td>
                    <td>
                        <h2>Price<br />{$total_price}</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Name<br />{$resv['guest_name']}</p>
                    </td>
                    <td></td>
                    <td>
                        <p>Surname<br />{$resv['guest_name']}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Email<br />{$resv['guest_name']}</p>
                    </td>
                    <td></td>
                    <td>
                        <p>Telephone<br />{$resv['guest_name']}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Country<br />{$resv['guest_name']}</p>
                    </td>
                    <td></td>
                    <td>
                        <p><Strong>Check In<br />{$resv['guest_name']}</Strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Room<br />{Room}</p>
                    </td>
                    <td></td>
                    <td>
                        <p>Guest</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Meal Plan<br />{Room}</p>
                    </td>
                    <td></td>
                    <td>
                        <p>Room Rate<br />{rate}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Allergy<br />{Room}</p>
                    </td>
                    <td>
                        <p>Preference</p>
                    </td>
                    <td>
                        <p>Facility<br />{rate}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>