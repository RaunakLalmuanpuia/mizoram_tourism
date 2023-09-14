<?php

use App\Http\Controllers\Api\UserBookingControllerApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\MobilePagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanYourTripController;
use App\Http\Livewire\IpCheckin;
use App\Http\Livewire\IpCheckInCount;
use App\Http\Livewire\LuckyDraw;
use App\Http\Livewire\WebCheckin;
use App\Http\Livewire\WebCheckinCount;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// home page
Route::controller(HomePageController::class)->group(function () {
  Route::get('/', 'index')->name('home');
  Route::get('/place-to-visit/{id}', 'placeToVisit')->name('placeToVisit');
  Route::get('/things-to-do/{item}', 'thingsToDo')->name('thingsToDo');
  Route::get('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');
  Route::get('/news-and-events', 'newsAndEvents')->name('newsAndEvents');
  Route::get('/news-and-events/{notice}', 'newsDetails')->name('newsDetails');
  Route::get('/terms-and-conditions', 'getTermsAndConditions')->name('termsAndConditions');
  Route::get('/refund-and-cancellations', 'refundAndCancellation')->name('refundAndCancellation');
  Route::middleware(['web', 'auth'])->get('/my-profile', 'getMyProfile')->name('myProfile');
  Route::get('/take-pledge', 'takePledge')->name('takePledge');
  Route::get('/initiative', 'initiative')->name('initiative');
  Route::get('/top-destination/{id}', 'getTopDestinationDetail')->name('destinationDetail');
  Route::get('/information/{slug}', 'getInformation')->name('getInformation');
  Route::get('/contact-us', 'contactUs')->name('contactUs');
  Route::get('/frequently-asked-questions', 'faqs')->name('faq');
  Route::get('/deposit-to-paytm', 'depositToPaytm');
  Route::post('/deposit-paytm', 'depositPaytm');
  Route::get('/deposited', 'deposited');
  Route::middleware(['cors'])->get('/hashtag-contest', 'getHashtagContest')->name('hashtag.contest');
});

// plan your trip
Route::controller(PlanYourTripController::class)->group(function () {
  Route::get('/how-to-get-to-mizoram', 'howToGetToMizoram')->name('howToGetToMizoram');
  Route::get('/festivals', 'getFestivals')->name('getFestivals');
  Route::get('/festivals/{id}', 'viewFestivals')->name('viewFestivals');
  Route::get('/tour-operators', 'getTourOperators')->name('getTourOperators');
  Route::get('/tour-guides', 'getTourGuides')->name('tourGuides');
  Route::get('/hotel-and-accommodations', 'getHotelAccomodations')->name('hotelAccomodations');
  Route::get('/rent-a-car', 'getRentACar')->name('rentACar');
  Route::get('/restaurants', 'getRestaurants')->name('restaurants');
  Route::get('/travel-agents', 'agents')->name('travelAgent');
  Route::get('/plan-your-trip/{type}', 'getGuides')->name('guides');
});

// Booking
Route::controller(BookingController::class)->group(function () {
  Route::get('/booking', 'index')->name('booking');
  Route::get('/lodge-detail/{id}', 'lodgeDetail')->name('lodgeDetail');
  Route::get('/booking-information', 'bookingInformation')->name('bookingInformation');
  Route::get('/my-bookings', 'getMyBookings')->name('myBookings');
});

Route::controller(UserBookingControllerApi::class)->group(function () {
  Route::get('/receipt', 'getUserReceipt')->name('getReceipt');
  Route::get('/dowload-statement', 'downloadStatement');
  Route::get('/download-lodge-cancelled-bookings', 'downloadCancelledBookings');
});

// payment
Route::controller(PaymentController::class)->group(function () {
  Route::post('save-payment', 'savePayment')->name('savePayment');
  Route::get('/response-handler', 'responseHandler');
  Route::get('/booking-completed', 'getBookingCompleted')->name('booking.completed');
});

// authentication
Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'login')->name('login');
  Route::post('/login', 'postLogin')->name('postLogin');
  Route::get('/register', 'getRegister')->name('getRegister');
  Route::post('/register', 'register')->name('register');
});

// about
Route::controller(AboutController::class)->group(function () {
  Route::get('/about/{about}', 'getAbout')->name('about');
  Route::get('/history', 'getHistory')->name('getHistory');
  Route::get('/environment', 'getEnvironment')->name('getEnvironment');
  Route::get('/mystical-mizoram', 'getMysticalMizoram')->name('mysticalMizoram');
  Route::get('/entry-formalities', 'getEntryFormalities')->name('entryFormalities');
  Route::get('/hotels', 'getHotels');
});

Route::controller(MobilePagesController::class)->group(function () {
  Route::get('/places-to-visit', 'getPlacesToVisit')->name('placesToVisit');
  Route::get('/things-to-do', 'getThingsToDo')->name('thingsToDoList');
  Route::get('/plan-your-trip', 'getPlanYourTrip')->name('planYourTrip');
  Route::get('/about-us', 'getAboutUs')->name('aboutUs');
});

Route::get('/web-checkin', WebCheckin::class)->name('web.checkin');
Route::get('/ip-check-in', IpCheckin::class)->name('ip.checkin');
Route::get('/ip-checkin-count', IpCheckInCount::class)->name('ip.checkin.count');
Route::get('/web-checkin-count', WebCheckinCount::class)->name('web.checkin.count');

Route::get('/send-email/{id}', [PaymentController::class, 'sendEmail']);

Route::middleware(['auth'])->group(function () {
  Route::get('/lucky-draw', LuckyDraw::class)->name('lucky.draw');
  Route::get('/{any}', function () {
    return view('app');
  })->where('any', '.*');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard');
