<div>
  <div class="mt-10 mb-10">
    <div class="font-kushan text-center text-4xl">List of Car Rentals</div>
    <div class="text-center text-sm">{{ count($operators) }} Rental{{ count($operators) == 1 ? '' : 's' }}</div>
  </div>
  <div class="text-right">
    <button  data-bs-toggle="modal" data-bs-target="#exampleModalXl" class="border border-district-outline outline-none p-2 rounded-lg text-xs">Hiring Rates</button>
  </div>
  <div class="m-4">
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-12 gap-4">
      @foreach ($districts as $district)
      <div wire:click="getData({{ $district->id }})" class="{{ $this->districtsId == $district->id ? 'border-colorx' : 'border-district-outline' }} border pl-4 pr-4 p-2 rounded-lg text-center hover:cursor-pointer hover:shadow-lg font-bold hover:scale-105 transition duration-300 ease-in-out">
        {{ $district->district_name }}
      </div>
      @endforeach
    </div>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4">
    @if (count($operators) == 0)
      <div class="italic text-xs">
        No operators found
      </div>  
    @endif
    @foreach ($operators as $operator)
    <div class="flex flex-row border border-card-border hover:shadow-xl pt-4 p-2 hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
      <div class="flex-col p-2"><img src="/image/rent-a-car.png" alt="guide" class="h-10 w-10"></div>
      <div class="flex-col">
        <div class="font-bold text-xl">{{ $operator->name }}</div>
        <div class="mt-4">
          <ul>
            <li class="location">{{ $operator->address }}</li>
            <li class="phone">{{ $operator->phone_one }}</li>
            <li class="mail">{{ $operator->email }}</li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="w-full mt-10">
    {{ $operators->links() }}
  </div>
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full bg-black bg-opacity-60 outline-none overflow-x-hidden overflow-y-auto" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
      <div class="modal-content border-none shadow-lg relative flex flex-col w-8/12 mx-auto mt-32 pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="modal-header flex flex-shrink-0 items-end justify-end p-4 rounded-t-md text-right">
          <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 512 512" style=" fill:#ffffff;"><path fill="#E04F5F" d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z"></path><path fill="#FFF" d="M285,256l72.5-84.2c7.9-9.2,6.9-23-2.3-31c-9.2-7.9-23-6.9-30.9,2.3L256,222.4l-68.2-79.2c-7.9-9.2-21.8-10.2-31-2.3c-9.2,7.9-10.2,21.8-2.3,31L227,256l-72.5,84.2c-7.9,9.2-6.9,23,2.3,31c4.1,3.6,9.2,5.3,14.3,5.3c6.2,0,12.3-2.6,16.6-7.6l68.2-79.2l68.2,79.2c4.3,5,10.5,7.6,16.6,7.6c5.1,0,10.2-1.7,14.3-5.3c9.2-7.9,10.2-21.8,2.3-31L285,256z"></path></svg>
          </button>
        </div>
        <div class="modal-body relative">
          <div class="font-kushan text-4xl text-center">Hiring Rate</div>
          <div class="mt-4 m-auto text-center p-20 pt-0">
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
                <td class="p-4 border-b border-r border-gray-300 text-left">{{ $columnNames[$loop->index] }}</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ {{ $rates->minimum_charge }}</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ {{ $rates->rate_per_km }}</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ {{ $rates->rate_per_hour }}</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ {{ $rates->halt }}</td>
              </tr>
              @endforeach
              {{-- <tr>
                <td class="p-4 border-b border-r border-gray-300 text-left">Rate per km</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 25</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 30</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 35</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 45</td>
              </tr>
              <tr>
                <td class="p-4 border-b border-r border-gray-300 text-left">Rate per hour/on duty waiting charge</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 300</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 350</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 400</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 700</td>
              </tr>
              <tr>
                <td class="p-4 border-b border-r border-gray-300 text-left">Rate per hour/on duty waiting charge</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 1000</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 1200</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 1800</td>
                <td class="p-4 border-b border-r border-gray-300 font-bold">₹ 1800</td>
              </tr> --}}
            </table>
            <div class="mt-10 bg-pale-yellow text-light-gray p-4 text-left text-xs">
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