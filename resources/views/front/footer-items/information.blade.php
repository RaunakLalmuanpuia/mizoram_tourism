@extends('layouts.layout')
@section('contents')
  <div class="container mx-auto">
    <div class="w-full md:w-1/2 p-5">
      <div class="font-kushan text-3xl ml-10">{{ $information->title }}</div>
      <div class="mt-5 mb-5">
        {!! $information->description !!}
      </div>
    </div>
  </div>
  @endsection