@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    @foreach ($destination->images as $image)
      <img src="/post_images/{{ $image->name }}" alt="district image" class="w-full h-80 object-cover district-header">
        @break
      @endforeach
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          {{ $destination->destination_name }}
        </div>
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
      <div class="text-xl font-extrabold">{{ $destination->altitude }}</div>
      mts
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/population.svg" alt="population" class="mx-auto">
      From Aizawl
      <div class="text-xl font-extrabold">{{ $destination->distance }}</div>
      kms
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/area.svg" alt="area" class="mx-auto">
      Nearest Tourist Lodge
      <div class="text-xl font-extrabold">{{ $destination->nearest_tourist_lodge_distance }}</div>
      kms
    </div>
    <div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
      <img src="/image/icons/walking.svg" alt="airport" class="mx-auto">
      Walking Distance
      <div class="text-xl font-extrabold">{{ $destination->walking_distance == null ? '0' : $destination->walking_distance }}</div>
      minutes away
    </div>
    @livewire('front.weather-forecast', ['lat' => $destination->latitude, 'lon' => $destination->longitude])
  </div>
  <div class="text-center mt-4">
    <div class="">Tags</div>
    <div class="mx-auto mt-2 mb-10">
      <div class="flex flex-row justify-center">
        @foreach ($destination->tags as $tag)
        <div class="flex-col border rounded-full p pl-3 pr-3 mr-4">
          {{ $tag->name }}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="grid grid-cols-4 gap-4">
    @if (count($destination->images) != 0)
    @foreach ($destination->images as $image)
      <img src="/post_images/{{ $image->name }}" alt="{{ $image->name }}">
    @endforeach
    @endif
  </div>
  <div class="mt-10 grid md:grid-cols-2 sm:grid-cols-1 gap-4">
    <div class="flex-col my-auto">
      <div class="text-4xl font-kushan">Glimpse of {{ $destination->destination_name }}</div>
      <div class="mt-6">
        {!! $destination->description !!}
      </div>
    </div>
    <div class="flex-col p-10">
      @if (count($destination->images) != 0)
        @foreach ($destination->images as $image)
            <img src="/post_images/{{ $image->name }}" alt="district image" class="object-contain">
            @break
        @endforeach
      @else
        <img src="{{ $destination->banner_image }}" alt="district image" class="object-contain">
      @endif
    </div>
  </div>
  <div class="bg-light-green mt-10">
    @foreach ($destination->districtMetaData as $district)
      @livewire('front.top-destination', ['districtId' => $district])
      @break
    @endforeach
  </div>
</div>
@endsection