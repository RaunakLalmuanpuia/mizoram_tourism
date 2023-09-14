<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\OccupancyRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Occupancy;

class OccupancyControllerApi extends Controller
{
  private OccupancyRepositoryInterface $OccupancyRepository;
  public function __construct(OccupancyRepositoryInterface $OccupancyRepository)
  {
    $this->OccupancyRepository = $OccupancyRepository;
  }

  public function index()
  {
    return [
      'data' => $this->OccupancyRepository->getAllModel()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->OccupancyRepository->createModel($request->all())
    ];
  }

  public function show($id)
  {
    return ['data' => $this->OccupancyRepository->getModelById($id)];
  }

  public function edit(Occupancy $Occupancy)
  {
  }

  public function update(Request $request, Occupancy $Occupancy)
  {
    return $this->OccupancyRepository->updateModel($Occupancy->id, $request->all());
  }

  public function destroy($id)
  {
    return $this->OccupancyRepository->deleteModel($id);
  }

  public function getByRole($id)
  {

    $user = User::find($id);
    $facility_name = '';

    switch ($user->role) {
      case "admin":
        // $occupancies = Occupancy::with(['user', 'occupancyDetails'])->get();
        $occupancies = Occupancy::with(['user', 'occupancyDetails'])->orderBy('created_at', 'desc')->paginate(10);
        // foreach ($occupancies as $occupancy) {

        //   $user = User::with('lodges')->find($occupancy->users_id);
        //   $role = $user->role;
        //   if ($role == 'lodge') {
        //     $facility_name = $user->lodges[0]->name;
        //   } else {
        //     $facility_name = $user->name;
        //   }
        //   $occupancy->facility_name = $facility_name;
        // }

        return [
          'data' => $occupancies
        ];
        break;
      case "lodge":
      case "hotel":
        $occupancies = Occupancy::with(['user', 'occupancyDetails'])->where('users_id', $user->id)->paginate(10);
        // $occupancies = Occupancy::with(['user', 'occupancyDetails'])->where('users_id', $user->id)->get();
        // foreach ($occupancies as $occupancy) {

        //   $user = User::with('lodges')->find($occupancy->users_id);
        //   $role = $user->role;
        //   if ($role == 'lodge') {
        //     $facility_name = $user->lodges[0]->name;
        //   } else {
        //     $facility_name = $user->name;
        //   }
        //   $occupancy->facility_name = $facility_name;
        // }

        return [
          'data' => $occupancies
        ];
        break;
    }
  }

  public function fiterByMonthAndYear($month, $year)
  {
    $occupancy = '';
    if ($month == "none" && $year == "none") {
      // $occupancy = Occupancy::with(['user', 'occupancyDetails'])->all();
      $occupancy = Occupancy::with(['user', 'occupancyDetails'])->paginate(10);
    } else if ($month == "none" && $year != "none") {
      // $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('year', $year)->get();
      $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('year', $year)->paginate(10);
    } else if ($month != "none" && $year == "none") {
      // $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('month', $month)->get();
      $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('month', $month)->paginate(10);
    } else if ($month != "none" && $year != "none") {
      // $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('month', $month)->where('year', $year)->get();
      $occupancy = Occupancy::with(['user', 'occupancyDetails'])->where('month', $month)->where('year', $year)->paginate(10);
    }

    return [
      'data' => $occupancy
    ];
  }
}
