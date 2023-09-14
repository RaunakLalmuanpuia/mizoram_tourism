<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Distance;
use App\Models\DistrictMetaData;
use App\Models\Festival;
use App\Models\Guide;
use App\Models\Operator;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PlanYourTripController extends Controller
{
  public $districts = [];

  public function __construct()
  {
    $this->districts = DistrictMetaData::get();
  }

  public function getGuides($type)
  {
    $model = 'App\\Models\\' . ucfirst($type);
    $guides = $model::paginate(30);
    $totalGuides = $model::count();
    return view('front.planYourTrip.guides', ['guides' => $guides, 'totalGuides' => $totalGuides]);
  }

  public function howToGetToMizoram()
  {
    $getToMizorams = Distance::get();
    return view('front.planYourTrip.getToMizoram', ['getToMizorams' => $getToMizorams]);
  }

  public function getFestivals()
  {
    $festivals = Festival::get();
    return view('front.planYourTrip.festival', ['festivals' => $festivals]);
  }

  public function getTourOperators()
  {
    $operators = Operator::get();
    return view('front.planYourTrip.tour-operators', ['operators' => $operators]);
  }

  public function getTourGuides()
  {
    $totalGuides = Guide::count();
    return view('front.planYourTrip.tour-guides', ['totalGuides' => $totalGuides]);
  }

  public function getHotelAccomodations()
  {
    return view('front.planYourTrip.hotel-accomodation', ['districts' => $this->districts]);
  }

  public function getRentACar()
  {
    return view('front.planYourTrip.rent-a-car', ['districts' => $this->districts]);
  }

  public function getRestaurants()
  {
    $restaurants = Restaurant::paginate(30);
    $totalRestaurants = Restaurant::count();
    return view('front.planYourTrip.restaurants', ['restaurants' => $restaurants, 'totalRestaurants' => $totalRestaurants, 'districts' => $this->districts]);
  }

  public function agents()
  {
    $agents = Agent::get();
    return view('front.planYourTrip.travel-agents', ['agents' => $agents]);
  }

  public function viewFestivals($id)
  {
    $festival = Festival::findOrFail($id);
    return view('front.planYourTrip.festival-detail', ['festival' => $festival]);
  }
}
