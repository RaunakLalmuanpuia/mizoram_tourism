<div id="indicators-carousel" class="relative" data-carousel="static">
  <div class="overflow-hidden relative h-[17rem] md:h-[48rem]">
    @foreach ($carousels as $carousel)
    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20" data-carousel-item="{{ $loop->index == 0 ? 'active' : '' }}">
      @foreach ($carousel->images as $image)
        <img src="/post_images/{{ $image->name }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 cover" alt="...">
        @break
      @endforeach
      <div class="absolute w-full h-full bg-opacity-60 bg-gradient-to-t from-black">
        <div class="absolute text-center w-full h-full top-5 sm:top-60">
          <div class="">
            <h4 class="text-4xl sm:text-8xl font-kushan tracking-tight text-white">Mystical Mizoram</h4>
            <p class="leading-normal text-lg text-gray-100">A Paradise for everyone</p>
          </div>
          <div class="mt-10">
            <a href="{{ Route('placesToVisit') }}" class="relative items-center justify-start inline-block overflow-hidden bg-colorx rounded-full group pl-6 pr-6 pt-2 pb-2">
              <span class="w-32 h-32 rotate-45 translate-x-12 -translate-y-2 absolute left-0 top-0 bg-charcoal-black opacity-[3%]"></span>
              <span class="absolute top-0 left-0 w-48 h-48 -mt-1 transition-all duration-500 ease-in-out rotate-45 -translate-x-56 -translate-y-24 bg-charcoal-black opacity-100 group-hover:-translate-x-8"></span>
              <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out font-extrabold">Let's Explore</span>
              <span class="absolute inset-0 border-2 border-colorx group-hover:border-charcoal-black rounded-full"></span>
            </a>
            {{-- <a href="{{ Route('placesToVisit') }}" class="rounded-full p-2 pl-4 pr-4 bg-colorx text-white">Let's Explore</a> --}}
          </div>
          <div class="mt-10">
            <a href="{{ Route('about', 4)}}" class="text-white hover:text-colorx">Get to know the latest SOP for tourist</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
    @for ($i = 0; $i < count($carousels); $i++)
    <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800" aria-current="true" aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
    @endfor
  </div>

  <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev="">
    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
      <span class="hidden">Previous</span>
    </span>
  </button>
  <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next="">
    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
      <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
      <span class="hidden">Next</span>
    </span>
  </button>
</div>
