<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'body',
    // ];

    protected $guarded = []; //Data don't want to input

    public function isOwnPost()
    {
        return Auth::check() && $this->user_id == Auth::id();
    }

    // public function user()
    // {
    //     // return $this->belongsTo(User::class,'user_id','id');

    //     return $this->belongsTo(User::class);
    // }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');

        // return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
}
