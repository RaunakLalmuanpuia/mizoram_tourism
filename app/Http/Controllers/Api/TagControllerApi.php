<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\TagRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagControllerApi extends Controller
{
    private TagRepositoryInterface $tagRepository;
    
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->tagRepository->getAllTag()
        ];   
    }

    public function create()   {  }

    public function store(Request $request)
    {
       return [
        'data' => $this->tagRepository->createTag($request->all())
    ];
    }

    public function show(Tag $tag)
    {
        return $this->tagRepository->getTagById($tag->id);
    }

    public function edit(Tag $tag){}

    public function update(Request $request, Tag $tag)
    {
        return $this->tagRepository->updateTag($tag->id, $request->all());
    }

    public function destroy(Tag $tag)
    {
        return $this->tagRepository->deleteTag($tag->id);
    }
}
