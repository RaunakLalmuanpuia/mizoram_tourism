<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PledgeRepositoryInterface;
use App\Models\Pledge;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Log;

class PledgeControllerApi extends Controller
{
  private PledgeRepositoryInterface $PledgeRepository;
  public function __construct(PledgeRepositoryInterface $PledgeRepository)
  {
    $this->PledgeRepository = $PledgeRepository;
  }

  public function index()
  {
    return [
      'data' => $this->PledgeRepository->getAllModel()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->PledgeRepository->createModel($request->all())
    ];
  }

  public function show($id)
  {
    return $this->PledgeRepository->getModelById($id);
  }

  public function edit(Restaurant $Restaurant)
  {
  }

  public function update(Request $request, Restaurant $Restaurant)
  {
    return $this->PledgeRepository->updateModel($Restaurant->id, $request->all());
  }

  public function destroy($id)
  {
    return $this->PledgeRepository->deleteModel($id);
  }
  public function takePledge(Request $request)
  {
    $pledge = new Pledge();

    $pledge->user_id = $request->userId;
    $pledge->status = $request->status;
    $pledge->save();
    return response()->json($pledge->user_id);
  }
  public function getPledgeStatus(Request $request)
  {
    $id = $request->userId;
    $data = Pledge::where('user_id', $id)->get();
    return $data;
  }
}
