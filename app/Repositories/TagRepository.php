<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface 
{
    public function getAllTag(){
        return Tag::with('districtTopDestinations')->get();

    }

      
    public function createTag(array $tagDetails){
        return Tag::create($tagDetails);

    }
    
    public function getTagById($tagId){
        return Tag::findOrFail($tagId);

    }
 
    public function updateTag($tagId, array $newDetails){
        return Tag::whereId($tagId)->update($newDetails);

    }

    public function deleteTag($tagId){
        return Tag::destroy($tagId);

    }

}
