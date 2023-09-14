@extends('layouts.layout')
@section('contents')
<div class="p-4 mt-10 mb-10 container mx-auto">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    <a href="{{ Route('howToGetToMizoram') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">How to get to Mizoram</div>
    </a>
    <a href="{{ Route('getFestivals') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Festivals</div>
    </a>
    <a href="{{ Route('tourGuides') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Tour Guides</div>
    </a>
    <a href="{{ Route('hotelAccomodations') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Hotels & Accommodations</div>
    </a>
    <a href="{{ Route('restaurants') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Restaurant</div>
    </a>
    <a href="{{ Route('travelAgent') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Travel Agents</div>
    </a>
    <a href="{{ Route('getTourOperators') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Tour Operators</div>
    </a>
    <a href="{{ Route('rentACar') }}" class="flex flex-row p-4 border-b border-opacity-20">
      <div class="flex-col mr-4"><img src="/image/plan-your-trip.png" alt="p" width="20"></div>
      <div class="font-extrabold">Car Rentals & Taxi</div>
    </a>
  </div>
</div>
@endsection