<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $data['order_id'] }}</title>
</head>
<style>
  .w-full{
    width: 100%;
  }

</style>
<body>
  <h3 style="text-align: center">MIZORAM TOURISM</h3>
  <table class="w-full">
    <tr>
      <td><b>TICKET - {{ $data['status'] }}</b></td>
      <td style="text-align: right">Booking Id: {{ $data['order_id'] }}</td>
    </tr>
  </table>
  <br>

  <table>
    <tr>
      <td>Lodge</td>
      <td>:</td>
      <td> <b> {{ $lodge['name'] }}, {{ $lodge['address'] }} </b></td>
    </tr>
    <tr>
      <td>Lodge Contact No. </td>
      <td>:</td>
      <td> <b> {{ $lodge['phone'] }} </b></td>
    </tr>
    <tr>
      <td>Room</td>
      <td>:</td>
      <td>{{ $lodgeRoomType['name'] }}</td>
    </tr>
    <tr>
      <td>No. of {{ $lodgeRoomType['name'] == 'Dormitory' ? 'Beds' : 'Rooms' }}</td>
      <td>:</td>
      <td>{{ $data['number_of_room_require'] }} ({{ $noOfNights }} {{ $noOfNights == 1 ? 'Night' : 'Nights'}})</td>
    </tr>
    <tr>
      <td>Check In</td>
      <td>:</td>
      <td>{{ date('d-m-Y', strtotime($data['check_in'])) }}</td>
    </tr>
    <tr>
      <td>Check Out</td>
      <td>:</td>
      <td>{{ date('d-m-Y', strtotime($data['check_out'])) }}</td>
    </tr>
  </table>
  <br>
  <hr>
  <br>
  <div style="margin-bottom: 4px; font-size: 20px">
    Guests
  </div>
  <table class="w-full" cellspacing=0 border="1">
    <tr style="background-color: rgb(161, 194, 212);">
      <td style="padding:10px;">Name</td>
      <td style="padding:10px;">Email</td>
      <td style="padding:10px;">Phone</td>
    </tr>
    @foreach ($guests as $guest)
        <tr>
          <td style="padding:10px;">{{ $guest->first_name }} {{ $guest->last_name }}</td>
          <td style="padding:10px;">{{ $guest->email }}</td>
          <td style="padding:10px;">{{ $guest->phone }}</td>
        </tr>
    @endforeach
  </table>
  <br>
  <hr>
  <br>
  <table class="w-full" cellspacing=0 border="1">
    <tr style="background-color: rgb(161, 194, 212);">
      <td style="padding:10px">Room Type</td>
      <td style="padding:10px">Rate</td>
      <td style="padding:10px">No. of Rooms</td>
      <td style="padding:10px">No. of Days</td>
    </tr>
    <tr>
      <td style="padding:10px">{{ $lodgeRoomType['name'] }}</td>
      <td style="padding:10px">{{ $lodgeRoom['price'] }}</td>
      <td style="padding:10px">{{ $data['number_of_room_require'] }}</td>
      <td style="padding:10px">{{ $noOfNights }}</td>
    </tr>
    <tr style="font-weight: 900">
      <td colspan="3" style="padding:10px; text-align:left">Total</td>
      <td style="padding:10px">{{ $data['number_of_room_require'] * $noOfNights * $lodgeRoom['price'] }}</td>
    </tr>
  </table>
  <br>
  <br>
  <div style="text-align:center;"><i>This bill is generated according to the bookings made on {{ date('d-m-Y',strtotime($data['created_at'])) }}</i></div>
  <div style="text-align: center">
    ************************************
  </div>
  <div style="text-align: center">
    <p>
      Click the following link to read more about our Refund Policy
    </p>
    <p>
      <u> https://www.mizoramtourism.com/information/refund-policy </u>
    </p>
  </div>
</body>
</html>
