<?php

namespace App\Repositories;

use App\Interfaces\LodgeRoomDataRepositoryInterface;
use App\Models\LodgeRoomData;
use App\Models\Amenity;
use Illuminate\Support\Facades\Log;
use App\Models\Image;
use File;

class LodgeRoomDataRepository implements LodgeRoomDataRepositoryInterface
{
  public function getAllLodgeRoomData()
  {
    return LodgeRoomData::with(['districtMetaData', 'lodges', 'lodgeRoomTypes', 'amenities'])->get();
  }


  public function createLodgeRoomData(array $lodgeRoomDataDetails)
  {
    //return LodgeRoomData::create($lodgeRoomDataDetails);
    $lodgeRoomData = LodgeRoomData::create($lodgeRoomDataDetails['data']);

    //GET THE ID OF THE AMENITY
    $amenities = $lodgeRoomDataDetails['amenity'];
    $arrLodgeId = array();
    try {
      foreach ($amenities as $amenity) {
        $mAmenity = Amenity::where('name', $amenity)->first();
        $arrLodgeId[] = $mAmenity->id;
      }
    } catch (Exception $e) {
      Log::debug($e);
    }

    //MAKE THE ATTACHMENT
    $lodgeRoomData->amenities()->attach($arrLodgeId);
    //DONE

    //MOVE THE IMAGE TO FOLDER
    foreach ($lodgeRoomDataDetails['images'] as $image) {

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
      $mImage->save();

      $lodgeRoomData->images()->attach($mImage->id);
    }

    return $lodgeRoomData;
  }

  public function getLodgeRoomDataById($lodgeRoomDataId)
  {
    return LodgeRoomData::with('amenities')->findOrFail($lodgeRoomDataId);
  }

  //UPDATE
  public function updateLodgeRoomData($lodgeRoomDataId, array $newDetails)
  {
    //return LodgeRoomData::whereId($lodgeRoomDataId)->update($newDetails);
    $room = LodgeRoomData::whereId($lodgeRoomDataId)->update($newDetails['data']);

    //GET THE ID OF THE TAGS
    $amenities = $newDetails['amenities'];
    $arrAmenitiesId = array();
    try {
      foreach ($amenities as $amenity) {
        $mAmenity = Amenity::where('name', $amenity)->first();
        $arrAmenitiesId[] = $mAmenity->id;
      }
    } catch (Exception $e) {
      Log::debug($e);
    }

    //MAKE THE ATTACHMENT
    LodgeRoomData::find($lodgeRoomDataId)->amenities()->sync($arrAmenitiesId);
    //TAG DONE

    //START IMAGE ATTACHMENT
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
        $mImage->save();

        LodgeRoomData::find($lodgeRoomDataId)->images()->attach($mImage->id);
      }
    }

    if (isset($deletedMedia)) {
      foreach ($deletedMedia as $deleted) {
        File::delete(public_path('post_images/' . $deleted['name']));
        Image::where('name', $deleted['name'])->delete();
      }
    }
    return $room;
  }

  public function deleteLodgeRoomData($lodgeRoomDataId)
  {
    return LodgeRoomData::destroy($lodgeRoomDataId);
  }

  public function getTypebyLodge($lodgeId)
  {
    return LodgeRoomData::where('lodges_id', $lodgeId)->with('lodgeRoomTypes')->get();
  }

  public function getRoomAvailablePrice($roomId)
  {
    return LodgeRoomData::where('id', $roomId)->get(['room_available', 'price']);
  }

  public function getRoomsByLodgeId($lodgeId)
  {
    return LodgeRoomData::where('lodges_id', $lodgeId)->with(['districtMetaData', 'lodges', 'lodgeRoomTypes'])->get();
  }
}
