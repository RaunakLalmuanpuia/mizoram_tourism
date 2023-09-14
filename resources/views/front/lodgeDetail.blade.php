@extends('layouts.layout')
@section('contents')
  <div class="p-10 text-center">
    <div class="text-xl">
      Welcome To
    </div>
    <div class="font-kushan text-4xl">
      {{ $lodge->name }}
    </div>
  </div>
  @livewire('lodge-detail', ['lodge' => $lodge, 'amenities' => $amenities, 'lodgeRooms' => $lodgeRooms])
@endsection