<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Index',[
            'users'=>User::all()->map(function ($user){
                return [
                    'id'=>$user->id,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'edit_url'=>route('user.edit',$user)
                ];
            })
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {

    }


    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}