<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function artist()
    {
        return $this->hasOneThrough(
            Artist::class,
            Album::class,
            'artist_id', // Foreign key on Albums table...
            'id', // Foreign key on Artists table...
            'album_id', // Local key on Songs table...
            'artist_id' // Local key on Albums table...
        );
    }

    

   

    //
}
