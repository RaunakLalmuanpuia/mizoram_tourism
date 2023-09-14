@extends('layouts.layout')
@section('contents')
  <div class="p-4 mt-10 mb-10 container mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
      @foreach ($districts as $district)
        <a href="{{ Route('placeToVisit', $district->id) }}">
          <div class="flex flex-row content-center items-center border-b border-opacity-20 pb-4">
            <div class="flex-col mr-4"><img src="/image/district.png" alt="district" width="200"></div>
            <div class="flex-col">
              <div class="font-extrabold text-xl">{{ $district->district_name }}</div>
              <div class="line-clamp-1 text-sm">{{ $district->description }}</div>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endsection