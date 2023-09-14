<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousal;
use App\Models\DistrictMetaData;
use App\Models\DistrictTopDestination;
use App\Models\Faq;
use App\Models\Information;
use App\Models\Mizoram;
use App\Models\Notice;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;

class HomePageController extends Controller
{
  public function index()
  {
    $districts = DistrictMetaData::get();
    $topDestinationsCount = DistrictTopDestination::count();
    $topDestinations = DistrictTopDestination::with('districtMetaData')->get()->random($topDestinationsCount < 3 ? $topDestinationsCount : 3);
    $newsEvents = Notice::latest()->take(3)->get();
    $mizoram = Mizoram::first();
    $carousels = Carousal::where('status', 1)->get();
    return view('welcome', ['districts' => $districts, 'topDestinations' => $topDestinations, 'newsEvents' => $newsEvents, 'mizoram' => $mizoram, 'carousels' => $carousels]);
  }

  public function placeToVisit($id)
  {
    $districts = DistrictMetaData::where('id', '!=', $id)->get();
    $district = DistrictMetaData::where('id', $id)->with('districtTopDestination')->first();
    return view('front.district', ['district' => $district, 'districts' => $districts]);
  }

  public function thingsToDo($item)
  {
    return view('front.thingsToDo', ['activity' => $item]);
  }

  public function privacyPolicy()
  {
    return view('front.footer-items.privacy-policy');
  }

  public function newsAndEvents()
  {
    $newsEvents = Notice::get();
    return view('front.footer-items.news-and-events', ['newsEvents' => $newsEvents]);
  }

  public function newsDetails(Notice $notice)
  {
    return view('front.news-detail', ['notice' => $notice]);
  }

  public function getMyProfile()
  {
    return view('front.update-profile');
  }

  public function getTermsAndConditions()
  {
    return view('front.footer-items.terms-and-conditions');
  }

  public function refundAndCancellation()
  {
    return view('front.footer-items.refund-and-cancellation');
  }

  public function takePledge()
  {
    return view('front.take-pledge');
  }

  public function initiative()
  {
    return view('');
  }

  public function getTopDestinationDetail($id)
  {
    $destination = DistrictTopDestination::findOrFail($id);
    return view('front.destination-detail', ['destination' => $destination]);
  }

  public function getInformation($slug)
  {
    $title = explode('-', $slug);
    $title = implode(" ", $title);
    $information = Information::where('title', $title)->first();
    return view('front.footer-items.information', ['information' => $information]);
  }

  public function contactUs()
  {
    return view('front.footer-items.contact-us');
  }

  public function faqs()
  {
    $faqs = Faq::get();
    return view('front.footer-items.faqs', compact('faqs'));
  }

  public function depositToPaytm()
  {
    return view('front.deposit-to-paytm');
  }

  public function depositPaytm(Request $request)
  {
    $callbackUrl = URL::to('/') . '/deposited';
    $amount = $request->amount;
    $orderId = 'MZTOUR' . now()->timestamp;

    $client = new Client();
    $response = $client->request('POST', 'https://paymentgw.mizoram.gov.in/api/initiate-payment', [
      'form_params' => [
        'callback_url' => $callbackUrl,
        'order_id' => $orderId,
        'amount' => $amount,
        'department_id' => 3,
        'customer' => json_encode('MZTOUR:Refund'),
        'shouldSplit' => false,
        'splitMethod' => 'PERCENTAGE',
        'splitMid' => 'ZUnFVOlw678076036222',
        'splitPercentage' => 100,
      ]
    ]);
    $response = json_decode($response->getBody());
    info($response);

    return redirect($response);
  }

  public function deposited(Request $request)
  {
    $message = '';
    if ($request->status == 'TXN_SUCCESS') {
      $message = 'Your amount for refund has been deposited successfully';
    } else {
      $message = 'Your amount could not be deposited! Please try again later';
    }
    return view('front.deposited', compact('message'));
  }

  public function getHashtagContest()
  {
    return view('front.hashtag-contest');
  }
}
