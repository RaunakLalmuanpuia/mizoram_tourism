@extends('layouts.layout')
@section('contents')
    <div class="container mx-auto mt-10">
        <a href="{{ Route('booking') }}" class="text-colorx">
            Modify your booking
        </a>
        @livewire('front.booking-information', ['bookingData'=>$data])
    </div>
@endsection
