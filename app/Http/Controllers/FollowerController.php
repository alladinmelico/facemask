<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(User $user)
    {
        if($user->is_follower){
            abort(403);
        }
        Follower::create([
            'user_id'=>$user->id,
            'user_follower_id' => auth()->user()->id
        ]);
        return redirect()->back();
    }

    public function show(Follower $follower)
    {
        //
    }

    public function edit(Follower $follower)
    {
        //
    }

    public function update(Request $request, Follower $follower)
    {
        //
    }

    public function destroy(Follower $follower)
    {
    }

    public function unfollow(User $user){
        Follower::where(['user_id'=>$user->id, 'user_follower_id'=>auth()->user()->id])->delete();
        return redirect()->back();
    }
}