<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request){
        $toSearch = '%'.$request->search.'%';

        $posts = Post::where('name','like',$toSearch)->orWhere('body','like',$toSearch)
                        ->with('user.followers')
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
        $comments = Comment::where('comment','like',$toSearch)->with('user')->get();
        $users = User::where('name','like',$toSearch)->orWhere('email','like',$toSearch)->get();

        return Inertia::render('Search',compact('posts','comments','users'));
    }
}
