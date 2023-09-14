<div>
    Hi, {{ $name }}
    <br>
    Your booking has been confirmed.
    <br>
    <b><i>Note: Full refund (charged only processing fee) will be made for cancellation of rooms up to 24 hours prior to scheduled check in date. For any cancellation within 24 hours of scheduled check-in, the complete booking amount shall be deducted as cancellation charges.</i></b>
    <br>
    Booking Detail:
    <table style="border: 1px solid;">
      <tr>
        <td colspan="3">{{ $booking->order_id }}</td>
      </tr>
      <tr>
        <td>Lodge Name</td>
        <td>:</td>
        <td>{{ $lodge->name }}</td>
      </tr>
      <tr>
        <td>Room</td>
        <td>:</td>
        <td>{{ $room->lodgeRoomTypes->name }}</td>
      </tr>
      <tr>
        <td>Date</td>
        <td>:</td>
        <td>{{ $booking->check_in }} to {{ $booking->check_out }}</td>
      </tr>
      <tr>
        <td>No. of Rooms</td>
        <td>:</td>
        <td>{{ $booking->number_of_room_require }}</td>
      </tr>
    </table>
    <br>
    For more information visit https://mizoramtourism.com/information/refund-policy
  </div>
