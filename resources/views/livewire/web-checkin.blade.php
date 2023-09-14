<div class="mx-auto mt-4">
  @if (session()->has('message'))
    <div class="bg-green-500 p-4 w-full text-center font-extrabold text-white">
      {{ session('message') }}
    </div>
  @endif
  <img src="/image/tourismlogo.png" alt="logo" class="mx-auto w-44">
  <form wire:submit.prevent="save" class="p-5">
    <div class="border p-4">
      <p class="text-center mb-10">Please enter your name, branch name and contact number</p>
      <div class="text-center">
        <div class="form-floating mb-3 w-full">
          <input required wire:model="name" type="text" class="form-control w-full text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="name" placeholder="Name">
          @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
        </div>
        <div class="form-floating mb-3 w-full">
          <input required wire:model="address" type="text" class="form-control w-full text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="address" placeholder="YMA Branch Name">
          @error('address') <span class="text-red-400">{{ $message }}</span> @enderror
        </div>
        <div class="form-floating mb-3 w-full">
          <input required wire:model="contact" type="number" class="form-control w-full text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="contact" placeholder="Contact">
          @error('contact') <span class="text-red-400">{{ $message }}</span> @enderror
        </div>
        <div class="form-floating mb-3 w-full">
          <button type="submit" class="w-full bg-green-800 hover:bg-green-700 text-white py-2">Submit</button>
        </div>
      </div>
    </div>
  </form>
</div>
