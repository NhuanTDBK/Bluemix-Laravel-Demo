<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
	protected $table = 'messages';
	protected $primaryKey = "conversation_id";
    public function getMessages($user_id){

    }
    public function createChannel($sender,$receiver){
        $result = min($sender,$receiver).':'.max($sender,$receiver);
        return $result;
    }
    public function generateData(){
//        $list_userid = User::all("user_id");
//        $sender_id = 11;
//        $receiver_id = 13;
//        $faker = Faker::create();
//        $date = $faker->dateTimeThisYear($max='now');
//        for($i=0;$i<20;$i++){
//            $noti = new Message();
//            $re=rand(10,13);
//            $se=rand(10,13);
//            while($re==$se){
//                $re=rand(10,13);
//                $se=rand(10,13);
//            }
//            $noti["sender_id"]=$re;
//            $noti["receiver_id"]=$re;
//            $noti["text"]=$faker->realText();
//            $noti["created_at"]=$faker->dateTimeThisYear($max='now');
//            $noti["TID"]=$this->createChannel($se,$re);
//            $noti->save();
//        }
//        return $list_userid;
    }
    public function getConversation($from,$to){
        $channel = $this->createChannel($from,$to);
        $messages = Message::where("TID",$channel)->take(20)->orderBy('created_at','desc')->get();
        return $messages;
    }
    public function getInbox($user_id){
       $maxDate = DB::table('messages')->select('conversation_id',DB::raw('max(created_at)'))->groupBy("TID")->toSQL();
       $query = DB::table('messages as msg')->select("sender_id","receiver_id","text","msg.created_at",
                                               DB::raw(sprintf('case
                                                                    when sender_id = %d then receiver_id
                                                                    when receiver_id = %d then sender_id
                                                                end as people',$user_id,$user_id)))
                                    ->leftJoin(DB::raw(sprintf('(%s) as dates',$maxDate)),'dates.conversation_id','=','msg
                                    .conversation_id')
                                    ->where('sender_id',$user_id)
                                    ->orWhere('receiver_id',$user_id)
                                    ->groupBy('TID')
                                    ->orderBy('created_at');
       return $query->get();
    }
}
