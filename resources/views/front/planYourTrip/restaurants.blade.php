@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="/image/tour-guide.png" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          Restaurants
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
  <div class="container mx-auto mb-10">
    <div class="mt-10 mb-10">
      <div class="p-4 font-kushan text-center text-4xl">List of Restaurants</div>
      <div class="text-center text-sm">{{ $totalRestaurants }} Restaurants</div>
    </div>
    @livewire('restaurant-rating')
  </div>
@endsection

@section('styles')
  <style>
    .location::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/location.png');
        background-size: contain;
        background-repeat: no-repeat;
      }

      .phone::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/phone.png');
        background-size: contain;
        background-repeat: no-repeat;
      }
  </style>
@endsection