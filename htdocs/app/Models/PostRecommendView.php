<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostRecommendView extends Model
{
    //
    protected $table="recommend_view";
    public static function getPosts($post_id){
        $photo_id = Post::where('post_id',$post_id)->get(['photo_link'])[0]["photo_link"];
        $list_id = PostRecommendView::where("photo_id",$photo_id)->orderBy("rank","desc")->take(10)->get(["post_id_recommend"]);
        $results = UserPosts::whereIn("post_id",$list_id)->distinct('photo_link')->get();
        return $results;
    }
}
