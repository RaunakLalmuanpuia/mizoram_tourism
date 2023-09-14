<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\DistrictMetaData;
use App\Models\Tag;
use Illuminate\Http\Request;

class MobilePagesController extends Controller
{
	public function getPlacesToVisit()
	{
		$districts = DistrictMetaData::get();
		return view('front.mobile-places-to-visit', ['districts' => $districts]);
	}

	public function getThingsToDo()
	{
		$tags = Tag::get();
		return view('front.mobile-things-to-do', ['tags' => $tags]);
	}

	public function getPlanYourTrip()
	{
		return view('front.mobile-plan-your-trip');
	}

	public function getAboutUs()
	{
		$abouts = About::get();
		return view('front.mobile-about-us', ['abouts' => $abouts]);
	}
}
