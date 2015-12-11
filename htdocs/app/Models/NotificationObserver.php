<?php

namespace App\Models;
use App\Models\Notification;
use Mockery\CountValidator\Exception;

class NotificationObserver implements AbstractObserver
{
    //
    public function saved($model){
        //Lưu vào db
        return Notification::createNotification($model);
    }
    public function saving($model){

    }
    public function deleted($model){
        try {
            $noti = Notification::where("objectID", $model["post_id"])->where('sender_id',$model["user_id"])->delete();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function deleting($model){

    }

}
