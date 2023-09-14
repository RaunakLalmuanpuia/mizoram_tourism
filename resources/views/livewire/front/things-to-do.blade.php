<div class="container mx-auto">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 p-10">
    @foreach ($activities as $activity)
      @foreach ($activity->districtTopDestinations as $destination)
      <div class="relative overflow-hidden">
        <div class="h-full w-full">
          @if (count($destination->images) != 0)
            @foreach ($destination->images as $images)
                <img src="/post_images/{{ $images->name }}" alt="destination image" class="object-cover w-full h-[15rem]" />
                @break
            @endforeach
            @else
            <img src="/image/tourism_cheraw.png" alt="" class="object-cover w-full h-[15rem]">
          @endif
          <div class="absolute bottom-0 left-0 px-6 py-1 w-full h-full bg-opacity-60 bg-gradient-to-t from-black">
            <div class="absolute bottom-10 left-0 px-6 py-1">
              <h4 class="text-xl font-semibold tracking-tight text-white">{{ $destination->destination_name }}</h4>
              <p class="leading-normal text-gray-100">{{ $destination->districtMetaData->district_name }} District</p>
            </div>
          </div>
        </div>
        <div class="opacity-0 hover:opacity-100 duration-300 absolute inset-0 z-10 text-white bg-colorx bg-opacity-[0.95] p-10">
          <div class="font-bold text-sm">{{ $destination->destination_name }}</div>
          <div class="text-xs">{{ $destination->districtMetaData->district_name }} District</div>
          <div class="text-xs mt-4">{{ substr($destination->description, 0, 50) }}</div>
          <div class="text-lg mt-4"><a href="{{ Route('destinationDetail', $destination->id) }}" class="hover:underline">— Show me in details</a></div>
        </div>
      </div>
      @endforeach
    @endforeach
  </div>
  <div class="mt-4"></div>
</div>
