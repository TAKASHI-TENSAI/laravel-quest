<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow',  'follow_id', 'user_id')->withTimestamps();
    }
    
    public function is_following($userid)
    {
        return $this->followings()->where('follow_id', $userid)->exists();
    }
    
    public function follow($userid)
    {
        //すでにフォロー済みではないか
        $existing = $this->is_following($userid);
        // フォローする相手がユーザ自身ではないか
        $myself = $this->id == $userid;
        
        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($userid);
        }
    }
    
    public function unfollow($userid)
    {
        //すでにフォロー済みではないか
        $existing = $this->is_following($userid);
        // フォローする相手がユーザ自身ではないか
        $myself = $this->id == $userid;
        
        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if ($existing && !$myself) {
            $this->followings()->detach($userid);
        }
    }
    
}
