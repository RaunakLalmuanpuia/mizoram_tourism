<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Lodge Statement</title>
</head>
<body>
  <table>
    <tr>
      <th class="text-center border p-2">Booking ID</th>
      <th class="text-center border p-2">Name</th>
      <th class="text-center border p-2">Contact</th>
      <th class="text-center border p-2">Email</th>
      <th class="text-center border p-2">Lodge/Room</th>
      <th class="text-center border p-2">No. of Rooms</th>
      <th class="text-center border p-2">Check In</th>
      <th class="text-center border p-2">Check Out</th>
      <th class="text-center border p-2">Amount</th>
      <th class="text-center border p-2">Cancelled At</th>
    </tr>
    @foreach ($data as $item)
    <tr>
      <td class="text-center border p-2">{{ $item->order_id }}</td>
      <td class="text-center border p-2">{{ $item->users->name }}</td>
      <td class="text-center border p-2">{{ $item->users->phone }}</td>
      <td class="text-center border p-2">{{ $item->users->email }}</td>
      <td class="text-center border p-2">{{ $item->lodgeRoomData->lodges->name }} / {{ $item->lodgeRoomData->lodgeRoomTypes->name }}</td>
      <td class="text-center border p-2">{{ $item->number_of_room_require }}</td>
      <td class="text-center border p-2">{{ date('d-m-Y', strtotime($item->check_in)) }}</td>
      <td class="text-center border p-2">{{ date('d-m-Y', strtotime($item->check_out)) }}</td>
      <td class="text-center border p-2">
        @if ($item->payment != null)
          {{ $item->payment->amount }}
          @php
              $total += $item->payment->amount;
          @endphp
        @endif
      </td>
      <td class="text-center border p-2">{{ date('d-m-Y H:i a', strtotime($item->cancelled_at)) }}</td>
    </tr>
    @endforeach
    <tr>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2"></th>
      <th class="text-center border p-2">Total</th>
      <th class="text-center border p-2">{{ $total  }}</th>
      <th class="text-center border p-2"></th>
    </tr>
  </table>
</body>
</html>
