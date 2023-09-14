<div>
  <div class="container m-auto">
    <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4">
      <div class="col-span-7 mb-10">
        @livewire('lodge-gallery', ['lodgeGallery' => $lodge->images])
      </div>
      @if ($haveRooms)
        <div class="col-span-5">
          <div class="bg-booking-card border border-booking-card-500 p-10">
            <div class="font-kushan text-2xl mb-10">Lets start booking</div>
            <div class="border border-booking-card-500 p-4">
              <div class="font-bold">{{ $lodge->name }}</div>
              <div class="text-sm">{{ $selectedLodge['district_meta_data']['district_name'] }} District</div>
            </div>
            <div class="grid grid-cols-2">
              <div class="border border-booking-card-500 p-4">
                  <div class="text-whitish-gray">
                    CHECK IN
                  </div>
                  <div class="mt-1">
                    <input min="{{ date('Y-m-d') }}" wire:model="checkIn" type="date" class="w-full p-0 border-none hover:cursor-pointer font-extrabold text-gray-700 placeholder:text-gray-700 bg-transparent" placeholder="Select date">
                  </div>
                  <div class="text-sm text-whitish-gray">{{ $selectedInDay }}</div>
                </div>
              <div class="p-4 border border-booking-card-500">
                <div class="text-whitish-gray">
                  CHECK OUT
                </div>
                <div class="mt-1">
                  <input min="{{ date('Y-m-d', strtotime("+1 day", strtotime($checkIn))); }}" wire:model="checkOut" type="date" class="w-full p-0 border-none hover:cursor-pointer font-extrabold text-gray-700 placeholder:text-gray-700 bg-transparent" placeholder="Select date">
                </div>
                <div class="text-sm text-whitish-gray">{{ $selectedOutDay }}</div>
              </div>
            </div>
            <div class="grid grid-cols-2">
              <div class="p-4 border border-booking-card-500">
                <div class="">
                  ROOM TYPE
                </div>
                <button id="roomType" data-dropdown-toggle="roomTypes" class="focus:ring-4 focus:ring-blue-300 py-1 text-center inline-flex items-center focus:outline-none font-bold w-full" type="button">
                  <div class="flex flex-row justify-between w-full">
                    <div class="flex-col">
                      {{ $selectedRoomType['name'] }}
                    </div>
                    <div class="flex-col">
                      <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                  </div>
                </button>
                <!-- Dropdown menu -->
                <div id="roomTypes" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                  <ul class="py-1" aria-labelledby="roomType">
                    @foreach ($roomTypes as $roomType)
                      <li wire:click.prevent="selectRoomType({{ $roomType }})" class="hover:cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ $roomType['name'] }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="p-4 border border-booking-card-500">
                <div class="">
                  ROOM
                </div>
                <button {{ $noOfRooms <= 0 ? 'disabled' : '' }} id="noOfRoom" data-dropdown-toggle="noOfRooms" class="focus:ring-4 focus:ring-blue-300 py-1 text-center inline-flex items-center focus:outline-none font-bold w-full" type="button">
                  <div class="flex flex-row justify-between w-full">
                    <div class="flex-col">
                      {{ $noOfRooms }} {{$noOfRooms == 1 ? 'Room' : 'Rooms'}}
                    </div>
                    <div class="flex-col">
                      <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                  </div>
                </button>
                <div id="noOfRooms" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 max-h-40 overflow-y-scroll">
                  <ul class="py-1" aria-labelledby="noOfRoom">
                    @for ($i = 1; $i <= $noOfRoomsAvailable; $i++)
                      <li wire:click.prevent="selectNoOfRooms({{ $i }})" class="hover:cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ $i }}
                      </li>
                    @endfor
                  </ul>
                </div>
              </div>
            </div>
            <div class="grid grid-cols-2 mt-4">
              <div>
                <div class="">AMOUNT</div>
                <div class="text-xl font-bold">₹{{ $price }}</div>
              </div>
              <div>
                <button {{ $noOfRooms <= 0 ? 'disabled' : '' }} wire:click="proceedBooking" class="{{ $noOfRooms <= 0 ? 'bg-gray-500' : 'bg-colorx' }} text-white rounded-full pl-4 pr-4 p-2 float-right">Book Now</button>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-span-5">
          No rooms available.
        </div>
      @endif
    </div>
    <div class="border-b border-booking-card-500 w-full mb-4 h-2"></div>
    <div class="p-4 md:p-0">
      <div class="font-bold text-xl">{{ $lodge->name }}</div>
      <div class="text-sm">{{ $lodge->address }}</div>
      <div class="font-bold text-sm">{{ $lodge->phone }}</div>
      <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-11 gap-4 mb-4">
        <a href="tel:{{ $lodge->phone }}" class="text-center bg-colorx text-white rounded-lg p-2">Call</a>
        <a href="https://maps.google.com/?q={{ $lodge->latlng }}" target="_blank" class="border text-center border-colorx text-colorx p-2 rounded-lg">Get Direction</a>
      </div>
      <div class="mt-4 font-bold">Amenities</div>
      <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4">
        <div class="sm:col-span-7 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
          @foreach ($amenities as $amenity)
            <div class="flex flex-row content-center items-center">

              <div class="flex-col ml-2">
                {{ $amenity->name }}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="mt-10">
      <div class="font-bold text-lg">
         {{$haveRooms ? 'Select Room' : 'No Rooms Available'}}
      </div>
      @if ($haveRooms)
      <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4">
        <div class="sm:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
          @foreach ($lodgeRooms as $room)
          <div class="border border-booking-card-500">
            <div class="grid grid-cols-2">
              <div class="">
                @if (count($room->images) != 0)
                @foreach ($room->images as $image)
                <img class="object-cover h-40 w-52" src="/post_images/{{ $image->name }}" alt="room">
                @break
                @endforeach
                @else
                <img src="/image/tourism_cheraw.png" alt="..." class="object-cover h-40 w-52">
                @endif
              </div>
              <div class="p-4">
                <div class="font-bold text-lg">
                  {{ $room->lodgeRoomTypes->name }}
                </div>
                <div class="flex flex-row justify-between text-sm">
                  <div class="flex-col">Rs. {{ $room->price }}</div>
                  <div class="flex-col">{{ $room->room_available <= 0 ? 0 : $room->room_available }} available</div>
                </div>
                <div class="flex flex-row justify-between mt-4">
                  @foreach ($room->amenities as $amenity)
                    <div class="flex-col">
                      <div class="">
                        {{ $amenity->name}}
                      </div>
                      {{-- <img src="{{ $amenity->logo }}" alt="{{ $amenity->name }}" class="object-contain w-4 h-4"> --}}
                    </div>
                  @endforeach
                </div>
                <div class="flex flex-row mt-4">
                  @if (!($room->room_available <= 0))
                  <button wire:click="selectRoomType({{ $room->lodgeRoomTypes }})" class="border border-colorx {{ $selectedRoomType['id'] == $room->lodgeRoomTypes['id'] ? 'bg-colorx text-white' : 'text-black' }} hover:bg-colorx hover:text-white pl-4 pr-4 rounded-full">Select</button>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>
    <div class="mt-10 mb-10">
      <div class="font-bold text-lg">About the lodge</div>
      <div class="grid grid-cols-1 md:grid-cols-12 md:gap-4">
        <div class="sm:col-span-7 mt-4 text-sm">
          {{ $lodge->description }}
        </div>
      </div>
    </div>
  </div>
</div>
