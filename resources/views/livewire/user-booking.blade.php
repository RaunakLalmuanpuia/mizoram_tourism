<div class="mt-10">
  <div class="text-2xl font-extrabold font-kushan">My Bookings</div>
  <div class="grid grid-cols-1 gap-4 mt-4 mb-4 sm:grid-cols-2">
    {{-- @dd($bookings) --}}
    @foreach ($bookings["data"] as $booking)
    <div class="border border-gray-200">
      <div class="p-4 font-bold underline">
        <div class="w-full">
          <div class="flex flex-row content-center justify-between">
            <div class="flex-col">
              {{ $booking["order_id"]}}
            </div>
            <div class="flex-col">
              <a href="{{ Route('getReceipt', $booking["order_id"]) }}" class="px-2 py-1 text-white bg-green-600 hover:bg-green-500">Download Receipt</a>
              {{-- <a href="{{ Route('getReceipt', $booking->order_id) }}" class="px-2 py-1 text-white bg-green-600 hover:bg-green-500">Download Receipt</a> --}}
            </div>
          </div>
        </div>

      </div>
      <div class="grid grid-cols-2 gap-4 ml-10">
        <div class="">
          <div class="">
            <span class="font-bold">Booked On: </span><span>{{ date('d M Y', strtotime($booking["created_at"])) }}</span>
          </div>
          {{-- {{ $booking->lodgeRoomData->lodges->name }} --}}
          {{ $booking["lodge_room_data"]["lodges"]["name"] }}
          <br>
          {{ $booking["lodge_room_data"]["lodges"]["address"] }}, {{ $booking["lodge_room_data"]["lodges"]["phone"] }}
          <br>
          <span class="font-bold">Room Type: </span>{{ $booking["lodge_room_data"]["lodge_room_types"]["name"] }}
          <div class="">
            <span class="font-bold">No. of Rooms: </span><span>{{ $booking["number_of_room_require"] }}</span>
          </div>
        </div>
        <div class="">
          <div class="">
            <span class="font-bold">Check In: </span><span>{{ date('d M Y', strtotime($booking["check_in"])) }}</span>
          </div>
          <div class="">
            <span class="font-bold">Check Out: </span><span>{{ date('d M Y', strtotime($booking["check_out"])) }}</span>
          </div>
          <div class="">
            <span class="font-bold">Status: </span><span>{{ $booking["status"] }}</span>
          </div>
          <div class="">
            <span class="font-bold">No. of Guests: </span><span>{{ count($booking["guests"]) }}</span>
          </div>
          <div class="text-blue-600"><a href="https://maps.google.com/?q={{ $booking['lodge_room_data']['lodges']['latlng'] }}" target="_blank">Get Direction</a></div>
        </div>
      </div>
      <div class="p-2 mt-4 text-center bg-green-100 bg-opacity-20">
        @php
          $date = new DateTime();
          $cancellationPeriod = new DateTime($booking["check_in"]);
          $cancellationPeriod->modify('+12 hours');
        @endphp
        @if ($booking["status"] == 'Confirmed' && $date < $cancellationPeriod)
          {{-- <button wire:click="dialogCancel" class="p-2 pl-5 pr-5 text-white bg-red-600">Cancel</button> --}}
          <button wire:click="onCancelClicked({{ $booking['id'] }})" class="p-2 pl-5 pr-5 text-white bg-red-600">Cancel</button>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <x-jet-confirmation-modal wire:model="cancelBooking">
    <x-slot name="title">Confirmation</x-slot>
    <x-slot name="content">
      Are you sure you want to cancel this booking?
    </x-slot>
    <x-slot name="footer">
      <div class="flex flex-row justify-between">
        <div class="flex-col">
          <button wire:click="onCancelled" class="p-2 pl-4 pr-4 text-white bg-green-500 rounded-lg hover:bg-green-600">
            Yes
          </button>
        </div>
        <div class="flex-col ml-4">
          <button wire:click="dialogCancel" class="p-2 pl-4 pr-4 text-white bg-red-600 rounded-lg hover:bg-red-700">Cancel</button>
        </div>
      </div>
    </x-slot>
  </x-jet-confirmation-modal>
</div>

