<?php

namespace App\Http\Controllers;

use App\Models\DistrictMetaData;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\DistrictTopDestination;
use App\Models\Lodge;
use App\Models\LodgeRoomData;
use App\Models\Distance;
use App\Models\Festival;
use App\Models\About;
use App\Models\Notice;

use App\Models\Image;
use App\Models\Carousal;

class ImageTempController extends Controller
{
  public function store(Request $request)
  {
    $path = public_path('tmp/uploads');
    if (!file_exists($path)) {
      mkdir($path, 0777, true);
    }
    $file = $request->file('image');
    $name = uniqid() . '_' . trim($file->getClientOriginalName());
    $file->move($path, $name);

    return ['name' => $name];
  }

  public function getImagesForDistrictMetaData($id)
  {
    $images = DistrictMetaData::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForTopDestination($id)
  {
    $images = DistrictTopDestination::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForLodges($id)
  {
    $images = Lodge::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForRoom($id)
  {
    $images = LodgeRoomData::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForDistance($id)
  {
    $images = Distance::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForFestival($id)
  {
    $images = Festival::find($id)->images;

    return ['media' => $images];
  }
  public function getImagesForAbout($id)
  {
    $images = About::find($id)->images;

    return ['media' => $images];
  }
  public function getImagesForNotice($id)
  {
    $images = Notice::find($id)->images;

    return ['media' => $images];
  }

  public function getImagesForCarousal($id)
  {
    $images = Carousal::find($id)->images;

    return ['media' => $images];
  }

  public function getImageByDistrict($districtId)
  {
    $images = Image::where('district_id', $districtId)->get();
    return ['data' => $images];
  }
}
