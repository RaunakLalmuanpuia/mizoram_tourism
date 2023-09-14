@extends('layouts.layout')
@section('header')
<div class="container mx-auto">
  <img src="/image/pledge_banner.png" alt="district image" class="w-full object-cover district-header">
</div>
@endsection

@section('contents')
<div class="container mx-auto">
  <div class="font-bold text-xl mt-10">Undertaking/Intiamkamna</div>
  <div class="grid grid-cols-3">
    <div class="col-span-2">
      <div class="mt-10 mb-10">
        I pledge to be a responsible traveller;
        <br>
        When I explore new places,
        <br>
        I will leave nothing but footprints,
        <br>
        and take away only memories;
        <br>
        I shall not harm,
        <br>
        what does not harm me;
        <br>
        I shall travel clean and green,
        <br>
        I shall respect the local culture;
        <br>
        And I shall promote sustainable tourism.
      </div>
    </div>
    <div class="p-4 border-gray-400">
      @livewire('take-pledge')
    </div>
  </div>
</div>

@endsection