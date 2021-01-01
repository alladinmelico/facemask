<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Bookmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','body','user_id','cover_id'
    ];

    protected $appends = ['date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function getAllCommentsAttribute()
    {
        $comments = Comment::where('commentable_id', $this->id)->with('user')->get();
        $comments_by_id = new Collection;

        foreach ($comments as $comment)
        {
            $comments_by_id->put($comment->id, $comment);
        }


        foreach ($comments as $key => $comment)
        {
            $comments_by_id->get($comment->id)->replies = new Collection;

            if (!is_null($comment->parent_id))
            {
                $comments_by_id->get($comment->parent_id)->replies->push($comment);
                unset($comments[$key]);
            }
        }
        return $comments->values();
    }

    public function getTotalCommentsAttribute(){
        return Comment::where('commentable_id', $this->id)->count();
    }

    public function userCanSee()
    {
        return $this->with('user');
    }

    public function getDateAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'like')->using(Like::class)->withTimestamps();
    }

    public function bookmarks(){
        return $this->belongsToMany(User::class, 'bookmark')->using(Bookmark::class)->withTimestamps();
    }

    public function getTotalLikesAttribute(){
        return $this->likes->count();
    }

    public function getTotalBookmarksAttribute(){
        return $this->bookmarks->count();
    }

    public function getIsLikedAttribute(){
        return $this->likes()->get()->pluck('id')->contains(auth()->user()->id);
    }

    public function getIsBookmarkedAttribute(){
        return $this->bookmarks()->get()->pluck('id')->contains(auth()->user()->id);
    }
}