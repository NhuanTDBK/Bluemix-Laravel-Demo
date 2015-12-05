<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Board;
class UserBoard extends Model
{
    //
    protected $table = "user_board";
    public static function getBoardById($board_id){
        $result["board"] = Board::where('board_id',$board_id)->first();
        $result["posts"] = UserPosts::where('board_id',$board_id)->get();
        $result["board"]["cover_link"] = $result["posts"][0]["photo_link"];
        $result["profile"]["number_of_posts"] = Post::where('board_id',$board_id)->count();
        $result["profile"]["number_of_following"] = FollowEvent::countFollower($board_id);
        return $result;
    }
}
