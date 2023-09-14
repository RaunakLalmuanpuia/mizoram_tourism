<?php

namespace App\Repositories;

use App\Interfaces\PledgeRepositoryInterface;
use App\Models\Pledge;

class PledgeRepository implements PledgeRepositoryInterface
{
    public function getAllModel(){
        // return Pledge::with('user')->get();
        return Pledge::with('user')->orderBy("created_at", "desc")->paginate(15);
    }


    public function createModel(array $modelDetails){
        return Pledge::create($modelDetails);

    }

    public function getModelById($modelId){
        return Pledge::with('user')->findOrFail($modelId);

    }

    public function updateModel($modelId, array $newDetails){
        return Pledge::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return Pledge::destroy($modelId);

    }

}
