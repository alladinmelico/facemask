<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user.followers')
                ->orderBy('updated_at','DESC')
                ->paginate(10)
                ->transform(function ($post) {
                return [
                    'id' => $post->id,
                    'name' => $post->name,
                    'body' => $post->body,
                    'cover_id' => $post->cover_id,
                    'date' => $post->date,
                    'user_id' => $post->user_id,
                    'user' => $post->user->only(['id','name', 'email','tag','profile_photo_path','is_tag_approved','is_private','profile_photo_url']),
                    'is_follower' => $post->user->is_follower,
                    'total_comments' => $post->total_comments

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
        $comments = $post->all_comments;
        // dd($comments);
        return Inertia::render('Post/Show',compact('post','comments'));
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