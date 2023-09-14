@extends('layouts.layout')
@section('header')
  <img src="/image/newsEvents.jpg" alt="district image" class="w-full h-80 object-cover district-header">
  <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full top-60">
    News And Events
  </div>
@endsection

@section('contents')
  <div class="container mx-auto mt-10 mb-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
      @foreach ($newsEvents as $newsEvent)
        @include('layouts.newsContainer', $newsEvent)
      @endforeach
    </div>
  </div>
@endsection