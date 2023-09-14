@extends('layouts.layout')
@section('contents')
@php
  $bookings = collect($myBookings)->all();
  $pageIndex = 0;
@endphp
  <div class="container mx-auto">
    {{-- @dd($myBookings->items()) --}}
    {{-- @dd($myBookings) --}}
    {{-- @livewire('user-booking', ['bookings' => $myBookings]) --}}
    {{-- @livewire('user-booking', ['bookings' => $myBookings->items()]) --}}
    @livewire('user-booking', ['bookings' => $bookings])
  </div>
  <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
    <div class="flex justify-between flex-1 sm:hidden">
      <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
      <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ $bookings["from"] }}</span>
          to
          <span class="font-medium">{{ $bookings["to"] }}</span>
          of
          <span class="font-medium">{{ $bookings["total"] }}</span>
          results
        </p>
      </div>
      <div>
        <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
          @foreach ($bookings["links"] as $page)
            @if ($page["active"])
              <a href="{{ $page["url"] }}" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-600 focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                {{ $page["label"] }}
              </a>
            @else
              <a href="{{ $page["url"]}}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                @if ($page["label"] == "&laquo; Previous")
                Previous
                @elseif ($page["label"] == "Next &raquo;")
                Next
                @else
                {{ $page["label"] }}
                @endif
              </a>
            @endif
          @endforeach
          </a>
        </nav>
      </div>
    </div>
  </div>
@endsection
