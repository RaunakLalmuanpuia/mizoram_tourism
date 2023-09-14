<div class="md:col-span-1 p-10 pt-4 pb-4 border border-[#e1e1e1] text-center">
  @if ($weatherFetched)
  <div class="bg-weather-bg rounded-full h-10 w-10 mx-auto">
    <img src="http://openweathermap.org/img/wn/{{ $weatherIcon }}@2x.png" alt="altitude">
  </div>
  Weather Forcast
  <div class="text-xl font-extrabold">{{ round($temperature) }}<sup>o</sup>C</div>
  {{ $weather }}
  @else
  <div class="text-center">
    Failed to fetch
    <br>
    weather.
  </div>
  @endif
</div>