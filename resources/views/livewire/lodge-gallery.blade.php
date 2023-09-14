<div>
  @if (count($lodgeGallery) != 0)
  <section class="mx-auto">
    <div class="relative">
      <!-- large image on slides -->
      @foreach ($lodgeGallery as $gallery)
      <div class="mySlides hidden">
        <div class="image{{ $loop->index + 1}} h-[30rem] w-full object-cover"></div>
      </div>
      @endforeach

      <!-- butttons -->
      <a class="absolute z-10 left-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(-1)">❮</a>
      <a class="absolute right-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(1)">❯</a>
      <div class="bg-whie mt-4"></div>

      <!-- smaller images under description -->
      <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-6 gap-4">
        @foreach ($lodgeGallery as $gallery)
        <div>
          <div class="image{{ $loop->index + 1 }} description object-cover w-28 h-24 opacity-50 hover:opacity-100 cursor-pointer" src="#" onclick="currentSlide({{ $loop->index + 1 }})"></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @else
  <section class="mx-auto">
    <div class="relative">
      <div class="image-placeholder h-[30rem] w-full object-cover"></div>
    </div>
  </section>
  @endif
</div>

@section('styles')
    <style>
  /*each image is referenced twice in the HTML, but each image only needs to be updated in the CSS*/
  @foreach($lodgeGallery as $gallery)
  .image{{ $loop->index + 1 }} {
    content: url("/post_images/{{ $gallery->name }}")
  }
  @endforeach
  .image-placeholder{
    content: url("/image/tourism_cheraw.png")
  },
	</style>
@endsection

@section('scripts')
    <script>
    //JS to switch slides and replace text in bar//
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("description");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" opacity-100", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " opacity-100";
    }
  </script>
@endsection
