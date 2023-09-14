@extends('layouts.layout')
@section('contents')
<form action="/deposit-paytm" method="post">
  @csrf
  <div class="mx-auto my-4 w-2/6 min-h-screen">
    <div class="text-2xl text-center font-bold">Deposit To Paytm</div>
    <div class="rounded border border-gray-300 text-center">
      <div class="my-4 mx-4">
        <div class="">
          <label for="amount" class="w-full">Please enter the amount you want to deposit for refund</label>
          <input required name="amount" type="number" id="amount" class="rounded border border-gray-200 px-2 py-4 w-full" value="1" min="1">
        </div>
        <div class="">
          <button class="px-4 py-2 mt-4 text-white bg-green-500 hover:bg-green-400">Deposit</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection