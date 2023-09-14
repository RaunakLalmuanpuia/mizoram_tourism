@extends('layouts.layout')
@section('contents')
  <div class="container mx-auto mt-20">
    <div class="w-1/2">
      <div class="font-kushan text-3xl ml-10">REFUND & CANCELLATION</div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">RESERVATION</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Please make advance reservation via telephone or book online to ensure room availability.</li>
            <li>Advance in Cash or deposit /online Payment is mandatory to obtain the confirmed reservation. Please read the cancellation policy before obtaining the confirmed reservation.</li>
            <li>Rates displayed online are not guaranteed until the confirmation voucher is generated. The rates are generally dynamic in nature. Once a rate is selected and transaction is executed by you, no other rate is applicable either higher or lower and enforce no refund is admissible.</li>
            <li>The estimated cost for stay includes the confirmed room rate, the estimated taxes, and estimated fees.</li>
            <li>The actual taxes, fees and cess prevalent at the time of stay shall be applicable, which may vary from the estimates and you are liable to pay any extra cost on account of such amendments in taxes, fees, cess etc.</li>
            <li>Currency conversions are estimates and are provided as information only. The bill on check out for stay shall be charged in the local currency.</li>
            <li>We reserve the right to modify or cancel the reservation if it appears, at sole discretion of the management, that a guest is engaged in fraudulent, illegal or other inappropriate activity or the reservation is obtained fraudulently or with malafide intention or mistake or error.</li>
            <li>On check in to the property, please present the property reservation confirmation voucher along with valid photo ID or Passport, Photo PAN Card, Election Identity Card, Photo driving license, or any photo ID card issued by Central/ State government and a valid credit card for any incidental and/ or extra charges.</li>
            <li>All promotion/sale rates are restrictive fares and are non-refundable. Certain promotion/sale Rates do not permit any changes in the property booking. Please check restrictions on the rate while booking. Under all promotion(s)/sale rates, limited inventory is available on select Room type(s) only on first come first served basis. Mizoram Tourism reserves the right to withdraw and/or amend the promotion/sale without any prior notice.</li>
            <li>All extra services & amenities not part of this offer will be available at an on additional charge only.</li>
            <li>This offer cannot be combined with any other offer/promotion or benefit(s) available through any loyalty program run by Mizoram Tourism or any third party.</li>
            <li>In case of non-availability of pre-booked room at the time of arrival, the property will offer an alternate similar standard hotel/ in a similar room type, at its discretion and without any further liability.</li>
            <li>Rates may change without notice and may vary for special events except for confirmed reservation against the advance payment.</li>
            <li>All rates are subject to prevailing local taxes as applicable on room tariff & services opted.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">OCCUPANCY</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Normal occupancy permits maximum two people per room. Additional person (if room size permits) is charge extra as per prevalent rate of the property.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">DEPOSIT/ONLINE PAYMENT</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>The deposit/online payment to be paid in advance equivalent to total room nights booked for the entire stay to get the confirmed reservation.</li>
            <li>We accept deposit only against the Maestro, Visa and MasterCard. For any alternate mode of payment, please contact the property's reservations.</li>
            <li>Corporate reservations need to be secured by a company credit card. For any alternate mode of payment, please contact Mizoram Tourism.</li>
            <li>Group bookings of four or more rooms require cancellation notice to refund the deposit as specified in cancellation & early checkout policy.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">CANCELLATION AND EARLY CHECKOUT POLICY</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>In case your plans change, ensure to inform in writing the cancellation/ amendments in plan to the Reservation for a refund of your deposit. The guidelines in this regards as under:-</li>
            <li>The modification/cancellation request for bookings made online will be processed automatically through the Internet Booking Engine. Any refund due shall be done through the system in accordance with the applicable modification/cancellation rules. In case of rebooking, a rate difference may be payable for the change as per the rate applicable for the rebooked date/ room type and subject to availability.</li>
            <li>Any additional charges or rate difference for the modified reservation can be paid through the same payment mode/card as used for original reservation.</li>
            <li>Please note that if an online booking is modified or cancelled with the reservations Office/ sales office, it cannot be further modified or cancelled online.</li>
            <li>The refund of the reservation done by the Travel Agent will be processed by the issuing Travel Agent only and no refund admissible online.</li>
            <li>In the event of cancellation of non-cancellable booking (s), the client shall not be refunded the amount paid towards making the reservation(s).</li>
            <li>In case of early checkout, you are liable to pay for the entire confirmed reservation. If not sure of the policy, contact the management for clarification.</li>
            <li>Please note for reservation of more than one room in that case all rooms are determined as "reserved nights". For example, two (2) rooms reserved for four (4) nights would be (8) reserved nights, hence to such (8) reserved nights applicable cancellation period is 72 hours.</li>
          </ul>
          <div class="p-5">
            <i><b>The cancellation applicable as under:</b></i>
            <br>
            <br>
            <table class="table table-auto w-full text-center">
              <thead>
                <tr class="border-b border-whitish-gray border-opacity-30">
                  <th class="border-r">Reserved Room<br>Nights(No.)</th>
                  <th>Cancellation Period<br>prior to arrival</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-whitish-gray border-opacity-30">
                  <td class="p-4 border-r">4</td>
                  <td>48 hours</td>
                </tr>
                <tr class="border-b border-whitish-gray border-opacity-30">
                  <td class="p-4 border-r">4-9</td>
                  <td>72 hours</td>
                </tr>
                <tr class="border-b border-whitish-gray border-opacity-30">
                  <td class="p-4 border-r">9 & above</td>
                  <td>7 days</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">REFUND POLICY</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>On cancellation of refundable booking the refund processing will take time between two(2)-to four(4) weeks to show refund back on your credit card statement. Reasons for the specified processing time are based on billing cycle of your credit card company and processing time of the bank. The refund depends on numerous factors such as the  cancellation policy, time of cancellation and processing fees etc. For more details refer to the cancellation policy mentioned above.</li>
            <li>In case the reservation is not confirmed, we will not charge you anything on your credit card and release the whole amount if any that was held on it immediately. Now after we do this, it will still take two(2) to four(4) weeks for the bank to process the refund and to show the refunded amount on your credit card.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">CHECK IN</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Normal check in time is 2:00 PM. For late arrivals, please call for instructions on the procedure for arrival after 6 PM.</li>
            <li>Check-out is at 12 Noon.</li>
            <li>Early check-in and check-out is available by prior arrangement only i.e. subject to availability and prior intimation & confirmation only.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">MODIFICATION</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Any modification in the reservation is subject to availability at the time of making such a request.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">CHILDREN AND INFANTS</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Child (up to 5 years) can stay free of charge with parents without extra bed.</li>
            <li>Children between 5 years to 12 years of age will be charged extra.</li>
            <li>Children above 12 years of age will be treated as young adults and the prevalent reservation charges will be applicable and levied.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">NON-ARRIVAL TO THE PROPERTY (NO SHOW)</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>If you fail to arrive at the property on the arrival date the entire reservation will be cancelled automatically by the properties and will be charged for the entire reservation.</li>
            <li>If you fail to check in on the first date but still continue your travel plan to stay at the property, please, urgently, contact us to keep the room for you for the rest of the nights. Otherwise as mentioned above, the entire reservation will be auto-cancelled and no refund admissible.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">SHORTENED STAY (EARLY CHECK-OUT)</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Shortened stay is subject to entire period charge whether or not you stay the entire period. If you know the change in your plan, please contact us at the earliest to minimize the charge by the property subject to cancellation policy.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">SPECIAL REQUEST</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>Please note that management neither guarantees nor liable to admit any request for amendment in plan or any other special requests which shall be admissible subject to availability on arrival.</li>
            <li>The request for airport pick-up requires intimation to the reservation at the time of the room(s) booking.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">CONFIRMATION VOUCHER OR CODE</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>The reservation once confirmed, a confirmation number and the code or voucher is generated that you can print for your convenience.</li>
            <li>It is necessary to present the confirmation code or voucher to the property on arrival. On failure to produce the confirmation code or voucher may result in the property not honoring your reservation unless the property is able to trace & match the excess in the reservation system.</li>
          </ul>
        </div>
      </div>
      <div class="mt-5 mb-5">
        <div class="font-bold text-lg">PAYMENT SECURITY</div>
        <div class="mt-2">
          <ul class="list-disc">
            <li>It is important to know that whenever you provide the personal details or credit card information, it is secured. Your credit card number, name, address, and telephone number are protected by the latest security technology.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection