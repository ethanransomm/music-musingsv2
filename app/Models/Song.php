<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    public function album()
    {
        return $this->belongsTo(Albums::class);
    }

    public function artist()
    {
        return $this->hasOneThrough(
            Artists::class,
            Albums::class,
            'artist_id', // Foreign key on Albums table...
            'id', // Foreign key on Artists table...
            'album_id', // Local key on Songs table...
            'artist_id' // Local key on Albums table...
        );
    }

    

   

    //
}
