@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="/image/sialsuk.jpeg" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        {{ ucfirst($activity) }}
      </div>
    </div>
  </div>
@endsection
@section('contents')
<div class="mt-10 mb-10">
  <div class="text-center text-4xl font-kushan">Top Destination</div>
  <div class="text-center">Places to visit for {{ $activity }}</div>
  <div class="w-10 m-auto">
    <img src="/image/separator.png" alt="separator" width="40">
  </div>
</div>
@livewire('front.things-to-do', ['activity' => $activity])
@endsection