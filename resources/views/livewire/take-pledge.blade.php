<div>
  @if ($pledged == false)
  <button wire:click="takeAPledge" class="text-white bg-colorx rounded-full p-2 pl-4 pr-4">Take a pledge</button>
  @else
  <img src="/image/pledged.png" alt="">
  @endif
  <x-jet-dialog-modal wire:model="successfulPledge">
    <x-slot name="title"></x-slot>
    <x-slot name="content">
      <div class="text-center mt-20 mb-20">
        <img src="/image/tick.png" alt="" class="mx-auto h-20 w-20">
        <div class="font-bold text-xl">Successful</div>
        <div class="">Pledged Successfully</div>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
</div>
