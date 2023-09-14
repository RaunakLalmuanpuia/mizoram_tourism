<div>
  <div class="grid grid-cols-2 gap-4 mt-10">
    @foreach ($images as $image)
      <img class="h-[30rem] w-[45rem] object-cover" height="300" wire:click="imageClicked" src="/post_images/{{ $image->name }}" alt="{{ $image->name }}">
      @break
    @endforeach
    <div class="grid grid-cols-2 gap-4">
      @foreach ($images as $image)
        @if ($loop->index != 0)
          <img wire:click='imageClicked' src="/post_images/{{ $image->name }}" alt="{{ $image->name }}" class="h-[230px] w-[400px] object-cover">
        @endif
        @if ($loop->index == 4)
            @break
        @endif
      @endforeach
    </div>
  </div>

  <x-jet-dialog-modal wire:model="showGallery" class="bg-transparent">
    <x-slot name="title"></x-slot>
    <x-slot name="content">
      <div id="default-carousel" data-carousel="slide" class="relative">
        <div class="overflow-hidden relative h-56 sm:h-64 xl:h-80 2xl:h-[30rem]">
          @foreach ($images as $image)
          <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0" data-carousel-item="{{ $loop->index == 0 ? 'active' : '' }}">
            <img src="/post_images/{{ $image->name }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
          </div>
          @endforeach
        </div>

        <button type="button" class="flex absolute top-0 left-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
          <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="hidden">Previous</span>
          </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
          <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="hidden">Next</span>
          </span>
        </button>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
</div>
