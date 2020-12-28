<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Carbon;
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

    public function allComments(){
        return $this->morphTo();
    }

    public function userCanSee()
    {
        return $this->with('user');
    }

    public function getDateAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }
}