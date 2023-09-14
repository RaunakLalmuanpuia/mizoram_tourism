<?php

namespace App\Interfaces;

interface RestaurantRatingRepositoryInterface 
{
    public function getAllModel();
    public function getModelById($modelId);
    public function deleteModel($modelId);
    public function createModel(array $modelDetails);
    public function updateModel($modelId, array $newDetails);

}