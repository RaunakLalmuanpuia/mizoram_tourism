<div>
  <div class="grid grid-cols-4 gap-4">
    @foreach ($histories as $history)
    <div class="flex-col hover:shadow-xl m-2 border border-card-border hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
      <img src="{{ $history->image }}" alt="vantawng" class="object-cover h-72 w-full">
      <div class="p-4">
        <div class="font-kushan text-2xl">{{ $history->name }}</div>
        <div class="">{!! $history->description !!}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>
