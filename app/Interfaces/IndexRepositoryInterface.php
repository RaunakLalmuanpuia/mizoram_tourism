<?php

namespace App\Interfaces;

interface IndexRepositoryInterface 
{
    public function getAllIndex();
    public function getIndexById($IndexId);
    public function deleteIndex($IndexId);
    public function createIndex(array $IndexDetails);
    public function updateIndex($IndexId, array $newDetails);

}