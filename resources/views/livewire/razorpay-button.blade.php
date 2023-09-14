<div>
    <form
        action="{{ route('savePayment', ['bookingData' => $bookingData,'guests' => $guests,'specialRequest' => $specialRequest]) }}"
        method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="{{ $bookingData['amount'] * 100 }}" data-currency="INR" data-buttontext="Make Payment"
                data-name="Mizoram Toursim" data-description="Lodge Booking" data-image="https://mizoramtourism.com/favicon.png"
                data-prefill.name="{{ Auth::user()->name }}" data-prefill.email="{{ Auth::user()->email }}"
                data-prefill.contact="{{ Auth::user()->phone }}" data-theme.color="#4a4a4a">
        </script>
    </form>
</div>
