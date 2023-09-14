@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="{{ $district->banner_image }}" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        {{ $district->district_name }}
      </div>
    </div>
  </div>
@endsection
@section('contents')
<div class="container mx-auto p-10">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 mt-4">
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/altitude.svg" alt="altitude" class="mx-auto">
      Altitude
      <div class="text-xl font-extrabold">{{ $district->altitude }}</div>
      mts
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/population.svg" alt="population" class="mx-auto">
      Population
      <div class="text-xl font-extrabold">{{ $district->population }}</div>
      (as of 2011 census)
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/area.svg" alt="area" class="mx-auto">
      Area
      <div class="text-xl font-extrabold">{{ $district->area }}</div>
      sq kms
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/airport.svg" alt="airport" class="mx-auto">
      Airport
      <div class="text-xl font-extrabold">{{ $district->airport }}</div>
      kms away
    </div>
    @livewire('front.weather-forecast', ['lat' => $district->latitude, 'lon' => $district->longitude])
  </div>
  @if (count($district->quotes) != 0)
  @foreach ($district->quotes as $quote)
    <div class="text-center text-4xl font-kushan mt-10">"{{ $quote->quote }}"</div>
  @break    
  @endforeach
  @else
  <div class="text-center text-4xl font-kushan mt-10">"{{ $district->quote }}"</div>
  @endif

  {{-- district images --}}

  @livewire('district-images', ['images' => $district->images])

  {{-- end district images --}}

  <div class="mt-10 grid md:grid-cols-2 sm:grid-cols-1 gap-4">
    <div class="flex-col my-auto">
      <div class="text-4xl font-kushan">Glimpse of {{ $district->district_name }}</div>
      <div class="mt-6">
        {!! $district->description !!}
      </div>
    </div>
    <div class="flex-col p-10">
      @if (count($district->images) != 0)
        @foreach ($district->images as $image)
            <img src="/post_images/{{ $image->name }}" alt="district image" class="object-contain">
            @break
        @endforeach
      @else
        <img src="{{ $district->banner_image }}" alt="district image" class="object-contain">
      @endif
    </div>
  </div>
</div>
<div class="bg-light-green">
  @livewire('front.top-destination', ['districtId' => $district->id])
</div>
<div class="container mx-auto p-10">
  <div class="font-kushan text-4xl text-center">
    Check Other Attraction
  </div>
  <div class="text-center">
    Peak on other district
  </div>
  <div class="w-10 m-auto"><img src="/image/separator.png" alt="separator" width="40"></div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
    @foreach ($districts as $checkoutDistrict)
      <a href="{{ Route('placeToVisit', $checkoutDistrict->id) }}">
        <div class="flex-col border border-[#e1e1e1] p-4 hover:bg-colorx hover:text-white hover:cursor-pointer hover:shadow-md hover:scale-105 transition duration-300 ease-in-out">
          <div class="font-bold text-lg">{{ $checkoutDistrict->district_name }}</div>
          <div>{{ substr($checkoutDistrict->description, 0, 50) }}</div>
        </div>
      </a>
    @endforeach
  </div>
</div>
@endsection

@section('styles')
  <style>
    .district-header{
      clip-path: url('/image/curve.svg');
    }
  </style>
@endsection