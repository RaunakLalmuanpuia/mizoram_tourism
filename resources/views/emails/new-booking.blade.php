<div class="">
  Dear Lodge,
  <br>
  <p>
    {{ $user->name }} has booked {{ $booking->number_of_room_require }} {{ $room->lodgeRoomTypes->name }} room{{ $booking->number_of_room_require == 1 ? '' : 's'}} in your lodge for {{ $booking->check_in }} to {{ $booking->check_out }}
    <br>
    Order ID is {{ $booking->order_id }}
    <br>
    Please login to https://mizoramtourism.com for more details.
  </p>
</div>