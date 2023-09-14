@extends('layouts.layout')
@section('header')
@foreach ($notice->images as $image)
  <img src="/post_images/{{ $image->name }}" alt="district image" class="w-full h-80 object-cover district-header">
  @break
@endforeach
@endsection

@section('contents')
<div class="container mx-auto mt-10 mb-10 p-5">
  <div class="font-kushan text-4xl text-center w-full">
    {{ $notice->title }}
  </div>
  <div class="float-right">
    <div class="rounded-full border border-colorx text-colorx bg-colorx bg-opacity-10 pl-2 pr-2">{{ $notice->category->name }}</div>
  </div>
  <div class="mt-10">
    {!! $notice->body !!}
  </div>
</div>
@endsection
