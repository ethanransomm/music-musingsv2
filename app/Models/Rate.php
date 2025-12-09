<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    use HasFactory;

    protected $fillable = [
        "user_id",
        "album_id",
        "score",    
        'title',
        "comment",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }



}


