<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Events\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Chat');
    }

    public function fetchAllMessages(User $user)
    {
        $chatIds = Chat::where([['sender_id','=',auth()->user()->id],['receiver_id','=',$user->id]])
        ->orWhere(function($query) use($user){
            $query->where([['sender_id','=',$user->id],['receiver_id','=',auth()->user()->id]]);
        })->select('id')->get()->toArray();
        $chatIds = array_column($chatIds, 'id');

        return Message::with('chat')->whereIn('chat_id',$chatIds)->orderBy('created_at','ASC')->get();
        // return Chat::where([['sender_id','=',auth()->user()->id],['receiver_id','=',$user->id]])
        //             ->orWhere(function($query) use($user){
        //                 $query->where([['sender_id','=',$user->id],['receiver_id','=',auth()->user()->id]]);
        //             })
        //             ->with(['messages','sender','receiver'])->get();

    }

    public function fetchAllChats()
    {
        return Chat::where('sender_id',auth()->user()->id)
                    ->orWhere('receiver_id',auth()->user()->id)
                    ->with(['messages','sender','receiver'])->orderBy('created_at', 'ASC')->get();

    }

    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
            'receiver_id'=>'exists:users,id'
        ]);

    	$chat = Chat::where([['sender_id',auth()->user()->id],['receiver_id',$validatedData['receiver_id']]])->first();
        if(is_null($chat)){
            $chat = Chat::create(['sender_id'=>auth()->user()->id,'receiver_id'=>$validatedData['receiver_id']]);

        }

        $message = new Message();
        $message->message = $validatedData['message'];
        $message->chat()->associate($chat);
        $message->save();
        $message->chat = $chat;

        broadcast(new ChatMessage($message))->toOthers();
        return $message;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Chat $chat)
    {
        return Inertia::render('User/Chat', compact('chat'));
    }

    public function edit(Chat $chat)
    {
        //
    }

    public function update(Request $request, Chat $chat)
    {
        //
    }

    public function destroy(Chat $chat)
    {
        //
    }
}