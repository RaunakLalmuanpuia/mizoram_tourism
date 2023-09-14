@extends('layouts.layout')
@section('contents')
<div class="container mx-auto my-4">
  <div class="text-3xl my-4">Frequently Asked Questions</div>
  <div id="accordion-collapse" data-accordion="collapse">
    @foreach ($faqs as $faq)
    <h2 id="accordion-collapse-heading-{{ $loop->index +1 }}">
      <button type="button" class="{{ $loop->index == 0 ? 'flex justify-between items-center p-5 w-full font-medium text-left rounded-t-xl border border-b-0 border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white' : 'flex justify-between items-center p-5 w-full font-medium text-left text-gray-500 border border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }} {{ $loop->index == count($faqs) - 1 ? '' : 'border-b-0' }}" data-accordion-target="#accordion-collapse-body-{{ $loop->index +1 }}" aria-expanded="{{ $loop->index == 0 ? 'true' : 'false' }}" aria-controls="accordion-collapse-body-{{ $loop->index +1 }}">
        <span>{{ $faq->question }}</span>
        <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-{{ $loop->index +1 }}" class="{{ $loop->index == 0 ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-{{ $loop->index +1 }}">
      <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq->answer }}</p>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
