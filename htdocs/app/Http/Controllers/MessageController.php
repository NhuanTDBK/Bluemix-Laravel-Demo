<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

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
