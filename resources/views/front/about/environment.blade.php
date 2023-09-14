@extends('layouts.layout')
@section('header')
  <img src="/image/banner.png" alt="district image" class="w-full h-80 object-cover district-header">
  <div class="z-1 absolute text-white text-center w-full top-60">
    <div class="text-4xl font-kushan">
      Environment
    </div>
    <div class="text-lg">About</div>
  </div>
@endsection
@section('contents')
  @livewire('front.environment')
@endsection