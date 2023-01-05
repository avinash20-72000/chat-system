<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chats($message=false)
    {
        $data['users']  =  User::where('id','<>',auth()->user()->id)->get();

        if(request()->id)
        {

            $sendMessage            =   $message;
            $data['chatting']       =   Messages::with('chats')->whereHas('chats', function($query) use($sendMessage)
                                        {
                                            $query->where('sender_id',$sendMessage->id)->orWhere('receiver_id',$sendMessage->id);
                                        })->get();
                                        // dd($data['chatting']);
            $data['message']        =   new Messages();
            $data['method']         =   'POST';
            $data['submitRoute']    =   'saveMessage';
            $data['sendMessage']    =   $sendMessage;
        }
        
        
        return view('chat.index',$data);
    }

    public function messageBox($id)
    {
        $message  =  User::findOrfail($id);

        return $this->chats($message);
    }

    public function saveMessage(Request $request)
    {
        $chat               =   new Chat();
        $chat->sender_id    =   auth()->user()->id;
        $chat->receiver_id    =   $request->receiver_id;
        $chat->save();
        $message            =   new Messages();
        $message->message   =   $request->message;
        $message->chat_id   =   $chat->id;
        $message->save();

        return back();
    }
}
