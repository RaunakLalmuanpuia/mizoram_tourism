<div>
  <x-jet-dialog-modal wire:model="otpConfirmed">
    <x-slot name="title">
      <div class="text-xl font-bold mb-4 text-black">
        Congratulations!
        <br>
        OTP Verified successfully
      </div>
    </x-slot>
    <x-slot name="content">
      <div class="border border-dashed pt-2 p-10 text-black">
        <input wire:model="name" type="text" class="border w-full mt-4 p-2 border-signup-border" placeholder="Name">
         @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        <input wire:model="email" type="email" class="border border-signup-border w-full mt-4 p-2" placeholder="Email" {{ $type == 'email' ? 'disabled' : '' }} value="{{ $email }}">
         @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        <input wire:model="phone" type="text" class="border border-signup-border w-full mt-4 p-2" placeholder="Phone" {{ $type == 'phone' ? 'disabled' : '' }} value="{{ $phone }}">
         @error('phone') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
         <br><br>
         <div class="flex items-center">
            <input wire:model="pledged" id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I <a class="text-blue-500" href="{{ Route('takePledge') }}">pledged</a> to be a responsible traveller.</label>
        </div>
         <br>
        <button {{ $pledged ? '' : 'disabled'}} wire:click.prevent="registerUser" class="bg-colorx text-white w-1/2 font-bold rounded-full p-2 mt-4">
          <div wire:loading.remove wire:target="registerUser" class="">
            Save & Continue
          </div>
          <div wire:loading wire:target="registerUser" class="">
            Saving...
          </div>
        </button>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
</div>
