<?php

namespace App\Repositories;

use App\Interfaces\AboutRepositoryInterface;
use App\Models\About;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;

class AboutRepository implements AboutRepositoryInterface 
{
    public function getAllAbout(){
        return About::with('images')->get();
    }
      
    public function createAbout(array $aboutDetails){
        $about = About::create($aboutDetails['data']);

        //MOVE THE IMAGE TO FOLDER
        foreach($aboutDetails['images'] as $image) {
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

            $about->images()->attach($mImage->id);
        }
    }
    
    public function getAboutById($aboutId){
         return About::with('images')->findOrFail($aboutId);
    }
 
    public function updateAbout($aboutId, array $newDetails){
        $about = About::whereId($aboutId)->update($newDetails['data']);
        
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

                About::find($aboutId)->images()->attach($mImage->id);

            }
        }

        if (isset($deletedMedia)){
            foreach($deletedMedia as $deleted){
                File::delete(public_path('post_images/'.$deleted['name']));
                Image::where('name',$deleted['name'])->delete();
            }
        }
        return $about;

    }

    public function deleteAbout($aboutId){
        return About::destroy($aboutId);
    }

   
}
