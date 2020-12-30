<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
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
                    ->with(['messages','sender','receiver'])->orderBy('created_at', 'DESC')->get();

    }

    public function sendMessage(Request $request)
    {
        dd($request);
    	$chat = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

    	broadcast(new ChatEvent($chat->load('user')))->toOthers();

    	return ['status' => 'success'];
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