<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Mockery\Matcher\Not;

DEFINE("LIKE",1);
DEFINE("COMMENT",2);
DEFINE("PIN",3);
DEFINE("FOLLOW",4);
DEFINE("POST",1);
DEFINE("BOARD",2);
DEFINE("USER",3);
class Notification extends Model
{
    //

    protected $table = 'notifications';
    protected $primaryKey = 'notifi_id';
    //protected $fillable = ['notifi_id','type','sender_id','receiver_id','is_read','objectID','objectType','created_at','updated_at'];
    public function user(){
        return $this->belongsTo('User',"receiver_id");
    }

    /**
     * @param $sender
     * @param $receiver
     * @param $object
     */
    private static function createNewNotification($sender,$event){
        $noti = new Notification();
        $noti["sender_id"]=$sender;
        $noti["is_read"] = 0;
        $noti["objectType"]=POST;
        if($event instanceof FollowEvent){
            $noti["type"]=FOLLOW;
            $noti["receiver_id"]=$event["following_id"];
            if($event["follow_type"]==2)
                $noti["objectType"]=BOARD;
            else
                $noti["objectType"]=USER;
        }
        else {
            $post = Post::getPostById($event["post_id"]);
            $noti["receiver_id"] = $post["user_id"];
            if ($event instanceof LikeEvent) {
                $noti["type"] = LIKE;
                $noti["objectID"] = $event["post_id"];

            } else if ($event instanceof CommentEvent) {
                $noti["type"] = COMMENT;
                $noti["objectID"] = $event["post_id"];
            } else if ($event instanceof PinEvent) {
                $noti["type"] = PIN;
                $noti["objectID"] = $event["post_id"];
            }
        }
        return $noti;
    }
    public static function createNotification($model){
        $noti = Notification::createNewNotification(Auth::user()->user_id,$model);
        //notify to realtime channel;

        //lưu vào database
        $result = $noti->save();
        return $noti;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        //Form: {{username}} {{action}} {{object}}
        //Nhuan likes your post
        //Tung follow you
        $noti="";

        $action="";
        $username="";
        $type="";
        if($this["type"]==FOLLOW){
            $action=" follow ";
            if($this["objectType"]==USER){
                $type = " you ";
            }
            else {
                $board_title = Board::getBoardById($this->objectID)["board_title"];
                $type=" your board ".' '.$board_title;
            }
        }
        else {
            $type="your post ";
            if($this["type"]==LIKE){
                $action=" liked ";
            }
            else if($this["type"]==COMMENT){
                $action=" comment on ";
            }
            else if($this["type"]==PIN){
                $action=" pinned ";
            }
        }
        if(isset($this["sender_id"]))
            $username = User::getUserById($this["sender_id"])["name"];
        else
            $username=$this["sender_string"];
        $noti = $username.$action.$type;
        return $noti;
    }
    public static function convertToNotification($model){
        $notification = new Notification();
        $notification["notifi_id"]=$model["notifi_id"];
        $notification["objectID"]=$model["objectID"];
        $notification["objectType"]=$model["objectType"];
        $notification["type"]=$model["type"];
        $notification["updated_at"]=$model["updated_at"];
        $notification["sender_string"]=$model["sender_string"];
        return $notification;
    }
    public static function getNotifications($user_id){
        //$query = "select noti.*, ng.sent_at,ng.is_read from (SELECT noti.notifi_id,noti.objectID,max(noti.updated_at) as 'sent_at', min(noti.is_read) as 'is_read', count(distinct(noti.sender_id)) as 'sender_count', case when count(DISTINCT(noti.sender_id)) = 1 then usr.name when count(DISTINCT(noti.sender_id)) = 2 then GROUP_CONCAT(usr.name SEPARATOR ' and ') when count(DISTINCT(noti.sender_id)) > 2 then CONCAT(count(distinct(noti.sender_id)), ' users' ) end as sender_string FROM `notifications` noti join users usr on noti.sender_id = usr.user_id where usr.user_id = 11 group by noti.objectID) as ng join notifications noti on noti.notifi_id = ng.notifi_id order by ng.is_read asc,ng.sent_at desc";
        $notificationsGroup = DB::table('notifications')->select('notifications.notifi_id','notifications.objectID','notifications.objectType','notifications.type',
            DB::raw('max(notifications.updated_at) as updated_at'),
            DB::raw('min(notifications.is_read) as is_read'),
            DB::raw('count(distinct(notifications.sender_id)) as sender_count'),
            DB::raw("case
                when count(DISTINCT(notifications.sender_id)) = 1 then users.name
                when count(DISTINCT(notifications.sender_id)) = 2 then GROUP_CONCAT(users.name SEPARATOR ' and ')
                when count(DISTINCT(notifications.sender_id)) > 2 then CONCAT(count(distinct(notifications.sender_id)), ' users' )
                end as sender_string"))
            ->join('users', 'users.user_id', '=', 'notifications.sender_id')
            ->whereRaw('notifications.receiver_id = ' . $user_id)
            ->groupBy('notifications.type', 'notifications.objectID');
        $notifications = $notificationsGroup->get();
        foreach ($notifications as $noti){
            $result[]=strval(Notification::convertToNotification((array)$noti));
        }
        return new Collection($result);
    }
}
