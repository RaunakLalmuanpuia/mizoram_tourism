<?php

namespace App\Repositories;

use App\Interfaces\DistanceRepositoryInterface;
use App\Models\Distance;
use Illuminate\Support\Facades\Log;
use File;
use App\Models\Image;

class DistanceRepository implements DistanceRepositoryInterface 
{
    public function getAllDistance(){
        return Distance::with('images')->get();
    }

      
    public function createDistance(array $distanceDetails){

        $distance = Distance::create($distanceDetails['data']);

        //MOVE THE IMAGE TO FOLDER
        foreach($distanceDetails['images'] as $image) {
            $path = public_path('post_images');
            if(!file_exists($path)) {
                mkdir($path,0777, true);
            }
            $from = public_path('tmp/uploads/' . $image['name']);
            $to = public_path('post_images/' . $image['name']);
            File::move($from,$to);
            
            //CREATE IMAGE DB
            $mImage = new Image();
            $mImage->name = $image['name'];
            $mImage->save();

            $distance->images()->attach($mImage->id);
        }

    }
    
    public function getDistanceById($distanceId){
        return Distance::with('images')->findOrFail($distanceId);

    }
 
    public function updateDistance($distanceId, array $newDetails){
        $distance = Distance::whereId($distanceId)->update($newDetails['data']);
        
        //START IMAGE ATTACHMENT
        $addedMedia = $newDetails['addedMedia'];
        $savedMedia = $newDetails['savedMedia'];
        $deletedMedia = $newDetails['deletedMedia'];

        if(isset($addedMedia)) {
            foreach($addedMedia as $image) {
                $from = public_path('tmp/uploads/'.$image['name']);
                $to = public_path('post_images/'. $image['name']);

                File::move($from, $to);

                //CREATE IMAGE DB
                $mImage = new Image();
                $mImage->name = $image['name'];
                $mImage->save();

                Distance::find($distanceId)->images()->attach($mImage->id);

            }
        }

        if (isset($deletedMedia)){
            foreach($deletedMedia as $deleted){
                File::delete(public_path('post_images/'.$deleted['name']));
                Image::where('name',$deleted['name'])->delete();
            }
        }
        return $distance;

    }

    public function deleteDistance($distanceId){
        return Distance::destroy($distanceId);

    }

}
