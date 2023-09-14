<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    public function getAllCategory(){
        return Category::all();
    }

      
    public function createCategory(array $CategoryDetails){
        return Category::create($CategoryDetails);

    }
    
    public function getCategoryById($CategoryId){
        return Category::findOrFail($CategoryId);

    }
 
    public function updateCategory($CategoryId, array $newDetails){
        return Category::whereId($CategoryId)->update($newDetails);

    }

    public function deleteCategory($CategoryId){
        return Category::destroy($CategoryId);

    }

}
