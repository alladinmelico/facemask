<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['user.followers','comments'])->orderBy('updated_at','DESC')->get()->map(function($post){
            return [
                'id'=>$post->id,
                'name' => $post->name,
                'body' => $post->body,
                'user_id'=>$post->user_id,
                'cover_id'=>$post->cover_id
            ];
        });

        return Inertia::render('Post/Index',compact('posts'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}