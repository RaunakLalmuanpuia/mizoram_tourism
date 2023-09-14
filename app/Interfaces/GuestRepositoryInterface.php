<?php

namespace App\Interfaces;

interface GuestRepositoryInterface 
{
    public function getAllGuest();
    public function getGuestById($guestId);
    public function deleteGuest($guestId);
    public function createGuest(array $guestDetails);
    public function updateGuest($guestId, array $newDetails);

}