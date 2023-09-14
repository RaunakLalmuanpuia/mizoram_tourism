<div>
  <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-7 p-4">
      @foreach ($guides as $guide)
      <div wire:click="onGuideClick({{$guide}})" class="flex flex-row border justify-between border-card-border hover:shadow-xl pt-4 p-2 pb-7 hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex-col">
          <div class="flex flex-row">
            <div class="flex-col p-2"><img src="/image/guides.png" alt="guide" class="h-10 w-10"></div>
            <div class="flex-col">
              <div class="font-bold text-xl">{{ $guide->name }} <span class="text-orange rounded-full bg-[#fff8ed] text-sm pl-2 pr-2">{{ $guide->average_ratings }} &#9733;</span></div>
              <div class="text-colorx text-[10px] bg-reg-background rounded-full pl-1 pr-1 w-1/2">
                {{ $guide->license }}
              </div>
              <div class="mt-4">
                <ul>
                  <li class="location">{{ $guide->address }}</li>
                  <li class="phone">{{ $guide->phone_one }}</li>
                  @if (!is_null($guide->phone_two))
                    <li class="phone">{{ $guide->phone_two }}</li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="mt-4">
      {{ $guides->links() }}
    </div>
  <x-jet-dialog-modal wire:model="ratingDialog">
    <x-slot name="title">
      <div class="text-xl font-bold mb-4 text-black">
        Tour Guide
      </div>  
    </x-slot>
    <x-slot name="content">
      <div class="grid grid-cols-2">
        <div class="">
          <div class="flex flex-row">
            <div class="flex-col p-2">
              <img src="/image/guides.png" alt="guide" class="h-10 w-10">
            </div>
            <div class="flex-col">
              <div class="font-bold text-xl">{{ $selectedGuide != null ? $selectedGuide['name'] : $guide->name }}</div>
              <div class="text-colorx text-[10px] bg-reg-background rounded-full pl-1 pr-1">{{ $selectedGuide != null ? $selectedGuide['license'] : $guide->license }}</div>
              <div class="mt-4">
                <ul>
                  <li class="location">{{ $selectedGuide != null ? $selectedGuide['address'] :$guide->address }}</li>
                  <li class="phone">{{ $selectedGuide != null ? $selectedGuide['phone_one'] : $guide->phone_one }} / {{ $selectedGuide != null ? $selectedGuide['phone_two'] : $guide->phone_two }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <div class="text-gray-400">OVERALL RATING</div>
          <div class="text-orange text-4xl font-bold text-center">{{ $selectedGuide != null ? $selectedGuide['average_ratings'] : $guide->average_ratings }} <span class="text-xl">&#9733;</span></div>
        </div>
      </div>
      <div class="text-center bg-gray-200 p-4">
        Give Rating
        <div class="">
          <div class="text-orange">
            @for ($i = 0; $i < $userRating; $i++)
            <span class="text-2xl hover:cursor-pointer" wire:click="onRatingClicked({{ $i + 1 }})">&#9733;</span>    
            @endfor
            @for ($i = 0; $i < 5 - $userRating; $i++)
            <span class="text-2xl hover:cursor-pointer" wire:click="onRatingClicked({{ $i + $userRating + 1 }})">&#9734;</span>
            @endfor
          </div>
          <textarea wire:model="review" name="" id="" cols="30" rows="4" class="bg-gray-200" placeholder="Review"></textarea>
        </div>
        <button class="bg-colorx p-2 pr-4 pl-4 text-white" wire:click="giveRating">Rate Now</button>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const addressElements = document.querySelectorAll('.location');
      const phoneElements = document.querySelectorAll('.phone');
      const ratingDialog = document.querySelector('.rating-dialog');

      // addressElements.forEach(function (element) {
      //     element.addEventListener('click', function () {
      //         const address = element.innerText;
      //         const googleMapsUrl = `https://www.google.com/maps/search/${encodeURIComponent(address)}`;
      //         window.open(googleMapsUrl, '_blank');

      //         // Prevent the modal from opening when the address is clicked
      //         event.stopPropagation();
      //     });
      // });

      phoneElements.forEach(function (element) {
          element.addEventListener('click', function () {
              const phoneNumber = element.innerText;
              const textArea = document.createElement('textarea');
              textArea.value = phoneNumber;
              document.body.appendChild(textArea);
              textArea.select();
              document.execCommand('copy');
              document.body.removeChild(textArea);

              // Optionally, you can display a notification to the user
              alert('Phone number copied to clipboard: ' + phoneNumber);

              // Prevent the modal from opening when the phone number is copied
              event.stopPropagation();
          });
      });
  });
</script>

