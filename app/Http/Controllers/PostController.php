<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Bookmark;
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
                ->paginate(10);

        $postLinks = $posts->toArray()['links'];
        array_shift($postLinks);
        array_pop($postLinks);

        // dd($postLinks);

        $posts = $posts->transform(function ($post) {
            return [
                'id' => $post->id,
                'name' => $post->name,
                'body' => $post->body,
                'cover_id' => $post->cover_id,
                'date' => $post->date,
                'user_id' => $post->user_id,
                'user' => $post->user->only(['id','name', 'email','tag','profile_photo_path','is_tag_approved','is_private','profile_photo_url']),
                'is_follower' => $post->user->is_follower,
                'total_comments' => $post->total_comments,
                'liked' => $post->is_liked,
                'bookmarked'=> $post->is_bookmarked
            ];
    });

        return Inertia::render('Post/Index',compact('posts','postLinks'));
    }

    public function getRelatedPosts(){
        $followingList = auth()->user()->following->pluck('id')->toArray();

        $posts = Post::with('user.followers')
                ->whereIn('user_id', $followingList)
                ->orderBy('updated_at','DESC')
                ->paginate(10);

        $postLinks = $posts->toArray()['links'];
        array_shift($postLinks);
        array_pop($postLinks);

        $posts = $posts->transform(function ($post) {
                return [
                    'id' => $post->id,
                    'name' => $post->name,
                    'body' => $post->body,
                    'cover_id' => $post->cover_id,
                    'date' => $post->date,
                    'user_id' => $post->user_id,
                    'user' => $post->user->only(['id','name', 'email','tag','profile_photo_path','is_tag_approved','is_private','profile_photo_url']),
                    'is_follower' => $post->user->is_follower,
                    'total_comments' => $post->total_comments,
                    'liked' => $post->is_liked,
                    'bookmarked'=> $post->is_bookmarked
                ];
        });

        $followings = auth()->user()->total_followings;
        $followers = auth()->user()->total_followers;
        $totalPosts = auth()->user()->total_posts;
        return Inertia::render('Dashboard',compact('posts','followers','followings','totalPosts', 'postLinks'));
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

    public function like(Post $post){
        $result = $post->likes()->attach(auth()->user());
        return redirect()->back();
    }

    public function unlike(Post $post){
        $post->likes()->detach(auth()->user());
        return redirect()->back();
    }

    public function bookmark(Post $post){
        $post->bookmarks()->attach(auth()->user());
        return redirect()->back();
    }

    public function removeBookmark(Post $post){
        $post->bookmarks()->detach(auth()->user());
        return redirect()->back();
    }
}