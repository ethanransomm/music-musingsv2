<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Artist extends Model
{


    use HasFactory;

    // Model fillable attributes.
    protected $fillable = [
        'artist_name',
        'genre',
        'image_url',
    ];

    // An artist has many albums.
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

}


