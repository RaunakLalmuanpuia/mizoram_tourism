@extends('layouts.layout')
@section('header')
  @include('layouts.carousel', [$carousels])
@endsection
@section('contents')
<div class="container m-auto">
  <div class="mt-6">
    <div class="font-kushan text-center text-4xl">Places to Visit</div>  
    <div class="text-center">
      Explore Mizoram
    </div>
    <div class="w-10 m-auto mt-2">
      <img src="/image/separator.png" alt="separator" width="40">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 mt-4 p-10">
      @foreach ($topDestinations as $destination)
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
      <div class="col-span-2">
        <img src="/image/cashback.jpg" alt="cashback" class="w-full h-full">
      </div>
    </div>
  </div>
  <div class="mt-4">
    <div class="grid grid-cols-1 md:grid-cols-2">
      <div class="flex-col p-10">
        <img src="https://images.unsplash.com/photo-1635606486436-7d0c994a260a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="greeting" class="object-cover h-fit">
      </div>
      <div class="flex-col m-auto">
        <div class="font-kushan pl-10 text-4xl">Welcome to Mizoram</div>
        <div class="p-10 pr-20">
          {!! $mizoram->description !!}
        </div>
        <div class="p-4 pl-10"><a class="hover:text-blue-500" href="{{ Route('about', 4) }}">— Before entering Mizoram, what to know?</a></div>
      </div>
    </div>
  </div>
</div>
<div class="mt-4 bg-light-green">
  <div class="container m-auto p-4">
    <div class="text-center text-4xl font-kushan">Glimpses of Districts</div>
    <div class="text-center">Know more about Mizoram</div>
    <div class="w-10 mt-3 m-auto">
      <img src="/image/separator.png" alt="separator" width="40">
    </div>
    @livewire('glimpse-of-districts', ['districts' => $districts])
  </div>
</div>
<div class="container m-auto p-4">
  <div class="text-center text-4xl font-kushan">Latest Updates</div>
  <div class="text-center">Don't miss out the latest updates</div>
  <div class="w-10 m-auto">
    <img src="/image/separator.png" alt="separator" width="40">
  </div>
  <div class="grid grid-cols-2 md:grid-cols-3">
    @foreach ($newsEvents as $newsEvent)
      @include('layouts.newsContainer', [$newsEvent])
    @endforeach
  </div>
</div>
{{-- <div class="container m-auto p-4">
  <div class="text-center text-4xl font-kushan">Live the Moment</div>
  <div class="text-center">
    Checkout the wonderful Mizoram
  </div>
  <div id="instafeed"></div>
  <div class="flex flex-row">
    <div class="flex-col">
      <img src="" alt="">
    </div>
  </div>
</div> --}}
@endsection

@section('styles')
    <style>
			.carousel-open:checked + .carousel-item {
				position: static;
				opacity: 100;
			}
			.carousel-item {
				-webkit-transition: opacity 0.6s ease-out;
				transition: opacity 0.6s ease-out;
        clip-path: url('/image/curve.svg');
			}
			#carousel-1:checked ~ .control-1,
			#carousel-2:checked ~ .control-2,
			#carousel-3:checked ~ .control-3 {
				display: block;
			}
			.carousel-indicators {
				list-style: none;
				margin: 0;
				padding: 0;
				position: absolute;
				bottom: 2%;
				left: 0;
				right: 0;
				text-align: center;
				z-index: 10;
			}
			#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
			#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
			#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
				color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
			}

      .element {
        
      }
		</style>
@endsection