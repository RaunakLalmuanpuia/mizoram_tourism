@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="https://www.iaspaper.net/wp-content/uploads/2017/12/Mizoram-NEET-Counselling.jpg" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          Festivals
        </div>
        <div class="text-lg">Plan Your Trip</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
  <div class="container mx-auto mt-10 mb-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    @foreach ($festivals as $festival)
    <a href="{{ Route('viewFestivals', $festival->id) }}" class="flex-col hover:shadow-xl m-2 border border-card-border hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
      @if (count($festival->images) != 0)
      @foreach ($festival->images as $image)
      <img src="/post_images/{{ $image->name }}" alt="vantawng" class="object-cover h-72 w-full">
      @break
      @endforeach
      @else
      <img src="/image/tourism_cheraw.jpeg" alt="vantawng" class="object-cover h-72 w-full">
      @endif
      <div class="p-4">
        <div class="grid grid-cols-2 content-center items-center mb-4">
          <div class="font-kushan text-2xl">{{ $festival->name }}</div>
          <div class="rounded-full text-tourism-green bg-light-green text-center">{{ $festival->date }}</div>
        </div>
        <div class="line-clamp-2">{!! $festival->description !!}</div>
      </div>
    </a>
    @endforeach
  </div>
  </div>
@endsection