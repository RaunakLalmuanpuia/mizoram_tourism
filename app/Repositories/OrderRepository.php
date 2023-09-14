<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Amenity;

class OrderRepository implements OrderRepositoryInterface 
{
    public function getAllOrders() 
    {
        return Amenity::all();
    }
 
}
