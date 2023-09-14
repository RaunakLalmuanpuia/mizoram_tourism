<a href="{{ Route('newsDetails', $newsEvent) }}">
  <div class="flex-col hover:shadow-xl m-2 border border-card-border hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
    @if (count($newsEvent->images) != 0)
    @foreach ($newsEvent->images as $image)
      <img src="/post_images/{{ $image->name }}" alt="vantawng" class="object-cover h-72 w-full">
      @break
    @endforeach
    @else
    <img src="/image/tourism_cheraw.png" class="object-cover h-72 w-full" alt="...">
    @endif
    <div class="p-4">
      <div class="rounded-full text-tourism-green bg-light-green w-16 text-center">{{ $newsEvent->category->name }}</div>
      <div class="text-lg font-bold">{{ $newsEvent->title }}</div>
    </div>
  </div>
</a>