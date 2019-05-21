<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Events\NewMessageAdded;
class ChatController extends Controller
{
    public function get_index(){
        $messages = Message::all();
        return view('chat.index',['messages'=>$messages]);
    }

    public function send(Request $request){
        $message = Message::create($request->all());
        event(
          new NewMessageAdded($message)
        );
        return back();
    }
}
