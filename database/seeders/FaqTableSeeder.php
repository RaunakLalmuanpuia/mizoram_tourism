<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faqs = [
      [
        'question' => 'How do I know if my booking was successful?',
        'answer' => 'You will receive an SMS and email confirmation through your registered phone number and email id.'
      ],
      [
        'question' => 'Do I need to confirm my booking?',
        'answer' => 'Once, payment is succeed, that means your booking is confirm. '
      ],
      [
        'question' => 'I didn\'t get an email confirmation. What do I do?',
        'answer' => 'You can check from “My booking” through your account.'
      ],
      [
        'question' => 'How long will it take for the hotel to get my booking information?',
        'answer' => 'It will be immediate'
      ],
      [
        'question' => 'How do I get a receipt or invoice for my Lodge booking?',
        'answer' => 'Through your register email ID'
      ],
      [
        'question' => 'Do I have to show ID proof at the time of check-in?',
        'answer' => 'Upon arrival, the room/accommodation I was given did not match what I booked. What should I do?'
      ],
      [
        'question' => 'How long does it take to process cancellation refund?',
        'answer' => '2-3 working days'
      ],
      [
        'question' => 'How can I request an invoice?',
        'answer' => 'At the time of booking, you will receive your booking invoice through your registered email ID'
      ],
      [
        'question' => 'Where can I confirm that I\'ve paid for my booking?',
        'answer' => 'Confirmation will be sent your registered email ID and in SMS, also stored in your account “My Booking”'
      ],
      [
        'question' => 'Where can I see the Return policy for my booking?',
        'answer' => 'In footer section “Return Policy” or click here'
      ],
      [
        'question' => 'I\'ve been charged. Do I need to do anything?',
        'answer' => 'Will I need to pay anything additional upon arrival?'
      ],
      [
        'question' => 'What does the price include?',
        'answer' => 'Reservation of the room. Food and other amenities are extra charged on location.'
      ],
      [
        'question' => 'Can I make a reservation without a credit/debit card?',
        'answer' => 'Yes, you can. We provide our Lodges contact number in each details page. Feel free to enquire your doubt. '
      ],
      [
        'question' => 'I am entering my credit/dedit card details, when will I pay?',
        'answer' => 'No, you have to enter OTP after that and only pay'
      ],
    ];

    foreach ($faqs as $faq) {
      Faq::create($faq);
    }
  }
}
