<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Artist;

class Album extends Model
{
    use HasFactory;

    // Model fillable attributes.
    protected $fillable = [
        'title',
        'artist_id',
        'release_date',
        'genre',
    ];

    // An album belongs to an artist.
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    // An album has many songs.
    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id');
    }


    // An album has many ratings.
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }


    // Many albums have many favourites by many users.
    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'user_album_favourites', 'album_id', 'user_id')->withTimestamps();
    }

    // Check if the album is favourited by a specific user.
    public function isFavouritedBy($user)
    {
        if (!$user) return false;
        return $this->favouritedBy()->where('user_id', $user->id)->exists();
    }

}






