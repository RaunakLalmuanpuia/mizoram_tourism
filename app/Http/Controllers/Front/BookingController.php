<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Image;
use App\Models\Lodge;
use App\Models\LodgeAmenity;
use App\Models\LodgeRoomData;
use App\Models\UserBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
  public function index()
  {
    if (Lodge::count() != 0 && LodgeRoomData::count() != 0) {
      return view('front.booking');
    }
    return view('front.no-booking');
  }

  public function lodgeDetail($id)
  {
    $lodge = Lodge::findOrFail($id);
    $lodgeAmenities = LodgeAmenity::where('lodges_id', $id)->get()->pluck('amenities_id');
    $amenities = Amenity::whereIn('id', $lodgeAmenities)->get();
    $lodgeRooms = LodgeRoomData::where('lodges_id', $id)->with(['lodgeRoomTypes', 'amenities'])->get();
    return view('front.lodgeDetail', ['lodge' => $lodge, 'amenities' => $amenities, 'lodgeRooms' => $lodgeRooms]);
  }

  public function bookingInformation(Request $request)
  {
    return view('front.bookingInformation', ['data' => $request->all()]);
  }

  public function getMyBookings()
  {
    $myBookings = UserBooking::with('lodgeRoomData', 'guests')->orderBy('created_at', 'desc')->where('users_id', Auth::user()->id)->where('status', '!=', 1)->paginate(10);
    // $myBookings = UserBooking::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->where('status', '!=', 1)->get();
    return view('front.my-bookings', ['myBookings' => $myBookings]);
  }
}
