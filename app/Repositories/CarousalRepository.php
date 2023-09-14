<?php

namespace App\Repositories;

use App\Interfaces\CarousalRepositoryInterface;
use App\Models\Carousal;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;

class CarousalRepository implements CarousalRepositoryInterface 
{
    public function getAllModel(){
        return Carousal::with('images')->get();
    }

      
    public function createModel(array $modelDetails){
        $carousal = Carousal::create($modelDetails['data']);

        //MOVE THE IMAGE TO FOLDER
        foreach($modelDetails['images'] as $image){
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

            $carousal->images()->attach($mImage->id);
        }
    }
    
    public function getModelById($modelId){
        return Carousal::with('images')->findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){

        $carousal = Carousal::whereId($modelId)->update($newDetails['data']);

        //START IMAGE ATTACHEMENT
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

                Carousal::find($modelId)->images()->attach($mImage->id);

            }
        }

        if (isset($deletedMedia)){
            foreach($deletedMedia as $deleted){
                File::delete(public_path('post_images/'.$deleted['name']));
                Image::where('name',$deleted['name'])->delete();
            }
        }
        return $carousal;

    }

    public function deleteModel($modelId){
        return Carousal::destroy($modelId);

    }

}
