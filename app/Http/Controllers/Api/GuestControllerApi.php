<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\GuestRepositoryInterface;
use App\Models\Guest;

class GuestControllerApi extends Controller
{
    private GuestRepositoryInterface $guestRepository;
    public function __construct(GuestRepositoryInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->guestRepository->getAllGuest()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->guestRepository->createGuest($request->all())
        ];
    }

    public function show(Guest $guest){
        return $this->guestRepository->getGuestById($guest->id);
    }

    public function edit(Guest $guest) {   }

    public function update(Request $request, Guest $guest)
    {
        return $this->guestRepository->updateGuest($guest->id, $request->all());
    }

    public function destroy(Guest $guest)
    {
        return $this->guestRepository->deleteGuest($guest->id);
    }
}
