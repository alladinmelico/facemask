<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['user.followers','comments'])->orderBy('updated_at','DESC')->paginate(10)->map(function($post){
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
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'body' => 'required|min:3',
            'cover_id' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Post::create($validatedData);

        return redirect()->back()->with('success', 'Post added');
    }

    public function show(Post $post)
    {
        $post = Post::with(['user','comments.user'])->find($post->id);
        return Inertia::render('Post/Show',compact('post'));
    }

    public function edit(Post $post)
    {
        if (! Gate::allows('update-delete-post', $post)) {
            abort(403);
        }
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (! Gate::allows('update-delete-post', $post)) {
            abort(403);
        }
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'body' => 'required|min:3',
            'cover_id' => 'required'
        ]);
        $post->update($validatedData);

        return redirect()->back()->with('success','Post was successfully updated');
    }

    public function destroy(Post $post)
    {
        if (! Gate::allows('update-delete-post', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->back()->with('warning','Post has been deleted');
    }

    public function updateCover(Request $request, Post $post){
        $validatedData = $request->validate([
            'cover_id' => 'required'
        ]);

        $post->update($validatedData);

        return redirect()->back()->with('success', 'Cover updated successfully');
    }
}