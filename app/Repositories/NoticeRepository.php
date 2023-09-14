<?php

namespace App\Repositories;

use App\Interfaces\NoticeRepositoryInterface;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Image;
use File;
use Illuminate\Support\Facades\Log;

class NoticeRepository implements NoticeRepositoryInterface 
{
    public function getAllNotice(){
        return Notice::all();
    }

      
    public function createNotice(array $noticeDetails){

         $notice = Notice::create($noticeDetails['data']);

        foreach ($noticeDetails['images'] as $image){
            $path = public_path('post_images');
            if (!file_exists($path)) {
              mkdir($path, 0777, true);
            }
            $from = public_path('tmp/uploads/' . $image['name']);
            $to = public_path('post_images/' . $image['name']);  
            File::move($from, $to);   

            //CREATE IMAGE DB
            $mImage = new Image();
            $mImage->name = $image['name'];
         //   $mImage->district_id = '';
        //    $mImage->model = 'Notice';
          //  $mImage->model_id = $notice->id;
            $mImage->save();

            $notice->images()->attach($mImage->id);

        }
      
        return $notice;
    }
    
    public function getNoticeById($noticeId){
        return Notice::with('images')->findOrFail($noticeId);

    }
 
    public function updateNotice($noticeId, array $newDetails){
        $notice = Notice::whereId($noticeId)->update($newDetails['data']);
        
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

                Notice::find($noticeId)->images()->attach($mImage->id);

            }
        }

        if (isset($deletedMedia)){
            foreach($deletedMedia as $deleted){
                File::delete(public_path('post_images/'.$deleted['name']));
                Image::where('name',$deleted['name'])->delete();
            }
        }
        return $notice;
    }

    public function deleteNotice($noticeId){
        return Notice::destroy($noticeId);

    }

}
