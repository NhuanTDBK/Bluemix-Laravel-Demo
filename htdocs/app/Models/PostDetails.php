<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikeEvent;
use App\Models\CommentEvent;
use App\Models\PinEvent;
class PostDetails extends Model
{
    //
    protected $table = 'post_detail';
    public static function getDetails($post_id){
            $result["post_id"] = $post_id;
            $result["likes"] = LikeEvent::where('post_id',$post_id)->count();
            $result["comments"] = CommentEvent::where('post_id',$post_id)->count();
            $result["pins"] = PinEvent::where('post_id',$post_id)->count();
            return $result;
    }
}
