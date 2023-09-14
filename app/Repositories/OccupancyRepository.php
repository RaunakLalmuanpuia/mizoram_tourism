<?php

namespace App\Repositories;

use App\Interfaces\OccupancyRepositoryInterface;
use App\Models\Occupancy;
use App\Models\OccupancyDetail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;

class OccupancyRepository implements OccupancyRepositoryInterface
{
  public function getAllModel()
  {
    return Occupancy::with(['user', 'occupancyDetails'])->get();
  }

  public function createModel(array $modelDetails)
  {
    try {
      //POPULATE MONTHLY OCCUPANCY STATEMENT
      $occupancy = Occupancy::create($modelDetails['report']);


      //POPULATE MONTHLY OCCUPANCY STATEMENT DETAILS
      foreach ($modelDetails['reportDetails'] as $report) {
        $r = new OccupancyDetail();
        $r->occupancies_id = $occupancy->id;
        $r->date = $report['date'];
        $r->suite = $report['suite'];
        $r->deluxe = $report['deluxe'];
        $r->double_room = $report['double_room'];
        $r->single_room = $report['single_room'];
        $r->dormitory = $report['dormitory'];
        $r->param1 = $report['param1']; //PARAM1 IS THE COTTAGEP

        $r->conference_hall = $report['conference_hall'];
        $r->convention_hall = $report['convention_hall'];
        $r->save();
      }

      return true;
    } catch (Exception $e) {
    }

    //return Occupancy::create($modelDetails);

  }

  public function getModelById($modelId)
  {
    // return Occupancy::with('occupancyDetails')->findOrFail($modelId);
    $occupancy = Occupancy::with(['user', 'occupancyDetails'])->findOrFail($modelId);

    $user = User::with('lodges')->find($occupancy->users_id);
    $role = $user->role;
    if ($role == 'lodge') {
      $lodgeName = $user->lodges[0]->name;
      $occupancy->facility_name = $lodgeName;
    } else {
      $occupancy->facility_name = $user->name;
    }


    return $occupancy;
  }

  public function updateModel($modelId, array $newDetails)
  {
    return Occupancy::whereId($modelId)->update($newDetails);
  }

  public function deleteModel($modelId)
  {
    return Occupancy::destroy($modelId);
  }
}
