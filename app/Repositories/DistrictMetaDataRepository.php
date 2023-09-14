<?php

namespace App\Repositories;

use App\Interfaces\DistrictMetaDataRepositoryInterface;
use App\Models\DistrictMetaData;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;

class DistrictMetaDataRepository implements DistrictMetaDataRepositoryInterface
{
  public function getAllDistrictMetaData()
  {
    $rr = DistrictMetaData::all();
    return $rr;
  }


  public function createDistrictMetaData(array $districtMetaDataDetails)
  {
    $districtMetaData = DistrictMetaData::create($districtMetaDataDetails['data']);

    //MOVE THE IMAGE TO FOLDER
    foreach ($districtMetaDataDetails['images'] as $image) {

      $path = public_path('post_images');
      if (!file_exists($path)) {
        mkdir($path, 0777, true);
      }
      $from = public_path('tmp/uploads/' . $image['name']);
      $to = public_path('post_images/' . $image['name']);

      File::move($from, $to);

      //CREATE IMAGE DB
      $mImage = new Image();
      $mImage->name = $image['name'];
      $mImage->district_id = $districtMetaData->id;
      $mImage->model = 'DistrictMetaData';
      $mImage->model_id = $districtMetaData->id;
      $mImage->save();

      $districtMetaData->images()->attach($mImage->id);
    }

    // return $districtMetaData;
  }

  public function getDistrictMetaDataById($districtMetaDataId)
  {
    return DistrictMetaData::findOrFail($districtMetaDataId);
  }


  // UPDATE FUNCTION
  public function updateDistrictMetaData($districtMetaDataId, array $newDetails)
  {
    $districtMetaData = DistrictMetaData::whereId($districtMetaDataId)->update($newDetails['data']);

    $addedMedia = $newDetails['addedMedia'];
    $savedMedia = $newDetails['savedMedia'];
    $deletedMedia = $newDetails['deletedMedia'];

    if (isset($addedMedia)) {
      foreach ($addedMedia as $image) {
        $from = public_path('tmp/uploads/' . $image['name']);
        $to = public_path('post_images/' . $image['name']);

        File::move($from, $to);
        //CREATE IMAGE DB
        $mImage = new Image();
        $mImage->name = $image['name'];
        $mImage->district_id = $districtMetaDataId;
        $mImage->model = 'DistrictMetaData';
        $mImage->model_id = $districtMetaDataId;

        $mImage->save();

        DistrictMetaData::find($districtMetaDataId)->images()->attach($mImage->id);
      }
    }

    if (isset($deletedMedia)) {
      foreach ($deletedMedia as $deleted) {
        File::delete(public_path('post_images/' . $deleted['name']));
        Image::where('name', $deleted['name'])->delete();
      }
    }
  }


  public function deleteDistrictMetaData($districtMetaDataId)
  {
    return DistrictMetaData::destroy($districtMetaDataId);
  }
}
