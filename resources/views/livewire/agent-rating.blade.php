<div>
  <div class="mt-10 mb-10">
    <div class="font-kushan text-center text-4xl">List of Travel Agents</div>
    <div class="text-center text-sm">{{ count($agents) }} Agent{{ count($agents) == 1 ? '' : 's' }}</div>
  </div>
  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4">
    @foreach ($agents as $agent)
      <div wire:click="onGuideClick({{$agent}})" class="flex flex-row justify-between border border-card-border hover:shadow-xl pt-4 p-2 hover:cursor-pointer hover:scale-105 transition duration-300 ease-in-out">
        <div class="flex-col">
          <div class="flex flex-row">
            <div class="flex-col p-2"><img src="/image/travel_agents.png" alt="guide" class="h-10 w-10"></div>
            <div class="flex-col">
              <div class="font-bold text-xl">{{ $agent->name }} <span class="text-orange rounded-full bg-[#fff8ed] text-sm pl-2 pr-2">{{ $agent->average_ratings }} &#9733;</span></div>
              <div class="text-colorx text-[10px] bg-reg-background rounded-full pl-1 pr-1 text-center">{{ $agent->license }}</div>
              <div class="mt-4">
                <ul>
                  <li class="location" data-address="{{ $agent->address }}" data-agent-name="{{ $agent->name }}">
                    {{ $agent->address }}
                 </li>
                  <li class="phone">
                    <!-- Add a unique ID to the phone number element -->
                    @if (!is_null( $agent->phone_one))
                    <span id="phone-one-{{ $agent->id }}" class="click-to-copy">{{ $agent->phone_one }}</span>
                    @endif  
                </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
    <div class="mt-4">
      {{ $agents->links() }}
    </div>

    <x-jet-dialog-modal wire:model="ratingDialog">
    <x-slot name="title">
      <div class="text-xl font-bold mb-4 text-black">
        Travel Agent
      </div>  
    </x-slot>
    <x-slot name="content">
      <div class="grid grid-cols-2">
        <div class="">
          <div class="flex flex-row">
            <div class="flex-col p-2">
              <img src="/image/travel_agents.png" alt="guide" class="h-10 w-10">
            </div>
            <div class="flex-col">
              <div class="font-bold text-xl">
                {{ $selectedAgent != null ? $selectedAgent['name'] : $agent->name }}
              </div>
              <div class="text-colorx text-[10px] bg-reg-background rounded-full pl-1 pr-1">{{ $selectedAgent != null ? $selectedAgent['license'] : $agent->license }}</div>
              <div class="mt-4">
                <ul>
                  <li class="location">{{ $selectedAgent != null ? $selectedAgent['address'] :$agent->address }}</li>
                  <li class="phone">{{ $selectedAgent != null ? $selectedAgent['phone_one'] : $agent->phone_one }} </li>
                    @if (!is_null(  $agent->phone_two ))
                        <li class="phone"> {{ $selectedAgent != null ? $selectedAgent['phone_two'] : $agent->phone_two }}</li>
                    @endif
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <div class="text-gray-400">OVERALL RATING</div>
          <div class="text-orange text-4xl font-bold text-center">{{ $selectedAgent != null ? $selectedAgent['average_ratings'] : $agent->average_ratings }} <span class="text-xl">&#9733;</span></div>
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
      const agentElements = document.querySelectorAll('.location');

      agentElements.forEach(function (element) {
          element.addEventListener('click', function () {
              const agentName = element.getAttribute('data-agent-name');
              const address = element.getAttribute('data-address');
              const googleMapsUrl = `https://www.google.com/maps/search/${encodeURIComponent(agentName + ' ' + address)}`;
              window.open(googleMapsUrl, '_blank');
              event.stopPropagation();
          });
      });

      const phoneElements = document.querySelectorAll('.click-to-copy');

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
              event.stopPropagation();
          });
      });
  });
</script>

