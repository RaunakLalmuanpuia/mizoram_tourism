<?php

namespace App\Repositories;

use App\Interfaces\DistrictTopDestinationRepositoryInterface;
use App\Models\DistrictTopDestination;
use App\Models\Tag;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Xml\Exception;

class DistrictTopDestinationRepository implements DistrictTopDestinationRepositoryInterface
{
  public function getAllDistrictTopDestination()
  {
    return DistrictTopDestination::with(['districtMetaData', 'tags', 'images'])->paginate(10);
  }


  public function createDistrictTopDestination(array $districtTopDestinationDetails)
  {
    //GET THE ID OF THE TAGS
    $tags = $districtTopDestinationDetails['tag'];
    $arrTagId = array();
    try {
      foreach ($tags as $tag) {
        $mTag = Tag::where('name', $tag)->first();
        $arrTagId[] = $mTag->id;
      }
    } catch (Exception $e) {
      return false;
      Log::debug($e);
    }

    $districtTopDestination = DistrictTopDestination::create($districtTopDestinationDetails['data']);
    //MAKE THE ATTACHMENT
    $districtTopDestination->tags()->attach($arrTagId);
    //DONE

    //MOVE THE IMAGE TO FOLDER
    foreach ($districtTopDestinationDetails['images'] as $image) {
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
      $mImage->district_id = $districtTopDestinationDetails['data']['district_meta_data_id'];
      $mImage->model = 'DistrictTopDestination';
      $mImage->model_id = $districtTopDestination->id;
      $mImage->save();

      $districtTopDestination->images()->attach($mImage->id);
    }

    return $districtTopDestination;
  }

  public function getDistrictTopDestinationById($districtTopDestinationId)
  {
    return DistrictTopDestination::with(['districtMetaData', 'tags', 'images'])->findOrFail($districtTopDestinationId);
  }

  //UPDATE
  public function updateDistrictTopDestination($districtTopDestinationId, array $newDetails)
  {

    $districtTopDestination = DistrictTopDestination::whereId($districtTopDestinationId)->update($newDetails['data']);

    //GET THE ID OF THE TAGS
    $tags = $newDetails['tag'];
    $arrTagId = array();
    try {
      foreach ($tags as $tag) {
        $mTag = Tag::where('name', $tag)->first();
        $arrTagId[] = $mTag->id;
      }
    } catch (Exception $e) {
      Log::debug($e);
    }

    //MAKE THE ATTACHMENT OF TAGS
    DistrictTopDestination::find($districtTopDestinationId)->tags()->sync($arrTagId);
    //TAGS DONE

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
        $mImage->district_id = $newDetails['data']['district_meta_data_id'];
        $mImage->model = 'DistrictTopDestination';
        $mImage->model_id = $districtTopDestinationId;

        $mImage->save();

        DistrictTopDestination::find($districtTopDestinationId)->images()->attach($mImage->id);
      }
    }

    if (isset($deletedMedia)) {
      foreach ($deletedMedia as $deleted) {
        File::delete(public_path('post_images/' . $deleted['name']));
        Image::where('name', $deleted['name'])->delete();
      }
    }

    return $districtTopDestination;
  }

  public function deleteDistrictTopDestination($districtTopDestinationId)
  {
    return DistrictTopDestination::destroy($districtTopDestinationId);
  }

  public function getTopDestinationByDistrictId($districtId)
  {
    return DistrictTopDestination::where('district_meta_data_id', $districtId)->with(['districtMetaData', 'tags', 'images'])->get();
  }

  public function getRandomDestination($count)
  {
    $numberOfRows = DistrictTopDestination::count();
    if ($numberOfRows >= $count) {
      return DistrictTopDestination::all()->random($count);
    } else {
      //IF REQUEST IS LARGER THAN THE NUMBER OF ROWS, GET NUMBER OF ROW
      return DistrictTopDestination::all()->random($numberOfRows);
    }
  }
}
