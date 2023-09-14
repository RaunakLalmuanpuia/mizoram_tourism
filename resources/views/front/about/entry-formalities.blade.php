@extends('layouts.layout')
@section('header')
  <img src="/image/entry.png" alt="district image" class="w-full h-80 object-cover district-header">
  <div class="z-1 absolute text-white text-center w-full top-60">
    <div class="text-4xl font-kushan">
      Entry Formalities
    </div>
    {{-- <div class="text-lg">Plan Your Trip</div> --}}
  </div>
@endsection
@section('contents')
  <div class="container mx-auto mt-10">
    <div class="grid sm:grid-cols-2 grid-cols-1">
      <div class="my-auto mr-10">
        <div class="font-kushan text-4xl">Domestic Tourists</div>
        <div class="mt-10">
          Inner Line Pass (ILP) is required for entry into Mizoram and can be obtained from Liaison Officer, Government of Mizoram from the following cities Kolkata, Silchar, Shillong, Guwahati or New Delhi. Government employees traveling for official purposes are exempted from obtaining ILP but are required to carry a photo identification card with them at all times. ILP On Arrival can also be obtained from Lengpui Airport
        </div>
      </div>
      <img src="/image/indian.png" alt="indian">
    </div>
    <div class="grid sm:grid-cols-2 grid-cols-1">
      <img src="/image/foreign.png" alt="foreign">
      <div class="my-auto ml-10">
        <div class="font-kushan text-4xl">Foreign Tourists</div>
        <div class="mt-10">
          All foreign nationals have to register themselves at the office of Superintendent of Police (CID/SB) Mizoram who is the designated Foreigners Registration Officer (FRO) of the State within 24 hours of arrival. They are not required to obtain Protected Area Permit
          <br><br>
          Citizens of Afghanistan, China and Pakistan and foreign nationals having their origin in these countries would continue to require prior approval of the Ministry of Home Affairs before entering the state
        </div>
      </div>
    </div>
  </div>
  <div class="bg-ilp-background">
    <div class="container mx-auto text-center p-20">
      <div class="font-kushan text-4xl text-white mb-10">Visit ILP Portal</div>
      <a href="https://police.mizoram.gov.in/online-ilp-portal/" target="_blank" class="pl-10 pr-10 text-white rounded-lg bg-colorx p-4">Go Now</a>
    </div>
  </div>
@endsection