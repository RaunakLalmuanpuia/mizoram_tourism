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
      <th class="text-center border p-2">Order ID</th>
      <th class="text-center border p-2">Transaction Date</th>
      <th class="text-center border p-2">Refund Date</th>
      <th class="text-center border p-2">Check In Date</th>
      <th class="text-center border p-2">Amount</th>
      <th class="text-center border p-2">Payment Status</th>
      <th class="text-center border p-2">Booking Status</th>
    </tr>
    @foreach ($data as $item)
    <tr>
      <td class="text-center border p-2">{{ $item[0]->orderId }}</td>
        <td class="text-center border p-2">
          {{ date('d-m-Y', strtotime($item[0]->created_at)) }}
        </td>
        <td class="text-center border p-2">
          @if ($item[0]->status == 'REFUND_INITIATED')
          {{ date('d-m-Y', strtotime($item[0]->updated_at)) }}
          @endif
        </td>
        <td class="text-center border p-2">{{ $item[0]->userBooking->check_in }}</td>
        <td class="text-center border p-2">{{ $item[0]->amount }}</td>
        <td class="text-center border p-2">{{ $item[0]->status }}</td>
        @if ($item[0]->userBooking->status == 1)
          <td class="text-center border p-2">Unconfirmed</td>
        @else
          <td class="text-center border p-2">{{ $item[0]->userBooking->status }}{{ $item[0]->userBooking->status == 'Cancelled' ? ' at ' . $item[0]->userBooking->cancelled_at : '' }}</td>
        @endif
    </tr>
    @endforeach
  </table>
</body>
</html>
