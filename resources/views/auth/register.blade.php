<x-guest-layout>
  <x-register-card>
    <x-slot name="logo">
      <img src="/image/nav_head.png" alt="tourism logo" class="w-2/5 mx-auto">
    </x-slot>
    <x-jet-validation-errors class="mb-4" />
    <x-slot name="slot">
      <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="">
          <div>
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          </div>
  
          <div class="mt-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
          </div>
  
          <div class="mt-4">
            <x-jet-label for="registerType" value="{{__('Register As') }}" />
            <div>
              <select name="role" id="registerType" class="block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                <option value="lodge">Lodge</option>
                <option value="hotel">Hotel</option>
                <option value="government_lodge">Government Lodge</option>
                <option value="outsourced_lodge">Outsourced Lodge</option>
                <option value="inn">Inn</option>
                <option value="private_lodge">Private Lodge</option>
                <option value="guesthouse">Guesthouse</option>
                <option value="homestay">Homestay</option>
                <option value="caravan">Caravan</option>
              </select>
            </div>
          </div>
          <div class="mt-5">
            <x-jet-label for="registerType" value="{{__('District') }}" />
            <div>
              <select name="district_id" id="registerType" class="block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="mt-4">
            <x-jet-label for="phone" value="{{ __('Phone') }}" />
            <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="Phone" />
          </div>
        </div>
        <div class="">
          <div>
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <textarea required name="address" id="address" cols="30" rows="8" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('address')"></textarea>
          </div>
  
          <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
          </div>
  
          <div class="mt-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
          </div>
  
          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
              <x-jet-label for="terms">
                <div class="flex items-center">
                  <x-jet-checkbox name="terms" id="terms"/>
                  <div class="ml-2">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                      'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                      'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                    ]) !!}
                  </div>
                </div>
              </x-jet-label>
            </div>
          @endif
        </div>
      </div>
      <div class="flex items-center justify-center mt-4">
        <x-jet-button class="ml-4">
          {{ __('Register') }}
        </x-jet-button>
      </div>
      <div class="text-center mt-4">
          Already registered? Click <a class="underline font-bold text-gray-600 hover:text-gray-900" href="{{ route('login') }}">Here</a> to login
        </a>
      </div>
    </form>
    </x-slot>
  </x-register-card> 
</x-guest-layout>
