@extends('layouts.layout')
@section('header')
@foreach ($festival->images as $image)
  <img src="/post_images/{{ $image->name }}" alt="district image" class="w-full h-80 object-cover district-header">
  @break
@endforeach
@endsection

@section('contents')
<div class="container mx-auto mt-10 mb-10">
  <div class="font-kushan text-4xl text-center w-full">
    {{ $festival->name }}
  </div>
  <div class="float-right">
    <div class="rounded-full border border-colorx text-colorx bg-colorx bg-opacity-10 pl-2 pr-2">{{ $festival->date }}</div>
  </div>
  <div class="mt-10">
    {!! $festival->description !!}
  </div>
</div>
@endsection
