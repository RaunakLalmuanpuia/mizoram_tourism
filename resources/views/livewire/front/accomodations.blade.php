<div>
  <div class="mt-10">
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-11 gap-4 mt-4">
      @foreach ($districts as $district)
        <button wire:click="onDistrictClicked('{{ $district->id }}')" class="ml-2 mr-2 bg-white pl-5 pr-5 p-2 rounded-lg hover:shadow-lg {{ $district->id == $selectedDistrict ? 'border-colorx shadow-lg border-2' : 'border-black border border-opacity-30' }}">{{ $district->district_name }}</button>
      @endforeach
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-10 mb-10">
      @foreach ($accomodations as $accomodation)
      <a href="{{ Route('lodgeDetail', $accomodation->id) }}">
        <div class="hover:shadow-xl border border-card-border hover:scale-105 transition duration-300 ease-in-out">
          @if (count($accomodation->images) != 0)
            @foreach ($accomodation->images as $image)
            <img src="/post_images/{{ $image->name }}" alt="chaltlang tourist lodge" class="w-full h-60">
            @break
            @endforeach
          @else
          <img src="/image/tourism_cheraw.png" alt="..." class="w-full h-60">
          @endif
          <div class="p-4">
            <div class="text-tourism-green bg-opacity-5 bg-tourism-green rounded-full w-4/12 text-xs pl-2 pr-2 p-1 text-center">{{ $accomodation->districtMetadata->district_name }} District</div>
            <div class="text-xl font-bold">{{ $accomodation->name }}</div>
            <div class="text-sm"></div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
