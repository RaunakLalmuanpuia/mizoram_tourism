<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function getAllCategory();
    public function getCategoryById($CategoryId);
    public function deleteCategory($CategoryId);
    public function createCategory(array $CategoryDetails);
    public function updateCategory($CategoryId, array $newDetails);

}