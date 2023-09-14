<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryControllerApi extends Controller
{
    private CategoryRepositoryInterface $CategoryRepository;
    public function __construct(CategoryRepositoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->CategoryRepository->getAllCategory()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->CategoryRepository->createCategory($request->all())
        ];
    }

    public function show($id){
        return $this->CategoryRepository->getCategoryById($id);
    }

    public function edit(Category $Category) {   }

    public function update(Request $request, $id)
    {
        return $this->CategoryRepository->updateCategory($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->CategoryRepository->deleteCategory($id);
    }
}
