<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title> receipt</title>

    <style>
        .center{
            text-align:center
        }
        table, th, td {
            border:1px solid;
        }
    </style>
</head>
<body>
<div style="text-align: center;"><h1>{{ $userBooking['lodgeRoomData']['lodges']['name'] ?? ''}}</h1></div>
<div style="text-align: center;"><h2>{{ $userBooking['lodgeRoomData']['lodges']['address'] ?? ''}}</h2></div>

<div style="text-align: center;"><h2>Bill</h2></div>


<div style="margin-top:30px;">Guest Name      : {{ $userBooking['users']['name']}}</div>
<div>Arrival Date    : {{ $userBooking['check_in']}}</div>
<div style="margin-bottom: 50px;">Checkout Date   : {{ $userBooking['check_out']}}</div>
 


<hr>
<div>Room Type       : {{ $userBooking['lodgeRoomData']['lodgeRoomTypes']['name'] ?? ''}}</div>
<div style="margin-bottom: 50px;">Room Price     : Rs. {{ $userBooking['lodgeRoomData']['price' ] ?? ''}}</div>



<hr>
<div style="margin-bottom: 50px;">Billing Instruction: </div>

<table>
    <tr>
        <td>Days</td>
 
        <td>Total</td>
    </tr>
    <tr>
        <td> {{ $userBooking['days']}}  </td>
 
        <td>Rs. {{ $userBooking['price']}}</td>
    </tr>

</table>
<hr>
<div>Lodge Name : {{ $userBooking['lodgeRoomData']['lodges']['name'] ?? ''}}</div>
<div>Address : {{ $userBooking['lodgeRoomData']['lodges']['address'] ?? ''}}</div>
<div>Phone : {{ $userBooking['lodgeRoomData']['lodges']['phone'] ?? ''}}</div>


</body>
</html>