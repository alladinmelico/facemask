<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Like;
use App\Models\Bookmark;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cover_id',
        'is_tag_approved',
        'tag_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url'
    ];

    protected $with = ['tag'];

    public function posts() {

        return $this->hasMany(Post::class);

    }

    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'user_follower_id');
    }

    public function following(){
        return $this->belongsToMany(User::class, 'followers', 'user_follower_id', 'user_id');
    }


    public function tag(){
        return $this->belongsTo('App\Models\Tag');
    }

    public function liked(){
        return $this->belongsToMany(Post::class, 'like')->using(Like::class)->withTimestamps();
    }

    public function bookmarked(){
        return $this->belongsToMany(Post::class, 'bookmark')->using(Bookmark::class)->withTimestamps();
    }

    public function getIsFollowerAttribute(){
        return $this->followers->contains(auth()->user()->id);
    }

    public function getIsPrivateAttribute($value){
        return $value == 1;
    }
    public function getIsTagApprovedAttribute($value){
        return $value == 1;
    }

    public function getIsLikedAttribute(){
        return $this->liked()->get()->pluck('id')->contains(auth()->user()->id);
    }

    public function getIsBookmarkedAttribute(){
        return $this->bookmarked()->get()->pluck('id')->contains(auth()->user()->id);
    }

    public function getTotalPostsAttribute(){
        return $this->posts->count();
    }

    public function getTotalFollowersAttribute(){
        return $this->followers->count();
    }

    public function getTotalFollowingsAttribute(){
        return $this->following->count();
    }

}