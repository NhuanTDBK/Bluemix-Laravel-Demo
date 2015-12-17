<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
class MessageController extends Controller
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
    public function create(Request $request)
    {
        $friend_id = $request->input("id");
        $result = User::getUserById($friend_id);
        $user_id = Auth::user()->user_id;
        $pusher = App::make('pusher');
        $pusher->trigger(strval($friend_id),'onShowChatBox',['user'=>Auth::user()]);
        $messages = new Message();
        $result["message"] = $messages->getConversation($user_id,$friend_id,5);
        return $result;
    }

    public function createchat(Request $request)
    {
        $chat = $request->input("chat");
        $channel = $request->input("channel");
        $userid = $request->input("userid");
        $friendid = $request->input("friendid");
        $pusher = App::make('pusher');

        $pusher->trigger( $friendid,
                        'chat', 
                        array('channel' => $channel));
        
        $pusher->trigger( $channel,
                        'chat', 
                        array('chat' => $chat,
                            'userid' => $userid));
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
        $text = $request->input('text');
        $receiver_id = $request->input("receiver_id");
        $result = Message::saveMessage($text,$receiver_id);
        if(!$result){
            $res = ["result"=>"failed"];
        }
        else $res = ["result"=>"done"];
        return response()->json($res);
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
    public function getInbox(){
        $message = new Message();
        $result = $message->getInbox(10);
        return response()->json($result);
    }
}
