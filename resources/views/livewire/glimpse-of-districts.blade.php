<div>
  <div class="mb-4">
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-11 gap-4 mt-4">
      @foreach ($districts as $district)
        <button wire:click="onDistrictClicked({{$district}})" class="ml-2 mr-2 bg-white pl-5 pr-5 p-2 rounded-lg hover:shadow-lg border-2 {{ $district->id == $selectedDistrict->id ? 'border-colorx shadow-lg' : 'border-white' }}">{{ $district->district_name }}</button>
      @endforeach
    </div>
  </div>
  <div id="myTabContent">
    <div class="p-4 rounded-lg">
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 content-center items-center">
        <div class="text-sm text-gray-500 dark:text-gray-400 bg-white bg-no-repeat bg-cover p-10 pt-10 md:pt-20 md:p-20 m-auto w-full h-full mb-10 relative">
          <div class="text-xl font-extrabold">{{ $selectedDistrict->district_name }}</div>
          <div class="grid grid-cols-2">
            <div class="flex flex-row content-center items-center">
              <span class="mr-1"><img src="/image/icons/airport.png" class="h-4 w-4" alt="airport"></span>
              <span class="font-bold mr-1">{{ $selectedDistrict->airport }}</span> <span>kms away</span>
            </div>
            <div class="flex flex-row content-center items-center">
              <span class="mr-1"><img src="http://openweathermap.org/img/wn/{{ $weatherIcon }}@2x.png" alt="weather" class="h-10 w-10"></span>
              <div class="font-bold mr-1">{{ round($temperature) }}<sup>o</sup>C</div> {{ $weather }}
            </div>
          </div>
          <div class="line-clamp-3 mt-4">
            {!! $selectedDistrict->description !!}
          </div>
          <div class="mt-4">
            <a href="{{ Route('placeToVisit', $selectedDistrict->id) }}" class="hover:text-colorx">— Read More</a>
          </div>
          <div class="mt-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
              <div class="md:col-span-1 pt-4 pb-4 text-center">
                <img src="/image/icons/altitude.svg" alt="altitude" class="mx-auto">
                Altitude
                <div class="text-xl font-extrabold">{{ $selectedDistrict->altitude }}</div>
                mts
              </div>
              <div class="md:col-span-1 pt-4 pb-4 text-center">
                <img src="/image/icons/population.svg" alt="population" class="mx-auto">
                Population
                <div class="text-xl font-extrabold">{{ $selectedDistrict->population }}</div>
                (as of 2011 census)
              </div>
              <div class="md:col-span-1 pt-4 pb-4 text-center">
                <img src="/image/icons/area.svg" alt="area" class="mx-auto">
                Area
                <div class="text-xl font-extrabold">{{ $selectedDistrict->area }}</div>
                sq kms
              </div>
            </div>
          </div>
          <div class="hidden sm:flex md:flex absolute right-0 overflow-visible -mr-32 top-40">
            <div class="h-full">
              @foreach ($selectedDistrict->images as $image)
              @if ($loop->index == 2)
                @break
              @endif
              <img src="/post_images/{{ $image->name }}" alt="{{ $selectedDistrict->district_name }}" class="rounded-lg mb-4" height="200" width="200">
              @endforeach
            </div>
          </div>
        </div>
        <div class="overflow-hidden w-full h-full">
          <img class="object-cover h-[35rem] mx-auto" src="/image/districts/{{ strtolower($selectedDistrict->district_name) }}.png" alt="{{ $selectedDistrict->district_name }}">
        </div>
      </div>
    </div>
  </div>
</div>
