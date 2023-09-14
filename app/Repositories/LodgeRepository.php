<?php

namespace App\Repositories;

use App\Interfaces\LodgeRepositoryInterface;
use App\Models\Lodge;
use App\Models\Amenity;
use Illuminate\Support\Facades\Log;
use App\Models\Image;
use App\Models\UserLodge;
use File;

class LodgeRepository implements LodgeRepositoryInterface
{
  public function getAllLodge()
  {

    return Lodge::with(['districtMetaData', 'amenities'])->get();
  }


  public function createLodge(array $lodgeDetails)
  {

    $lodge = Lodge::create($lodgeDetails['data']);

    //GET THE ID OF THE AMENITY
    $amenities = $lodgeDetails['amenity'];
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
    $lodge->amenities()->attach($arrLodgeId);
    //DONE

    //MAKE THE PIVOT TABLE OF LODGE AND USER
    $current_user_id = $lodgeDetails['user_id'];
    $lodge->users()->attach($current_user_id);
    //DONE


    //MOVE THE IMAGE TO FOLDER
    foreach ($lodgeDetails['images'] as $image) {

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

      $lodge->images()->attach($mImage->id);
    }
    return $lodge;
  }

  public function getLodgeById($lodgeId)
  {

    return Lodge::with(['amenities', 'images'])->findOrFail($lodgeId);
  }
  //GET LODGE ANEMITIES
  public function getAmenitiesById($lodgeId)
  {

    return Lodge::with('amenities')->findOrFail($lodgeId);
  }
  //GET LODGE IMAGES
  public function getLodgeImageById($lodgeId)
  {

    return Lodge::with('images')->findOrFail($lodgeId);
  }

  //UPDATE
  public function updateLodge($lodgeId, array $newDetails)
  {

    $lodge = Lodge::whereId($lodgeId)->update($newDetails['data']);

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

    //SAVE THE LODGE CREATOR

    // $arrUsersId = array();
    // try {
    //   foreach ($users as $user) {
    //     $mUser = Amenity::where('name', $amenity)->first();
    //     Log::debug($mAmenity->id);
    //     $arrAmenitiesId[] = $mAmenity->id;
    //   }
    // } catch (Exception $e) {
    //   Log::debug($e);
    // }
    //Log::debug(Lodge::find($lodgeId)->users()->sync($users));

    //MAKE THE PIVOT TABLE OF LODGE AND USER
    //  $current_user_id[]=$newDetails['user_id'];
    //  $lodge->users()->attach($current_user_id);
    //DONE

    //MAKE THE ATTACHMENT
    Lodge::find($lodgeId)->amenities()->sync($arrAmenitiesId);
    //END

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

        Lodge::find($lodgeId)->images()->attach($mImage->id);

        Log::debug("Image ID: " . $mImage->id);
      }
    }

    if (isset($deletedMedia)) {
      foreach ($deletedMedia as $deleted) {
        File::delete(public_path('post_images/' . $deleted['name']));
        Image::where('name', $deleted['name'])->delete();
      }
    }


    return $lodge;
  }

  public function deleteLodge($lodgeId)
  {

    //Lodge::find($lodgeId)->reports()->detach($lodgeId);
    UserLodge::where("lodges_id", $lodgeId)->delete();
    return Lodge::destroy($lodgeId);
  }

  public function getLodgebyDistrict($districtId)
  {
    return Lodge::with('amenities')->where('district_meta_data_id', $districtId)->get();
  }
}
