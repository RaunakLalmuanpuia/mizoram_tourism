<?php

namespace App\Repositories;

use App\Interfaces\FestivalRepositoryInterface;
use App\Models\Festival;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;

class FestivalRepository implements FestivalRepositoryInterface 
{
    public function getAllFestival(){
        return Festival::with('images')->get();
    }

      
    public function createFestival(array $festivalDetails){
        $festival = Festival::create($festivalDetails['data']);

        //MOVE THE IMAGE TO FOLDER
        foreach($festivalDetails['images'] as $image){
            $path = public_path('post_images');
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
            $from = public_path('tmp/uploads/'.$image['name']);
            $to = public_path('post_images/'.$image['name']);
            File::move($from,$to);

            //CREATE IMAGE DB
            $mImage = new Image();
            $mImage->name = $image['name'];
            $mImage->save();

            $festival->images()->attach($mImage->id);
        }
    }
    
    public function getFestivalById($festivalId){
        return Festival::with('images')->findOrFail($festivalId);

    }
 
    public function updateFestival($festivalId, array $newDetails){
        $festival = Festival::whereId($festivalId)->update($newDetails['data']);
        
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

                Festival::find($festivalId)->images()->attach($mImage->id);

            }
        }

        if (isset($deletedMedia)){
            foreach($deletedMedia as $deleted){
                File::delete(public_path('post_images/'.$deleted['name']));
                Image::where('name',$deleted['name'])->delete();
            }
        }
        return $festival;
    }

    public function deleteFestival($festivalId){
        return Festival::destroy($festivalId);

    }

}
