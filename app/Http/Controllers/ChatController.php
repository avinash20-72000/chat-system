<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chats($user = false)
    {

        $allUsers           =   User::select('users.id','users.name','users.online_status','users.image', 'messages.created_at')
                                    ->leftJoin('messages','messages.sender_id','users.id')
                                    ->where('users.id', '<>', auth()->user()->id)->orderBy('messages.created_at','desc')->get()->groupBy('name');
// dd($allUsers);
        $users              =   [];
        foreach($allUsers as $key=>$dataUsers)
        {
            $users[$key] =   $dataUsers->first();
        }

        $data['users']              =     $users;

        if (request()->id) {

            $sendMessage            =   $user;
            $chat                   =   Chat::with('messages')->where(function ($query) use ($sendMessage) {
                                            $query->where('sender_id', auth()->user()->id)->where('receiver_id', $sendMessage->id);
                                        })->orWhere(function ($query1) use ($sendMessage) {
                                            $query1->where('sender_id', $sendMessage->id)->where('receiver_id', auth()->user()->id);
                                        })->first();
            if (!empty($chat)) {
                $messages           =   $chat->messages;
                $chatId             =   $chat->id;
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
            $data['user']           =   $sendMessage;
        }


        return view('chat.index', $data);
    }

    public function messageBox($id)
    {
        $user  =  User::findOrfail($id);
        
        return $this->chats($user);
    }

    public function saveMessage(Request $request)
    {
        $message                =   new Messages();
        $message->message       =   $request->message;
        $message->sender_id     =   auth()->user()->id;
        $message->chat_id       =   $request->chat_id;
        $message->save();

        $link       =   route('messageBox',['id' =>$request->receiver_id ]);
        
        send_notification($request->receiver_id, 'You have a new message from' .  auth()->user()->name, $link, 'new message');

        return back();
    }

    public function getUsers(Request $request)
    {
        $data   = $request->all();
        $query  = $data['query'];

        $filter_data = User::select('name','id')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json($filter_data);
    }
}
