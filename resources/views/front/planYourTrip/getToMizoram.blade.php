@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="https://www.iaspaper.net/wp-content/uploads/2017/12/Mizoram-NEET-Counselling.jpg" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          How to get to Mizoram
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
<div class="container mt-10 mx-auto mb-4">
  <div class="text-center">Mizoram is linked with the rest of the country by air, rail and surface transport.</div>
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
    @foreach ($getToMizorams as $getToMizoram)
    <div class="border border-card-border hover:shadow-xl hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
      @foreach ($getToMizoram->images as $image)
      <img src="/post_images/{{ $image->name }}" alt="ariport" class="w-full h-72 object-cover">
      @break
      @endforeach
      <div class="p-6">
        <div class="font-bold font-xl">{{ $getToMizoram->means }}</div>
        <div class="mt-2">
          {!! $getToMizoram->description !!}
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<div class="bg-light-green mt-10">
  <div class="container mx-auto pt-10 pb-10">
    <div class="font-kushan text-4xl text-center">Related Information</div>
    <div class="text-center">Place to visit inside Aizawl District</div>
    <div class="w-10 m-auto">
      <img src="/image/separator.png" alt="separator" width="40">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
      <a href="{{ Route('tourGuides') }}" class="bg-white p-10 hover:shadow-xl hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex flex-row">
          <div class="flex-col">
            <img class="h-16 w-16" src="/image/guides.png" alt="tour guides">
          </div>
          <div class="flex-col">
            Certified guides for you
            <div class="font-bold">Tour Guides</div>
          </div>
        </div>
      </a>
      <a href="{{ Route('rentACar') }}" class="bg-white p-10 hover:shadow-xl hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex flex-row">
          <div class="flex-col">
            <img class="h-16 w-16" src="/image/rent.png" alt="tour guides">
          </div>
          <div class="flex-col">
            Rent a Car
            <div class="font-bold">Car Rental Information</div>
          </div>
        </div>
      </a>
      <a href="{{ Route('getTourOperators') }}" class="bg-white p-10 hover:shadow-xl hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex flex-row">
          <div class="flex-col">
            <img class="h-16 w-16" src="/image/map.png" alt="tour guides">
          </div>
          <div class="flex-col">
            Select your choice
            <div class="font-bold">Tour Operators</div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
@livewire('front.top-destination', ['districtId' => '1'])
@endsection