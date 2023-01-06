<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chats($message = false)
    {
        $data['users']  =  User::where('id', '<>', auth()->user()->id)->get();

        if (request()->id) {

            $sendMessage            =   $message;
            $chat                   =   Chat::with('messages')->where(function ($query) use ($sendMessage) {
                                            $query->where('sender_id', auth()->user()->id)->where('receiver_id', $sendMessage->id);
                                        })->orWhere(function ($query1) use ($sendMessage) {
                                            $query1->where('sender_id', $sendMessage->id)->where('receiver_id', auth()->user()->id);
                                        })->get();
            if ($chat->isNotEmpty()) {
                $messages           =   $chat[0]->messages;
                $chatId             =   $chat[0]->id;
            } else {
                $chat               =   new Chat();
                $chat->sender_id    =   auth()->user()->id;
                $chat->receiver_id  =   $sendMessage->id;
                $chat->save();
                $messages           =   '';
                $chatId             =   $chat->id;
            }
            $data['chatId']         =   $chatId;
            $data['messages']       =    $messages;
            $data['message']        =   new Messages();
            $data['method']         =   'POST';
            $data['submitRoute']    =   'saveMessage';
            $data['userName']       =   $sendMessage->name;
        }


        return view('chat.index', $data);
    }

    public function messageBox($id)
    {
        $message  =  User::findOrfail($id);

        return $this->chats($message);
    }

    public function saveMessage(Request $request)
    {
        $message                =   new Messages();
        $message->message       =   $request->message;
        $message->sender_id     =   auth()->user()->id;
        $message->chat_id       =   $request->chat_id;
        $message->save();

        return back();
    }
}
