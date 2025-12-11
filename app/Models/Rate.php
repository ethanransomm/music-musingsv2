<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    use HasFactory;

    // Model fillable attributes.
    protected $fillable = [
        "user_id",
        "album_id",
        "score",    
        'title',
        "comment",
    ];

    // A rate belongs to a user.
    public function user(){
        return $this->belongsTo(User::class);
    }

    // A rate belongs to an album.
    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }

    // A rate has many comments.
    public function comments() {
        return $this->hasMany(Comment::class);
    }

}


