<?php

namespace App\Repositories;

use App\Interfaces\IndexRepositoryInterface;
use App\Models\Index;

class IndexRepository implements IndexRepositoryInterface 
{
    public function getAllIndex(){
        return Index::all();
    }

      
    public function createIndex(array $IndexDetails){
        return Index::create($IndexDetails);

    }
    
    public function getIndexById($IndexId){
        return Index::findOrFail($IndexId);

    }
 
    public function updateIndex($IndexId, array $newDetails){
        return Index::whereId($IndexId)->update($newDetails);

    }

    public function deleteIndex($IndexId){
        return Index::destroy($IndexId);

    }

}
