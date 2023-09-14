<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutImage;
use App\Models\DistrictMetaData;
use App\Models\Image;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public $districts = [];

  public function __construct()
  {
    $this->districts = DistrictMetaData::get();
  }

  public function getAbout(About $about)
  {
    $aboutImages = AboutImage::where('abouts_id', $about->id)->pluck('images_id');
    $images = Image::whereIn('id', $aboutImages)->get();
    return view('front.about.mystical-mizoram', ['about' => $about, 'images' => $images]);
  }

  public function getMysticalMizoram()
  {
    return view('front.about.mystical-mizoram');
  }

  public function getEntryFormalities()
  {
    return view('front.about.entry-formalities');
  }

  public function getHistory()
  {
    return view('front.about.history');
  }

  public function getEnvironment()
  {
    return view('front.about.environment');
  }
}
