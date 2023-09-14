@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="/image/hotel.png" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          Hotels & Accommodations
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
<div class="container mx-auto mb-10">
  @livewire('front.hotel-and-accomodation', ['districts'=>$districts])
</div>
@endsection