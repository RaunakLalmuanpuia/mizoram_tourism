<div class="mb-10">
  <div class="grid grid-cols-2 gap-4">
    <div class="mt-10">
      <div class="text-2xl font-kushan mb-5">Update my profile</div>
      <div class="w-full border border-card-border p-4">
        <form wire:submit.prevent="updateProfile">
          @if ($existingPhoto == false)
          <img class="rounded-full h-20 w-20" src="{{ $avatar != null ? $avatar->temporaryUrl() : '/image/placeholder.jpeg' }}">
          @else
          <img class="rounded-full h-20 w-20" src="{{ $avatar == Auth::user()->profile_photo_path ? asset('/storage/'.Auth::user()->profile_photo_path) : $avatar->temporaryUrl() }}">
          @endif

          <input type="file" name="" id="" class="w-full" wire:model="avatar">
          <div class="grid grid-cols-1 mt-5">
            <div class="relative z-0 mb-6 w-full group">
              <input type="text" name="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required wire:model="name" />
              <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>
          </div>
          <div class="grid grid-cols-2 mt-2 gap-2">
            <div class="relative z-0 mb-6 w-full group">
              <input type="text" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required wire:model="email" />
              <label for="email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
              <input type="text" name="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required wire:model="phone" />
              <label for="phone" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
            </div>
          </div>
          <div class="grid grid-cols-1 mt-2">
            <div class="relative z-0 mb-6 w-full group">
              <textarea name="address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " wire:model="address"></textarea>
              <label for="address" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>
            </div>
          </div>
          <div class="mt-5 text-right">
            <button type="submit" class="rounded-full bg-colorx text-white p-2 pl-4 pr-4 font-extrabold">
              <div class="" wire:loading.remove wire:target="updateProfile">
                Update
              </div>
              <div class="" wire:loading wire:target="updateProfile">
                Updating...
              </div>
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="mt-10">
      <div class="text-2xl font-kushan mb-5">My Bookings</div>
    </div>
  </div>
</div>
