<div class="relative">
  <form wire:submit.prevent="proceedBooking">
    <div class="p-10 bg-white shadow-lg sm:top-0">
      <div class="text-3xl font-kushan">
        Let's Start Booking
      </div>
      <div class="grid grid-cols-1 mt-4 sm:grid-cols-2 md:grid-cols-8">
        <div class="sm:border-t sm:border-l sm:border-r md:border-l md:border-t md:border-b border-[#D8D8D8] p-4 sm:col-span-2">
          <div class="text-whitish-gray">
            NAME OF LODGE
          </div>
          <div class="w-full" wire:ignore>
            <select class="form-control" id="select2-dropdown">
              <option disabled value="">Select Option</option>
              @foreach ($lodges as $lodge)
                <option {{ $lodge->id == $selectedLodgeId ? 'selected' : '' }}  value="{{ $lodge->id }}">
                  {{ $lodge->name }},
                  <span class="text-xl text-charcoal-black-500">{{ $lodge->districtMetaData->district_name }} District </span>
                </option>
              @endforeach
            </select>
          </div>
          <div class="text-sm text-whitish-gray">{{ $selectedLodge['district_meta_data']['district_name'] }} District </div>
        </div>
        <div class="sm:border-t sm:border-l sm:border-r md:border-l md:border-t md:border-b border-[#D8D8D8] p-4">
          <div class="text-whitish-gray">
            CHECK IN
          </div>
          <div class="mt-1">
            <input min="{{ date('Y-m-d') }}" wire:model="checkIn" type="date" class="w-full p-0 font-extrabold text-gray-700 border-none hover:cursor-pointer placeholder:text-gray-700" placeholder="Select date">
          </div>
          <div class="text-sm text-whitish-gray">{{ $selectedInDay }}</div>
        </div>
        <div class="sm:border-t sm:border-r md:border-l md:border-t md:border-b border-[#D8D8D8] p-4">
          <div class="text-whitish-gray">
            CHECK OUT
          </div>
          <div class="mt-1">
            <input min="{{ date('Y-m-d', strtotime("+1 day", strtotime($checkIn))); }}" wire:model="checkOut" type="date" class="w-full p-0 font-extrabold text-gray-700 border-none hover:cursor-pointer placeholder:text-gray-700" placeholder="Select date">
          </div>
          <div class="text-sm text-whitish-gray">{{ $selectedOutDay }}</div>
        </div>
        <div class="sm:border-t sm:border-l sm:border-r md:border-l md:border-t md:border-b border-[#D8D8D8] p-4 sm:col-span-2">
          <div class="text-whitish-gray">
            ROOM TYPE
          </div>
          <button id="roomType" data-dropdown-toggle="roomTypes" class="inline-flex items-center w-full py-1 font-bold text-center focus:ring-4 focus:ring-blue-300 focus:outline-none" type="button">
            <div class="flex flex-row justify-between w-full">
              <div class="flex-col">
                {{ $selectedRoomType['name'] }}
              </div>
              <div class="flex-col">
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
              </div>
            </div>
          </button>
          <!-- Dropdown menu -->
          <div id="roomTypes" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700">
            <ul class="py-1" aria-labelledby="roomType">
              @foreach ($roomTypes as $roomType)
                <li wire:click.prevent="selectRoomType({{ $roomType }})" class="block px-4 py-2 text-sm text-gray-700 hover:cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                  {{ $roomType['name'] }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="sm:border md:border-l md:border-t md:border-b border-[#D8D8D8] p-4">
          <div class="text-whitish-gray">
            {{ $roomType['name'] == 'Dormitory' ? 'BEDS' : 'ROOMS' }} REQUIRED
          </div>
          <button {{ $noOfRooms <= 0 ? 'disabled' : '' }} id="noOfRoom" data-dropdown-toggle="noOfRooms" class="inline-flex items-center w-full py-1 font-bold text-center focus:ring-4 focus:ring-blue-300 focus:outline-none" type="button">
            <div class="flex flex-row justify-between w-full">
              <div class="flex-col">
                {{ $noOfRooms }} {{$noOfRooms <= 1 ? ($roomType['name'] == 'Dormitory' ? 'Bed' : 'Room') : ($roomType['name'] == 'Dormitory' ? 'Beds' : 'Rooms') }}
              </div>
              <div class="flex-col">
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
              </div>
            </div>
          </button>
          <div id="noOfRooms" class="z-10 hidden overflow-y-scroll text-base list-none bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 max-h-40">
            @if ($noOfRoomsAvailable != 0)
            <ul class="py-1" aria-labelledby="noOfRoom">
              @for ($i = 1; $i <= $noOfRoomsAvailable; $i++)
                <li wire:click.prevent="selectNoOfRooms({{ $i }})" class="block px-4 py-2 text-sm text-gray-700 hover:cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                  {{ $i }}
                </li>
              @endfor
            </ul>
            @endif
          </div>
        </div>
        <div class="sm:border-t sm:border-b sm:border-r md:border border-[#D8D8D8] p-4">
          <div class="text-whitish-gray">
            AMOUNT
          </div>
          <div class="mt-1 font-extrabold">
            ₹{{ $price }}
          </div>
        </div>
      </div>
    </div>
    <div class="absolute flex items-center content-center w-full -bottom-5">
      <button {{ $noOfRoomsAvailable <= 0 ? 'disabled' : '' }} class="relative inline-flex {{ $noOfRoomsAvailable <= 0 ? 'bg-gray-500 border-gray-500 hover:text-gray-500' : 'bg-colorx border-colorx hover:text-colorx' }} items-center overflow-hidden text-white border-2 rounded-full group hover:bg-white p-2 pl-10 pr-10 mx-auto">
        @if (!($noOfRoomsAvailable <= 0))
        <span class="absolute left-0 block w-full h-0 transition-all bg-white opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
        <span class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </span>
        @endif
        <span class="relative">Book Now</span>
      </button>
    </div>
  </form>

  {{-- login for mobile users --}}
  <div>
    <x-jet-dialog-modal wire:model="signupDialog">
      <x-slot name="title">
        <div class="mb-4 text-xl font-bold text-black">
          @if ($mailSent)
            <button wire:click="goBack" class="font-bold text-colorx">
              <div class="flex flex-row">
                <div class="items-center m-auto text-sm">
                  &#10094;
                </div>
                <div>
                  &nbsp;Back
                </div>
              </div>
            </button>
          @else
            Login/Sign Up
          @endif
        </div>
      </x-slot>
      <x-slot name="content">
        <div class="p-10 border border-dashed">
          <div class="{{ $mailSent ? 'hidden' : '' }}">
            <div class="relative">
              @if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailPhone))
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                  <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                    <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAEd0lEQVR4nO3aW6gVVRzH8Y8XDNNumgqllBBWh0Aq7UImUQ8ZKlF006KoQCyIIgKhC/XQgw8RSL30UhF0sSKiGxVUBqWRZA+lhVCiJ7uYYZ6O2SnP2T2sPczax9nH2fvMnrY2Xxj2Zf5rzW/9Zmat/6w1VFRUVFRUVFRU/D8Z0+T/o3ElLsSMEeK6nRp+wXq8gT/zFFqCnfXCR9K2E4uHN3b4mb0GL2Fc/fde/JbHtS5mKo6rfx/EdXgtK3A6+gS3+nEHxpcgsNOMF9rSL7Ttd0zLCnxIerlcX5a6ErlB2r4HsgLW1XduKlFU2XwptPGj5I+x0c6T6p9bylRUMpvrnydn7fxecOcHnFeWohI5B71CG7dlBSQG1PAPVpUmrfPchH3S9h3SgGR7HpPL0dgRjsIaB7drRAM+x44oeDPOKEFs0czEZ9J2/Iwv5DDgWZyId6PCfwjDyOHCQvwk1b8Rp+AZOQ0gZImrhOwpqegpTOig8CJYgb9la27JgIRLhcsndvPUolUXwGSslercj9uHxbRlAOF+Wh9V/isuL0J1QczBV1J92zE/I65tAwg59eroIEP132ObxJfFUuyR6noHU5rEjsqAhOVCp5gc8ANhzqBsxuERaR+V54QUYgCcrvGS68UFOYUXwVS8Fx1/L67KUa4wAwidzouRiLKyx7M1Jm3f4MycZQs1IGEFBiJBncwebxamtZJjvYBJLZTviAEwr15pIuxbnNVGPc0YntK2e7V1zAA6lz3OxIao3l1CbtIOBxlQ5BC2W5hwSEj6iDXazx4vEyZo4g52QHhkL5zRXAFj8aTGGdjd0e8NmNVCfUkafiCq45Po+4/oaUNnR26BcXg6ErcNp2k/ezwGr0Tl9uPW+r5VGm+FuS1qLdyACXg1ErVFaHhCq9njHHwdxW8XOtiY+6L9e3B+C3oLNWAS3o/EbBQ6wiyWS6elk9grhH5iDGYLxsSzNm/hhCb13S2YmZiQNwkrzIDj8Wkk9mMce4gyPULSEs/MDGkc12tCavuwQ3fQK6VpcB8uzqG7EAOmS6eXa3gbE3McnLDm+JjGMx1vm7AgZ12EviHpKPuFUWMkRm3ALCHJSQSv1d4QNwXL8CgeF+7rdmeilwuJUU24mhaNEDsqA2bjO2njn9M9S2dL8Zega0DzB6O2DejRuGL8hO5bMl8sDJlJqnxjRkxbBszXmNSsLkZvR1gk7VQP4JZh+1s24BLpivEQ7i1Wb0dYKNU8iNuifS0ZsER6SR1w8ARjN7NAmCRJTtxd9f9zG7BMOrU8gGs7q7cjzBNe7khMuEdOA3qlCcY+Iw8r3c65UhNq0un9TAO2RoE14U2KPNlVtzNXeHCK27Y1K3BdFLBLcO9IoUfjUtmHWUEPRgF3liatPFZK23d/VsA0ac/ZJ/T63b4OmIcJQluStYw9oqfW4dnc1XhZ+ppcv3A7HM7MkM4cDwqvAr4+UoFF0ldJjqRth4wZqWb5/EThAeOiuoP/9fpfuwwJQ996vCkkdhUVFRUVFRUVFRX4F62wTU4fLviuAAAAAElFTkSuQmCC"/>
                  </button>
                </span>
              @elseif(preg_match("/^\d+$/", $emailPhone))
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                  <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                    <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABRklEQVRoge3Wr27CUBTH8e9pBobd8gaEVE6SLZlBTewt0JMgmuIIEhDYTfMm28TEMjtBUh5hoSmmpDCxULOapbe7ITkf1Vxxz/nl/isopZRSZ0xOH8dHji4b+St5+Ondc91IVRrANQ3gmgZwTQO4VrzEu93urF7iVqslABd1TJ4kGcvlB2maAWBMk+Gwh+83rdeyHiBJMsbjV8LwmjzPERE8zyOKXpjN+tZDWN9C0+kbg8EVm82WON4CEARtul2f1eqTyeTWRpn6tlCa7snzA3G8Zb3+KsY7nUvSdG+7XF23UNliSslYddZXwJgGIh5B0C7GgqCNiGBMw3Y5+2cgSTKi6JkwvOFwOCICIsJi8c583scYO4f4dAZqeQfKrtHRqGeteag5wH/4dQvdPd2766aCs/8X0gCuaQDXNIBrGkAppZRSFXwD27peeb0XT8IAAAAASUVORK5CYII="/>
                  </button>
                </span>
              @else
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                  <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                    <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAADVklEQVRoge2ZTUgVURTHfz7Nj0I0JcSigr7ITAzMMqJaVUK7FgVFLapVRYWbaFe0DloVEZSbICLTdpUFpRhuhApDigrCrBDzI7LS1GlxzjRm+Zy59466eD94HN579/zv/8zMnTtzL6RIEQtpMWqvADYCq4B8YBToAVqBJmAkxr6tSQcOAe2Al+TzBtjqsmOXZ6QYqAM26fePQAvQBXTqb0uBauQs/QCuAzeApw59WJEPvEKO9mtgF5MfpARwgb/P0E1gbvw2p6YWMdQG5IVonwDWAKeAbs29E5u7kCxBBu4voNwgfxnQixRT7dBXZI6qiToLjbMEl9iMUa8mDltolKjGWyeODGlVE1UWGunAT2AMw0GfsOjcp1Bjv4XGKDCE3OkyTQRcFOLP0J6lTobGMZNkF4V0ayyy0ChALqlB4KuJgItCPmlcaKGxUuM7UwEXhbzQaDKH+GzR2GIq4KKQNo0bLDS2aWw2FXBRiK9RSTBgo5BJcEYGHPgx5jFyxzqN2dN0GnBGNR469BWZDjVhM0bKVeOlqYCLS6tdY4WFRqVG40JccBA5mu+BGoP8Gs31gAMOfUUmHbiNzMgDRDvLCc3xn57Tnbsz4BliqDRCTpnmdNh27mKM+DzRuD9Czr4JubOCCuTo9gILQrQvAL5ozuYYfRnRgBh7TPB4/z9ygfvatnEafEVmEfCZqV+0VmubfmC5i45djhGQNayuCP324Oj11nUhEO4Nz38Jy3LVaRyFZGv8lqTNoEZnhbimCCnAAxYnaZeHTKBDyLrYrKIMeI4UcS9E+1sEk+H6GH2FphS4DAwTrP0Wh8grJFi1HwGuAeti8jgpGcBu4BFyiXjIkk4tsqAdllzgqub6C9rNwB5gjkO//5ANHCd4WvWQgXsFWGuhWwJcIhhfHvABOAnkWOj+QxqygdM1rqN24AQw32E/ecAxgrHmIfssR3CwlzMPuDtOuJXpWTXfjmwA+f02qBcjspD9Pg+Zhfc6MBiVAwSXXBOGS6oXVaAT2S6bKcrUg4fsdkViJbJ5M4rszs40VYiXYWTHODTnkSPwIAZTpjQins5N/CPZs9YOjfVxODLE32fcOfGPZLe0PqJNbtNJH/KG+YfJCskBvsdux44cZJcrRYoUIfgNHq3EbO8epBkAAAAASUVORK5CYII="/>
                  </button>
                </span>
              @endif
              <input maxlength="{{ $type == 'phone' ? '10' : '' }}" type="text" class="w-full pl-10 text-black border border-signup-border" placeholder="Email ID or Mobile Number" wire:model="emailPhone">
            </div>
            <button wire:click="createUser" class="p-4 pt-2 pb-2 mt-4 font-bold text-white rounded-full disabled:bg-signup-border disabled:text-whitish-gray bg-colorx" {{ preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailPhone) || preg_match("/^\d+$/", $emailPhone) ? '' : 'disabled' }}>
              <div wire:loading.remove wire:target="createUser">
                Continue
              </div>
              <div wire:loading wire:target="createUser">
                Processing...
              </div>
            </button>
          </div>
          <div class="{{ !$mailSent ? 'hidden' : '' }}">
            <div class="text-black">
              OTP Sent to {{ $type == 'email' ? '***'.substr($emailPhone, strpos($emailPhone, '@') - 3, strlen($emailPhone)) : substr($emailPhone, 0, 1).'*****'.substr($emailPhone, 6,10) }}
            </div>
            <div class="w-full">
              <div class="relative">
                <input wire:model="enteredOtp" type="text" class="w-full pr-24 text-black border border-signup-border" placeholder="Enter OTP" maxlength="4">
                <span class="absolute inset-y-0 flex items-center pl-2 right-2">
                  <button wire:click="createUser" type="submit" class="p-1 text-sm underline focus:outline-none focus:shadow-outline text-colorx">
                    <div wire:loading.remove wire:target="createUser">
                      Resend OTP
                    </div>
                    <div wire:loading wire:target="createUser">
                      Resending...
                    </div>
                  </button>
                </span>
              </div>
              @if ($invalid)
                <div class="text-red-900">
                  Invalid OTP
                </div>
              @endif
            </div>
            <button wire:click.prevent="verifyOtp" class="w-1/2 p-2 mt-4 font-bold text-white rounded-full bg-colorx">
              Verify & {{ !$existing ? 'Create account' : 'Login' }}
            </button>
          </div>
        </div>
      </x-slot>
    </x-jet-dialog-modal>

    @livewire('front.confirm-otp')
  </div>

</div>

@push('scripts')
<script>
	$(document).ready(function () {
    $('#select2-dropdown').select2();
    $('#select2-dropdown').on('change', function (e) {
      var data = $('#select2-dropdown').select2("val");
        @this.set('selectedLodgeId', data);
      });
    });
  </script>
@endpush

@push('styles')
  <style>
    .select2{
      width: 100% !important;
      border: none !important;
    }

    .select2-container {
      box-sizing: border-box;
      display: inline-block;
      margin: 0;
      position: relative;
      vertical-align: middle;
    }

    .select2-container .select2-selection--single {
      box-sizing: border-box;
      cursor: pointer;
      height: 28px;
      user-select: none;
      -webkit-user-select: none;
      display: contents;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
      padding-left: unset;
      font-weight: 800;
    }
  </style>
@endpush
