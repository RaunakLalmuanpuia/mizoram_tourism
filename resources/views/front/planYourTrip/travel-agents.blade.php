@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="https://www.iaspaper.net/wp-content/uploads/2017/12/Mizoram-NEET-Counselling.jpg" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          Travel Agents
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
  <div class="container mx-auto mt-10 mb-10">
    @livewire('agent-rating')
</div>
@endsection