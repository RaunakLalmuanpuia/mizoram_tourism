@extends('layouts.layout')
@section('header')
<div class="[position:unset] sm:static">
  <div class="bg-booking-background bg-cover bg-center bg-no-repeat h-[unset] sm:h-96 [position:unset] sm:relative mb-10 sm:mb-80 md:mb-32">
    <div class="[position:unset] sm:absolute w-full sm:top-20 md:top-52">
      <div class="container mx-auto">
        @livewire('front.booking')
      </div>
    </div>
  </div>
</div>
@endsection
@section('contents')
<div class="container m-auto">
  <div class="text-center font-kushan text-4xl">Accommodations</div>
  <div class="text-center">List of Tourist Lodge</div>
  <div class="w-10 m-auto">
    <img src="/image/separator.png" alt="separator" width="40">
  </div>
  @livewire('front.accomodations', ['districtId' => 1])
</div>
@endsection
