<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function myPosts()
    {
        return $this->hasMany(Post::class,'user_id','id');
    }

    public function profile_image()
    {
        return $this->hasOne(Image::class,'imageable_id','id');
    }

    public function latestPost()
    {
        return $this->posts()->orderBy('id','desc')->paginate();
    }
    public function photo()
    {
        if($this->profile_image){
            return $this->profile_image->path;
        }

        return '/storage/images/profile_avater_full.png';
    }
}
