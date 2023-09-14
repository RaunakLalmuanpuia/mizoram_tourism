@extends('layouts.layout')
@section('header')
  <img src="/image/tour-guide.png" alt="district image" class="w-full h-80 object-cover district-header">
  <div class="z-1 absolute text-white text-center w-full top-60">
    <div class="text-4xl font-kushan">
      Tour Guides
    </div>
    <div class="text-lg">Plan Your Trip</div>
  </div>
@endsection
@section('contents')
  <div class="container mx-auto mb-10">
    <div class="mt-10 mb-10">
      <div class="p-4 font-kushan text-center text-4xl">Certified tour guide list</div>
      <div class="text-center text-sm">{{ $totalGuides }} Guides</div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @foreach ($guides as $guide)
      <div class="flex flex-row border border-card-border hover:shadow-xl pt-4 p-2 hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex-col p-2"><img src="/image/guides.png" alt="guide" class="h-10 w-10"></div>
        <div class="flex-col">
          <div class="font-bold text-xl">{{ $guide->name }}</div>
          <div class="text-colorx text-[10px] bg-reg-background rounded-full pl-1 pr-1">{{ $guide->license }}</div>
          <div class="mt-4">
            <ul>
              <li class="location">{{ $guide->address }}</li>
              <li class="phone">{{ $guide->phone_one }} / {{ $guide->phone_two }}</li>
            </ul>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="mt-4">
      {{ $guides->links() }}
    </div>
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