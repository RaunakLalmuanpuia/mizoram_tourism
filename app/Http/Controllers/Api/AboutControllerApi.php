<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AboutRepositoryInterface;
use App\Models\About;
class AboutControllerApi extends Controller
{
    private AboutRepositoryInterface $aboutRepository;
    public function __construct(AboutRepositoryInterface $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->aboutRepository->getAllAbout()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->aboutRepository->createAbout($request->all())
        ];
    }

    public function show(About $about){
        return $this->aboutRepository->getAboutById($about->id);
    }

    public function edit(About $about) {   }

    public function update(Request $request, About $about)
    {
        return $this->aboutRepository->updateAbout($about->id, $request->all());
    }

    public function destroy(About $about)
    {
        return $this->aboutRepository->deleteAbout($about->id);
    }

}
