<?php

namespace App\Interfaces;

interface TagRepositoryInterface 
{
    public function getAllTag();
    public function getTagById($tagId);
    public function deleteTag($tagId);
    public function createTag(array $tagDetails);
    public function updateTag($tagId, array $newDetails);

}