<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PassportController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageTempController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Api\AmenityControllerApi;
use App\Http\Controllers\Api\DistrictMetaDataControllerApi;
use App\Http\Controllers\Api\DistrictTopDestinationControllerApi;
use App\Http\Controllers\Api\LodgeControllerApi;
use App\Http\Controllers\Api\LodgeRoomDataControllerApi;
use App\Http\Controllers\Api\LodgeRoomTypeControllerApi;
use App\Http\Controllers\Api\QuoteControllerApi;
use App\Http\Controllers\Api\UserBookingControllerApi;
use App\Http\Controllers\Api\ReportControllerApi;
use App\Http\Controllers\Api\TagControllerApi;

use App\Http\Controllers\Api\GuideControllerApi;
use App\Http\Controllers\Api\HotelControllerApi;
use App\Http\Controllers\Api\RestaurantControllerApi;
use App\Http\Controllers\Api\OperatorControllerApi;
use App\Http\Controllers\Api\RentalControllerApi;
use App\Http\Controllers\Api\AgentControllerApi;
use App\Http\Controllers\Api\DistanceControllerApi;
use App\Http\Controllers\Api\FestivalControllerApi;
use App\Http\Controllers\Api\AboutControllerApi;
use App\Http\Controllers\Api\InformationControllerApi;
use App\Http\Controllers\Api\GuestControllerApi;
use App\Http\Controllers\Api\NoticeControllerApi;
use App\Http\Controllers\Api\HiringControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\Api\IndexControllerApi;
use App\Http\Controllers\Api\MizoramControllerApi;

use App\Http\Controllers\Api\AgentRatingControllerApi;
use App\Http\Controllers\Api\BookingCategoriesController;
use App\Http\Controllers\Api\GuideRatingControllerApi;
use App\Http\Controllers\Api\HotelRatingControllerApi;
use App\Http\Controllers\Api\LodgeRatingControllerApi;
use App\Http\Controllers\Api\OperatorRatingControllerApi;
use App\Http\Controllers\Api\RentalRatingControllerApi;
use App\Http\Controllers\Api\RestaurantRatingControllerApi;
use App\Http\Controllers\Api\PledgeControllerApi;
use App\Http\Controllers\Api\UserStatusControllerApi;
use App\Http\Controllers\Api\OccupancyControllerApi;
use App\Http\Controllers\Api\OccupancyDetailControllerApi;
use App\Http\Controllers\Api\CarousalControllerApi;
use App\Http\Controllers\Front\BookingController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware('auth:sanctum')->get('/ss', function (Request $request) {
  return "ddd";
});

Route::resource('/amenities', AmenityControllerApi::class);
Route::resource('/districts', DistrictMetaDataControllerApi::class);
Route::resource('/destinations', DistrictTopDestinationControllerApi::class);
Route::resource('/lodges', LodgeControllerApi::class);
Route::resource('/lodge-room-type', LodgeRoomTypeControllerApi::class);
Route::resource('/room', LodgeRoomDataControllerApi::class);
Route::resource('/quotes', QuoteControllerApi::class);
Route::resource('/bookings', UserBookingControllerApi::class);
Route::resource('/tags', TagControllerApi::class);
Route::resource('/images', ImageController::class);

Route::resource('/guides', GuideControllerApi::class);
Route::resource('/hotels', HotelControllerApi::class);
Route::resource('/restaurants', RestaurantControllerApi::class);
Route::resource('/operators', OperatorControllerApi::class);
Route::resource('/rentals', RentalControllerApi::class);
Route::resource('/agents', AgentControllerApi::class);
Route::resource('/distances', DistanceControllerApi::class);
Route::resource('/festivals', FestivalControllerApi::class);
Route::resource('/abouts', AboutControllerApi::class);
Route::resource('/informations', InformationControllerApi::class);
Route::resource('/guests', GuestControllerApi::class);
Route::resource('/notices', NoticeControllerApi::class);
Route::resource('/hiring', HiringControllerApi::class);
Route::resource('/mizoram', MizoramControllerApi::class);
Route::resource('/categories', CategoryControllerApi::class);
Route::resource('/indices', IndexControllerApi::class);

Route::resource('/agent-rating', AgentRatingControllerApi::class);
Route::resource('/guide-rating', GuideRatingControllerApi::class);
Route::resource('/hotel-rating', HotelRatingControllerApi::class);
Route::resource('/lodge-rating', LodgeRatingControllerApi::class);
Route::resource('/operator-rating', OperatorRatingControllerApi::class);
Route::resource('/rental-rating', RentalRatingControllerApi::class);
Route::resource('/restaurant-rating', RestaurantRatingControllerApi::class);
Route::resource('/occupancy', OccupancyControllerApi::class);
Route::resource('/occupancy-detail', OccupancyDetailControllerApi::class);
Route::resource('/carousal', CarousalControllerApi::class);

Route::post('/checkme', [AuthController::class, 'checkme']);

Route::controller(PassportController::class)->group(function () {
  Route::post('/register', 'register');
  Route::post('/login', 'login');
  Route::get('/gt-user/{id}', 'getUser');
  Route::put('/updt-user/{id}', 'updateUser');
  Route::get('/get-all-users', 'getAllUsers');
  Route::get('/user-filter/{role}', 'getUserByRole');
  Route::get('/user/destroy/{id}', 'deleteUser');
});

Route::get('/delete/room/{id}', [LodgeRoomTypeControllerApi::class, 'searchAndDelete']);

Route::get('/carousal-status/{id}', [CarousalControllerApi::class, 'changeStatus']);
Route::get('/status-count', [CarousalControllerApi::class, 'countTheStatus']);
Route::get('/get-five-carousal', [CarousalControllerApi::class, 'getTheFiveEnabled']);

Route::get('/occupancy-by-role/{id}', [OccupancyControllerApi::class, 'getByRole']);
Route::get('/fiter/occupancy/{month}/{year}', [OccupancyControllerApi::class, 'fiterByMonthAndYear']);

Route::controller(LodgeRoomDataControllerApi::class)->group(function () {
  Route::get('/filter-room-with-lodge/{id}', 'getRoomByLodge');
  Route::get('/get-lodge-with-role/{id}', 'getLodgeAccordingToRole');
  Route::get('/getRoomAvailable/{roomId}', 'getRoomAvailable');
  Route::get('/getPrice/{roomId}/{roomReq}', 'getRoomPrice');
  Route::get('/getTypeByLodge/{lodgeId}', 'getTypebyLodge');
  Route::get('/getRoomAvailablePrice/{roomId}', 'getRoomAvailablePrice');
  Route::get('/delete/room/{id}', 'searchAndDelete');
  Route::get('/getRoomsByLodgeId/{lodgeId}', 'getRoomsByLodgeId');
  Route::get('/getAvailableRoom/{roomId}', 'getAvailableRoom');
});

Route::get('/check-user-status/{id}', [UserStatusControllerApi::class, 'checkUserStatus']);
Route::get('/residence/{category}', [IndexControllerApi::class, 'getResidenceByCategory']);

Route::controller(UserBookingControllerApi::class)->group(function () {
  Route::get('/userbooking/{id}', 'getBookingAccordingToRole');
  Route::get('/userbooking-all/{id}', 'getBookingAccordingToRoleAll');
  Route::get('/guest-list/{id}', 'guestList');
  Route::get('/booking-status/{value_one}/{id}', 'bookingStatusCheck');
  Route::get('/test2/{value_one}/{value_two}/{id}', 'testFilter');
  Route::get('/checkout/{id}', 'checkOut');
  Route::get('/room-assign/{id}/{roomNumber}', 'roomAssign');
  Route::get('/receipt-pdf/{id}', 'downloadReceiptPdf');
  Route::get('/payment-details/{bookingId}', 'paymentDetails');
  Route::get('/search-for-booking', 'searchForBooking');
  Route::get('/get-cancelled-bookings', 'getCancelledBookings');
  Route::post('/restore-cancelled-booking/{id}', 'restoreCancelledBooking');
  Route::get('/search-for-cancelled-bookings', 'searchForCancelledBookings');
  Route::get('/check-status', 'checkTransaction');
  Route::get('/test-pdf', 'getUserReceipt');
});

Route::controller(ImageTempController::class)->group(function () {
  Route::post('/media/{id}', 'getImagesForDistrictMetaData');
  Route::post('/media/destination/{id}', 'getImagesForTopDestination');
  Route::post('/media/lodge/{id}', 'getImagesForLodges');
  Route::post('/media/room/{id}', 'getImagesForRoom');
  Route::post('/media/distance/{id}', 'getImagesForDistance');
  Route::post('/media/festival/{id}', 'getImagesForFestival');
  Route::post('/media/about/{id}', 'getImagesForAbout');
  Route::post('/media/notice/{id}', 'getImagesForNotice');
  Route::post('/media/carousal/{id}', 'getImagesForCarousal');
  Route::post('/upload', 'store')->name('upload');
  Route::get('/image/district/{districtId}', 'getImageByDistrict');
});

Route::controller(LodgeControllerApi::class)->group(function () {
  Route::get('/lodge-user/{id}', 'findLodgeWithUser');
  Route::get('/getByDistrict/{districtId}', 'getByDistrict');
  Route::get('/delete/lodges/{id}', 'searchAndDelete');
  Route::get('/userHasLodge/{id}', 'userHasLodge');
  Route::get('/getOnlyLodgeName', 'getOnlyLodgeName');
  Route::get('/getSingleLodgeName/{id}', 'getSingleLodgeName');
  Route::get('/filter-lodge-with-role/{id}', 'getLodgeAccordingToRole');
});

Route::controller(DistrictTopDestinationControllerApi::class)->group(function () {
  Route::get('/getTopDestinationByDistrictId/{districtId}', 'getTopDestinationByDistrictId');
  Route::get('/mTags/{id}', 'getAllTagByDestination');
  Route::get('/mDestinations/{id}', 'getAllDestinationByTag');
  Route::get('/get-all-tags', 'getAllTags');
  Route::get('/destination/random/{id}', 'getRandomDestination');
});

Route::controller(ReportControllerApi::class)->group(function () {
  Route::post('/reports', 'storeReport');
  Route::get('/getAllReports/{id}', 'showReports');
  Route::get('/reports/{id}', 'findReportById');
  Route::get('/reports/month/{month}', 'getReportByMonth');
  Route::get('/report/between/{from}/{to}', 'getReportInBetween');
  Route::post('/dashboard', 'dashboard');
  Route::delete('/reports/{id}', 'destroy');
  Route::get('/facility-name/{id}', 'getFacilityNameWithUserId');
  Route::post('/search-facility', 'searchFacility');
  Route::get('/download/report/{reportId}', 'downloadReportPDF');
  Route::get('/download/occupancy/{occupancyId}', 'downloadOccupancyPDF');
});

Route::controller(DistrictMetaDataControllerApi::class)->group(function () {
  Route::get('/post/update/{post}', 'imageIndex');
  Route::post('/post/update/{post}', 'imageUpdate')->name('imageUpdate');
  Route::get('/delete/district/{id}', 'searchAndDelete');
});

//MAFAKA TAN. RATING AND REVIEW NA
Route::controller(AgentControllerApi::class)->group(function () {
  Route::get('/agents/district/{districtId}', 'getAgentByDistrict');
  Route::get('/all-agents-rating', 'getAllAgentsWithRating')->name('getAllAgentsWithRating');
  Route::get('/single-agent-rating/{id}', 'findAgentWithRating')->name('findAgentWithRating');
});

Route::get('/guides/district/{districtId}', [GuideControllerApi::class, 'getGuideByDistrict']);
Route::get('/all-guides-rating', [GuideControllerApi::class, 'getAllGuidesWithRating'])->name('getAllGuidesWithRating');
Route::get('/single-guide-rating/{id}', [GuideControllerApi::class, 'findGuideWithRating'])->name('findGuideWithRating');

Route::get('/get-district-wise-hotels', [HotelControllerApi::class, 'getDistrictWiseHotels']);
Route::get('/hotels/district/{districtId}', [HotelControllerApi::class, 'getHotelByDistrict']);
Route::get('/all-hotels-rating', [HotelControllerApi::class, 'getAllHotelsWithRating'])->name('getAllHotelsWithRating');
Route::get('/single-hotel-rating/{id}', [HotelControllerApi::class, 'findHotelWithRating'])->name('findHotelWithRating');

Route::get('/all-lodges-rating', [LodgeControllerApi::class, 'getAllLodgesWithRating'])->name('getAllLodgesWithRating');
Route::get('/single-lodge-rating/{id}', [LodgeControllerApi::class, 'findLodgeWithRating'])->name('findLodgeWithRating');

Route::get('/operators/district/{districtId}', [OperatorControllerApi::class, 'getOperatorByDistrict']);
Route::get('/all-operators-rating', [OperatorControllerApi::class, 'getAllOperatorsWithRating'])->name('getAllOperatorsWithRating');
Route::get('/single-operator-rating/{id}', [OperatorControllerApi::class, 'findOperatorWithRating'])->name('findOperatorWithRating');

Route::get('/rentals/district/{districtId}', [RentalControllerApi::class, 'getRentalByDistrict']);
Route::get('/all-rentals-rating', [RentalControllerApi::class, 'getAllRentalsWithRating'])->name('getAllRentalsWithRating');
Route::get('/single-rental-rating/{id}', [RentalControllerApi::class, 'findRentalWithRating'])->name('findRentalWithRating');

Route::get('/restaurants/district/{districtId}', [RestaurantControllerApi::class, 'getRestaurantByDistrict']);
Route::get('/all-restaurants-rating', [RestaurantControllerApi::class, 'getAllRestaurantsWithRating'])->name('getAllRestaurantsWithRating');
Route::get('/single-restaurant-rating/{id}', [RestaurantControllerApi::class, 'findRestaurantWithRating'])->name('findRestaurantWithRating');

Route::resource('/pledges', PledgeControllerApi::class);

Route::controller(BookingCategoriesController::class)->group(function () {
  Route::get('/failed-payments', 'getFailedPaymentBookings');
  Route::post('/update-failed-transaction', 'updateFailedTransaction');
  Route::post('/resend-confirmation', 'resendConfirmation');
  Route::post('/initiate-refund', 'initiateRefund');
  Route::get('/check-refund', 'checkRefund');
  Route::post('/cancel-booking/{id}', 'cancelBooking');
  Route::get('/transactions', 'getTransactions');
  Route::get('/download-lodge-statement', 'downloadStatement');
  Route::get('/total-guests-for-month', 'getTotalGuests');
});

require base_path('routes/mobile.php');
