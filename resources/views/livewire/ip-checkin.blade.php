<div>
  <div class="mx-auto mt-4">
  @if (session()->has('message'))
    <div class="bg-green-500 p-4 w-full text-center font-extrabold text-white">
      {{ session('message') }}
    </div>
  @endif
</div>
