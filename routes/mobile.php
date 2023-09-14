<?php

use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\DistrictTopDestinationControllerApi;
use App\Http\Controllers\Api\LodgeControllerApi;
use App\Http\Controllers\Api\MobilePaymentController;
use App\Http\Controllers\Api\NoticeControllerApi;
use App\Http\Controllers\Api\PledgeControllerApi;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\ImageTempController;
use App\Http\Controllers\MizoramController;
use App\Repositories\LodgeRepository;
use Illuminate\Support\Facades\Route;

Route::post('login-register', [UserAuthController::class, 'loginRegister']);
Route::post('verify-otp', [UserAuthController::class, 'verifyOtp']);
Route::post('signup', [UserAuthController::class, 'signup']);

///------MAFAKA
Route::get('/top-destination-gallery-image/{topDestinationId}', [DistrictTopDestinationControllerApi::class, 'getAllImageTopDestination']);
Route::get('/get-top-destination-images/{id}', [ImageTempController::class, 'getImagesForTopDestination']);
Route::get('/get-lodge-images/{id}', [LodgeRepository::class, 'getLodgeImageById']);
Route::get('/get-lodge-amenities/{id}', [LodgeRepository::class, 'getAmenitiesById']);
Route::get('/get-mizoram', [MizoramController::class, 'getMizoram']);
Route::get('/get-user/{id}', [UserAuthController::class, 'getUser']);
Route::get('/filter-notice', [NoticeControllerApi::class, 'filterNotice']);
Route::get('/filter-lodge', [LodgeControllerApi::class, 'filterLodges']);

Route::post('/make-payment', [MobilePaymentController::class, 'makePayment']);

Route::post('/save-payment', [MobilePaymentController::class, 'savePayment']);
Route::get('/save-bookings', [MobilePaymentController::class, 'responseHandler']);
// Route::post('/save-bookings', [MobilePaymentController::class, 'saveBookings']);

Route::get('/get-my-bookings', [BookingsController::class, 'getMyBookings']);
Route::get('/cancel-my-booking', [BookingsController::class, 'cancelBooking']);

Route::post('/update-profile', [UserProfileController::class, 'updateProfile']);

Route::get('/check-no-of-rooms', [BookingsController::class, 'checkDate']);
Route::post('/takePledge',[PledgeControllerApi::class,'takePledge']);
Route::get('/get-pledge',[PledgeControllerApi::class,'getPledgeStatus']);
