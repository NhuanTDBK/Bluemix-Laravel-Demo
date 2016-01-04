<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class PostRecommend extends Model
{
    //
    protected $table="recommends";
    protected $primaryKey = "id";
    public static function getPosts($post_id){
        $list_id = PostRecommend::where("post_id",$post_id)->orderBy("rank","desc")->take(10)->get(["post_id_recommend"]);
        $results = UserPosts::whereIn("post_id",$list_id)->get();
        return $results;
    }
    public static function setRecommend(){
        $user_id = Auth::user()->user_id;
        $list_post = Post::where("user_id",'!=',$user_id)->get();
        foreach($list_post as $post){
//            $list_id = (array) DB::select(DB::raw("SELECT * FROM user_posts WHERE user_id != ".$user_id." ORDER BY RAND() LIMIT 10"));
            $list_id = Post::where("user_id","!=",$user_id)->orderByRaw("rand()")->take(5)->get();
            foreach($list_id as $id){
                $recommend = new PostRecommend;
                $recommend->post_id=$post["post_id"];
                $recommend->post_id_recommend = $id["post_id"];
                $recommend->rank = 1.0;
                $recommend->save();
            }
//            print_r($post);
        }
        return $list_id;
    }
}
