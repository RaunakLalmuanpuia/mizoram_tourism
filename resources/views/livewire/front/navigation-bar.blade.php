<div>
  <nav x-data="{ open: false }" class="relative bg-charcoal-black text-white">
    <div class="container mx-auto justify-between hidden md:flex">
      <ul class="flex content-center items-center">
        <li class="">
          <a href="/">
            <img width="150" src="/image/nav_head.png" alt="icon" />
          </a>
        </li>
        <li class="hoverable mt-auto">
          <a href="#" class="block px-4 text-sm lg:text-base font-bold border-b-[3px] border-charcoal-black hover:border-b-[3px] hover:border-tourism-green">
            <div class="flex flex-row">
              <span>
                Places to Visit
              </span>
              <span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z" fill="currentColor"/>
              </svg>
            </span>
          </div>
          </a>
          <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
            <div class="container mx-auto w-full grid grid-cols-4 gap-4">
              @foreach ($districts as $district)
                <a href="{{ route('placeToVisit', $district->id) }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                  <div class="flex items-center">
                    <h3 class="font-bold text-xl text-white text-bold mb-2">
                      {{ $district->district_name }}
                    </h3>
                  </div>
                  <p class="text-gray-100 text-sm">
                    {{ substr($district->description, 0, 50,) }}
                  </p>
                </a>
              @endforeach
            </div>
          </div>
        </li>
        <li class="hoverable mt-auto">
          <a href="#" class="block px-4 text-sm lg:text-base font-bold border-b-[3px] border-charcoal-black hover:border-b-[3px] hover:border-tourism-green">
            <div class="flex flex-row">
              <span>
                Things to Do
              </span>
              <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z" fill="currentColor"/>
                </svg>
              </span>
            </div>
          </a>
          <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
            <div class="container mx-auto w-full grid grid-cols-4 gap-4">
              @foreach ($tags as $tag)
              <a href="{{ Route('thingsToDo', $tag->name) }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    {{ $tag->name }}
                  </h3>
                </div>
                @endforeach
              </a>
            </div>
          </div>
        </li>
        <li class="hoverable mt-auto">
          <a href="#" class="block px-4 text-sm lg:text-base font-bold border-b-[3px] border-charcoal-black hover:border-b-[3px] hover:border-tourism-green">
            <div class="flex flex-row">
              <span>
                Plan your Trip
              </span>
              <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z" fill="currentColor"/>
                </svg>
              </span>
            </div>
          </a>
          <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
            <div class="container mx-auto w-full grid grid-cols-4 gap-4">
              <a href="{{ Route('howToGetToMizoram') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    How to get to Mizoram
                  </h3>
                </div>
              </a>
              <a href="{{ Route('getFestivals') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Festivals
                  </h3>
                </div>
              </a>
              <a href="{{ Route('tourGuides') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Tour Guides
                  </h3>
                </div>
              </a>
              <a href="{{ Route('hotelAccomodations') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Hotel & Accommodation
                  </h3>
                </div>
              </a>
              <a href="{{ Route('restaurants') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Restaurant
                  </h3>
                </div>
              </a>
              <a href="{{ Route('travelAgent') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Travel Agents
                  </h3>
                </div>
              </a>
              <a href="{{ Route('getTourOperators') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Tour Operators
                  </h3>
                </div>
              </a>
              <a href="{{ Route('rentACar') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Car Rentals & Taxi
                  </h3>
                </div>
              </a>
            </div>
          </div>
        </li>

        <li class="hoverable mt-auto">
          <a href="#" class="block px-4 text-sm lg:text-base font-bold border-b-[3px] border-charcoal-black hover:border-b-[3px] hover:border-tourism-green">
            <div class="flex flex-row">
              <span>
                Responsible Tourism
              </span>
              <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z" fill="currentColor"/>
                </svg>
              </span>
            </div>
          </a>
          <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
            <div class="container mx-auto w-full grid grid-cols-4 gap-4">
              <a href="{{ Route('takePledge') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Take Pledge
                  </h3>
                </div>
              </a>
              <a href="{{ Route('getEnvironment') }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    Initiative
                  </h3>
                </div>
              </a>
            </div>
          </div>
        </li>

        <li class="hoverable mt-auto">
          <a href="#" class="block px-4 text-sm lg:text-base font-bold border-b-[3px] border-charcoal-black hover:border-b-[3px] hover:border-tourism-green">
            <div class="flex flex-row">
              <span>
                About
              </span>
              <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.34317 7.75732L4.92896 9.17154L12 16.2426L19.0711 9.17157L17.6569 7.75735L12 13.4142L6.34317 7.75732Z" fill="currentColor"/>
                </svg>
              </span>
            </div>
          </a>
          <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
            <div class="container mx-auto w-full grid grid-cols-4 gap-4">
              @foreach ($aboutUs as $about)
              <a href="{{ Route('about', $about) }}" class="px-4 pb-6 pt-6 lg:pt-3 border-b border-light-gray hover:border-b hover:border-tourism-green">
                <div class="flex items-center">
                  <h3 class="text-white">
                    {{ $about->things_to_do }}
                  </h3>
                </div>
              </a>    
              @endforeach
            </div>
          </div>
        </li>
      </ul>
      <ul class="flex content-center items-center">
        @if(!Auth::user())
        <li class="relative block py-6 lg:pt-4 lg:pl-4 text-sm lg:text-base font-bold">
          @livewire('front.login-signup')
        </li>
        @endif
        <li class="relative block py-6 lg:pt-4 lg:pl-4 text-base font-bold mt-1 overflow-hidden">
          <a href="{{ Route('booking') }}" class="relative items-center justify-start inline-block overflow-hidden rounded-full group pl-6 pr-6 pt-2 pb-2">
            <span class="w-32 h-32 rotate-45 translate-x-12 -translate-y-2 absolute left-0 top-0 bg-colorx opacity-[3%]"></span>
            <span class="absolute top-0 left-0 w-48 h-48 -mt-1 transition-all duration-500 ease-in-out rotate-45 -translate-x-56 -translate-y-24 bg-colorx opacity-100 group-hover:-translate-x-8"></span>
            <span class="relative w-full text-left text-colorx transition-colors duration-200 ease-in-out group-hover:text-white">Booking</span>
            <span class="absolute inset-0 border-2 border-colorx rounded-full"></span>
          </a>
        </li>
        <li class="relative block py-6 lg:pt-4 lg:pl-4 text-sm lg:text-base font-bold">
          <button class="button rounded-lg text-white pt-1 pb-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </li>
        @if (Auth::user())
        <li class="relative block py-6 lg:pt-4 lg:pl-4 text-sm lg:text-base font-bold">
          <x-jet-dropdown align="right">
            <x-slot name="trigger">
              <button class="button rounded-lg text-white pt-1 pb-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-jet-dropdown-link href="{{ Route('myBookings') }}">My Bookings</x-jet-dropdown-link>
              <x-jet-dropdown-link href="{{ Route('myProfile') }}">Profile</x-jet-dropdown-link>
              <x-jet-dropdown-link class="hover:cursor-pointer" wire:click="logout">
                  Logout
              </x-jet-dropdown-link>
            </x-slot>
          </x-jet-dropdown>
        </li>
        @endif
      </ul>
    </div>
    <div class="flex md:hidden bg-charcoal-black text-white p-4">
      <div class="grid grid-cols-2 w-full">
        <div class="flex-col">
          <a href="/">
            <img src="/image/nav_head.png" alt="icon" class="object-cover h-14" />
          </a>
        </div>
        <div class="flex-col ml-auto">
          <div class="flex md:hidden items-center">
            <button @click="open = ! open" class="outline-none mobile-menu-button">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 24 24" style=" fill:#ffffff;">
                <path d="M 2 5 L 2 7 L 22 7 L 22 5 L 2 5 z M 2 11 L 2 13 L 22 13 L 22 11 L 2 11 z M 2 17 L 2 19 L 22 19 L 22 17 L 2 17 z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden z-50 absolute bg-charcoal-black w-full">
      <div class="pt-2 pb-3 space-y-1">
        <x-jet-responsive-nav-link href="{{ Route('placesToVisit') }}" :active="request()->routeIs('placesToVisit')">
          Places to Visit
        </x-jet-responsive-nav-link>
        <x-jet-responsive-nav-link href="{{ Route('thingsToDoList') }}" :active="request()->routeIs('thingsToDoList')">
          Things to Do
        </x-jet-responsive-nav-link>
        <x-jet-responsive-nav-link href="{{ Route('planYourTrip') }}" :active="request()->routeIs('planYourTrip')">
          Plan your Trip
        </x-jet-responsive-nav-link>
        <x-jet-responsive-nav-link href="{{ Route('aboutUs') }}" :active="request()->routeIs('aboutUs')">
          About
        </x-jet-responsive-nav-link>
        <x-jet-responsive-nav-link href="{{ Route('booking') }}" :active="request()->routeIs('booking')">
          Booking
        </x-jet-responsive-nav-link>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-light-gray">
        <div class="mt-3 space-y-1">
          <!-- Account Management -->
          @if (Auth::user())
            <x-jet-responsive-nav-link href="{{ route('myProfile') }}" :active="request()->routeIs('myProfile')">
              Profile
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('myBookings') }}">My Bookings</x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link wire:click="logout">
              Log Out
            </x-jet-responsive-nav-link>
          @else
          <div class="pl-4 hover:bg-white font-extrabold hover:text-black p2">
            @livewire('front.login-signup')
          </div>
          @endif
        </div>
      </div>
    </div>
  </nav>
</div>