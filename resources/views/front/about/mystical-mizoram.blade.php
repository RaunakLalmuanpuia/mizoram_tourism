@extends('layouts.layout')
@section('header')
  <div class="relative w-full h-[20rem] overflow-hidden">
    <img src="/image/banner.png" alt="Avatar" class="object-cover w-full h-full" />
    <div class="z-1 absolute text-white font-kushan text-6xl text-center w-full h-full top-0 bg-gradient-to-t from-black">
      <div class="absolute text-center w-full top-32">
        <div class="text-4xl font-kushan">
          {{ $about->things_to_do }}
        </div>
        <div class="text-lg">About Us</div>
      </div>
    </div>
  </div>
@endsection
@section('contents')
  <div class="container mx-auto p-4">
    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 mt-10 mb-10">
      <div class="my-auto">
        {!! $about->description !!}
      </div>
      @if (count($images) != 0)
        @foreach ($images as $image)
            <img src="/post_images/{{ $image->name }}" alt="">
        @endforeach
      @else
      <img src="/image/mystical.png" alt="mystical">
      @endif
    </div>
  </div>
@endsection