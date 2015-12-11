<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\LikeEvent;
use Auth;
class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function likePost($post_id)
    {
        if(!Auth::check()){
            return response()->json('Please login');
        }
        $current_id = Auth::user()->user_id;
        $avatar_link = Auth::user()->avatar_link;
        $name = Auth::user()->name;
        $post= LikeEvent::checkLiked($post_id,$current_id);
        $channel = Post::getPostById($post_id)["user_id"];
        if(!$post){
            $result = LikeEvent::createLikeEvent($post_id,$current_id);
            $pusher = App::make('pusher');

            $pusher->trigger( $channel,
                            'like', 
                            array('name' => $name,
                                'post_id' => $post_id,
                                'avatar_link' => $avatar_link));
        }else{
            $result = LikeEvent::removeLikeEvent($post["like_event_id"]);
        }
        return response()->json(["result"=>$result]);
    }
}
