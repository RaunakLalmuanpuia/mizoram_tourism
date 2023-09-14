<?php

namespace App\Interfaces;

interface UserBookingRepositoryInterface 
{
    public function getAllUserBooking();
    public function getUserBookingById($userBookingId);
    public function deleteUserBooking($userBookingId);
    public function createUserBooking(array $userBookingDetails);
    public function updateUserBooking($userBookingId, array $newDetails);

    public function checkOut($userBookingId);
}