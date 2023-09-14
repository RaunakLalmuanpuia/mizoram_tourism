@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="/image/taxi.png" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          Rent A Car
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
<div class="container mx-auto mb-10">
  @livewire('front.rent-a-car', ['districts' => $districts])
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

      .mail::before{
        content: '\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0';
        background-image: url('/image/mail.png');
        background-size: contain;
        background-repeat: no-repeat;
      }
  </style>
@endsection