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

    public function fetchAllMessages($chat)
    {
        return Message::where('chat_id',$chat)->with(['sender','receiver'])->orderBy('created_at','ASC')->get();

    }

    public function fetchAllChats()
    {
        return Chat::with(['messages'=>function($query){
            $query->where('sender_id',auth()->user()->id)
            ->orWhere('receiver_id',auth()->user()->id);
        },'messages.sender','messages.receiver'])->has('messages')->orderBy('created_at','ASC')->get()->filter(function($chat, $key){
            return $chat->messages->isNotEmpty();
        })->values();
    }

    public function fetchAllFriends(){
        return Chat::with(['messages'=>function($query){
            $query->where('sender_id',auth()->user()->id)
            ->orWhere('receiver_id',auth()->user()->id);
        },'messages.sender','messages.receiver'])->has('messages')->orderBy('created_at','ASC')->get()->filter(function($chat, $key){
            return $chat->messages->isNotEmpty();
        })->values();
    }

    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
            'receiver_id'=>'exists:users,id'
        ]);
        try {
            $chat = Message::where([['sender_id',auth()->user()->id],['receiver_id',$validatedData['receiver_id']]])
                        ->orWhere(function($query) use($validatedData){
                            $query->where([['sender_id',$validatedData['receiver_id']],['receiver_id',auth()->user()->id]]);
                        })->first();
        } catch (\Throwable $th) {

        }

        if(is_null($chat)){
            $chat = Chat::create();
        } else {
            $chat = Chat::find($chat->chat_id);
        }

        $message = new Message();
        $message->message = $validatedData['message'];
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $validatedData['receiver_id'];
        $message->chat()->associate($chat);
        $message->save();

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

        //TODO: Seen message
}