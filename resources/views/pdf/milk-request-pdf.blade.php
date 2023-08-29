<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<table
    style="width: 100%"
>
    <tr>
        <td>
            <h2>BABY PASSPORT</h2>
        </td>
        <td>
            <p>Date:  <span style="font-weight: bold">{{ $created_at }}</span></p>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <div style="height: 50px">

            </div>
        </td>
    </tr>

    <tr>
        <td>
            <h1 style="font-weight: normal">Information</h1>
            <hr>
        </td>
        <td>
            <h1 style="font-weight: normal">Requester</h1>
            <hr>
        </td>
    </tr>

    <tr>
        <td style="width: 50%">
            <p>Reference Number: {{ $ref_number }}</p>
            <p>Mother Name: {{ $mother_name }}</p>
            <p>Baby Name: {{ $baby_name }}</p>
            <p>Contact Number: {{ $phone_number }}</p>
            <p>Address: {{ implode(', ', $address) }}</p>
        </td>
        <td style="width: 50%; vertical-align: top">
            <p>Email: {{ $requester['email'] }}</p>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <div style="height: 50px">

            </div>
        </td>
    </tr>

    <tr>
        <td>
            <span style="font-weight: bold">Description</span>
            <hr>
        </td>
        <td>
            <span style="font-weight: bold">Quantity</span>
            <hr>
        </td>
    </tr>

    <tr>
        <td>Milk Bags</td>
        <td style="font-weight: bold">{{ $quantity }}</td>
    </tr>
</table>
</body>

</html>
