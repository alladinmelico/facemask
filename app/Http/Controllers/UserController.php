<?php

namespace App\Http\Controllers;

use App\Models\Tag;
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
        $tags = Tag::all();

        $canView = true;
        if($user->is_private){
            if($user->id != auth()->user()->id){
                if(!$user->followers->contains(auth()->user()->id)){
                    $canView = false;
                }
            }
        }
        $canEdit = $user->id == auth()->user()->id;
        $userProfile = User::with(['followers','following','posts'])->find($user->id);
        return Inertia::render('User/Show',compact('userProfile','canView','canEdit','tags'));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        if($user->id != auth()->user()->id){
            abort(403);
        }
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3|email',
            'tag_id' => 'required|exists:tags,id'
        ]);

        $validatedData['is_tag_approved'] = false;

        $user->update($validatedData);

        return redirect()->back()->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        //
    }

    public function updateCover(Request $request){
        $validatedData = $request->validate([
            'cover_id' => 'required'
        ]);
        $user = User::find(auth()->user()->id);
        $user->update($validatedData);

        return redirect()->back()->with('success', 'Cover updated successfully');
    }
}
