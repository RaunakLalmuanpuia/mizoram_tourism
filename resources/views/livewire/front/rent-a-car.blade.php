<div>
  <div class="mt-10 mb-10">
    <div class="text-4xl text-center font-kushan">List of Car Rentals</div>
    <div class="text-sm text-center">{{ count($operators) }} Rental{{ count($operators) == 1 ? '' : 's' }}</div>
  </div>
  <div class="text-right">
    <button  data-bs-toggle="modal" data-bs-target="#exampleModalXl" class="p-2 text-xs border rounded-lg outline-none border-district-outline">Hiring Rates</button>
  </div>
  <div class="m-4">
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 md:grid-cols-12">
      @foreach ($districts as $district)
      <div wire:click="getData({{ $district->id }})" class="{{ $this->districtsId == $district->id ? 'border-colorx' : 'border-district-outline' }} border pl-4 pr-4 p-2 rounded-lg text-center hover:cursor-pointer hover:shadow-lg font-bold hover:scale-105 transition duration-300 ease-in-out">
        {{ $district->district_name }}
      </div>
      @endforeach
    </div>
  </div>
  <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 md:grid-cols-3">
    @if (count($operators) == 0)
      <div class="text-xs italic">
        No operators found
      </div>  
    @endif
    @foreach ($operators as $operator)
    <div class="flex flex-row p-2 pt-4 transition duration-300 ease-in-out border border-card-border hover:shadow-xl hover:cursor-pointer hover:scale-105">
      <div class="flex-col p-2"><img src="/image/rent-a-car.png" alt="guide" class="w-10 h-10"></div>
      <div class="flex-col">
        <div class="text-xl font-bold">{{ $operator->name }}</div>
        <div class="mt-4">
          <ul>
            <li class="location" data-address="{{ $operator->address }}" data-agent-name="{{ $operator->name }}" data-district = "{{$operator->districtMetaData->district_name}}">
              {{ $operator->address }}
           </li>
            {{-- <li class="location">{{ $operator->address }}</li> --}}
            @if (!is_null( $operator->phone_one))
            <li class="phone">
              <!-- Add a unique ID to the phone number element -->
              <span id="phone-one-{{ $operator->id }}" class="click-to-copy">{{ $operator->phone_one }}</span>
            </li>
           @endif
           
            {{-- <li class="phone">{{ $operator->phone_one }}</li> --}}
            @if (!is_null( $operator->email))
            <li class="mail">{{ $operator->email }}</li>
            @endif
            
          </ul>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="w-full mt-10">
    {{ $operators->links() }}
  </div>
  <div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black outline-none modal fade bg-opacity-60" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-modal="true" role="dialog">
    <div class="relative w-auto pointer-events-none modal-dialog modal-xl">
      <div class="relative flex flex-col w-8/12 mx-auto mt-32 text-current bg-white border-none rounded-md shadow-lg outline-none pointer-events-auto modal-content bg-clip-padding">
        <div class="flex items-end justify-end flex-shrink-0 p-4 text-right modal-header rounded-t-md">
          <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 512 512" style=" fill:#ffffff;"><path fill="#E04F5F" d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z"></path><path fill="#FFF" d="M285,256l72.5-84.2c7.9-9.2,6.9-23-2.3-31c-9.2-7.9-23-6.9-30.9,2.3L256,222.4l-68.2-79.2c-7.9-9.2-21.8-10.2-31-2.3c-9.2,7.9-10.2,21.8-2.3,31L227,256l-72.5,84.2c-7.9,9.2-6.9,23,2.3,31c4.1,3.6,9.2,5.3,14.3,5.3c6.2,0,12.3-2.6,16.6-7.6l68.2-79.2l68.2,79.2c4.3,5,10.5,7.6,16.6,7.6c5.1,0,10.2-1.7,14.3-5.3c9.2-7.9,10.2-21.8,2.3-31L285,256z"></path></svg>
          </button>
        </div>
        <div class="relative modal-body">
          <div class="text-4xl text-center font-kushan">Hiring Rate</div>
          <div class="p-20 pt-0 m-auto mt-4 text-center">
            <table class="w-full">
              <tr>
                <td class="p-4 border-b border-r border-gray-300"></td>
                @foreach ($hiringRates as $rates)
                <td class="p-4 border-b border-r border-gray-300">
                  <div class="flex flex-row">
                    <div class="flex-col">
                      <img src="" alt="">
                    </div>
                    <div class="flex-col">
                      {{ $rates->type }}
                    </div>
                  </div>
                </td>
                @endforeach
              </tr>
              @foreach ($hiringRates as $rates)
              <tr>
                <td class="p-4 text-left border-b border-r border-gray-300">{{ $columnNames[$loop->index] }}</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ {{ $rates->minimum_charge }}</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ {{ $rates->rate_per_km }}</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ {{ $rates->rate_per_hour }}</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ {{ $rates->halt }}</td>
              </tr>
              @endforeach
              {{-- <tr>
                <td class="p-4 text-left border-b border-r border-gray-300">Rate per km</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 25</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 30</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 35</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 45</td>
              </tr>
              <tr>
                <td class="p-4 text-left border-b border-r border-gray-300">Rate per hour/on duty waiting charge</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 300</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 350</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 400</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 700</td>
              </tr>
              <tr>
                <td class="p-4 text-left border-b border-r border-gray-300">Rate per hour/on duty waiting charge</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 1000</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 1200</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 1800</td>
                <td class="p-4 font-bold border-b border-r border-gray-300">₹ 1800</td>
              </tr> --}}
            </table>
            <div class="p-4 mt-10 text-xs text-left bg-pale-yellow text-light-gray">
              Note:
              <ol>
                <li>1. ON Duty Waiting Charge hi 1st hour ah chuan a free ang</li>
                <li>2. Chhun leh zan inzawm a passenger nghah a nih chuan per day/per night  charge chiah a awm ang.</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const agentElements = document.querySelectorAll('.location');

      agentElements.forEach(function (element) {
          element.addEventListener('click', function () {
              const agentName = element.getAttribute('data-agent-name');
              const address = element.getAttribute('data-address');
              const district = element.getAttribute('data-district');
              const state = 'Mizoram';
              const country = 'India';
              const googleMapsUrl = `https://www.google.com/maps/search/${encodeURIComponent(agentName + ' ' + address + ' ' + district + ' ' + state + ' ' + country )}`;
              window.open(googleMapsUrl, '_blank');
              event.stopPropagation();
          });
      });

      const phoneElements = document.querySelectorAll('.click-to-copy');

      phoneElements.forEach(function (element) {
          element.addEventListener('click', function () {
              const phoneNumber = element.innerText;
              const textArea = document.createElement('textarea');
              textArea.value = phoneNumber;
              document.body.appendChild(textArea);
              textArea.select();
              document.execCommand('copy');
              document.body.removeChild(textArea);

              // Optionally, you can display a notification to the user
              alert('Phone number copied to clipboard: ' + phoneNumber);
              event.stopPropagation();
          });
      });
  });
</script>